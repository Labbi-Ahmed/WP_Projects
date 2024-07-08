<?php
/*
Plugin Name: Simple CRUD Plugin
Description: A simple plugin to create a custom table and perform CRUD operations.
Version: 1.0
Author: Your Name
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class SimpleCRUDPlugin {
    public function __construct() {
        // Hooks
        register_activation_hook(__FILE__, [$this, 'create_custom_table']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    // Create custom table
    public function create_custom_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'simple_crud';
        $charset_collate = $wpdb->get_charset_collate();

        // Check if the table already exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                name tinytext NOT NULL,
                email text NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    // Add admin menu
    public function add_admin_menu() {
        add_menu_page(
            'Simple CRUD Plugin',
            'Simple CRUD',
            'manage_options',
            'simple-crud-plugin',
            [$this, 'admin_page_content'],
            'dashicons-welcome-widgets-menus',
            6
        );
    }

    // Enqueue admin scripts
    public function enqueue_admin_scripts() {
        echo plugins_url('simple-crud-plugin.js', __FILE__);
        wp_enqueue_script('simple-crud-plugin-script', plugins_url('simple-crud-plugin.js', __FILE__), ['jquery'], null, true);
    }

    // Admin page content
    public function admin_page_content() {
        echo '<div class="wrap">';
        echo '<h1>Simple CRUD Plugin</h1>';
        // CRUD operations form and table will go here
        $this->handle_form_submission();
        $this->render_form();
        $this->render_table();
        echo '</div>';
    }

    // Handle form submission
    private function handle_form_submission() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'simple_crud';

        if (isset($_POST['newsubmit'])) {
            $name = sanitize_text_field($_POST['newname']);
            $email = sanitize_text_field($_POST['newemail']);

            $wpdb->insert($table_name, ['name' => $name, 'email' => $email]);
        }

        if (isset($_POST['updatesubmit'])) {
            $id = intval($_POST['updateid']);
            $name = sanitize_text_field($_POST['updatename']);
            $email = sanitize_text_field($_POST['updateemail']);

            $wpdb->update($table_name, ['name' => $name, 'email' => $email], ['id' => $id]);

            // Hide the update form after successful update
            echo '<style>#update-form { display: none; }</style>';
            echo '<script>jQuery(document).ready(function($) { $("#update-form").hide(); });</script>';
        }

        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);

            $wpdb->delete($table_name, ['id' => $id]);
        }
    }

    // Render form
    private function render_form() {
        echo '<h2>Add New Record</h2>';
        echo '<form method="post" action="">';
        echo '<table>';
        echo '<tr><td>Name:</td><td><input type="text" name="newname" required></td></tr>';
        echo '<tr><td>Email:</td><td><input type="email" name="newemail" required></td></tr>';
        echo '<tr><td></td><td><input type="submit" name="newsubmit" value="Add"></td></tr>';
        echo '</table>';
        echo '</form>';

        if (isset($_GET['edit'])) {
            global $wpdb;
            $id = intval($_GET['edit']);
            $table_name = $wpdb->prefix . 'simple_crud';
            $record = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

            if ($record) {
                echo '<h2>Edit Record</h2>';
                echo '<form method="post" action="" id="update-form">';
                echo '<input type="hidden" name="updateid" value="' . esc_attr($record->id) . '">';
                echo '<table>';
                echo '<tr><td>Name:</td><td><input type="text" name="updatename" value="' . esc_attr($record->name) . '" required></td></tr>';
                echo '<tr><td>Email:</td><td><input type="email" name="updateemail" value="' . esc_attr($record->email) . '" required></td></tr>';
                echo '<tr><td></td><td><input type="submit" name="updatesubmit" value="Update">';
                echo ' <button type="button" id="cancel-update">Cancel</button></td></tr>';
                echo '</table>';
                echo '</form>';
            }
        }
    }

    // Render table
    private function render_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'simple_crud';
        $records = $wpdb->get_results("SELECT * FROM $table_name");

        if ($records) {
            echo '<h2>Records</h2>';
            echo '<table class="widefat fixed" cellspacing="0">';
            echo '<thead><th>Name</th><th>Email</th><th>Actions</th></tr></thead>';
            echo '<tbody>';
            foreach ($records as $record) {
                echo '<tr>';
                echo "<td style='display:none;'>" . esc_html($record->id) . '</td>';
                echo '<td>' . esc_html($record->name) . '</td>';
                echo '<td>' . esc_html($record->email) . '</td>';
                echo '<td>';
                echo '<a href="?page=simple-crud-plugin&edit=' . $record->id . '">Edit</a> | ';
                echo '<a href="?page=simple-crud-plugin&delete=' . $record->id . '" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No records found.</p>';
        }
    }
}

new SimpleCRUDPlugin();
?>
