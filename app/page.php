<?php
/**
 * Plantilla para las páginas
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// Agregar la plantilla de comentarios si estos están abiertos o
			// existe alguno. Para usar comentarios con todas las funcionalidades
			// por defecto, descomentar '/inc/core/class-enqueue.php#L26' y
			// modifica el archivo comments.php a gusto.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		} // Fin del loop.
		?>
	</main><!-- #main -->

<?php
get_footer();
