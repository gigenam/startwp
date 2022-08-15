<?php
/**
 * Plantilla para mostrar comentarios en entradas
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package startwp
 * @since   1.0.0
 */

/**
 * Desde WordPress 3.0 es recomendable tener este archivo de forma obligatoria.
 * En caso de usar comentarios, también activa las opciones extras descomentando
 * la linea en '/inc/core/class-enqueue.php#L27'.
 */

if ( post_password_required() ) {
	// Si la publicación actual está protegida por una contraseña y el visitante
	// aún no ha ingresado la misma, no cargar los comentarios.
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$startwp_comment_count = get_comments_number();
			if ( '1' === $startwp_comment_count ) {
				printf(
					/* translators: 1: Título de la entrada. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'startwp' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: Número de comentarios, 2: Título. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $startwp_comment_count, 'Título de la entrada', 'startwp' ) ),
					number_format_i18n( $startwp_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// Mensaje para cuando los comentarios están cerrados.
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'startwp' ); ?></p>
			<?php
		endif;

	endif; // Fin have_comments().

	comment_form();
	?>
</div><!-- #comments -->
