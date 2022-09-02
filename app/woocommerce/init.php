<?php
/**
 * Iniciar funcionalidades personalizadas para WooCommerce
 *
 * @package    startwp
 * @subpackage WooCommerce
 * @version    1.0.0
 */

add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/**
 * Cargar estilos y scripts
 */
function startwp_woocommerce_scripts() {
	wp_enqueue_style( 'startwp-woo', get_template_directory_uri() . "/css/woo{$GLOBALS['startwp_theme_suffix']}.css", null, $GLOBALS['startwp_theme_version'], 'all' );
}
add_action( 'wp_enqueue_scripts', 'startwp_woocommerce_scripts', 20 );


/**
 * Agregar nombre de página de woocommerce al <body> como clase
 *
 * @param array $classes Todas las clases por defecto del <body>.
 */
function startwp_woocommerce_body_classes( $classes ) {
	if ( is_woocommerce() && ! is_product() ) {
		$classes[] = sanitize_html_class( 'woocommerce-shop' );
	}
	return $classes;
}
add_filter( 'body_class', 'startwp_woocommerce_body_classes' );


/**
 * Cambiar el tamaño de las imágenes de las galerías de productos
 *
 * @param array $size Todas las propiedades de la galería de imágenes.
 */
function startwp_gallery_thumbnail_sizes( $size ) {
	return array(
		'width'  => 250,
		'height' => 250,
		'crop'   => 0,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'startwp_gallery_thumbnail_sizes' );


/**
 * Quitar los títulos "Descripción" e "Información adicional" de las pestañas
 * de detalles.
 */
// add_filter( 'woocommerce_product_description_heading', '__return_null' );
// add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
