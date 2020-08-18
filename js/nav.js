/**
 * Polyfill for IE11 - adds NodeList.foreach().
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach
 */
if ( window.NodeList && ! NodeList.prototype.forEach ) {
    NodeList.prototype.forEach = function( callback, thisArg ) {
        thisArg = thisArg || window;
        for ( var i = 0; i < this.length; i++ ) { // eslint-disable-line vars-on-top
            callback.call( thisArg, this[ i ], i, this );
        }
    };
}

window.alxMediaMenu = {

	/**
	 *
	 * @param {Object} args - The arguments.
	 * @param {string} args.selector - The navigation selector.
	 * @param {int}    args.breakpoint - The breakpoint in pixels.
	 */
	init: function( args ) {
		var self = this,
			navs = document.querySelectorAll( args.selector );

		if ( ! navs.length ) {
			return;
		}

		navs.forEach( function( nav ) {
			var menuToggler = nav.querySelector( '.menu-toggle' );

			// Hide menu toggle button if menu is empty and return early.
			if ( ! nav.querySelector( 'ul' ) && nav.querySelector( '.menu-toggle' ) ) {
				nav.querySelector( '.menu-toggle' ).style.display = 'none';
			}

			// Add nav-menu class.
			if ( ! nav.classList.contains( 'nav-menu' ) ) {
				nav.classList.add( 'nav-menu' );
			}

			// Toggle the hover event listeners.
			self.toggleHoverEventListeners( nav );

			// Toggle focus classes on links.
			nav.querySelectorAll( 'a,button' ).forEach( function( link ) {
				link.addEventListener( 'focus', window.alxMediaMenu.toggleFocus, true );
				link.addEventListener( 'blur', window.alxMediaMenu.toggleFocus, true );
			});

			menuToggler.addEventListener( 'click', function() {
				if ( nav.classList.contains( 'toggled' ) ) {
					menuToggler.setAttribute( 'aria-expanded', 'false' );
					nav.classList.remove( 'toggled' );
				} else {
					menuToggler.setAttribute( 'aria-expanded', 'true' );
					nav.classList.add( 'toggled' );
				}
			});

			// If on mobile nav, close it when clicking outside.
			// If on desktop, close expanded submenus when clicking outside.
			document.addEventListener( 'click', function( event ) {
				if ( ! nav.contains( event.target ) ) {

					// Mobile.
					nav.classList.remove( 'toggled' );

					// Desktop.
					nav.querySelectorAll( 'button.active,.sub-menu.active' ).forEach( function( el ) {
						el.classList.remove( 'active' );
					});

					menuToggler.setAttribute( 'aria-expanded', 'false' );
				}
			});
		});

		// Toggle mobile classes on initial load.
		window.alxMediaMenu.toggleMobile( args.selector, args.breakpoint );

		// Toggle mobile classes on resize.
		window.addEventListener( 'resize', function() {

			// If timer is null, reset it to our bounceDelay and run, otherwise wait until timer is cleared.
			if ( ! window.resizeDebouncedTimeout ) {
				window.resizeDebouncedTimeout = setTimeout( function() {
					window.resizeDebouncedTimeout = null;
					window.alxMediaMenu.toggleMobile( args.selector, args.breakpoint );
				}, 250 );
			}
		});

		// Toggle focus classes to allow submenu access on tables.
		document.querySelectorAll( args.selector ).forEach( function( el ) {
			window.alxMediaMenu.toggleFocusTouch( el );
		});
	},

	/**
	 * Expand a menu item.
	 *
	 * @param {Element} - The menu item (DOM element).
	 * @return {void}
	 */
	toggleItem: function( el ) {
		var parentLi = this.helper.firstAncestorMatch( el, 'li' ),
			parentUl = this.helper.firstAncestorMatch( el, 'ul' ),
			ul = parentLi.querySelector( 'ul.sub-menu' );

		parentLi.classList.remove( 'hover' );

		ul.setAttribute( 'tabindex', '-1' );
		this.helper.toggleClass( ul, 'active' );
		this.helper.toggleClass( el, 'active' );

		// Go one level up in the list, and close other items that are already open.
		parentUl.querySelectorAll( 'ul.sub-menu' ).forEach( function( subMenu ) {
			var subMenuButton;
			if ( ! parentLi.contains( subMenu ) ) {
				subMenu.classList.remove( 'active' );
				subMenuButton = subMenu.parentNode.querySelector( 'button.active' );
				if ( subMenuButton ) {
					subMenuButton.classList.remove( 'active' );
				}
			}
		});
	},

	/**
	 * Toggles a mobile class to elements matching our selector,
	 * depending on the defined breakpoint.
	 *
	 * @param {string} selector - The elements where we want to toggle our mobile class.
	 * @param {string} className - The class-name we want to toggle.
	 * @param {int} breakpoint - The breakpoint.
	 * @return {void}
	 */
	toggleMobile: function( selector, breakpoint ) {
		var self = this,
			screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
			navs = document.body.querySelectorAll( selector ),
			isMobile;

		breakpoint = breakpoint || 720;
		isMobile = breakpoint > screenWidth;

		if ( isMobile ) {
			navs.forEach( function( nav ) {
				if ( ! nav.classList.contains( 'mobile' ) ) {
					nav.classList.add( 'mobile' );
					self.toggleHoverEventListeners( nav );
				}
			});
		} else {
			navs.forEach( function( nav ) {
				if ( nav.classList.contains( 'mobile' ) ) {
					nav.classList.remove( 'mobile' );
					self.toggleHoverEventListeners( nav );
				}
			});
		}
	},

	/**
	 * Add a "hover" class.
	 *
	 * @return {void}
	 */
	liMouseEnterEvent: function() {
		this.classList.add( 'hover' );
	},

	/**
	 * Remove the "hover" class.
	 *
	 * @return {void}
	 */
	liMouseLeaveEvent: function() {
		this.classList.remove( 'hover' );
	},

	/**
	 *
	 * @param {Element} nav - The nav element.
	 * @return {void}
	 */
	toggleHoverEventListeners: function( nav ) {
		if ( nav.classList.contains( 'mobile' ) ) {
			this.removeHoverEventListeners( nav );
		} else {
			this.addHoverEventListeners( nav );
		}
	},

	/**
	 * Add event-listeners for hover events.
	 *
	 * @param {Element} nav - The nav element.
	 * @return {void}
	 */
	addHoverEventListeners: function( nav ) {
		nav.querySelectorAll( 'li' ).forEach( function( li ) {
			li.addEventListener( 'mouseenter', window.alxMediaMenu.liMouseEnterEvent );
			li.addEventListener( 'mouseleave', window.alxMediaMenu.liMouseLeaveEvent );
		});
	},

	/**
	 * Remove event-listeners for hover events.
	 *
	 * @param {Element} nav - The nav element.
	 * @return {void}
	 */
	removeHoverEventListeners: function( nav ) {
		nav.querySelectorAll( 'li' ).forEach( function( li ) {
			li.removeEventListener( 'mouseenter', window.alxMediaMenu.liMouseEnterEvent );
			li.removeEventListener( 'mouseleave', window.alxMediaMenu.liMouseLeaveEvent );
		});
	},

	/**
	 * Sets or removes .focus class on an element.
	 *
	 * @return {void}
	 */
	toggleFocus: function() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	},

	/**
	 * Toggle focus classes to allow submenu access on tables.
	 *
	 * @param {Element} el - The menu element.
	 * @return {void}
	 */
	toggleFocusTouch: function( el ) {
		var touchStartFn,
			parentLinks = el.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					menuItem.parentNode.children.forEach( function( child ) {
						if ( menuItem !== child ) {
							child.classList.remove( 'focus' );
						}
					});
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			parentLinks.forEach( function( parentLink ) {
				parentLink.addEventListener( 'touchstart', touchStartFn, false );
			});
		}
	},

	/**
	 * Helper methods.
	 */
	helper: {

		/**
		 * Toggle a class to an element.
		 *
		 * @param {Element} el - The element.
		 * @param {string} className - The class we want to toggle.
		 * @return {void}
		 */
		toggleClass: function( el, className ) {
			if ( el.classList.contains( className ) ) {
				el.classList.remove( className );
			} else {
				el.classList.add( className );
			}
		},

		/**
		 * Get the 1st ancestor of an element that matches our selector.
		 *
		 * @param {Element} el - The element.
		 * @param {string} selector - The class we want to toggle.
		 * @return {Element}
		 */
		firstAncestorMatch: function( el, selector ) {
			if ( el.parentNode.matches( selector ) ) {
				return el.parentNode;
			}
			return this.firstAncestorMatch( el.parentNode, selector );
		}
	}
};

window.alxMediaMenu.init({
	selector: '.main-navigation.nav-menu',
	breakpoint: 720
});
