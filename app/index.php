<?php
/**
 * Plantilla principal.
 *
 * En caso de no tener otros archivos como page.php, single.php, archive.php, etc.
 * Esta va a ser siempre la utilizada por defecto.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() || is_archive() ) :
			?>
			<header class="entry-header">
				<h1 class="section-title">
					<?php is_archive() ? the_archive_title() : single_post_title(); ?>
				</h1>
			</header>
			<?php
		endif;

		while ( have_posts() ) {
			the_post();

			/**
			 * Incluye la parte especifica dependiendo del post-type.
			 * Si deseas modificar esto en un tema hijo (child theme), agrega un
			 * archivo llamado content-___.php (donde ___ el nombre del post-type.
			 * Ej: page), para que sea utilizado en remplazo a este.
			 */
			get_template_part( 'template-parts/content', get_post_type() );

		}// Fin del loop.

		the_posts_navigation();    // anterior - siguiente.
		// the_posts_pagination(); // Alternativa: < 1 2 ... >.

		get_sidebar();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;// Fin have_posts().
	?>
</main><!-- #primary -->

<?php
get_footer();
