<?php
/**
 * Plantilla principal para el contenido de entradas.
 * Si no hay otras plantillas, esta siempre será usada por defecto.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

$startwp_wrapper = ! is_singular() && ! is_archive() ? '' : ' wrapper';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header<?php echo esc_html( $startwp_wrapper ); ?>">

		<?php
		/**
		 * Hook: startwp_single_header
		 *
		 * @hooked Startwp_Posts_Extras->post_thumbnail - 10
		 * @hooked Startwp_Posts_Extras->post_title     - 20
		 */
		do_action( 'startwp_single_header' );

		if ( has_action( 'startwp_single_publish' ) && 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				/**
				 * Hook: startwp_single_publish
				 *
				 * @hooked Startwp_Posts_Extras->posted_on     - 10
				 * @hooked Startwp_Posts_Extras->posted_by     - 20
				 * @hooked Startwp_Posts_Extras->posted_update - 30
				 */
				do_action( 'startwp_single_publish' );
				?>
			</div><!-- .entry-meta -->
			<?php
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content<?php echo esc_html( $startwp_wrapper ); ?>">

		<?php
		$startwp_read_more_link = apply_filters( 'startwp_excerpt_more', '<a class="has-icon-after icon-arrow is-right readmore" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Read more', 'startwp' ) . ' <span class="screen-reader-text">' . esc_html_x( 'about ', 'Sobre la entrada', 'startwp' ) . get_the_title() . '</span></a>' );
		if ( ! is_singular() && ! has_excerpt() ) {
			printf(
				'%1$s',
				wp_kses(
					'<p>' . get_the_excerpt() . $startwp_read_more_link . '</p>',
					array(
						'p'    => array(),
						'a'    => array(
							'class' => array(),
							'href'  => array(),
							'rel'   => array(),
						),
						'span' => array( 'class' => array() ),
					)
				)
			);
		} else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Nombre de la entrada para lectores de pantalla */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'startwp' ),
						array( 'span' => array( 'class' => array() ) )
					),
					wp_kses_post( get_the_title() )
				)
			);
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'startwp' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<?php if ( has_action( 'startwp_single_footer' ) && ! post_password_required() ) : ?>
		<footer class="entry-footer wrapper">
			<?php
			/**
			 * Hook: startwp_single_footer
			 *
			 * @hooked Startwp_Posts_Extras->post_categories - 10
			 * @hooked Startwp_Posts_Extras->post_tags       - 20
			 */
			do_action( 'startwp_single_footer' );
			?>
		</footer> <!-- .post__footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
