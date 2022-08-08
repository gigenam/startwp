<?php
/**
 * Alertas
 *
 * * create_alert()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Alerts' ) ) {
	/**
	 * Crear y mostrar alertas en ciertas situaciones
	 */
	class Startwp_Alerts {
		/**
		 * Iniciar clase
		 *
		 * @param array $args     Pasar múltiples parámetros al momento de crear instancia.
		 * @param int   $priority La posición en donde agregar las alertas.
		 */
		public function __construct( $args, $priority = 10 ) {
			add_action(
				'wp_footer',
				function() use ( $args ) {
					return self::create_alert( $args );
				},
				$priority,
			);
		}

		/**
		 * Crear alertas
		 *
		 * @param array $args Pasar parámetros para personalizar la alerta.
		 */
		public static function create_alert( $args = array() ) {
			$defaults = array(
				'type'     => '',    // Tipo de alerta (no-js | old-browser | o cualquier cosa).
				'icon'     => '',    // Icono de fondo (ver nombres disponibles en la carpeta assets/img/sprites).
				'classes'  => '',    // Clases personalizadas (Ej. message-error, message-info, lo que quieras, etc.)(ver assets/scss/components/_alerts.scss).
				'message'  => '',    // Mensaje de alerta. Ver linea 26.
				'button'   => '',    // Texto para cerrar (no funciona en no-js alertas).
				'privacy'  => false, // Mostrar mensaje de privacidad (no funciona en no-js alertas. Política de privacidad debe estar publicado).
				'remember' => false, // Agregar check para no mostrar de nuevo (no funciona en no-js alertas).
				'save'     => false, // Luego de cerrar alerta, salvar estado en localStorage para no mostrar más (sin necesidad de confirmar el check anterior).
			);

			$args = wp_parse_args( $args, $defaults );

			$show_alert     = ! empty( $args['type'] ) ? 'alert--visible ' : null;
			$alert_icon     = ! empty( $args['icon'] ) ? '<svg class="icon-' . esc_html( $args['icon'] ) . '" aria-hidden="true"><use xlink:href="#' . esc_html( $args['icon'] ) . '" /></svg>' : null;
			$alert_classes  = ! empty( $args['classes'] ) ? $args['classes'] : null;
			$alert_button   = ! empty( $args['button'] ) ? $args['button'] : __( 'Close', 'startwp' );
			$alert_privacy  = $args['privacy'] ? get_the_privacy_policy_link( '<p class="col-medium-6">' . esc_html_x( 'Read more about our ', 'Sobre políticas de privacidad', 'startwp' ), '</p>' ) : null;
			$alert_remember = $args['remember'] ? '<label for="remember"><input type="checkbox" id="remember" class="check-remember">' . esc_html__( 'Don&rsquo;t show again', 'startwp' ) . '</label>' : null;
			$alert_save     = $args['save'] ? ' alert--save-on-local' : null;
			$alert_content  = '
				<div class="alert ' . esc_html( $show_alert . $alert_classes . $alert_save ) . '">
					' . $alert_icon . '
					<div class="flexrow alert__content pos-relative">
						<p class="col-12 margin-bottom alert__message">' . $args['message'] . '</p>
						' . $alert_privacy .
						( 'no-js' !== $args['type'] ? '<p class="flexrow main-end cross-center col-medium-6 margin-left-auto">' : null ) .
							( 'no-js' !== $args['type'] ? $alert_remember : null ) .
							( 'no-js' !== $args['type'] ? '<button class="btn btn__alert-close">' . $alert_button . '</button>' : null ) .
						( 'no-js' !== $args['type'] ? '</p>' : null ) . '
					</div>
				</div>
			';

			$alert_sanitize = array(
				'div'    => array( 'class' => array() ),
				'svg'    => array(
					'class'       => array(),
					'aria-hidden' => array(),
				),
				'use'    => array( 'xlink:href' => array() ),
				'p'      => array( 'class' => array() ),
				'span'   => array( 'class' => array() ),
				'strong' => array( 'class' => array() ),
				'i'      => array( 'class' => array() ),
				'em'     => array( 'class' => array() ),
				'br'     => array(),
				'button' => array( 'class' => array() ),
				'label'  => array(
					'for'   => array(),
					'class' => array(),
				),
				'input'  => array(
					'type'  => array(),
					'id'    => array(),
					'class' => array(),
				),
				'a'      => array(
					'class' => array(),
					'href'  => array(),
				),
			);

			if ( 'no-js' === $args['type'] ) {
				echo '<noscript>' . wp_kses( $alert_content, $alert_sanitize ) . '</noscript>';
			} elseif ( 'old-browser' === $args['type'] ) {
				echo '
					<script id="' . esc_html( $args['type'] ) . '">
						var detectBrowser = new DetectBrowsers();
						if ( detectBrowser.isIE || detectBrowser.isOperaOld || detectBrowser.isOutdated ) document.write( `' . wp_kses( $alert_content, $alert_sanitize ) . '` );
					</script>
				';
			} else {
				echo '
					<script id="' . esc_html( $args['type'] ) . '">
						document.write( `' . wp_kses( $alert_content, $alert_sanitize ) . '` );
					</script>
				';
			}
		}

	}//end class

}

/**
 * Esperar a que el tema sea configurado para cargar las alertas y poder
 * traducir los mensajes correctamente.
 */
add_action(
	'after_setup_theme',
	function() {
		// JavaScript desactivado.
		$alert_no_javascript = new Startwp_Alerts(
			array(
				'type'    => 'no-js',
				'icon'    => 'error',
				'classes' => 'alert__no-js message-error',
				'message' => '<span class="heading-3">' . __( 'Ups. This is not working fine.', 'startwp' ) . '</span><br>' . __( 'Your web browser is not compatible or has Javascript disable witch is important for multiple functionalities. Activate, update or change to a web browser compatible with this functions.', 'startwp' ),
			)
		);

		// Navegadores viejos sin soporte.
		$alert_old_browsers = new Startwp_Alerts(
			array(
				'type'     => 'old-browser',
				'icon'     => 'warning',
				'classes'  => 'alert__old-browsers message-error',
				'message'  => '<span class="heading-3">' . __( 'We have a problem here.', 'startwp' ) . '</span><br>' . __( 'Your web browser doesn&rsquo;t support some properties and technologies that this site use.', 'startwp' ) . '<br> ' . __( 'Update to the latest version or try another modern options like Mozilla Firefox, Google Chrome or the new Microsoft Edge.', 'startwp' ),
				'privacy'  => false,
				'remember' => true,
			),
			30
		);

		// Ejemplo adicional: Alerta de Cookies.
		// $alert_cookies = new Startwp_Alerts(
		// array(
		// 'type'    => 'cookies',
		// 'icon'    => 'cookie',
		// 'classes' => 'alert__cookies message-info',
		// 'message' => '<span class="heading-3">' . __( 'We use cookies here.', 'startwp' ) . '</span><br> ' . __( 'If you don\'t mind we will save some data in your browser for better experience.', 'startwp' ),
		// 'button'  => __( 'I Understand', 'startwp' ),
		// 'privacy' => true,
		// 'save'    => true,
		// ),
		// 50
		// );
	}
);
