<?php
/**
 * Agregar compatibilidad con widgets
 *
 * * register()
 * * render()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Widgets' ) ) {
	/**
	 * Registrar y crear posiciones
	 *
	 * Primero se registran las posiciones por única vez (al final de este archivo).
	 * Luego se crean las posiciones con el método render().
	 *
	 * @see sidebar.php
	 */
	class Startwp_Widgets {
		/**
		 * Registrar posiciones
		 */
		public static function register() {
			// Para más posiciones, copiar y pegar la función 'register_sidebar()'
			// y modificar los valores 'name' y 'id'. El resto son opcionales.
			register_sidebar(
				array(
					'name'          => esc_html__( 'Main Sidebar', 'startwp' ),
					'id'            => 'main-sidebar',
					'description'   => esc_html__( 'Add widgets here to show in the main sidebar.', 'startwp' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget__title">',
					'after_title'   => '</h2>',
				)
			);

			add_action( 'widgets_init', array( 'Startwp_Widgets', 'register' ), 1 );
		}

		/**
		 * Crear posiciones
		 *
		 * @param array $args Pasar argumentos para personalizar el sidebar.
		 */
		public static function render( $args = array() ) {
			$defaults = array(
				'side_type'         => '', // El nombre de la posición. Igual al ID.
				'side_wrap_classes' => '', // Clases personalizadas para agregar al contenedor.
			);
			$args     = wp_parse_args( $args, $defaults );

			echo "<aside id='" . esc_html( $args['side_type'] ) . "' class='widgets-sidebar widgets-sidebar--" . esc_html( $args['side_type'] ) . ' ' . esc_html( $args['side_wrap_classes'] ) . "' role='complementary' aria-label='complementary sidebar'>";
			dynamic_sidebar( $args['side_type'] );
			echo '</aside>';
		}

	}//end class

}

/**
 * Registrar posiciones en widgets init
 *
 * @see sidebar.php
 */
Startwp_Widgets::register();
