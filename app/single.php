<?php
/**
 * Plantilla para las entradas
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package startwp
 * @since   1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main site-main--inner">
		<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// Paginación entre entradas.
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'startwp' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'startwp' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// Agregar la plantilla de comentarios si estos están abiertos o
			// existe alguno. Para usar comentarios con todas las funcionalidades
			// por defecto, descomenta '/inc/core/class-enqueue.php#L26' y
			// modifica el archivo comments.php a gusto.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}; // Fin del loop.

		get_sidebar();
		?>
	</main><!-- #primary -->

<?php
get_footer();
