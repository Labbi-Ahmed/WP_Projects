<?php
/*
include __FILE__ . '/includes/dbConfig/Config.php';



class CurdPage{

   
    public function __construct() {

        register_activation_hook(__FILE__, 'create_db_table');
        add_action('admin_menu',[$this, 'curd_menu_page']);
    }


    public function create_db_table(){
        global $wpdb;
        global $conn;

        $tableName = $wpdb->prefix . 'custom';

        $sql = "CREATE TABLE $tableName(
            id int NOT NULL,
            name varchar(50),
            email varchar(64),
            primary key (id)
        )";


        mysqli_query($conn, $sql);

        mysqli_close($conn);

    }

    public function curd_menu_page(){
        add_menu_page(
            'curd operation',
            'curd on db',
            'manage_options',
            'curd-operation',
            [$this,'curd_page'],
            'dashicons-editor-table'
        );
    }


    public function curd_page(){

       echo 'hello';
    }

}

*/
