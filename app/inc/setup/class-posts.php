<?php
/**
 * Funcionalidades para entradas y páginas
 *
 * * read_more()
 * * article_post_type()
 * * post_thumbnail()
 * * post_title()
 * * posted_on()
 * * posted_by()
 * * comments_count()
 * * posted_update()
 * * post_categories()
 * * post_tags()
 * * check_post_password()
 * * password_form()
 * * post_password_message()
 * * protected_post_text()
 * * search_excerpt_highlight()
 *
 * @package startwp
 * @since   1.0.0
 */

if ( ! class_exists( 'Startwp_Posts_Extras' ) ) {
	/**
	 * Funcionalidades extras para entradas y páginas
	 */
	class Startwp_Posts_Extras {
		/**
		 * Iniciar clase
		 */
		public function __construct() {
			add_filter( 'startwp_article_type', array( $this, 'article_post_type' ) );

			// Páginas.
			add_action( 'startwp_page_header', array( $this, 'post_thumbnail' ), 10 );
			add_action( 'startwp_page_header', array( $this, 'post_title' ), 20 );

			// Entradas.
			add_action( 'startwp_single_header', array( $this, 'post_thumbnail' ), 10 );
			add_action( 'startwp_single_header', array( $this, 'post_title' ), 20 );
			add_action( 'startwp_single_publish', array( $this, 'posted_on' ), 10 );
			add_action( 'startwp_single_publish', array( $this, 'posted_by' ), 20 );
			add_action( 'startwp_single_publish', array( $this, 'comments_count' ), 30 );
			add_action( 'startwp_single_publish', array( $this, 'posted_update' ), 40 );
			add_action( 'startwp_single_footer', array( $this, 'post_categories' ), 10 );
			add_action( 'startwp_single_footer', array( $this, 'post_tags' ), 20 );

			// Búsqueda.
			add_action( 'startwp_search_content', array( $this, 'search_excerpt_highlight' ), 10 );
			add_action( 'startwp_search_header', array( $this, 'post_title' ), 10 );

			// Extracto.
			add_filter( 'excerpt_more', '__return_null' );
			add_filter( 'startwp_excerpt_more', array( $this, 'read_more' ) );

			// Protegidas por contraseña.
			add_action( 'wp', array( $this, 'check_post_password' ) );
			add_filter( 'the_password_form', array( $this, 'password_form' ) );
			add_filter( 'the_password_form', array( $this, 'post_password_message' ) );
			add_filter( 'protected_title_format', array( $this, 'protected_post_text' ) );
			add_filter( 'private_title_format', array( $this, 'private_post_text' ) );
		}

		/**
		 * Agregar enlace de leer más después del extracto.
		 *
		 * @param  string $link Devuelve el valor desde el filtro startwp_excerpt_more.
		 * @return string
		 */
		public static function read_more( $link ) {
			return esc_html( ' ' ) . $link;
		}

		/**
		 * Agregar filtros dependiendo el tipo de entrada
		 *
		 * @param  string $type El tipo de entrada desde el filtro startwp_article_type.
		 * @return string
		 */
		public static function article_post_type( $type ) {
			if ( is_page() ) {
				$type = 'page';
			}
			return $type;
		}

		/**
		 * Mostrar imagen destacada.
		 * Agregar o no enlace a la imagen dependiendo la vista y/o entradas.
		 */
		public static function post_thumbnail() {
			$article_type = apply_filters( 'startwp_article_type', $type = 'single' );

			if ( post_password_required() || is_attachment() || ! has_post_thumbnail() || is_search() ) {
				return;
			}

			if ( is_singular() ) {
				printf(
					'<p class="entry-thumbnail entry-thumbnail--' . esc_html( $article_type ) . ' alignfull pos-relative">%s</p>',
					get_the_post_thumbnail()
				);
			} else {
				printf(
					'<a class="entry-thumbnail entry-thumbnail--blog alignfull" href="' . esc_url( get_the_permalink() ) . '" aria-hidden="true" tabindex="-1">%s</a>',
					get_the_post_thumbnail(
						get_the_ID(),
						'blog-thumbnail',
						array( 'alt' => the_title_attribute( array( 'echo' => false ) ) )
					)
				);
			}
		}

		/**
		 * Modificar el titulo de la entrada dependiendo de la vista.
		 * Si es singular, quitar enlace.
		 */
		public static function post_title() {
			$article_type      = apply_filters( 'startwp_article_type', $type = 'single' );
			$article_sticky    = ( is_sticky() ) ? '<svg class="icon-sticky" aria-hidden="true"><use xlink:href="#sticky" /></svg>' : '';
			$article_protected = ( post_password_required() ) ? '<svg class="icon-lock" aria-hidden="true"><use xlink:href="#lock" /></svg>' : '';

			if ( is_singular() ) {
				the_title( '<h1 class="entry-title entry-title--' . esc_html( $article_type ) . '">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title entry-title--blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $article_sticky . $article_protected, '</a></h2>' );
			}
		}

		/**
		 * Agregar información sobre fecha de publicación
		 */
		public static function posted_on() {
			if ( post_password_required() ) {
				return;
			}

			$time_string = '<time class="has-icon icon-calendar" datetime="%1$s">%2$s</time>';
			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() )
			);

			if ( is_singular() ) {
				printf(
					// %s&nbsp; == %s = time. &nbsp; = espacio en blanco.
					'<span class="entry-posted-on">%s&nbsp;</span>',
					wp_kses(
						$time_string,
						array(
							'time' => array(
								'class'    => array(),
								'datetime' => array(),
							),
						)
					)
				);
			} else {
				printf(
					'<span class="entry-posted-on entry-posted-on--blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">%s</a>&nbsp;</span>',
					wp_kses(
						$time_string,
						array(
							'time' => array(
								'class'    => array(),
								'datetime' => array(),
							),
						)
					)
				);
			}
		}

		/**
		 * Agregar información sobre fecha de actualización
		 */
		public static function posted_update() {
			if ( is_singular() && ! post_password_required() ) {
				if ( get_the_modified_date() !== get_the_date() ) {
					$time_string_update = '<time class="has-icon icon-clock" datetime="%1$s">' . __( 'Updated on', 'startwp' ) . ' %2$s</time>';
					$time_string_update = sprintf(
						$time_string_update,
						esc_attr( get_the_modified_date( DATE_W3C ) ),
						esc_html( get_the_modified_date() )
					);

					// Última actualización.
					printf(
						'<br><span class="col-12 entry-posted-on entry-posted-on--updated">%s</span>',
						wp_kses(
							$time_string_update,
							array(
								'time' => array(
									'class'    => array(),
									'datetime' => array(),
								),
							)
						)
					);
				}
			}
		}

		/**
		 * Agregar información sobre el autor
		 */
		public static function posted_by() {
			if ( post_password_required() ) {
				return;
			}
			printf(
				'<span class="entry-posted-by">' . esc_html(
					/* translators: %s: Nombre de autor. */
					apply_filters( 'startwp_posted_by_text', esc_html_x( 'by %s', 'Autor de la entrada', 'startwp' ) )
				) . '</span>',
				wp_kses(
					'<a class="entry-author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>',
					array(
						'a' => array(
							'class' => array(),
							'href'  => array(),
						),
					)
				)
			);
		}

		/**
		 * Agregar contador de comentarios
		 */
		public static function comments_count() {
			/**
			 * Mostrar contador sólo si los comentarios están abiertos o hay
			 * alguno publicado. Y sólo si la entrada no está protegida con contraseña.
			 */
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				$startwp_comment_count = get_comments_number();
				$startwp_comments_icon = ( '0' === $startwp_comment_count ) ? '#cmt' : '#cmts';
				$startwp_no_comments   = ( '0' === $startwp_comment_count ) ? ' is-outline' : '';

				printf( '<span class="entry-comments margin-left-auto"><a href="' . esc_url( get_permalink() . '#comments' ) . '">' );
				if ( '1' === $startwp_comment_count ) {
					// Un comentario.
					printf(
						/* translators: 1: Título de la entrada. */
						esc_html__( '1 %1$s', 'startwp' ),
						'<span class="screen-reader-text">' . esc_html__( 'comment on', 'startwp' ) . ' &ldquo;' . wp_kses_post( get_the_title() ) . '&rdquo;</span><svg class="icon-comment" aria-hidden="true"><use xlink:href="#cmt" /></svg>'
					);
				} else {
					// 0 o muchos comentarios.
					printf(
						/* translators: 1: Número de comentarios, 2: Título de la entrada. */
						esc_html( _nx( '%1$s %2$s', '%1$s %2$s', $startwp_comment_count, 'Cantidad comentarios y título de la entrada', 'startwp' ) ),
						number_format_i18n( $startwp_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span class="screen-reader-text">' . esc_html__( 'comments on', 'startwp' ) . ' &ldquo;' . wp_kses_post( get_the_title() ) . '&rdquo;</span><svg class="icon-comment' . esc_html( $startwp_no_comments ) . '" aria-hidden="true"><use xlink:href="' . esc_attr( $startwp_comments_icon ) . '" /></svg>'
					);
				}
				printf( '</a></span>' );
			}
		}

		/**
		 * Agregar enlace a la/s categoría/s.
		 */
		public static function post_categories() {
			// Solo mostrar en entradas.
			if ( 'post' === get_post_type() ) {
				$categories_list = get_the_category_list( esc_html( ', ' ) );

				if ( $categories_list && is_single() ) {
					printf(
						/* translators: 1: Lista de categorías. */
						'<p class="entry-categories"><span class="entry-categories-title">' . esc_html(
							apply_filters( 'startwp_categories_list_text', __( 'Categories', 'startwp' ) )
						) . '</span><br>' . esc_html( '%1$s' ) . '</p>',
						wp_kses(
							$categories_list,
							array(
								'a' => array(
									'href' => array(),
									'rel'  => array(),
								),
							)
						)
					);
				}
			}
		}

		/**
		 * Agregar enlace a la/s etiqueta/s.
		 */
		public static function post_tags() {
			// Solo mostrar en entradas.
			if ( 'post' === get_post_type() ) {
				$tags_list = get_the_tag_list( '', esc_html( ', ' ) );

				if ( $tags_list && is_single() ) {
					printf(
						/* translators: 1: Lista de etiquetas */
						'<p class="entry-tags"><span class="entry-tags-title">' . esc_html(
							apply_filters( 'startwp_tags_list_text', __( 'Tags', 'startwp' ) )
						) . '</span><br>' . esc_html( '%1$s' ) . '</p>',
						wp_kses(
							$tags_list,
							array(
								'a' => array(
									'href' => array(),
									'rel'  => array(),
								),
							)
						)
					);
				}
			}
		}

		/**
		 * Revisar si hay contraseña almacenada en cookies
		 */
		public static function check_post_password() {
			if ( ! post_password_required() ) {
				return;
			}

			if ( isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ) {
				define( 'STARTWP_INVALID_POST_PASS', true );

				/**
				 * Revisar y quitar clave de cookies para que la alerta no ocurra
				 * o se imprima cada vez
				 */
				setcookie( 'wp-postpass_' . COOKIEHASH, null, -1, COOKIEPATH );
			}
		}

		/**
		 * Formulario de contraseña personalizado
		 *
		 * @param  string $form El contenido del formulario por defecto.
		 * @return string
		 */
		public static function password_form( $form ) {
			$form  = '<form class="password-form" action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
			$form .= '<p class="password-form__description">' . esc_html__( 'This content is private. To view it enter your password below:', 'startwp' ) . '</p>';
			$form .= '<p class="screen-reader-text password-form__label"><label for="password">' . esc_html_x( 'Password:', 'Private post form label', 'startwp' ) . '</label></p>';
			$form .= '<div class="flexrow">';
			$form .= '<input class="password-form__input" name="post_password" id="password" type="password" required />';
			$form .= '<button class="btn btn-primary password-form__submit" type="submit">' . esc_html_x( 'Enter', 'Private post form submit', 'startwp' ) . '</button>';
			$form .= '</div>';
			$form .= '</form>';
			return $form;
		}

		/**
		 * Agregar mensaje de contraseña incorrecta
		 *
		 * @param  string $form El contenido del formulario por defecto.
		 * @return string
		 */
		public static function post_password_message( $form ) {
			if ( ! defined( 'STARTWP_INVALID_POST_PASS' ) ) {
				return $form;
			}
			$error_message = esc_html__( 'Sorry, your password is wrong. Please try again.', 'startwp' );
			$error_message = '
			<p class="message-error password-form-message">
				<svg class="icon-warning" aria-hidden="true"><use xlink:href="#warning" /></svg>'
				. $error_message .
			'</p>';
			return $form . $error_message; // El mensage debajo del formulario.
		}

		/**
		 * Quitar texto protegido en artículos
		 *
		 * @param  string $protect Agrega la palabra "protegido" al los títulos.
		 * @return string Solo el título original sin "protegido".
		 */
		public static function protected_post_text( $protect ) {
			/**
			 * Para agregar contenido personalizado es recomendable hacerlo traducible:
			 * Ej: esc_html_x( 'Hola %s', 'Título original', 'startwp' ).
			 */
			return esc_html( '%s' );
		}

		/**
		 * Quitar texto privado en artículos y agregar ícono
		 *
		 * @param  string $private Agrega la palabra "privado" al los títulos.
		 * @return string Solo el título original sin "privado". Con ícono en blog.
		 */
		public static function private_post_text( $private ) {
			/**
			 * Para agregar contenido personalizado es recomendable hacerlo traducible:
			 * Ej: esc_html_x( 'Hola %s', 'Título original', 'startwp' ).
			 */
			if ( ! is_singular() ) {
				$private = '<svg class="icon-private" aria-hidden="true"><use xlink:href="#private"></svg>%s';
			} else {
				$private = '%s';
			}
			return $private;
		}

		/**
		 * Resaltar la palabras buscadas
		 */
		public static function search_excerpt_highlight() {
			$excerpt = get_the_excerpt();
			$keys    = implode( '|', explode( ' ', get_search_query() ) );
			if ( '' !== get_search_query() ) {
				$excerpt = preg_replace( '/(' . $keys . ')/iu', '<strong class="search-highlight">\0</strong>', $excerpt );
			}
			$read_more_link = apply_filters(
				'startwp_search_readmore_text',
				' <a class="has-icon-after icon-arrow is-right readmore" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Continue reading', 'startwp' ) . ' <span class="screen-reader-text">' . esc_html_x( 'about ', 'Sobre la entrada', 'startwp' ) . get_the_title() . '</span></a>'
			);

			printf(
				'%1$s',
				wp_kses(
					'<p>' . $excerpt . $read_more_link . '</p>',
					array(
						'p'      => array(),
						'a'      => array(
							'class' => array(),
							'href'  => array(),
							'rel'   => array(),
						),
						'span'   => array( 'class' => array() ),
						'strong' => array( 'class' => array() ),
					)
				)
			);
		}

	}//end class

}

new Startwp_Posts_Extras();
