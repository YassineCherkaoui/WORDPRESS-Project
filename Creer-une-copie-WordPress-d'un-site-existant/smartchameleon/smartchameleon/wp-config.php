<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'smartchameleon' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'F%X[=SZAM/n_8~yFceg#}* ?ibKGD<1v |;)<27FZH9f^M@LbSG{_qY/B{pE03=4' );
define( 'SECURE_AUTH_KEY',  'S3-E*|vE;jF^4|<CWb(sC>tU*4QHRC{Zx!]xwW=8H^Nq-e}u {BaD2O-%>DlI{T-' );
define( 'LOGGED_IN_KEY',    '02})BD9qKX]Gr<Y,C@t|I6DcwHBz7i&.7bI47WR-,e*LG8yrA`%Eq-$mgI c>;;V' );
define( 'NONCE_KEY',        'g6<)$qDU/h0cIX-|e,JY!i2GrDP_{)M2l{APa<MpGwng(BJY:#TKk%Bg@>VUBD=z' );
define( 'AUTH_SALT',        '-M7[>#r;h!uwy po->@xI!Sk)oXl8|40I2]+8~9F2DC[V6q*G&VRkYV?8]LN)4e[' );
define( 'SECURE_AUTH_SALT', 'w{P0nJL^&$A.;GFB9uKgz1s/i2L(${E5Dy07;bR,$TXoKY^FwfEjPw22!h809MCN' );
define( 'LOGGED_IN_SALT',   '+!S+}hC$~scUtA;lKgacQk/1@>$9k7W?GatYP&3jlYl+%f~@^.+h*0Q}8AHY]X}k' );
define( 'NONCE_SALT',       ' 6Gl2YxM3A]Su3V$|AHxu)`+5S&SIJLqIyuQB)7v`q`W1]@D?pw?WD.fS#-YFe@1' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_smartchameleon';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
