<?php
/**
 * Footer template.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer class="site-footer">
		<div class="dsmd-container dsmd-footer-row">
			<div class="footer-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="footer-logo"><?php the_custom_logo(); ?></div>
				<?php endif; ?>
			</div>

			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'dsm-designs' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'container'      => false,
					'fallback_cb'    => false,
				) );
				?>
			</nav>

			<p class="footer-copy"><?php echo wp_kses_post( get_theme_mod( 'dsmd_footer_text', sprintf( '&copy; %s %s. All rights reserved.', gmdate( 'Y' ), get_bloginfo( 'name' ) ) ) ); ?></p>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
