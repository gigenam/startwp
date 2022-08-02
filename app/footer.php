<?php
/**
 * Pie de página principal del tema
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package startwp
 * @since   1.0.0
 */

?>

	<footer id="site-footer" class="site-footer wrapper has-background-color has-foreground-background-color">

		<div class="site-footer-container flexrow main-between margin-bottom-none padding-v">
			<p class="site-info">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			</p>

			<?php
			/**
			 * Dirección del sitio
			 *
			 * @see /inc/custom/class-customizer.php#L38
			 */
			if ( get_theme_mod( 'startwp_address', false ) || is_customize_preview() ) :
				?>
				<p class="site-address">
					<?php echo esc_html( get_theme_mod( 'startwp_address', false ) ); ?>
				</p>
				<?php
			endif;

			/**
			 * Enlace a políticas de privacidad
			 *
			 * @see /inc/setup/class-general.php#L90
			 */
			Startwp_General_Setup::privacy_policy();
			?>
		</div>

	</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</body>
</html>
