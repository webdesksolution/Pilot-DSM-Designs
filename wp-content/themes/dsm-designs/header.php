<?php
/**
 * Header template.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dsm-designs' ); ?></a>

<div class="dsmd-topbar">
	<div class="dsmd-container dsmd-topbar-row">
		<span class="dsmd-topbar-note"><?php echo esc_html( get_theme_mod( 'dsmd_topbar_note', __( 'Free USA shipping on orders over $100', 'dsm-designs' ) ) ); ?></span>
		<?php $dsmd_phone = get_theme_mod( 'dsmd_phone', '(515) 965-3182' ); ?>
		<?php if ( $dsmd_phone ) : ?>
			<a class="dsmd-topbar-phone" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $dsmd_phone ) ); ?>"><?php echo esc_html( $dsmd_phone ); ?></a>
		<?php endif; ?>
		<span class="dsmd-socials" aria-label="<?php esc_attr_e( 'Social links', 'dsm-designs' ); ?>">
			<?php
			$dsmd_socials = array(
				'instagram' => __( 'Instagram', 'dsm-designs' ),
				'facebook'  => __( 'Facebook', 'dsm-designs' ),
				'tiktok'    => __( 'TikTok', 'dsm-designs' ),
				'youtube'   => __( 'YouTube', 'dsm-designs' ),
				'pinterest' => __( 'Pinterest', 'dsm-designs' ),
			);
			foreach ( $dsmd_socials as $dsmd_key => $dsmd_label ) :
				$dsmd_url = get_theme_mod( 'dsmd_social_' . $dsmd_key, '' );
				if ( ! $dsmd_url ) {
					continue;
				}
				?>
				<a class="dsmd-social" href="<?php echo esc_url( $dsmd_url ); ?>"><span class="screen-reader-text"><?php echo esc_html( $dsmd_label ); ?></span><span aria-hidden="true"><?php echo esc_html( strtoupper( substr( $dsmd_key, 0, 2 ) ) ); ?></span></a>
			<?php endforeach; ?>
		</span>
	</div>
</div>

<header class="site-header">
	<div class="dsmd-container dsmd-header-row">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
			<?php endif; ?>
		</div>

		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'dsm-designs' ); ?>">
			<button class="nav-toggle" aria-expanded="false" aria-controls="primary-menu">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'dsm-designs' ); ?></span>
				<span class="nav-toggle-bars"></span>
			</button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<div class="header-actions">
			<button class="header-ico" type="button" aria-label="<?php esc_attr_e( 'Search', 'dsm-designs' ); ?>"><span aria-hidden="true">⌕</span></button>
			<a class="header-ico" href="<?php echo esc_url( function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'dsm-designs' ); ?>"><span aria-hidden="true">♢</span></a>
			<a class="header-cart" href="<?php echo esc_url( function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' ) ); ?>" aria-label="<?php esc_attr_e( 'Cart', 'dsm-designs' ); ?>">
				<?php if ( function_exists( 'WC' ) ) : ?>
					<span class="cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
				<?php endif; ?>
			</a>
		</div>
	</div>
</header>
