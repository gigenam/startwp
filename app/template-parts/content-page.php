<?php
/**
 * Plantilla principal para el contenido de paginas en page.php
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

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
