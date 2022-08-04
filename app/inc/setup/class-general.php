<?php
/**
 * Generales
 *
 * * slug_class()
 * * optimize_html()
 * * custom_logo()
 * * privacy_policy()
 * * pingbacks()
 * * open_graph()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_General_Setup' ) ) {
	/**
	 * Funcionalidades generales
	 */
	class Startwp_General_Setup {
		/**
		 * Init
		 */
		public function __construct() {
			add_filter( 'body_class', array( $this, 'slug_class' ) );
			add_filter( 'the_content', array( $this, 'optimize_html' ) );
			add_action( 'wp_head', array( $this, 'open_graph' ), 1 );
			// add_action( 'wp_head', array( $this, 'pingbacks' ) );
		}

		/**
		 * Agregar nombre de pagina o entrada al <body> como clase
		 *
		 * @param array $classes Todas las clases por defecto del <body>.
		 */
		public static function slug_class( $classes ) {
			global $post;
			$singular_slug = ! empty( $post->post_name ) ? $post->post_name : '';

			// Agregar título de páginas singulares.
			if ( is_singular() ) {
				$classes[] = sanitize_html_class( $singular_slug );
			}

			// Agregar clase cuando no hay widgets activados en main-sidebar.
			if ( ! is_active_sidebar( 'main-sidebar' ) ) {
				$classes[] = sanitize_html_class( 'no-sidebar' );
			}
			return $classes;
		}

		/**
		 * Comprimir el contenido del HTML
		 *
		 * @param string $content Todo el contenido principal de entradas y páginas.
		 */
		public static function optimize_html( $content ) {
			return preg_replace( '/(\>)\s*(\<)/m', '$1$2', $content );
		}

		/**
		 * Logo personalizado
		 *
		 * @see header.php#L36
		 */
		public static function custom_logo() {
			$custom_logo = get_custom_logo();
			printf(
				wp_kses(
					$custom_logo,
					array(
						'a'   => array(
							'href'         => array(),
							'class'        => array(),
							'rel'          => array(),
							'aria-current' => array(),
						),
						'img' => array(
							'width'  => array(),
							'height' => array(),
							'src'    => array(),
							'class'  => array(),
							'alt'    => array(),
						),
					)
				)
			);
		}

		/**
		 * Modificar el enlace de WP de políticas de privacidad
		 *
		 * @see footer.php#L36
		 */
		public static function privacy_policy() {
			$privacy_link = get_the_privacy_policy_link( '<p class="privacy-policy">', '</p>' );

			if ( function_exists( 'the_privacy_policy_link' ) ) {
				/**
				 * Si por alguna razón pones la página de política de privacidad
				 * con protección de contraseña, agregar la palabra privado.
				 */
				add_filter(
					'protected_title_format',
					function() {
						/* translators: %s: Título de la página de políticas de privacidad */
						return esc_html__( '%s - Private', 'startwp' );
					}
				);
			}

			/**
			 * Imprimir link
			 */
			printf(
				wp_kses(
					$privacy_link,
					array(
						'p' => array( 'class' => array() ),
						'a' => array(
							'class' => array(),
							'href'  => array(),
						),
					)
				)
			);
		}

		/**
		 * Pingbacks
		 *
		 * Encabezado de detección automática de URL de pingback para publicaciones,
		 * páginas o archivos adjuntos individuales.
		 */
		public static function pingbacks() {
			if ( is_singular() && pings_open() ) {
				printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
			}
		}

		/**
		 * Open Graph metas
		 *
		 * Algunas funcionalidades para poder compartir páginas en redes sociales.
		 * Para opciones o control más avanzado, comenta esto en el __construct()
		 * y utiliza algunos de los plugins más populares.
		 *
		 * En el caso de Twitter se puede usar una imagen diferente. Para esto
		 * hay que cambiar el valor de la linea 161 por 'summary' y agregar una
		 * imagen llamada 'og-summary.jpg' en la carpeta 'img' principal.
		 *
		 * @see templates/README.md
		 */
		public static function open_graph() {
			if ( ! is_404() ) {
				$site_type        = 'website';
				$site_uri         = ( is_front_page() ) ? get_home_url() : get_permalink( get_the_ID() );
				$site_name        = ( is_front_page() ) ? get_bloginfo( 'name' ) : get_the_title( get_the_ID() );
				$site_description = ( is_front_page() ) ? get_bloginfo( 'description' ) : get_the_excerpt( get_the_ID() );
				$site_image       = ( is_front_page() ) ? get_template_directory_uri() . '/img/og-summary-large.jpg' : ( ( get_the_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'social-summary-large' ) : get_template_directory_uri() . '/img/og-summary-large.jpg' );
				$twitter_card     = 'summary-large';
				$twitter_type     = ( 'summary' === $twitter_card ) ? 'summary' : 'summary-large';
				$twitter_image    = ( is_front_page() ) ? get_template_directory_uri() . '/img/og-' . $twitter_type . '.jpg' : ( ( get_the_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_ID(), 'social-' . $twitter_type ) : get_template_directory_uri() . '/img/og-' . $twitter_type . '.jpg' );
				$twitter_user     = ''; // Puedes agregar tu usuario de twitter (sin @).
				?>
				<meta property="og:type" content="<?php echo esc_attr( $site_type ); ?>" />
				<meta property="og:url" content="<?php echo esc_url( $site_uri ); ?>" />
				<meta property="og:title" content="<?php echo esc_attr( wp_trim_words( $site_name, 80, null ) ); ?>" />
				<meta property="og:description" content="<?php echo esc_attr( wp_trim_words( $site_description, 150, null ) ); ?>" />
				<?php if ( ! empty( $site_image ) ) : ?>
					<meta property="og:image" content="<?php echo esc_url( $site_image ); ?>" />
					<meta name="twitter:card" content="<?php echo esc_html( $twitter_card ); ?>" />
					<meta name="twitter:image" content="<?php echo esc_url( $twitter_image ); ?>" />
				<?php endif; ?>
				<?php if ( ! empty( $twitter_user ) ) : ?>
					<meta name="twitter:site" content="<?php echo esc_html( '@' . $twitter_user ); ?>" />
					<?php
				endif;
			}
		}

	}//end class

}

new Startwp_General_Setup();
