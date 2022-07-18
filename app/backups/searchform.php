<?php
/**
 * Plantilla para formulario de búsqueda
 *
 * @package startwp
 * @since   1.0.0
 */

/**
 * De momento este archivo no es utilizado pero sirve para personalizar el widget
 * de busqueda deWordPress. Este queda de respaldo para sitios más complejos o
 * más personalizaciones.
 */
?>

<form action="<?php echo esc_url( home_url() ); ?>" method="get" class="flexrow cross-start searchform" role="search">

	<label class="col-12 screen-reader-text" for="search"><?php esc_html_e( 'Search', 'startwp' ); ?></label>

	<input type="search" name="s" id="<?php echo esc_attr( uniqid( 'searchform-' ) ); ?>" class="col-flex searchform-input" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e( 'What are you looking for?', 'startwp' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'startwp' ); ?>" />

	<button id="<?php echo esc_attr( uniqid( 'searchform-' ) ); ?>-submit" type="submit" class="searchform-submit">
		<span><?php esc_html_e( 'Search', 'startwp' ); ?></span>
	</button>

</form>
