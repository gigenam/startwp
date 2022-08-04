/**
 * Scripts principales
 */

import MainNav        from './components/MainNav.js';
import DetectBrowsers from './utilities/DetectBrowsers.js';
import LinksAsButtons from './utilities/LinksAsButtons.js';
import InlineIcons    from './utilities/InlineIcons.js';

// Componentes.
new MainNav();

// Utilidades.
( ( window ) => {
	// Hacer DetectBrowsers de acceso global guardándolo en window.
	if ( typeof( window.DetectBrowsers ) === 'undefined' ) {
		window.DetectBrowsers = DetectBrowsers;
	}
} )( window );
new LinksAsButtons();
new InlineIcons();
