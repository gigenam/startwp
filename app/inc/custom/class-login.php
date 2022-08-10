<?php
/**
 * Inicio de sesión / Registro
 *
 * * logo_url()
 * * logo_text()
 * * inline_styles()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Login' ) ) {
	/**
	 * Modificar la página de inicio / registro
	 */
	class Startwp_Login {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			add_filter( 'login_headerurl', array( $this, 'logo_url' ) );
			add_filter( 'login_headertext', array( $this, 'logo_text' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'inline_styles' ) );
		}

		/**
		 * Remplazar la url de wordpress.org del logo por la de tu sitio
		 */
		public function logo_url() {
			return esc_url( home_url() );
		}

		/**
		 * Remplazar el texto del logo por el nombre de tu sitio
		 */
		public function logo_text() {
			return esc_html( get_bloginfo( 'name' ) );
		}

		/**
		 * Mostrar título o imagen
		 *
		 * Si se agregó un logo en el personalizador, va a mostrar este.
		 * Sino el título del sitio.
		 */
		public function inline_styles() {
			$inline_styles = ! empty( get_custom_logo() )
				? 'background-image: url(' . esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ) . '); background-size: contain; line-height: 3;'
				: 'background-image: none; text-indent: 0';
			wp_add_inline_style( 'startwp-login', ".login h1 a{ {$inline_styles} }" );
		}
	}
}

new Startwp_Login();
