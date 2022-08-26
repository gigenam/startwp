<?php
/**
 * Navegaciones de menús
 *
 * * register()
 * * render()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Menus' ) ) {
	/**
	 * Registrar y crear menús.
	 *
	 * Primero se registran las posiciones una vez (al final de este archivo).
	 * Luego se crean los menús con el método render().
	 *
	 * @see header.php#L61
	 */
	class Startwp_Menus {
		/**
		 * Registrar posiciones
		 */
		public static function register() {
			register_nav_menus(
				array(
					'menu-primary' => __( 'Primary Menu', 'startwp' ),
					// Registrar más posiciones acá.
				)
			);
			add_action( 'init', array( 'Startwp_Menus', 'register' ), 1 );
		}

		/**
		 * Crear menús
		 *
		 * @param array $args Pasar argumentos para crear el menú.
		 */
		public static function render( $args = array() ) {
			$defaults   = array(
				'nav_type'         => '',      // El nombre de la ubicación.
				'nav_wrap_classes' => '',      // Clases personalizadas para agregar al elemento ul.
				'has_button'       => false,   // Agregar botón para móviles.
				'depth'            => 0,       // Profundidad de sub-menus. 0 == ilimitado.
				'submenu'          => 'hover', // Comportamiento para mostrar sub-menus (hover | click).
			);
			$args       = wp_parse_args( $args, $defaults );
			$nav_button = null;
			if ( $args['has_button'] ) {
				$nav_button = "
				<a href='#show-menu' id='btn-menu-{$args['nav_type']}' class='btn btn-menu btn-menu--{$args['nav_type']} hidden-from-large' data-prevent='true' aria-label='" . apply_filters( 'startwp_show_menu_button_text', esc_html__( 'Navigation Menu', 'startwp' ) ) . "' aria-expanded='false'>
					<span class='btn-menu-bar btn-menu-bar--top' aria-hidden='true'></span>
					<span class='btn-menu-bar btn-menu-bar--middle' aria-hidden='true'></span>
					<span class='btn-menu-bar btn-menu-bar--bottom' aria-hidden='true'></span>
				</a>";
			} // endif.

			wp_nav_menu(
				array(
					'theme_location'       => 'menu-' . $args['nav_type'],
					'container'            => 'nav',
					'container_class'      => 'nav-' . $args['nav_type'],
					'container_aria_label' => wp_get_nav_menu_name( 'menu-' . $args['nav_type'] ),
					'menu_id'              => 'nav-' . $args['nav_type'],
					'items_wrap'           => '<ul id="%1$s" class="menu ' . $args['nav_wrap_classes'] . '" data-submenu="' . $args['submenu'] . '">%3$s</ul>' . $nav_button,
					'fallback_cb'          => false,
					'depth'                => $args['depth'],
				)
			);
		}

	}//end class

}

/**
 * Registrar posiciones
 */
Startwp_Menus::register();
