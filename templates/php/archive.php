<?php
/**
 * Plantilla para archivos del blog (fechas, autores, ect.).
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

/**
 * Este archivo no fue modificado desde que se clonó de Underscores.
 * Este archivo sirve para personalizar las diferentes vistas de archivos como
 * Mostrar entradas por fechas, categorías, etc.
 */
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Incluye la parte especifica dependiendo del post-type.
				 * Si deseas modificar esto en un tema hijo (child theme), agrega
				 * un archivo llamado content-___.php (donde ___ el nombre del
				 * post-type. Ej: page), para que sea utilizado en remplazo a este.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
