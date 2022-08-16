<?php
/**
 * Plantilla para el inicio del sitio
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 * @package startwp
 * @since   1.0.0
 */

/**
 * Este archivo sirve para personalizar el inicio del sitio, sin importar si es
 * una página estática o un blog.
 * En este caso de ejemplo se quitó cualquier cosa de tipo blog con el propósito
 * de mostrar un página y personalizar todo el contenido en esta desde el editor.
 */

/**
 * Si quieres tener cabecera y/o pié de página personalizados, puedes quitar las
 * funciones get_header() y get_footer() y crear en este archivo las tuyas
 * personalizadas en base a app/header.php y app/footer.php.
 * No te olvides de incluir como mínimo las funciones wp_head() y wp_footer() o
 * no se cargará ningún estilo o script.
 */
get_header();
?>

	<main id="primary" class="site-main site-main--front-page">

		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'wrapper' ); ?>>

				<?php the_content(); ?>

			</article><!-- #post-<?php the_ID(); ?> -->
			<?php
		}; // Fin del loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
