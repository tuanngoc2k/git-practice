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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */


define( 'DB_NAME', 'duongsinhtrunghoa' );

/** Database username */
define( 'DB_USER', 'dsth' );

/** Database password */
define( 'DB_PASSWORD', 'root1234!' );

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
define( 'AUTH_KEY',         'bzkpJ:BwXMziq5wsdNkKWQ$S_Q,cZIc)i%4K;|D5a(mDM+}vr3h<CiL~fspy`P.)' );
define( 'SECURE_AUTH_KEY',  'n5ONv2GmB?3YUb(r@_GoB*`G!C|VhJC]iXc#`wfXRjhv1m ad@[!Cf=uj|pM=HcM' );
define( 'LOGGED_IN_KEY',    'hH$LFxRe/lQx<|ty)i;]<5w(tt4<+/@{_Vyv!m,<R7Qp wlJv3KfeE{j,9a?ogXy' );
define( 'NONCE_KEY',        'Z{oA3*$bbFWT^^78 Z&eK!D=7u9;Y}!tR.G4*RTd qV&j_(Nc35])URWu^UoFbf3' );
define( 'AUTH_SALT',        'nLMDH9y{aL15a[u7oZAN-u_`8lWGOA(mm8]XF!98.0`&$j6(cznKKS7tAm/pQo7q' );
define( 'SECURE_AUTH_SALT', 'VOF$HMl3 +|eumbba2_Y@|J5.SAN52e#6Kny`fh&nUYFe{q`Yuu6!Cd++p KmOYF' );
define( 'LOGGED_IN_SALT',   '99)w*A>[>gt F8aB(9fs(}q67&K$)}9n]?sz`)f~XflwgOBBPdEXAO|uePinc8eg' );
define( 'NONCE_SALT',       'ZvOJ*`_xBD<MB7/*oKi~S@XvR<,>xT$J0e~N6cI%pEl`8nbIW@OL#w2xA1XQnt0>' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
