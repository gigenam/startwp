/**
 * Agregar íconos SVG en linea
 *
 * Agregarle las clases 'has-icon icon-[nombre ícono]' a un elemento en el HTML.
 * Para agregar el ícono después, usar 'has-icon-after icon-[nombre ícono]'.
 * En caso de no poder controlar el HTML, usar el método customIcon().
 * Ver a partir de lineas 21 y 86.
 *
 * @since 1.0.0
 */

export default class InlineIcons {
	constructor() {
		this.iconSelectors = document.querySelectorAll(
			'[class*="icon-"]:where(:not(svg):not([class*="icon-button"]):not([class*="wp-block-social-links"]))',
		);

		if ( this.iconSelectors ) {
			this.addIcons();

			// Ejemplo para agregar en un elemento existente (Login/out widget)
			// con posibilidad de cambiar de estado.
			// this.customIcon(
			// 	'.wp-block-loginout',
			// 	'loginout',
			// 	false,
			// 	true,
			// 	'logged-out',
			// 	[ 'login', 'logout' ],
			// );
		}
	}

	/**
	 * Crear elemento SVG en linea.
	 *
	 * @param { string } iconClass El nombre del ícono.
	 * @return { Object } Elemento svg.
	 */
	createSvgIcon( iconClass ) {
		const iconSVG = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
		iconSVG.setAttribute( 'aria-hidden', 'true' );
		iconSVG.classList.add( `icon-${ iconClass }` );
		iconSVG.innerHTML = `<use xlink:href="#${ iconClass }"/>`;
		return iconSVG;
	}

	/**
	 * Crear un SVG dentro de un elemento con las clases 'icon-[nombre icono]'
	 */
	addIcons() {
		this.iconSelectors.forEach( ( el ) => {
			// Separar clases.
			const trimClasses = el.classList.value.substring( el.classList.value.search( /\s[icon]/ ) + 1 );
			let iconClass     = trimClasses.substring( 5, trimClasses.search( /[a-z]\s/g ) + 1 );
			if ( trimClasses.search( /[a-z]\s/g ) < 0 ) {
				iconClass = trimClasses.substring( 5 );
			}

			// Si es un menú de navegación o un botón de bloque, agregar el SVG
			// dentro del enlace.
			if ( el.classList.contains( 'menu-item' ) || el.classList.contains( 'wp-block-button' ) ) {
				if ( el.classList.contains( 'has-icon-after' ) ) {
					el.firstElementChild.insertAdjacentElement( 'beforeend', this.createSvgIcon( iconClass ) );
					return;
				}
				el.firstElementChild.insertAdjacentElement( 'afterbegin', this.createSvgIcon( iconClass ) );
				return;
			}

			// Si es un archivo de bloque, agregar el SVG dentro del último enlace.
			if ( el.classList.contains( 'wp-block-file' ) ) {
				if ( el.classList.contains( 'has-icon-after' ) ) {
					el.lastElementChild.insertAdjacentElement( 'beforeend', this.createSvgIcon( iconClass ) );
					return;
				}
				el.lastElementChild.insertAdjacentElement( 'afterbegin', this.createSvgIcon( iconClass ) );
				return;
			}

			const insertPosition = ( el.classList.contains( 'has-icon-after' ) ) ? 'beforeend' : 'afterbegin';
			el.insertAdjacentElement( insertPosition, this.createSvgIcon( iconClass ) );
		} );
	}

	/**
	 * Agregar íconos a elementos específicos
	 *
	 * @param { string }  iconSelector  Clase del elemento.
	 * @param { string }  iconClass     Nombre del ícono.
	 * @param { boolean } afterPos      Agregar ícono antes o después del elemento. true para agregarlo después.
	 * @param { boolean } validate      Si quieres cambiar el estado de un elemento con dos íconos.
	 * @param { string }  validateClass Verificar si el elemento tiene cierta clase para hacer el cambio de íconos.
	 * @param { Array }   changeClasses Las dos clases para cambiar de íconos.
	 */
	customIcon( iconSelector, iconClass, afterPos = false, validate = false, validateClass = '', changeClasses = [] ) {
		const elements       = document.querySelectorAll( iconSelector );
		const insertPosition = ( afterPos ) ? 'beforeend' : 'afterbegin';

		elements.forEach( ( element ) => {
			if ( validate ) {
				iconClass = ( element.classList.contains( validateClass ) ) ? changeClasses[ 0 ] : changeClasses[ 1 ];
			}
			this.createSvgIcon( iconClass );
			element.insertAdjacentElement( insertPosition, this.createSvgIcon( iconClass ) );
		} );
	}
}
