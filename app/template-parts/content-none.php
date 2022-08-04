<?php
/**
 * Plantilla para cuando no se encontró contenido (página o entrada)
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'not-found' ); ?>>

	<header class="entry-header wrapper">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'startwp' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content wrapper">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			printf(
				'<p>' . wp_kses(
					/* translators: 1: Enlace a WP Admin para crear una entrada nueva. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'startwp' ),
					array( 'a' => array( 'href' => array() ) )
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'startwp' ); ?></p>
			<?php
			get_search_form();

		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'startwp' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
