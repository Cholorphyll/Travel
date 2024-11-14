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
define('DB_NAME', 'wordpress_9');

/** MySQL database username */
define('DB_USER',       'wordpress_8');

/** MySQL database password */
define('DB_PASSWORD',       'a7Ss9TX2!y');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',       'aT#Q@c#Bt!VuiM3)!LnK4yw1EN0lLRTRf0s5)@H*&7M&b77w!z9WYbFDi46)HEAH');
define('SECURE_AUTH_KEY',       'e1DWgbTk&gSLyn4kO4NYh&WuXLk&#3hq(xvF^s7m!*jDPC!Zzc79UH@@2K2!gC(%');
define('LOGGED_IN_KEY',       'lJ0ySyEZ5Fdt@B6PicpCs9e@i&eVsQuRdocQHYd6pt)*@qq%)PwBfL0@4cGoN@Ys');
define('NONCE_KEY',       'a3vmmozc*ec*GwXCDYr0Sl*c)tISoGCysxIyZry1b9K*Qhq)twOZkrWVjywH53DW');
define('AUTH_SALT',       '&9!5csw1R9ZgBHahclxF*8ycDROALr!09ygUB(ew!mUz0vEJYnPs0bk@XBCG&9jj');
define('SECURE_AUTH_SALT',       'oDblJ!2DlD^6#lomfXK)Xm2vkCtHjHN@^8cHCStGO1iOeFD1d3P!X)ex%gZarX0T');
define('LOGGED_IN_SALT',       'us6AuCfN#Sd0xljgWu4ubtPWxG@93d)L71g^)5MI&RPZ(S(RbZ8kHr^ozBtqzMWM');
define('NONCE_SALT',       '9RVgK4%Ywv0oyFnY7c1OT3LufSDI)O%nYe13nUs!dilTPU2T3g3%ql0fiTUtpfi2');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ZWqevHMC_';

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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
