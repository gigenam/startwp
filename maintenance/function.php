<?php
/**
 * Fragmento de código para poner el sitio en mantenimiento y que nadie salvo
 * los usuarios autorizados puedan seguir visualizando el sitio.
 *
 * Si quieres hacer modificaciones en tu sitio sin que otros usuarios
 * (registrados o anónimos) puedan ver, no es muy recomendable hacerlo con los
 * archivos de mantenimiento.
 *
 * Una mejor forma es modificar y agregar el siguiente fragmento de código en el
 * archivo 'app/functions.php'.
 *
 * Dentro de 'wp_die()' puedes agregar casi todo el contenido HTML que quieras e
 * incluso usar funciones de WordPress, ya que el sitio sigue funcionando.
 *
 * @package startwp
 * @since   1.1.0
 */

if ( ! function_exists( 'startwp_maintenance_mode' ) ) {
	/**
	 * Poner el sitio en mantenimiento y permitir el acceso a administradores.
	 */
	function startwp_maintenance_mode() {
		/**
		 * Puedes cambiar los permisos mínimos para poder visualizar el sitio.
		 *
		 * @see https://wordpress.org/support/article/roles-and-capabilities/
		 */
		if ( ! current_user_can( 'administrator' ) || ! is_user_logged_in() ) {
			wp_die(
				'
				<style>
					*,
					*::before,
					*::after { box-sizing: inherit; word-break: break-word }
					html { box-sizing: border-box; font-size: 16px; -webkit-text-size-adjust: 100% }
					body#error-page {
						max-width: 100%;
						padding: 0;
						margin: 0;
						line-height: 1.5;
						color: #333333;
						background-color: #ffffff;
						font-family: sans-serif;
						border: 0;
					}
					body#error-page .wp-die-message {
						display: flex;
						flex-wrap: wrap;
						flex-direction: column;
						align-items: center;
						min-height: 100vh;
						margin: 0;
						font-size: 1em;
					}
					body#error-page p { font-size: 1em }
					a { color: #305cd4; font-weight: bold }
					a:not(:hover) { text-decoration: none }
					.main-container { padding: 5rem 1rem }
					.main-title {
						margin-top: 0;
						margin-bottom: 0;
						line-height: 1.15;
						color: inherit;
						font-size: 1.8em;
						border-bottom: 0;
					}
					.main-container,
					.main-footer { text-align: center }
					.main-footer {
						margin-top: auto;
						padding-top: 1em;
						padding-bottom: 1em;
						font-size: .9em;
					}
					.main-footer span { display: block; padding-bottom: .25em }
					@media screen and (min-width: 640px) {
						.main-container { padding: 7% 1rem; font-size: 1.2em }
						.main-title { font-size: 3.2rem }
						.main-footer span { font-size: 1.2rem }
					}
				</style>
				<main class="main-container">
					<h1 class="heading main-title">
						' . esc_html__( 'Site under maintenance', 'startwp' ) . '
					</h1>
					<p class="main-description">
						' . esc_html__( 'We are making some improvements,', 'startwp' ) . '<br>
						' . esc_html__( 'please come back later.', 'startwp' ) . '
					</p>
				</main>
				<footer class="main-footer">
					<p>
						<span>
							<a href="https://github.com/gigenam/startwp" target="_blank">StartWP</a> &copy; ' . esc_html( gmdate( 'Y' ) ) . '
						</span>
						<a href="https://www.gnu.org/licenses/old-licenses/gpl-2.0.html" target="_blank">
							GNU General Public License
						</a>
					</p>
				</footer>
				',
				esc_html__( 'Site under maintenance', 'startwp' ),
				array( 'response' => 503 )
			);
		}
	}
}
add_action( 'init', 'startwp_maintenance_mode' );
