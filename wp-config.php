<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hilltop');

/** MySQL database username */
define('DB_USER', 'smithandrowe');

/** MySQL database password */
define('DB_PASSWORD', 'kUh-ZFr-Nm6-7Yb');

/** MySQL hostname */
define('DB_HOST', 'smithandrowe.c7xfhegd9lep.ap-southeast-2.rds.amazonaws.com');

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
define('AUTH_KEY',         '#FwA7dW,m{OLFU{kDp1|qUqmDm%K9?I|E !,52&JXzgH$D/SCAT{}][zaf>XnPK-');
define('SECURE_AUTH_KEY',  'r6p%NNAPWMxKoDIFR+|UBtLBoRjv2HkNE{+d%i>&DR@}uj`rcjh&i$#Zj.4{A}Mv');
define('LOGGED_IN_KEY',    'Q7{.V#}lCNq#|mBNF!-DwRH 9qO7M9k2ePI0*ZO#^/A=}r.U8[K{PDH58$Qb!j:&');
define('NONCE_KEY',        '|l+YPAhwz#O 5l/>o@.pgJ@udc2@rttT4Upf$ujsLAqG{TV+;GEZEbM;ZoJ|NS)T');
define('AUTH_SALT',        ',}[IPB$J4]-C^[E 1^<?x`.|1it2YP`x=H=49=D^[UCVLm&<kxzC jb0}AB%FKwy');
define('SECURE_AUTH_SALT', 'h=^2*CRFnD_gO^fe};dT/FDuK|284PG4E|+~-WfW=X]=4f(7f!F%IKZO+T^w#Rc~');
define('LOGGED_IN_SALT',   'N8z|vAvb>F3g~5WG(*!+;eSIH,tw?v/;S<+)sC*Br+*96;aCL)D%(-YZ~f,oIjMR');
define('NONCE_SALT',       'MNWS @eya4+c?@3#=v e>O&bOGeB#6Z$.[u=g1,KO;$G*|z7_bM{8%gJmNVma!y0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
