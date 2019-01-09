/**
 * Asset dependencies.
 */

// Styles
import '../scss/style.scss';

/**
 * External dependencies.
 */
import domReady from '@wordpress/dom-ready';

domReady( () => {
	const cover = document.querySelector( '.home .wp-block-cover-image' );

	if ( ! cover || window.innerWidth < 576 ) {
		return;
	}

	window.addEventListener( 'scroll', () => {
		const offset = window.pageYOffset;

		if ( offset > 50 && offset < 500 ) {
			cover.style.transform = `translate3d(0, ${ ( offset / 100 ) * 6 }px, 0)`;
		}
	} );
} );
