/**
 * Enlaces como botones para interactuar
 *
 * Usar etiquetas <a> como botones para prevenir diferentes comportamientos
 * entre navegadores. Especialmente en iOS.
 *
 * Agregar el atributo data-prevent="true" a un enlace <a>.
 * En el atributo 'href' se puede agregar cualquier cosa como "#menu o #show-search",
 * no importa, pero es importante no dejar dicho atributo vacío.
 *
 * @since 1.0.0
 */

export default class LinksAsButtons {
	constructor() {
		this.btnPreventDefault = document.querySelectorAll( '[data-prevent]' );
		if ( this.btnPreventDefault ) {
			this.btnPreventDefault.forEach( ( link ) => link.addEventListener( 'click', ( e ) => e.preventDefault() ) );
		}
	}
}
