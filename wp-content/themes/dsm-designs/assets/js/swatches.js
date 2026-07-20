/**
 * Swatch UI (MOD-16) — converts configured variation selects into chip groups
 * that stay in sync with WooCommerce's variation form.
 *
 * The original <select> stays in the DOM (visually hidden) and remains the
 * source of truth: chips write to it and dispatch the jQuery 'change' WC listens
 * for. WC's own availability logic (which disables invalid <option>s) is mirrored
 * onto the chips on every variation update.
 */
( function ( $ ) {
	'use strict';

	if ( typeof window.dsmdSwatches === 'undefined' || ! Array.isArray( window.dsmdSwatches.attributes ) ) {
		return;
	}

	var TARGET = window.dsmdSwatches.attributes; // e.g. ['attribute_pa_laminate-color', ...]

	$( function () {
		var $form = $( '.variations_form' );
		if ( ! $form.length ) {
			return;
		}

		$form.find( 'select' ).each( function () {
			var select = this;
			var name = select.getAttribute( 'name' ) || '';
			if ( TARGET.indexOf( name ) === -1 ) {
				return;
			}
			buildSwatches( $( select ) );
		} );

		// Mirror WC availability onto chips whenever variations recalc.
		$form.on( 'woocommerce_update_variation_values reset_data', function () {
			$form.find( '.dsmd-swatches' ).each( function () {
				syncAvailability( $( this ) );
			} );
		} );
	} );

	var MAP = window.dsmdSwatches.swatches || {};

	function buildSwatches( $select ) {
		var name = $select.attr( 'name' ) || '';
		var termMap = MAP[ name ] || {};
		var label = $select.closest( 'tr, .variation, td' ).find( 'label' ).text().trim() || 'Option';
		var $group = $( '<div class="dsmd-swatches" role="radiogroup"></div>' ).attr( 'aria-label', label );

		$select.find( 'option' ).each( function () {
			var val = this.value;
			if ( ! val ) {
				return; // skip "Choose an option"
			}
			var text = this.textContent;
			var meta = termMap[ val ] || null;
			var $chip = $( '<button type="button" class="dsmd-swatch" role="radio"></button>' )
				.attr( 'data-value', val )
				.attr( 'aria-checked', 'false' )
				.attr( 'title', text );

			if ( meta && meta.image ) {
				$chip.addClass( 'dsmd-swatch--image' )
					.append( $( '<img alt="" aria-hidden="true">' ).attr( 'src', meta.image ) )
					.append( $( '<span class="screen-reader-text"></span>' ).text( text ) );
			} else if ( meta && meta.color ) {
				$chip.addClass( 'dsmd-swatch--color' )
					.append( $( '<span class="dsmd-swatch-chip" aria-hidden="true"></span>' ).css( 'background-color', meta.color ) )
					.append( $( '<span class="screen-reader-text"></span>' ).text( text ) );
			} else {
				$chip.append( $( '<span class="dsmd-swatch-label"></span>' ).text( text ) );
			}

			$chip.on( 'click', function () {
				if ( $chip.prop( 'disabled' ) ) {
					return;
				}
				$select.val( val ).trigger( 'change' );
			} );

			$group.append( $chip );
		} );

		$select.addClass( 'dsmd-swatch-select' ).after( $group );

		// Reflect programmatic select changes back onto the chips.
		$select.on( 'change', function () {
			var current = $select.val();
			$group.find( '.dsmd-swatch' ).each( function () {
				var on = this.getAttribute( 'data-value' ) === current;
				this.setAttribute( 'aria-checked', on ? 'true' : 'false' );
				$( this ).toggleClass( 'is-selected', on );
			} );
		} );

		syncAvailability( $group );
	}

	function syncAvailability( $group ) {
		var $select = $group.prevAll( 'select.dsmd-swatch-select' ).first();
		if ( ! $select.length ) {
			return;
		}
		$group.find( '.dsmd-swatch' ).each( function () {
			var val = this.getAttribute( 'data-value' );
			var $opt = $select.find( 'option[value="' + $.escapeSelector( val ) + '"]' );
			var disabled = $opt.length === 0 || $opt.is( ':disabled' );
			$( this ).prop( 'disabled', disabled ).toggleClass( 'is-unavailable', disabled );
		} );
	}
}( jQuery ) );
