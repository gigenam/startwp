<?php
/**
 * Funcionalidades principales llamadas en la acción 'after setup theme'
 *
 * * setup()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Setup' ) ) {
	/**
	 * Configurar y agregar funcionalidades básicas
	 */
	class Startwp_Setup {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
		}

		/**
		 * Main setup theme
		 */
		public static function setup() {
			/*
			* Hacer que el tema pueda ser localizado.
			* @see directorio /languages/.
			*/
			load_theme_textdomain( 'startwp', get_template_directory() . '/languages' );

			/**
			 * RSS feed para entradas y comentarios
			 */
			// add_theme_support( 'automatic-feed-links' );

			/*
			* Título del documento (que aparece en la pestaña del navegador)
			*/
			add_theme_support( 'title-tag' );

			/*
			* Soporte HTML5 para formularios y otros elementos de WordPress
			*/
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'style',
					'script',
				)
			);

			/**
			 * Ancho máximo del contenido
			 */
			global $content_width;
			$startwp_content_width = $content_width;
			if ( ! isset( $startwp_content_width ) ) {
				// igual al tamaño definido en theme.json#L6.
				$startwp_content_width = 1100;
			}

			/**
			 * Logo personalizado desde el personalizador
			 */
			add_theme_support( 'custom-logo' );

			/*
			* Image destacada para entradas y páginas
			*/
			add_theme_support( 'post-thumbnails' );

			/*
			* Tamaño de imágenes para open graph
			*/
			add_image_size( 'social-summary', 300, 300, true );
			add_image_size( 'social-summary-large', 1200, 630, true );

			/**
			 * Gutenberg block editor
			 */
			// Block styles.
			add_theme_support( 'wp-block-styles' );

			// Block templates.
			// Posibilidad de crear plantillas directo desde el editor.
			// Posiblemente obsoleto desde WP 5.9 y el nuevo FSE.
			// add_theme_support( 'block-templates' );

			// Imágenes a tamaño completo y anchas.
			add_theme_support( 'align-wide' );
			add_theme_support( 'gutenberg', array( 'wide-images', true ) );

			// Responsive embedded content.
			add_theme_support( 'responsive-embeds' );
		}

	}//end class

}

new Startwp_Setup();
