<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$template          = wc_get_theme_slug_for_templates();
$startwp_page_type = ( is_product() ) ? ' site-shop--inner' : '';
?>

<main id="primary" class="site-shop<?php echo esc_html( $startwp_page_type ); ?> wrapper">
<?php if ( is_product() ) : ?>
	<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>
	<?php
endif;

/**
 * Quitar resultados y opción de ordenado por defecto y agregarlos dentro de un
 * contenedor.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action(
	'woocommerce_before_shop_loop',
	function() {
		echo '<div class="woocommerce-result-ordering">';
		woocommerce_result_count();
		woocommerce_catalog_ordering();
		echo '</div>';
	},
	20
);
