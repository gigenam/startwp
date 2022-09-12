<?php
/**
 * Iniciar funcionalidades personalizadas para WooCommerce
 *
 * @package    startwp
 * @subpackage WooCommerce
 * @version    1.0.0
 */

if ( ! class_exists( 'Startwp_Woo_Init' ) ) {
	/**
	 * Agregar funcionalidades extras a WooCommerce
	 */
	class Startwp_Woo_Init {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			// Soporte básico.
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Acciones.
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 20 );

			// Filtros.
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_filter( 'woocommerce_currency_symbol', array( $this, 'currency_symbol' ), 9999, 2 );
			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', array( $this, 'gallery_thumbnails' ) );
			add_filter( 'woocommerce_get_price_html', array( $this, 'free_price_prefix' ), 99, 2 );

			// Quitar los títulos "Descripción" e "Información adicional" de las
			// pestañas de detalles en los productos.
			// add_filter( 'woocommerce_product_description_heading', '__return_null' );
			// add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
		}

		/**
		 * Enqueue scripts
		 */
		public function scripts() {
			wp_enqueue_style( 'startwp-woo', get_template_directory_uri() . "/css/woo{$GLOBALS['startwp_theme_suffix']}.css", null, $GLOBALS['startwp_theme_version'], 'all' );
		}

		/**
		 * Agregar clase woocommerce-shop al <body>
		 *
		 * @param array $classes Todas las clases por defecto del <body>.
		 */
		public function body_classes( $classes ) {
			if ( is_woocommerce() && ! is_product() ) {
				$classes[] = sanitize_html_class( 'woocommerce-shop' );
			}
			return $classes;
		}

		/**
		 * Cambiar el formato del simbolo según la configuración de moneda.
		 *
		 * @link https://es.wikipedia.org/wiki/ISO_4217
		 * @param  string $currency_symbol El simbolo de la moneda.
		 * @param  string $currency        El tipo de moneda.
		 * @return string
		 */
		public function currency_symbol( $currency_symbol, $currency ) {
			switch ( $currency ) {
				case 'ARS':
					$currency_symbol = 'AR$';
					break;
				case 'EUR':
					$currency_symbol = 'EU€';
					break;
				case 'USD':
					$currency_symbol = 'US$';
					break;
			}
			return $currency_symbol;
		}

		/**
		 * Cambiar el tamaño de las imágenes de las galerías de productos
		 *
		 * @param array $size Todas las propiedades de la galería de imágenes.
		 */
		public function gallery_thumbnails( $size ) {
			return array(
				'width'  => 250,
				'height' => 250,
				'crop'   => 0,
			);
		}

		/**
		 * Remplazar el valor por texto cuando los productos son gratuitos.
		 *
		 * @param  string $price   El precio del producto.
		 * @param  object $product El producto.
		 * @return string
		 */
		public function free_price_prefix( $price, $product ) {
			if ( '0' === $product->get_regular_price() ) {
				// Si el producto es gratis remplazar el 0.
				$price = sprintf( '<ins class="is-free"><bdi>' . __( 'Free', 'startwp' ) . '</bdi></ins>' );
			} elseif ( '0' === $product->get_price() ) {
				// Si el producto es gratis en oferta, tachar el precio real y
				// remplazar el 0.
				$price = sprintf(
					get_woocommerce_price_format(),
					'<del>' . wc_price( $product->get_regular_price() ) . '</del> ',
					'<ins><bdi>' . __( 'Free', 'startwp' ) . '</bdi></ins>'
				);
			}
			return $price;
		}

	} //end class.

}

new Startwp_Woo_Init();
