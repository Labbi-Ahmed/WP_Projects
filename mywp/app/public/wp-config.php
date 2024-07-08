<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ')f`Gx+.#4H_]/7h.|G` ,<&P68>Ok>F16I4l&AnGra)RCtfhdXh,-r?)7iN?//3d' );
define( 'SECURE_AUTH_KEY',   '<DpT.#-=A<Lt}f?;bM?AZOAl.sEbf)!Pvx!GMyXo3 /02MVM@NGhe;w2]fb.:!*}' );
define( 'LOGGED_IN_KEY',     'GI=%DP/ivftZ(2g}xxiAK73:.:DT(Plr]rURofYlJkl#>mM?pSPUO=uYBak%pU|F' );
define( 'NONCE_KEY',         'mq#>SRMm;MJbHdw>KrRh`bD(2n^#/dlS1lTReaIS<l}TM{j`EYCP_-L?zL)7Xv:t' );
define( 'AUTH_SALT',         'MFd~|N1t}v]Z)n>@u LHXpZQk!b]k|fWSG^S:,3{+WT]V[<0Lwc-B05sxvUAr&.3' );
define( 'SECURE_AUTH_SALT',  'mc~iVz0[:X>.N([qTV)YCvow:{neFyHN:coT}Kz<=/sgR|IT4uhQme1Q_ .1CS;M' );
define( 'LOGGED_IN_SALT',    '`oWsjuUProV)zDG_eU:k8SdgdKoSL^jRwu5fgi^K(kIZKD=1Vs|)XI8D%qNx)_I(' );
define( 'NONCE_SALT',        'pZ9<&S_:lj,uo?pIp&A+=HEXRCxxY}> Dfvfv[~CEUK9$3xSR[0~r{>Vn.-%s_/`' );
define( 'WP_CACHE_KEY_SALT', '4[:ciXJftOQuTrJGODZ8%+UvTIihQF?8A<GB<Q;-W-M=xld=kDiB=ETma@;9vdEw' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}


if( !defined( 'WP_DEBUG_LOG' )){
	define('WP_DEBUG_LOG', true);
}

if( !defined( 'WP_DEBUG_DISPLAY' )){
	define('WP_DEBUG_DISPLAY', false); // Hide errors on the frontend

}


define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
