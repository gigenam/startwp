<?php
/**
 * Funcionalidades generales
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 * @package startwp
 * @since   1.0.0
 */

/**
 * Modo desarrollo
 *
 * Si esta definido define( 'WP_ENVIRONMENT_TYPE', 'development' ) o
 * define( 'WP_DEBUG', 'true' ) en wp-config.php, el tema va a cargar los archivos
 * no comprimidos de estilos y scripts y le agregará un versionado aleatorio para
 * prevenir almacenamiento en la cache del navegador.
 */
// Nombre del tema.
$startwp_name = wp_get_theme( 'startwp' );

// En producción, la version del tema es agregada desde 'style.css#L7'.
$startwp_theme_version = ( 'development' === wp_get_environment_type() || WP_DEBUG )
	? microtime()
	: $startwp_name->get( 'Version' );

// En producción, carga los archivos minificados.
$startwp_theme_suffix = ( 'development' === wp_get_environment_type() || WP_DEBUG )
	? null
	: '.min';

/**
 * Importar clases
 */
require_once get_template_directory() . '/inc/core/class-enqueue.php';
require_once get_template_directory() . '/inc/core/class-setup.php';
require_once get_template_directory() . '/inc/core/class-menus.php';
// require_once get_template_directory() . '/inc/core/class-widgets.php';

require_once get_template_directory() . '/inc/setup/class-general.php';
require_once get_template_directory() . '/inc/setup/class-posts.php';
require_once get_template_directory() . '/inc/setup/class-alerts.php';

require_once get_template_directory() . '/inc/custom/class-login.php';
require_once get_template_directory() . '/inc/custom/class-customizer.php';


/**
 * Quitar acciones
 *
 * Comenta o elimina las funcionalidades que quieras utilizar, como emojis,
 * feeds y estilos nuevos del FSE (full site editing) y gutenberg, etc.
 */
//phpcs:disable
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );      // global custom properties desde WP 5.9.
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' ); // inline svg para duotones desde WP 5.9.
remove_action( 'wp_head', 'wp_generator' );                             // WP Meta.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );          // WP Emojis JS.
remove_action( 'wp_print_styles', 'print_emoji_styles' );               // WP Emojis CSS.
remove_action( 'wp_head', 'feed_links_extra', 3 );                      // Links de extra feeds como category feeds.
remove_action( 'wp_head', 'feed_links', 2 );                            // Links de general feeds: Entradas y comentarios feeds.
remove_action( 'wp_head', 'rsd_link' );                                 // Link de Really Simple Discovery service endpoint, EditURI link.
remove_action( 'wp_head', 'wlwmanifest_link' );                         // Link de Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
// Para agregar pingbacks, descomentar la linea en /inc/setup/class-general.php#L28
