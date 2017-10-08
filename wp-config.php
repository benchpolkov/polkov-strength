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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'polkov_strength');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'V]t.qQW$TL*c8O5,<UT2-t}`Fab-[5-=MFv2HF0Zf7Y-iD/+cOp:SQ+l@:b0;/v#');
define('SECURE_AUTH_KEY',  'KQ>[ cz8{zl5~ gbZq<LmMSuSD`]phGB|mqI/;5RY XhK?T&pgdhLN1JB6*Y4bIL');
define('LOGGED_IN_KEY',    '+BZiY2we[~hC+E?M/i>gS!(t7~j#PL#w#v:A^K=lD1.~7zsV8b(wwR!gGeBdHGQt');
define('NONCE_KEY',        'L~1bC<D[g_6bzCv#mPw!Loy`2)43>1:%Wm i_*g3X[daK4f$7+<^+pKFXm u>9kS');
define('AUTH_SALT',        'Z19ck648O=GZPql9x%jRY;SD!uaJ4{yoL3wJ<-B|O iW=%rd(L{5Qwz3XSD<#Q#V');
define('SECURE_AUTH_SALT', 'c!`5l>p&[?#YRv[}&S-FbY7J*yAEI?:IanUjP4! au&m]]}:#ImEMm0=PgwCQob-');
define('LOGGED_IN_SALT',   'J/cNVx?tngjn~!E.Vq9@`(K-IS6 TN[d`-ADq{RV%~J>q2%MISfJ$)}<&GD~toHe');
define('NONCE_SALT',       '{P:3H(<KU)3Do6]qGU?MpA)lKEK!Ysrt)!ZX^JFNDDFc^2NU#u&~:?I[8X:kzox~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
