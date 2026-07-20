<?php
/**
 * Laminate / hardware / colour swatch UI (MOD-16) — code-based, no plugin.
 *
 * Frontend: converts designated variation <select> dropdowns into accessible
 * swatch chips that stay in sync with WooCommerce's native variation form (the
 * original select stays the source of truth).
 *
 * Admin: adds a swatch colour + swatch image field to each swatch attribute's
 * term edit screen, so RFI-020 assets can be attached per term. When set, the
 * chip renders the image or colour; otherwise it falls back to the term label.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const DSMD_SWATCH_COLOR_META = 'dsmd_swatch_color';
const DSMD_SWATCH_IMAGE_META = 'dsmd_swatch_image';

/**
 * Attribute slugs (without pa_ prefix) rendered as swatches.
 *
 * @return string[]
 */
function dsmd_swatch_attributes() {
	$defaults = array(
		'laminate-color',
		'body-laminate-color',
		'drawer-face-color',
		'shelf-laminate-color',
		'ada-shelf-color',
		'color',
		'hardware',
		'hardware-style',
		'mirror-frames',
	);
	return apply_filters( 'dsmd_swatch_attributes', $defaults );
}

/**
 * Swatch attribute taxonomies (pa_ prefixed).
 *
 * @return string[]
 */
function dsmd_swatch_taxonomies() {
	return array_map(
		static function ( $slug ) {
			return 'pa_' . $slug;
		},
		dsmd_swatch_attributes()
	);
}

/* -------------------------------------------------------------------------
 * Frontend
 * ---------------------------------------------------------------------- */

/**
 * Enqueue swatch assets + per-term swatch data on single product pages.
 */
function dsmd_swatches_enqueue() {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}

	wp_enqueue_script(
		'dsmd-swatches',
		DSMD_THEME_URI . '/assets/js/swatches.js',
		array( 'jquery', 'wc-add-to-cart-variation' ),
		dsmd_asset_version( '/assets/js/swatches.js' ),
		true
	);

	$map = array();
	foreach ( dsmd_swatch_taxonomies() as $tax ) {
		if ( ! taxonomy_exists( $tax ) ) {
			continue;
		}
		$terms = get_terms( array(
			'taxonomy'   => $tax,
			'hide_empty' => false,
		) );
		if ( is_wp_error( $terms ) ) {
			continue;
		}
		$entries = array();
		foreach ( $terms as $term ) {
			$color    = get_term_meta( $term->term_id, DSMD_SWATCH_COLOR_META, true );
			$image_id = (int) get_term_meta( $term->term_id, DSMD_SWATCH_IMAGE_META, true );
			$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';
			if ( $color || $image ) {
				$entries[ $term->slug ] = array(
					'color' => $color ? sanitize_hex_color( $color ) : '',
					'image' => $image ? esc_url_raw( $image ) : '',
				);
			}
		}
		if ( $entries ) {
			$map[ 'attribute_' . $tax ] = $entries;
		}
	}

	wp_localize_script(
		'dsmd-swatches',
		'dsmdSwatches',
		array(
			'attributes' => array_values( array_map(
				static function ( $tax ) {
					return 'attribute_' . $tax;
				},
				dsmd_swatch_taxonomies()
			) ),
			'swatches'   => $map,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'dsmd_swatches_enqueue', 20 );

/* -------------------------------------------------------------------------
 * Admin — per-term swatch colour + image (RFI-020 assets)
 * ---------------------------------------------------------------------- */

/**
 * Register term-meta fields on every swatch attribute taxonomy.
 */
function dsmd_swatches_admin_init() {
	foreach ( dsmd_swatch_taxonomies() as $tax ) {
		add_action( "{$tax}_add_form_fields", 'dsmd_swatch_term_add_fields' );
		add_action( "{$tax}_edit_form_fields", 'dsmd_swatch_term_edit_fields', 10, 2 );
		add_action( "created_{$tax}", 'dsmd_swatch_term_save' );
		add_action( "edited_{$tax}", 'dsmd_swatch_term_save' );
	}
}
add_action( 'admin_init', 'dsmd_swatches_admin_init' );

/**
 * Add-term form fields.
 */
function dsmd_swatch_term_add_fields() {
	wp_nonce_field( 'dsmd_swatch_save', 'dsmd_swatch_nonce' );
	?>
	<div class="form-field">
		<label for="dsmd_swatch_color"><?php esc_html_e( 'Swatch colour (hex)', 'dsm-designs' ); ?></label>
		<input type="text" name="dsmd_swatch_color" id="dsmd_swatch_color" value="" placeholder="#B8ADA4" />
		<p><?php esc_html_e( 'Optional. Used when no swatch image is set.', 'dsm-designs' ); ?></p>
	</div>
	<div class="form-field">
		<label for="dsmd_swatch_image"><?php esc_html_e( 'Swatch image (attachment ID)', 'dsm-designs' ); ?></label>
		<input type="number" name="dsmd_swatch_image" id="dsmd_swatch_image" value="" min="0" step="1" />
		<p><?php esc_html_e( 'Optional. Media library attachment ID for the laminate/hardware swatch (RFI-020).', 'dsm-designs' ); ?></p>
	</div>
	<?php
}

/**
 * Edit-term form fields.
 *
 * @param WP_Term $term Term being edited.
 */
function dsmd_swatch_term_edit_fields( $term ) {
	$color    = get_term_meta( $term->term_id, DSMD_SWATCH_COLOR_META, true );
	$image_id = get_term_meta( $term->term_id, DSMD_SWATCH_IMAGE_META, true );
	wp_nonce_field( 'dsmd_swatch_save', 'dsmd_swatch_nonce' );
	?>
	<tr class="form-field">
		<th scope="row"><label for="dsmd_swatch_color"><?php esc_html_e( 'Swatch colour (hex)', 'dsm-designs' ); ?></label></th>
		<td>
			<input type="text" name="dsmd_swatch_color" id="dsmd_swatch_color" value="<?php echo esc_attr( $color ); ?>" placeholder="#B8ADA4" />
			<p class="description"><?php esc_html_e( 'Optional. Used when no swatch image is set.', 'dsm-designs' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="dsmd_swatch_image"><?php esc_html_e( 'Swatch image (attachment ID)', 'dsm-designs' ); ?></label></th>
		<td>
			<input type="number" name="dsmd_swatch_image" id="dsmd_swatch_image" value="<?php echo esc_attr( $image_id ); ?>" min="0" step="1" />
			<p class="description"><?php esc_html_e( 'Optional. Media library attachment ID for the swatch (RFI-020).', 'dsm-designs' ); ?></p>
		</td>
	</tr>
	<?php
}

/**
 * Persist swatch term meta.
 *
 * @param int $term_id Term ID.
 */
function dsmd_swatch_term_save( $term_id ) {
	if ( ! isset( $_POST['dsmd_swatch_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dsmd_swatch_nonce'] ) ), 'dsmd_swatch_save' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_woocommerce' ) && ! current_user_can( 'manage_categories' ) ) {
		return;
	}

	if ( isset( $_POST['dsmd_swatch_color'] ) ) {
		$color = sanitize_hex_color( trim( wp_unslash( $_POST['dsmd_swatch_color'] ) ) );
		if ( $color ) {
			update_term_meta( $term_id, DSMD_SWATCH_COLOR_META, $color );
		} else {
			delete_term_meta( $term_id, DSMD_SWATCH_COLOR_META );
		}
	}

	if ( isset( $_POST['dsmd_swatch_image'] ) ) {
		$image_id = absint( wp_unslash( $_POST['dsmd_swatch_image'] ) );
		if ( $image_id ) {
			update_term_meta( $term_id, DSMD_SWATCH_IMAGE_META, $image_id );
		} else {
			delete_term_meta( $term_id, DSMD_SWATCH_IMAGE_META );
		}
	}
}
