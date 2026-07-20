<?php
/**
 * Transactional email branding (MOD-11).
 *
 * Applies DSM Designs brand styling to WooCommerce transactional emails via the
 * woocommerce_email_styles filter (inlined by WC's Emogrifier) and defaults the
 * email header image to the site's custom logo. No email template files are
 * overridden and no transactional data/trigger logic is changed (EMAIL-04).
 *
 * Brand values are literal hex (email clients don't support CSS custom
 * properties). Kept in sync with :root tokens in assets/css/main.css.
 *
 * SCOPE — this styles the emails WooCommerce core generates. The full email
 * trigger inventory (which emails are enabled, plus any plugin/shipment
 * triggers) is RFI-010 / EMAIL-01, still open. Styling here applies to whatever
 * WC-core emails are active; plugin-generated emails are covered once inventoried.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Brand palette for emails (mirror of main.css :root tokens).
 */
function dsmd_email_palette() {
	return array(
		'primary'        => '#1E1E1E',
		'secondary'      => '#B8ADA4',
		'secondary_text' => '#726459',
		'accent'         => '#D8CEC6',
		'background'     => '#F6F4F1',
		'border'         => '#E4DFDA',
		'white'          => '#FFFFFF',
	);
}

/**
 * Append brand overrides to WooCommerce email CSS.
 *
 * @param string   $css   Existing email CSS.
 * @param WC_Email $email Email object (unused; branding is global).
 * @return string
 */
function dsmd_email_styles( $css, $email = null ) {
	$c = dsmd_email_palette();

	$brand = "
		#wrapper { background-color: {$c['background']} !important; }
		#template_container { border-radius: 2px; border: 1px solid {$c['border']}; }
		#template_header {
			background-color: {$c['primary']} !important;
			border-radius: 2px 2px 0 0;
		}
		#template_header h1,
		#template_header h1 a { color: {$c['white']} !important; }
		#body_content { background-color: {$c['white']} !important; }
		#body_content, #body_content td { color: {$c['primary']} !important; }
		#body_content h1, #body_content h2, #body_content h3 {
			color: {$c['primary']} !important;
			font-family: Georgia, 'Times New Roman', serif !important;
			font-weight: 400 !important;
		}
		#body_content a { color: {$c['secondary_text']} !important; }
		.order_item td, .order_item th,
		#body_content table.td th { border-color: {$c['border']} !important; }
		#template_footer #credit { color: {$c['secondary_text']} !important; }
	";

	return $css . $brand;
}
add_filter( 'woocommerce_email_styles', 'dsmd_email_styles', 20, 2 );

/**
 * Default the WooCommerce email header image to the site custom logo when the
 * WooCommerce setting is empty. Does not overwrite an explicit admin value.
 *
 * @param string $value Stored option value.
 * @return string
 */
function dsmd_email_header_image( $value ) {
	if ( ! empty( $value ) ) {
		return $value;
	}
	$logo_id = (int) get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$src = wp_get_attachment_image_url( $logo_id, 'full' );
		if ( $src ) {
			return $src;
		}
	}
	return $value;
}
add_filter( 'option_woocommerce_email_header_image', 'dsmd_email_header_image' );
add_filter( 'default_option_woocommerce_email_header_image', 'dsmd_email_header_image' );
