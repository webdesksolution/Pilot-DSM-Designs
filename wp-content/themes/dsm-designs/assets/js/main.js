( function () {
	'use strict';

	var toggle = document.querySelector( '.nav-toggle' );
	var nav = document.querySelector( '.primary-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = nav.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	} );

	/**
	 * Mobile submenu expand — items with children rely on :hover on desktop,
	 * which doesn't work reliably on touch. Inject a toggle button that
	 * expands the submenu without following the parent link (accordion
	 * pattern, per SOW mega-menu scope: "tablet and mobile views will adapt
	 * to mobile-friendly navigation formats such as accordion or collapsible
	 * menus").
	 */
	var parents = nav.querySelectorAll( '.menu-item-has-children' );
	parents.forEach( function ( parent ) {
		var link = parent.querySelector( ':scope > a' );
		var submenu = parent.querySelector( ':scope > ul' );
		if ( ! link || ! submenu ) {
			return;
		}

		var btn = document.createElement( 'button' );
		btn.className = 'submenu-toggle';
		btn.setAttribute( 'aria-expanded', 'false' );
		btn.setAttribute( 'aria-label', 'Show ' + link.textContent.trim() + ' categories' );
		btn.innerHTML = '<span aria-hidden="true">+</span>';
		link.insertAdjacentElement( 'afterend', btn );

		btn.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			var isOpen = parent.classList.toggle( 'submenu-open' );
			btn.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
			btn.querySelector( 'span' ).textContent = isOpen ? '−' : '+';
		} );
	} );
}() );
