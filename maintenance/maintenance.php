<?php // phpcs:ignoreFile
/**
 * Modo mantenimiento.
 *
 * Subir este archivo dentro de la carpeta /wp-content/ en el servidor para que
 * WordPress lo utilice cuando actualiza el sitio en vez de la típica pantalla
 * en blanco con el cartel "No disponible por mantenimiento programado...".
 *
 * NO USAR funciones de WordPress. Sólo PHP plano y HTML.
 *
 * @package startwp
 * @since   1.0.0
 */

header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
header( 'Status: 503 Service Temporarily Unavailable' );
header( 'Retry-After: 600' );
$startwp_lang = substr( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2 );

// Modo desarrollo para pruebas. Cambiar a true para activarlo.
define( 'STARTWP_DEV_MODE', false );

// Dirección del sitio dependiendo si estas en modo desarrollo o producción.
// Modificar los valores dependiendo de tus sitios.
$startwp_site_url = ( STARTWP_DEV_MODE )
	/**
	 * @param string $_SERVER['SERVER_NAME'] El nombre del dominio (localhost o
	 * tu-dominio.com).
	 */
	? $_SERVER['SERVER_NAME'] . '/startwp/' // En desarrollo.
	: $_SERVER['SERVER_NAME'] . '/';        // En producción.

// Por cuestión de organización, es recomendable crear una carpeta para imágenes
// y demás archivos que quieras usar para esta plantilla de mantenimiento.
$startwp_maintenance = $startwp_site_url . 'wp-content/maintenance';
?>

<!DOCTYPE html>
<html lang="<?php echo $startwp_lang; ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- <link rel="icon" type="image/png" sizes="32x32" href="//<?php echo $startwp_maintenance . '/favicon.png'; ?>"> -->
	<style>
		*,
		*::before,
		*::after { box-sizing: inherit; word-break: break-word; }
		html { box-sizing: border-box; font-size: 16px; -webkit-text-size-adjust: 100%; }
		body {
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
			align-items: center;
			min-height: 100vh;
			margin: 0;
			line-height: 1.5;
			color: #333333;
			background-color: #ffffff;
			font-family: sans-serif;
		}
		a { color: #305cd4; font-weight: bold; }
		a:not(:hover) { text-decoration: none; }
		.main-container { padding: 5rem 1rem; }
		.main-title {
			margin-top: 0;
			margin-bottom: 0;
			line-height: 1.15;
			font-size: 1.8em;
		}
		.main-container,
		.main-footer { text-align: center; }
		.main-footer {
			margin-top: auto;
			padding-top: 1em;
			padding-bottom: 1em;
			font-size: 0.9em;
		}
		.main-footer span { display: block; padding-bottom: 0.25em; }
		@media screen and (min-width: 640px) {
			.main-container { padding: 7% 1rem; font-size: 1.2em; }
			.main-title { font-size: 3.2rem; }
			.main-footer span { font-size: 1.2rem; }
		}
	</style>

	<!-- Para sitios multi-idioma hay que hacer la validación de forma manual. -->
	<!-- Es importante revisar que el servidor esté pasando correctamente el idioma. -->
	<?php if ( 'es' == $startwp_lang ) : ?>
		<title>Sitio en mantenimiento</title>
	<?php else : ?>
		<title>Site under maintenance</title>
	<?php endif; ?>
</head>

<body>
	<?php if ( STARTWP_DEV_MODE ) : ?>
<pre style="max-width: 100%; padding: 15px; margin: 15px 10px; background-color: #eeeeee; border: 1px solid rgba(0,0,0,0.1); overflow: auto;">
<?php
// Algunas variables para probar la información del servidor (URLs, idioma, etc.).
// Para ver esto es necesario activar el modo desarrollo en la linea 21.
print_r( 'SERVER_NAME : ') . var_dump( $_SERVER['SERVER_NAME'] );
print_r( 'HTTP_HOST   : ') . var_dump( $_SERVER['HTTP_HOST'] );
print_r( 'PHP_SELF    : ') . var_dump( $_SERVER['PHP_SELF'] );
print_r( 'REQUEST_URI : ') . var_dump( $_SERVER['REQUEST_URI'] );
print_r( 'LANGUAGE    : ') . var_dump( $startwp_lang );
print_r( 'SITE_URL    : ') . var_dump( $startwp_site_url );
?>
</pre>
	<?php endif; //end STARTWP_DEV_MODE ?>

	<main class="main-container">
		<?php if ( 'es' == $startwp_lang ) : ?>
			<h1 class="heading main-title">Sitio en mantenimiento</h1>
			<p>
				Estamos haciendo algunas mejoras,<br>
				por favor vuelve m&aacute;s tarde.
			</p>
		<?php else : ?>
			<h1 class="heading main-title">Site under maintenance</h1>
			<p>
				We are making some improvements,<br>
				please come back later.
			</p>
		<?php endif; ?>
	</main>

	<footer class="main-footer">
		<p>
			<span>
				<a href="https://github.com/gigenam/startwp" target="_blank">StartWP</a> &copy; <?php echo gmdate( 'Y' ); ?>
			</span>
			<a href="https://www.gnu.org/licenses/old-licenses/gpl-2.0.html" target="_blank">
				GNU General Public License
			</a>
		</p>
	</footer>
</body>
</html>
