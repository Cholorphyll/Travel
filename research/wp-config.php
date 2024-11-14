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
define('DB_NAME', 'wordpress_4');

/** MySQL database username */
define('DB_USER', 'wordpress_5');

/** MySQL database password */
define('DB_PASSWORD', 'm!11DpYmU6');

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
define('AUTH_KEY',         '7BhtoLFtI^m&ihcr9ST3P&YJ9I0xlDQO%!GY@Vci4cwIMO9MRuxaRlnq3(Dl1xcm');
define('SECURE_AUTH_KEY',  '9)6yp1bXGBL4Qn9tlYeE%2z44rWf%Y(5U4(CYOZ!FJISe5@6yP3&^et6#D4p4*je');
define('LOGGED_IN_KEY',    'EqCLwce!NmwyGzTW)*Y(tz@XNMnWrCzJQKkG^%RGnoUunD2BY*fm(*6)QuWpoD@W');
define('NONCE_KEY',        'XExZtXx^ftWUbkEox&U3wtlGspCZ^!k7!pVn1F@LN@%dHlpSQw%))3iUT(7xwdg3');
define('AUTH_SALT',        'qOfUzi*IQy1ngCl2%NG6VFepq4UqkZxY)XPGWFGRFW%Tt2I^VGfHv&SwTwsi3wz%');
define('SECURE_AUTH_SALT', 'O!bWIVeoX8*wVwNzDAruAveV5v@vJs6)LjWYdL3%Av9Kv9eQ2Mw6FbupTAvi7THx');
define('LOGGED_IN_SALT',   'lZrbFnpfe*MQsMvqeLq)USt6GAoWqHOYz7Jq4lhzFUvzSKY(mLOJ92Mm&7!4zYj6');
define('NONCE_SALT',       'CZApvGWF!)33HZyR1Ln#oe4l7rMK6fAk97dDRIM)^P!MnGoZ^b*2rInwP5b9yqyf');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hc9k8aqv_';

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
