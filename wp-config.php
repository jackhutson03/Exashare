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
define('DB_NAME', 'exashare');

/** MySQL database username */
define('DB_USER', 'exashare');

/** MySQL database password */
define('DB_PASSWORD', 'exashare123');

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
define('AUTH_KEY',         'T8>jK5a>TNb Hf7ZP$,Pk%zODFsGMT#ljB1qS#;)L+DgPfkOzM{]JK#ma<>?nq]#');
define('SECURE_AUTH_KEY',  'Vt5Ph^=}N%#LRBB=yL||D:iLRbJa3jf6LYow3CMc?FTE:bg|h4HkD7]gkJ9-l(5^');
define('LOGGED_IN_KEY',    'Phid_U(:b :caDPxD%O;a782LK,k8V:[QuCj$8Xf@htA<x-vcH?jviuwU:mt*,(4');
define('NONCE_KEY',        ':VOouatd[1B[Q56%{n)iJ<gsr,S&Q:*Nq#L:9w9C8z8SRJ5#9>ok{v=9!]fsKrqx');
define('AUTH_SALT',        'O=W@8qGCU(<9C5rSvmPDPn%r6?yNz+sq}!Ec%N97-Dw_&h45k3rdDz+*Pgo1=$1L');
define('SECURE_AUTH_SALT', 'KigS@B >y!M+G3hYz+FMej/ q_pB]s,_iBy6K1NbQB.R?gOL3NFL&-{kh($05?#r');
define('LOGGED_IN_SALT',   'wgLm?{C54W&t:aH!ZKE=Vw!;Mv7b+7x,g}1`i|Q#f03BJ;BD$Zq&,%Q3k}C]emkt');
define('NONCE_SALT',       'eWc$}F`xA&q@iT7UV||X7Uk%pD$|Db]566Ihhk oTS:|M[*u5INnt2ia_;6QQyDR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'exashare_';

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
