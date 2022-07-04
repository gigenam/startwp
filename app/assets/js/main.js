/**
 * Scripts principales
 */

import MainNav        from './components/MainNav';
import DetectBrowsers from './utilities/DetectBrowsers';
import LinksAsButtons from './utilities/LinksAsButtons';
import InlineIcons    from './utilities/InlineIcons';

// Componentes.
new MainNav();

// Utilidades.
( function( window ) {
	// Hacer DetectBrowsers de acceso global guardándolo en window.
	if ( typeof( window.DetectBrowsers ) === 'undefined' ) {
		window.DetectBrowsers = DetectBrowsers;
	}
} )( window );
new LinksAsButtons();
new InlineIcons();
