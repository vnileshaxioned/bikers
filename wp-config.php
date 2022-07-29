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
define( 'DB_NAME', 'bikers' );

/** Database username */
define( 'DB_USER', 'phpmyadmin' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ' 0z7=ejI9?<wqt^<v<}Zu}`}x|4xpwQBcy<3 Snwl2GALfN|.}ZqMp%*eB~4-*]J' );
define( 'SECURE_AUTH_KEY',  'M5Z>1a9,D81tji0#hF^Io/Hv sJ<dCA@/HDl?UPqvyo^_]%]_~C3zSZD5QvHmxeG' );
define( 'LOGGED_IN_KEY',    '2#q$Bgb#P(X5m2u4{1SlMQzpQD.:=XCS_p?/Q>qG~,n@NZmsO_a<%U7$>;/op|Lc' );
define( 'NONCE_KEY',        '^9{ESP@Bv@ms6fE8ElisNJ9n^Mz!%||=[rd-/p,lXBff?(Lt 5n)-XGI<:M,ttj>' );
define( 'AUTH_SALT',        ',p5lc>Oim_,j|gvqd,(d_^%^A.W&!5e]|=i8D]<DJ/yK[5OlX/KxpGh[U;j7=sR<' );
define( 'SECURE_AUTH_SALT', '`5P@0rEu4[3,SsCAat?B-6>.TLpd^AeU}8&=y d^E&|b|e~Cnk&_w&df9##$aJF:' );
define( 'LOGGED_IN_SALT',   '}g2CI>-8QX6*(]q~-#}UrL58.vWGJHT={/4T=gKeV1.!O*@Bhiks#(lt,Fu5jO08' );
define( 'NONCE_SALT',       'l%9p(5zuz?cuTUU^TItW|=+Wb>)@pha]1k8>z$l?|{8P@]k&K5oimylVvSDx9og]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'travel_bike_';

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
