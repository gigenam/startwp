<?php
/**
 * Archivos necesarios de estilos y scripts para todo el tema
 *
 * * main()
 * * editor()
 * * login()
 * * comments()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Enqueues' ) ) {
	/**
	 * Agregar todos los estilos y scripts del tema
	 */
	class Startwp_Enqueues {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'main' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'editor' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'login' ) );
			// add_action( 'wp_enqueue_scripts', array( $this, 'comments' ) );
		}

		/**
		 * Main
		 */
		public static function main() {
			wp_enqueue_style( 'startwp-main', get_template_directory_uri() . "/css/main{$GLOBALS['startwp_theme_suffix']}.css", null, $GLOBALS['startwp_theme_version'], 'all' );
			wp_enqueue_script( 'startwp-main', get_template_directory_uri() . "/js/main{$GLOBALS['startwp_theme_suffix']}.js", null, $GLOBALS['startwp_theme_version'], true );

			/**
			 * Localizar textos en Javascript.
			 * Usar: startwp_i10n.[key value]
			 */
			wp_localize_script(
				'startwp-main',
				'startwp_i10n',
				array(
					'themeURI'     => esc_url( get_template_directory_uri() ), // Usado en: InlineIcons.js.
					'viewSubmenus' => __( ' Press enter to view the sub-menu.', 'startwp' ), // Usado en: MainNav.js.
				)
			);
		}

		/**
		 * Block editor
		 */
		public static function editor() {
			wp_enqueue_style( 'startwp-editor', get_template_directory_uri() . "/css/editor{$GLOBALS['startwp_theme_suffix']}.css", null, $GLOBALS['startwp_theme_version'], 'all' );
		}

		/**
		 * Login/register
		 */
		public static function login() {
			wp_enqueue_style( 'startwp-login', get_template_directory_uri() . "/css/login{$GLOBALS['startwp_theme_suffix']}.css", null, $GLOBALS['startwp_theme_version'], 'all' );
		}

		/**
		 * Comentarios
		 */
		public static function comments() {
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

	}//end class

}

new startwp_Enqueues();
