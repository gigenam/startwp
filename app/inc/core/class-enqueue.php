<?php
/**
 * Archivos necesarios de estilos y scripts para todo el tema
 *
 * * main()
 * * editor()
 * * login()
 * * comments()
 * * icons()
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
			add_action( 'wp_footer', array( $this, 'icons' ), 1 );
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
					'themeURI'     => esc_url( get_template_directory_uri() ), // URL absoluta hasta el tema en caso de necesitarla para JavaScript.
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

		/**
		 * Agregar íconos en linea antes de finalizar el contenido.
		 *
		 * Para poder usarlos con <svg><use xlink:href="#nombre-icono" /></svg>
		 * sin requerir de una URL absoluta y poder cargarlos correctamente sin
		 * problemas (CORS) en caso de usar servicios de tipo CDN para cargar y
		 * cachear los recursos de forma externa.
		 */
		public static function icons() {
			/**
			 * El plugin Theme Check recomienda usar WP_Filesystem sólo para
			 * actualizaciones. Para este caso es más recomendable usar wp_remote_get().
			 */
			$response = wp_remote_get( get_template_directory_uri() . '/img/sprites.svg' );

			/**
			 * Agregar nuevos filtros para escapar las propiedades de SVG de
			 * forma segura.
			 */
			add_filter(
				'safe_style_css',
				function( $styles ) {
					$styles[] = 'display';
					$styles[] = 'fill';
					$styles[] = 'fill-opacity';
					$styles[] = 'stroke';
					$styles[] = 'stroke-width';
					return $styles;
				}
			);

			if ( is_array( $response ) && ! is_wp_error( $response ) ) {
				/**
				 * Agrega el contenido de sprites.svg en el pie de página del
				 * sitio de forma segura para evitar código malicioso. Si tienes
				 * problemas con algunos ícono, puedes escapar más propiedades
				 * como 'clipPath' o 'circle', etc.
				 */
				echo '<div class="svg-sprites hidden">' . wp_kses(
					$response['body'],
					array(
						'svg'   => array(
							'xmlns'   => array(),
							'version' => array(),
							'id'      => array(),
							'width'   => array(),
							'height'  => array(),
							'viewbox' => array(),
						),
						'style' => array(),
						'g'     => array(
							'id'        => array(),
							'style'     => array(),
							'transform' => array(),
							'clip-path' => array(),
							'stroke'    => array(),
						),
						'path'  => array(
							'd'         => array(),
							'style'     => array(),
							'transform' => array(),
							'fill'      => array(),
							'stroke'    => array(),
						),
						'rect'  => array(
							'x'      => array(),
							'y'      => array(),
							'width'  => array(),
							'height' => array(),
						),
					)
				) . '</div>';
			}
		}

	}//end class

}

new startwp_Enqueues();
