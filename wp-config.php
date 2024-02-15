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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nvatejjtre' );

/** Database username */
define( 'DB_USER', 'nvatejjtre' );

/** Database password */
define( 'DB_PASSWORD', 'wksQnZ5URH' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define('AUTH_KEY',         'H6-5*,dTIZL+%V<+@Xo_y|jh<- Wotr|b8E8bP%Hw<>*p;Xz&&)Qj$0402?/y-)+');
define('SECURE_AUTH_KEY',  'Q`s[p1Y_>EAm|u<r3<C+EfcVo.x?N%^uV#5Ej2_GBO<#T$+))[#U|aQ5Ed+jzv,B');
define('LOGGED_IN_KEY',    ')}?<#<CAxmvS,!i1K-Ln4i,|K>Kll>O!viK>6b^R-upI2 }a6+eLNEL/.`{X{Nc!');
define('NONCE_KEY',        'ijskop1^Ur0Z$UusoH|L|i$[d0bJIJW*o_-|,f*#*2{/l5HxU:D^bgCPfDC1gfl#');
define('AUTH_SALT',        'xMZ39~]ee6-oAalM2HJW#e0= Pj0uiTE)+c7i-bc+`0wRKd#*)NY{v:+J;wuT{xr');
define('SECURE_AUTH_SALT', '!JSa[Y.Ux%kJx#$kSuJy!`|iT?6BL;J`iiV%M7Eatmq7#9WGH(BhLfveBjWFOR%@');
define('LOGGED_IN_SALT',   'j1>U39@vBA>H^=B:.`5=AP@WTXxc^jKtaBvweM;!`y/@}z/e<(-#f-*qrM*k!n ^');
define('NONCE_SALT',       'ZB41~$e-IY`=ao+)8dla;/>)F{(bMPzJ6x&[9e|;O7ZF&]yzL` /}k(-!r9K]g,$');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */

// define( 'WP_DEBUG_LOG', true );
// define( 'WP_DEBUG_DISPLAY', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
