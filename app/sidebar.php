<?php
/**
 * Secciones para los widgets
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package startwp
 * @since   1.0.0
 */

/**
 * Desde WordPress 3.0 es recomendable tener este archivo de forma obligatoria.
 * En caso de usar widgets, descomentar en 'functions.php#L35' para habilitar
 * las posiciones.
 */

/**
 * Sidebar principal (de muestra)
 *
 * Luego de habilitar el uso de widgets y crear una posición (o usar la principal),
 * ve al archivo donde quieres agregar los widgets y añade el siguiente código php:
 * get_sidebar( 'sidebar-ID' );
 *
 * Si no cambias nada para usar la posición principal, los widgets se va a publicar
 * automáticamente en todas las plantillas que tengan definido 'get_sidebar()'.
 *
 * @see /inc/core/class-widget.php
 */
if ( is_active_sidebar( 'main-sidebar' ) && class_exists( 'Startwp_Widgets' ) ) {
	Startwp_Widgets::render( array( 'side_type' => 'main-sidebar' ) );
}
