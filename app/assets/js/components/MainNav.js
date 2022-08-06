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
		this.menuButton    = document.querySelector( '.btn-menu--primary' );
		this.menuPrimary   = document.querySelector( '.nav-primary' );
		this.menuContainer = document.querySelector( '.nav-primary .menu' );
		this.menuItems     = document.querySelectorAll( '.nav-primary .menu[data-submenu="hover"] .menu-item-has-children' );
		this.clickItems    = document.querySelectorAll( '.nav-primary .menu[data-submenu="click"] .menu-item-has-children' );
		this.events();
	}

	// Iniciar eventos.
	events() {
		if ( ! this.menuButton && ! this.menuContainer ) {
			return;
		}

		this.menuButton.addEventListener( 'click', () => this.toggleMenu() );

		// Navegación por el menú con el teclado.
		this.menuItems.forEach( ( el ) => {
			// Agregar flecha indicadora de sub-menus.
			el.firstElementChild.classList.add( 'has-icon-after', 'icon-arrow' );

			el.firstElementChild.addEventListener( 'focus', () => this.showSubMenus( el ) );
			el.lastElementChild.lastElementChild.addEventListener( 'focusout', () => this.hideSubMenus( el ) );

			// Si el elemento tiene un enlace local (#anchor), quitar la clase focus.
			el.firstElementChild.addEventListener( 'click', () => this.hideSubMenus( el ) );
		} );

		/**
		 * Mostrar sub-menus al hacer click
		 *
		 * Agregar el atributo data-submenu="click" al ul/ol padre.
		 * Por defecto el menú principal viene con data-submenu="hover".
		 *
		 * @see header.php#L71
		 */
		this.clickItems.forEach( ( el ) => {
			// Crear y mostrar una ayuda para la navegación con teclado cuando
			// hay sub-menus disponibles.
			const label = document.createElement( 'span' );
			label.classList.add( 'menu-item--sub-menu-tip' );
			label.innerHTML = startwp_i10n.viewSubmenus;
			el.firstElementChild.addEventListener( 'keyup', ( e ) => e.target.appendChild( label ) );
			el.firstElementChild.addEventListener( 'focusout', ( e ) => e.target.removeChild( label ) );

			// Agregar flecha indicadora de sub-menus.
			el.firstElementChild.classList.add( 'has-icon-after', 'icon-arrow' );

			el.firstElementChild.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				e.stopPropagation();
				el.firstElementChild.classList.toggle( 'is-open' );
				if ( el.classList.contains( 'menu-item--show-sub-menu' ) ) {
					this.hideSubMenus( el );
				} else {
					this.showSubMenus( el );
				}
			} );
			document.body.addEventListener( 'click', () => this.hideSubMenus( el ) );

			// Cerrar menú con ESC.
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
		// Comentar en caso de usar estilos flotante o lateral.
		// @see /assets/scss/components/_menus.scss#L150
		document.documentElement.style.setProperty( '--startwp--nav-primary--height', `${ this.menuContainer.getBoundingClientRect().height }px` );

		this.menuButton.classList.toggle( 'btn-menu--is-active' );
		this.menuPrimary.classList.toggle( 'nav-primary--is-visible' );

		if ( 'true' === this.menuButton.getAttribute( 'aria-expanded' ) ) {
			this.menuButton.setAttribute( 'aria-expanded', 'false' );
		} else {
			this.menuButton.setAttribute( 'aria-expanded', 'true' );
		}
	}

	/**
	 * Mostrar sub-menus
	 *
	 * @param { Object } el El elemento seleccionado.
	 */
	showSubMenus( el ) {
		el.classList.add( 'menu-item--show-sub-menu' );
		el.lastElementChild.classList.add( 'sub-menu--is-visible' );
	}

	/**
	 * Ocultar sub-menus
	 *
	 * @param { Object } el El elemento seleccionado.
	 */
	hideSubMenus( el ) {
		el.classList.remove( 'menu-item--show-sub-menu' );
		el.lastElementChild.classList.remove( 'sub-menu--is-visible' );
	}
}
