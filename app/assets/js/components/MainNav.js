/**
 * Navegación principal
 *
 * Controla múltiples comportamientos de la navegación principal, como abrir
 * sub-menús al hacer clic o pasar el mouse y hacer accesible para la navegación
 * con el teclado.
 *
 * @since 1.0.0
 */

export default class MainNav {
	constructor() {
		this.menuButton  = document.getElementById( 'btn-menu-primary' );
		this.menuPrimary = document.getElementById( 'nav-primary' );
		this.menuItems   = document.querySelectorAll( '#nav-primary .menu-item-has-children' );
		this.initNav();
	}

	// Iniciar.
	initNav() {
		if ( ! this.menuButton && ! this.menuPrimary ) {
			return;
		}

		this.menuButton.addEventListener( 'click', () => this.toggleMenu() );

		/**
		 * Mostrar sub-menus
		 *
		 * Agregar el atributo data-submenu="click" al ul/ol padre permite abrir
		 * los sub-menus haciendo click en el padre de estos.
		 * Por defecto el menú principal viene con data-submenu="hover".
		 *
		 * @see header.php#L70
		 */
		this.menuItems.forEach( ( el ) => {
			// Mostrar / ocultar sub-menus al hacer click.
			if ( 'click' === this.menuPrimary.getAttribute( 'data-submenu' ) ) {
				el.firstElementChild.addEventListener( 'click', ( e ) => {
					e.preventDefault();
					e.stopPropagation();
					// Mostrar al menos 2 sub-niveles de menus.
					if ( ! el.parentElement.classList.contains( 'sub-menu' ) ) {
						this.menuItems.forEach( ( item ) => item.classList.remove( 'menu-item--show-sub-menu' ) );
					}
					this.showSubMenus( el );
				} );
			}

			// Agregar flecha indicadora de sub-menus.
			el.firstElementChild.classList.add( 'has-icon-after', 'icon-arrow' );

			// Mostrar / ocultar sub-menus con el teclado.
			el.firstElementChild.addEventListener( 'focus', () => this.showSubMenus( el ) );
			el.lastElementChild.lastElementChild.addEventListener( 'focusout', () => this.hideSubMenus( el ) );

			// Ocultar sub-menus haciendo click en otra parte del documento o con la tecla ESC.
			document.body.addEventListener( 'click', () => this.hideSubMenus( el ) );
			document.addEventListener( 'keydown', ( e ) => {
				if ( 'Escape' === e.key ) {
					this.hideSubMenus( el );
				}
			} );
		} );
	}

	/**
	 * Mostrar navegación adaptable
	 */
	toggleMenu() {
		/**
		 * Comentar en caso de usar estilos flotante o lateral.
		 *
		 * @see /assets/scss/components/_menus.scss#L138
		 */
		document.documentElement.style.setProperty( '--startwp--nav-primary--height', `${ this.menuPrimary.getBoundingClientRect().height }px` );

		this.menuButton.classList.toggle( 'btn-menu--is-active' );
		this.menuPrimary.parentElement.classList.toggle( 'nav-primary--is-visible' );

		if ( 'true' === this.menuButton.getAttribute( 'aria-expanded' ) ) {
			this.menuButton.setAttribute( 'aria-expanded', 'false' );
		} else {
			this.menuButton.setAttribute( 'aria-expanded', 'true' );
		}
	}

	/**
	 * Mostrar sub-menus
	 *
	 * @param { HTMLElement } el El elemento seleccionado.
	 */
	showSubMenus( el ) {
		el.classList.add( 'menu-item--show-sub-menu' );
		el.lastElementChild.classList.add( 'sub-menu--is-visible' );
	}

	/**
	 * Ocultar sub-menus
	 *
	 * @param { HTMLElement } el El elemento seleccionado.
	 */
	hideSubMenus( el ) {
		el.classList.remove( 'menu-item--show-sub-menu' );
		el.lastElementChild.classList.remove( 'sub-menu--is-visible' );
	}
}
