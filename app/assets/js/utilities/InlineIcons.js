/**
 * Agregar íconos SVG en linea
 *
 * Agregarle las clases 'has-icon icon-[nombre ícono]' a un elemento en el HTML.
 * Para agregar el ícono después, usar 'has-icon-after icon-[nombre ícono]'.
 * En caso de no poder controlar el HTML, usar el método customIcon().
 * Ver a partir de lineas 20 y 82.
 *
 * @since 1.0.0
 */

export default class InlineIcons {
	constructor() {
		this.iconSelectors = document.querySelectorAll( '[class*="icon-"]:where(:not(svg):not([class*="icon-button"]):not([class*="wp-block-social-links"]))' );

		if ( this.iconSelectors ) {
			this.addIcons();

			// Ejemplo para agregar en un elemento existente (Login/out widget)
			// con posibilidad de cambiar de estado.
			// this.customIcon(
			// 	'.logged-in.wp-block-loginout',
			// 	'loginout',
			// 	false,
			// 	true,
			// 	'logged-in',
			// 	[ 'logout', 'login' ],
			// );
		}
	}

	/**
	 * Crear un SVG dentro de un elemento con las clases `icon-[nombre icono]`
	 */
	addIcons() {
		this.iconSelectors.forEach( ( element ) => {
			// Separar clases.
			const elementClasses = element.classList.value;
			const trimClasses    = elementClasses.substring( elementClasses.search( /\s[icon]/ ) + 1 );
			let iconClass        = trimClasses.substring( 5, trimClasses.search( /[a-z]\s/g ) + 1 );
			if ( trimClasses.search( /[a-z]\s/g ) < 0 ) {
				iconClass = trimClasses.substring( 5 );
			}

			// Crear SVG en linea.
			const iconSVG = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
			iconSVG.setAttribute( 'aria-hidden', 'true' );
			iconSVG.classList.add( `icon-${ iconClass }` );
			iconSVG.innerHTML = `<use xlink:href="#${ iconClass }"/>`;

			// Si es un menú de navegación o un botón de bloque,
			// agregar el SVG dentro del enlace.
			if ( element.classList.contains( 'menu-item' ) || element.classList.contains( 'wp-block-button' ) ) {
				element.firstElementChild.insertAdjacentElement( 'afterbegin', iconSVG );

				if ( element.classList.contains( 'has-icon-after' ) ) {
					element.firstElementChild.insertAdjacentElement( 'beforeend', iconSVG );
				}
				return;
			}

			// Si es un archivo de bloque, agregar el SVG dentro del último enlace.
			if ( element.classList.contains( 'wp-block-file' ) ) {
				element.lastElementChild.insertAdjacentElement( 'afterbegin', iconSVG );

				if ( element.classList.contains( 'has-icon-after' ) ) {
					element.lastElementChild.insertAdjacentElement( 'beforeend', iconSVG );
				}
				return;
			}

			if ( element.classList.contains( 'has-icon-after' ) ) {
				element.insertAdjacentElement( 'beforeend', iconSVG );
			} else {
				element.insertAdjacentElement( 'afterbegin', iconSVG );
			}
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
		const elements = document.querySelectorAll( iconSelector );
		elements.forEach( ( element ) => {
			const iconSVG = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );
			iconSVG.setAttribute( 'aria-hidden', 'true' );
			iconSVG.classList.add( `icon-${ iconClass }` );

			if ( validate ) {
				const icon = ( element.classList.contains( validateClass ) ) ? changeClasses[ 0 ] : changeClasses[ 1 ];
				iconSVG.innerHTML = `<use xlink:href="#${ icon }"/>`;
			} else {
				iconSVG.innerHTML = `<use xlink:href="#${ iconClass }"/>`;
			}

			if ( afterPos ) {
				element.insertAdjacentElement( 'beforeend', iconSVG );
			} else {
				element.insertAdjacentElement( 'afterbegin', iconSVG );
			}
		} );
	}
}
