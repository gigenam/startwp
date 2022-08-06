/**
 * Tareas de desarrollo mediante Gulp
 *
 * * sync()
 * * cleanCss()
 * * styles()
 * * scripts()
 * * sprites()
 * * images()
 * * translate()
 * * updateThemeInfo()
 * * updateThemeVersion()
 * * watchFiles()
 */

import info         from './package.json' assert {'type':'json'};
import gulp         from 'gulp';
import clean        from 'gulp-clean';
import gulpSass     from 'gulp-sass';
import postcss      from 'gulp-postcss';
import sourcemaps   from 'gulp-sourcemaps';
import imagemin     from 'gulp-imagemin';
import svgSprite    from 'gulp-svg-sprite';
import wpPot        from 'gulp-wp-pot';
import mergeMQ      from 'gulp-merge-media-queries';
import rename       from 'gulp-rename';
import urlAdjuster  from 'gulp-css-url-adjuster';
import replace      from 'gulp-string-replace';
import BrowserSync  from 'browser-sync';
import dartSass     from 'sass';
import autoprefixer from 'autoprefixer';
import cssnano      from 'cssnano';
import webpack      from 'webpack-stream';
const sass = gulpSass( dartSass );

/**
 * Variables globales
 */
// Prod.
const PRODUCTION = process.env.NODE_ENV;

// Variables con información del tema desde package.json.
const devURL           = info.site;
const themeDomain      = info.name;
const themeURL         = info.repository.url;
const themeDescription = info.description;
const themeVersion     = info.version;
const authorName       = info.author;
const authorURL        = info.homepage;

// Browser Sync.
const liveSync = devURL;
const server   = BrowserSync.create();

// Rutas.
const paths = {
	styles: {
		src: './app/assets/scss/*.scss',
		dest: './app/css',
	},
	scripts: {
		src: './app/assets/js/main.js',
		dest: './app/js',
	},
	sprites: {
		src: './app/assets/img/sprites/*.svg',
		dest: './app/assets/img',
	},
	images: {
		src: './app/assets/img/*.{jpg,jpeg,png,gif,webp,svg}',
		dest: './app/img',
	},
};

/**
 * Tareas
 *
 * @param { Function } done Finalizar la tarea.
 */
// Iniciar Browser Sync.
export const sync = ( done ) => {
	server.init( {
		proxy: liveSync,
		open: false,                     // Prevenir abrir navegador al arrancar.
		notify: false,                   // Quitar notificaciones.
		// injectChanges: true,          // Forzar inyección de CSS.
		// browser: {string or string[]} // Navegador por defecto (cuando 'open' está en true).
	} );
	done();
};

// Limpiar carpeta CSS para evitar problemas de sobre-escritura.
export const cleanCss = () => {
	return gulp.src( paths.styles.dest + '/', { read: false, allowEmpty: true } )
		.pipe( clean() );
};

// Compilar archivos SCSS.
export const styles = ( done ) => {
	if ( PRODUCTION !== 'production' ) {
		gulp.src( paths.styles.src )
			.pipe( sourcemaps.init() )
			.pipe( sass( { outputStyle: 'expanded' } ).on( 'error', sass.logError ) )
			// .pipe( mergeMQ() )
			.pipe( sourcemaps.write( '.' ) )
			.pipe( gulp.dest( paths.styles.dest ) )
			.pipe( server.stream() );
	} else {
		gulp.src( paths.styles.src )
			.pipe( sass().on( 'error', sass.logError ) )
			.pipe( postcss( [ autoprefixer( { grid: true } ) ] ) )
			.pipe( urlAdjuster( { append: `?ver=${ themeVersion }` } ) )
			.pipe( replace( /sprites.svg#[a-zA-Z-_?ver=[0-9.]*/g, ( e ) => {
				// Quitar versión a los sprites para evitar problemas.
				return e.match( /sprites.svg#[a-zA-Z-_]*/g );
			} ) )
			// .pipe( mergeMQ() )
			.pipe( gulp.dest( paths.styles.dest ) )
			.pipe( postcss( [ cssnano() ] ) )
			.pipe( rename( { suffix: '.min' } ) )
			.pipe( gulp.dest( paths.styles.dest ) );
	}
	done();
};

// Compilar archivos JS.
export const scripts = ( done ) => {
	gulp.src( paths.scripts.src )
		.pipe( webpack( {
			mode: ( PRODUCTION !== 'production' ) ? 'development' : 'production',
			entry: { main: paths.scripts.src },
			module: {
				rules: [ {
					test: /\.js$/,
					use: {
						loader: 'babel-loader',
						options: { presets: [ '@babel/preset-env' ] },
					},
				} ],
			},
			devtool: ( PRODUCTION !== 'production' ) ? 'inline-source-map' : false,
			output: { filename: ( PRODUCTION !== 'production' ) ? '[name].js' : '[name].min.js' },
		} ).on( 'error', function handleError() {
			this.emit( 'end' ); // Seguir compilando a pesar de errores.
		} ) )
		.pipe( gulp.dest( paths.scripts.dest ) );
	done();
};

// Crear sprites de íconos.
export const sprites = ( done ) => {
	gulp.src( paths.sprites.src )
		.pipe( svgSprite( {
			mode: {
				inline: true,
				stack: {
					dest: './',
					sprite: './sprites.svg',
				},
			},
		} ) )
		.pipe( gulp.dest( paths.sprites.dest ) );
	done();
};

// Copiar imágenes a la carpeta final. Comprimir en producción.
export const images = ( done ) => {
	if ( PRODUCTION !== 'production' ) {
		gulp.src( paths.images.src )
			.pipe( gulp.dest( paths.images.dest ) );
	} else {
		// Primero borrar todo.
		gulp.src( paths.images.dest + '/*', { allowEmpty: true } )
			.pipe( clean() );

		gulp.src( paths.images.src )
			.pipe( imagemin( {
				interlaced: true,
				progressive: true,
				optimizationLevel: 5,
				svgoPlugins: [
					{ removeViewBox: true },
					{ cleanupIDs: true },
				],
			} ) )
			.pipe( gulp.dest( paths.images.dest ) );
	}
	done();
};

// Crear archivo de traducción.
export const translate = ( done ) => {
	gulp.src( [ './app/**/*.php' ] )
		.pipe( wpPot( { domain: themeDomain } ) )
		.pipe( gulp.dest( `./app/languages/${ themeDomain }.pot` ) );
	done();
};

// Actualizar info del tema en app/styles.css al instalar herramientas de
// desarrollo. Igual a package.json.
export const updateThemeInfo = ( done ) => {
	let themeName = themeDomain.replace( '-', ' ' );
	themeName = themeName.trim().replace( /^\w/, ( c ) => c.toUpperCase() );

	gulp.src( './app/style.css' )
		.pipe( replace( /Theme Name:\s.*/, `Theme Name: ${ themeName }` ) )
		.pipe( replace( /Theme URI:\s.*/, `Theme URI: ${ themeURL }` ) )
		.pipe( replace( /Author:\s.*/, `Author: ${ authorName }` ) )
		.pipe( replace( /Author URI:\s.*/, `Author URI: ${ authorURL }` ) )
		.pipe( replace( /Description:\s.*/, `Description: ${ themeDescription }` ) )
		.pipe( replace( /License:\s.*/, `License: ${ info.license }` ) )
		.pipe( replace( /Text Domain:\s.*/, `Text Domain: ${ themeDomain }` ) )
		.pipe( gulp.dest( './app' ) );

	gulp.src( [ './composer.json', '!./node_modules/**/*', '!./vendor/**/*' ] )
		.pipe( replace( /"name":\s.*/, `"name": "${ info.repository.author }/${ themeDomain }"` ) )
		.pipe( replace( /"description":\s.*/, `"description": "${ themeDescription }"` ) )
		.pipe( replace( /"author":\s.*/, `"author": "${ authorName }"` ) )
		.pipe( replace( /"homepage":\s.*/, `"homepage": "${ themeURL }"` ) )
		.pipe( replace( /"license":\s.*/, `"license": "${ info.license }"` ) )
		.pipe( gulp.dest( './' ) );
	done();
};

// Actualizar versión del tema al correr 'npm run build'.
// Igual a package.json.
export const updateThemeVersion = ( done ) => {
	gulp.src( './app/style.css' )
		.pipe( replace( /Version:\s([0-9.])*/, `Version: ${ themeVersion }` ) )
		.pipe( gulp.dest( './app' ) );

	gulp.src( [ './composer.json', '!./node_modules/**/*', '!./vendor/**/*' ] )
		.pipe( replace( /"version":\s.*/, `"version": "${ themeVersion }",` ) )
		.pipe( gulp.dest( './' ) );
	done();
};

// Vigilar archivos en desarrollo.
export const watchFiles = ( done ) => {
	// Estilos.
	gulp.watch( './app/assets/scss/**/*.scss', gulp.series( styles ) );
	// Scripts.
	gulp.watch( './app/assets/js/**/*.js', gulp.series( scripts ) ).on( 'change', server.reload );
	// Imágenes.
	gulp.watch( './app/assets/img/*', images ).on( 'change', server.reload );
	// PHP.
	gulp.watch( './app/**/*.php' ).on( 'change', server.reload );
	done();
};

// Arrancar servidor local, compilar y vigilar archivos de desarrollo.
export const dev = gulp.series( cleanCss, gulp.parallel( styles, scripts, images ), sync, watchFiles );

// Compilar y vigilar archivos de desarrollo.
export const watch = gulp.series( cleanCss, gulp.parallel( styles, scripts, images ), watchFiles );

// Compilar y comprimir todo para producción.
export const build = gulp.series( cleanCss, gulp.parallel( styles, scripts, images ), updateThemeVersion );
