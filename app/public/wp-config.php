<?php
define( 'WP_CACHE', true );

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
define( 'AUTH_KEY',          '62s!kJ5(rMGF-khM<)[rdxi5$t>DW^q6ViBdWttWwuRSUgx?cQzi8Aj.zXlC.:`e' );
define( 'SECURE_AUTH_KEY',   '+:u=$ #m2=XJg@~Col=iT4bS:*iGDwJwN2p;?8pan,gc7LtD;*d%+nj=@jJsRo-|' );
define( 'LOGGED_IN_KEY',     'XmzkfrRi<`h:Ci=Nr7K9*Cg4d{mxm_egZBhQL^j-(h?(:]1d=nKusklrb~=ij;j$' );
define( 'NONCE_KEY',         '= ~EgKG1Z`]kLSJ5Zm!k6D3G{3C2z2Ze!W*<`/W&.Xr4CYE6r$5{4j/LdTtUN$]u' );
define( 'AUTH_SALT',         '<0wZ{ZJk$Q.W)u/}OE@%CSZ(8k){-7djE5rKIURx>Hv6iU0qkR~+yU+$v+==g].+' );
define( 'SECURE_AUTH_SALT',  'L:lzh3vqc#Ali^?9MbXI3&`E=OrZf5{VcpFX{gD}UZ]I4Q%QOE}b}fx@>@Y)Ztsz' );
define( 'LOGGED_IN_SALT',    '6GI$7jJ,g,x{+j^{9PQ[konP!kBBgd*1Jyh^lI&G:=@X.!dPUTLAn.[p.JDV!fn%' );
define( 'NONCE_SALT',        '0UG~:g]YA$V|~t/>Rps~GkMyeseJ<K=k M<.Xq rz~my#h6ufzpDih(M}H_gI?:*' );
define( 'WP_CACHE_KEY_SALT', '>[2y9?10J&61)H4}E1/mFRIZf&B()bL5^(Y=SJ<J@s#DrBW?vN3{a,!|/Lx>9~ f' );


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
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
