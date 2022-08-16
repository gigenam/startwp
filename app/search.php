<?php
/**
 * Plantilla para las búsquedas
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package startwp
 * @since   1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="entry-header wrapper">
				<h1 class="entry-title">
					<?php
					printf(
						/* translators: %s: Palabras de búsqueda. */
						esc_html__( 'Search results for: %s', 'startwp' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>
			</header><!-- .entry-header -->

			<?php
			while ( have_posts() ) {
				the_post();

				/**
				 * Ejecutar el loop para que la búsqueda genere los resultados.
				 * Si deseas modificar esto en un tema hijo (child theme), agrega
				 * un archivo llamado content-search.php (respetando la ruto
				 * completa) para que sea utilizado en remplazo a este.
				 */
				get_template_part( 'template-parts/content' );
			}; // Fin del loop.

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
