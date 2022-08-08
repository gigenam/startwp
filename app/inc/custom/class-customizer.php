<?php
/**
 * Personalizador del tema
 *
 * * register()
 * * site_address()
 *
 * @package startwp
 * @since   1.0.0
 */

// Es probable que a futuro el personalizador quede obsoleto a cambio del nuevo
// sistema de FSE (Full Site Editing) mediante bloques, el cual no está soportado
// por este tema de momento hasta que dicho sistema este más maduro/estable.

// La intención de este archivo es dejar una pequeña funcionalidad de muestra
// (agregar dirección en el pie de página) para poder extender y agregar más
// opciones.

if ( ! class_exists( 'Startwp_Customizer' ) ) {
	/**
	 * Personalizador
	 */
	class Startwp_Customizer {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'register' ) );
		}

		/**
		 * Registrar opciones
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function register( $wp_customize ) {
			self::site_address( $wp_customize, 'title_tagline' );
		}

		/**
		 * Dirección del sitio
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @param string               $sec_name     Nombre de la sección.
		 */
		private static function site_address( $wp_customize, $sec_name ) {
			$wp_customize->add_setting(
				'startwp_address',
				array(
					'default'           => '',
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'startwp_address',
					array(
						'label'    => __( 'Site Address', 'startwp' ),
						'section'  => $sec_name,
						'settings' => 'startwp_address',
					)
				)
			);
		}
	}
}

new Startwp_Customizer();
