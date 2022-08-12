/**
 * Detectar el navegador web del usuario
 *
 * Verifica el navegador y la versión del usuario y agrega una clase al elemento
 * HTML principal con el nombre 'is-[navegador]' (Ej. is-firefox).
 * Además, para navegadores viejos, como Internet Explorer, agrega una alerta.
 *
 * @since 1.0.0
 */

export default class DetectBrowsers {
	constructor() {
		this.userAgentString = navigator.userAgent;
		this.isChrome        = false;
		this.isFirefox       = false;
		this.isIE            = false;
		this.isSafari        = false;
		this.isOperaOld      = false;
		this.isOutdated      = false;

		document.addEventListener( 'DOMContentLoaded', () => {
			this.alerts         = document.querySelectorAll( '.alert' );
			this.alertsAutoSave = document.querySelectorAll( '.alert--save-on-local' );
			this.rememberClose  = document.querySelectorAll( '.check-remember' );
			this.closeButtons   = document.querySelectorAll( '.btn__alert-close' );
			this.getBrowser();
			this.browserVersion();
			this.hideAlert();
			this.rememberAlert();
		} );
	}

	/**
	 * Saber que navegador se está utilizando y devolver true o false en cada
	 * uno de estos.
	 */
	getBrowser() {
		// Chrome (blink).
		this.isChrome = this.userAgentString.indexOf( 'Chrome' ) > -1;

		// Internet Explorer.
		this.isIE = this.userAgentString.indexOf( 'MSIE' ) > -1 || this.userAgentString.indexOf( 'rv:' ) > -1;

		// Firefox.
		this.isFirefox = this.userAgentString.indexOf( 'Firefox' ) > -1;

		// Safari (webkit).
		this.isSafari = this.userAgentString.indexOf( 'Safari' ) > -1;

		// Opera viejo (presto) (Nueva versión usa blink).
		this.isOperaOld = this.userAgentString.indexOf( 'OP' ) > -1;

		// Descartar IE ya que también coincide con Firefox rv:.
		if ( this.isFirefox && this.isIE ) {
			this.isIE = false;
		}

		// Descartar Safari ya que también coincide con Chrome.
		if ( this.isChrome && this.isSafari ) {
			this.isSafari = false;
		}

		// Descartar Chrome ya que también coincide con Opera.
		if ( this.isChrome && this.isOperaOld ) {
			this.isChrome = false;
		}
	}

	/**
	 * Obtener y validar las versiones de Chrome, Firefox y Safari y devuelve
	 * verdadero o falso para el parámetro this.isOutdated.
	 *
	 * Agregar la clase is-[navegador] al elemento HTML principal.
	 */
	browserVersion() {
		if ( this.isChrome ) {
			this.userAgentBrowser = this.userAgentString.slice( this.userAgentString.indexOf( 'Chrome' ), -1 );
			this.userAgentBrowser = this.userAgentBrowser.split( ' ' )[ 0 ];
			this.userAgentVersion = parseInt( this.userAgentBrowser.split( '/' )[ 1 ] );
			this.isOutdated       = ( this.userAgentVersion < 90 ) ? true : false;
			document.documentElement.classList.add( 'is-chrome' );
		} else if ( this.isFirefox ) {
			this.userAgentBrowser = this.userAgentString.slice( this.userAgentString.indexOf( 'Firefox' ), -1 );
			this.userAgentBrowser = this.userAgentBrowser.split( ' ' )[ 0 ];
			this.userAgentVersion = parseInt( this.userAgentBrowser.split( '/' )[ 1 ] );
			this.isOutdated       = ( this.userAgentVersion < 90 ) ? true : false;
			document.documentElement.classList.add( 'is-firefox' );
		} else if ( this.isSafari ) {
			this.userAgentVersion = this.userAgentString.split( 'Version/' );
			this.userAgentVersion = parseInt( this.userAgentVersion[ 1 ] );
			this.isOutdated       = ( this.userAgentVersion < 13 ) ? true : false;
			document.documentElement.classList.add( 'is-safari' );
		}
	}

	/**
	 * Ocultar alerta de navegadores viejos
	 */
	hideAlert() {
		this.closeButtons.forEach( ( btn ) => {
			const btnParent = btn.parentElement.parentElement.parentElement;

			btn.addEventListener( 'click', () => {
				btnParent.classList.remove( 'alert--visible' );
				btnParent.classList.add( 'alert--hide' );
				setTimeout( () => btnParent.classList.remove( 'alert--hide' ), 1000 );
			} );
		} );
	}

	/**
	 * Recordar opción del usuario para no mostrar de nuevo la alerta
	 */
	rememberAlert() {
		this.rememberClose.forEach( ( check ) => {
			const checkParent = check.parentElement.parentElement.parentElement.parentElement;
			const storageItem = 'startwp_' + checkParent.classList[ checkParent.classList.length - 1 ];

			check.addEventListener( 'click', () => {
				if ( check.checked ) {
					localStorage.setItem( storageItem, true );
				} else {
					localStorage.removeItem( storageItem );
				}
			} );

			if ( localStorage.getItem( storageItem ) ) {
				checkParent.classList.remove( 'alert--visible' );
			}
		} );

		// Auto almacenar la alerta y no mostrar más sin necesidad de confirmación.
		// TODO: EN PRUEBA.
		// if ( this.alertsAutoSave ) {
		// 	this.alertsAutoSave.forEach( ( alert ) => {
		// 		const storageItem = 'startwp_' + alert.classList[ 2 ];
		// 		setTimeout( () => localStorage.setItem( storageItem, true ), 500 );
		// 		if ( localStorage.getItem( storageItem ) ) {
		// 			alert.classList.remove( 'alert--visible' );
		// 		}
		// 	} );
		// }
	}
}
