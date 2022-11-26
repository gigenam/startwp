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

	<main id="primary" class="site-main site-main--inner">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header wrapper">
					<?php
					/**
					 * Hook: startwp_page_header
					 *
					 * @hooked Startwp_Posts_Extras->post_thumbnail - 10
					 * @hooked Startwp_Posts_Extras->post_title     - 20
					 */
					do_action( 'startwp_page_header' );
					?>
				</header><!-- .entry-header -->

				<div class="entry-content wrapper">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'startwp' ),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->

			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
			/**
			 * Agregar la plantilla de comentarios si estos están abiertos o
			 * existe alguno. Para usar comentarios con todas las funcionalidades
			 * por defecto, descomenta '/inc/core/class-enqueue.php#L27' y
			 * modifica el archivo comments.php a gusto.
			 *
			 * Revisar single.php#L20 en caso de tener WooCommerce activado.
			 */
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		} // Fin del loop.
		?>
	</main><!-- #primary -->

<?php
get_footer();
