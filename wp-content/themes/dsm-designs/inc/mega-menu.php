<?php
/**
 * Dynamic category mega menu (MOD-12).
 *
 * Injects the live product_cat hierarchy (up to 3 levels) as sub-items of the
 * primary-menu item flagged as the Shop trigger, so the mega panel stays in
 * sync with WooCommerce categories with no manual menu maintenance.
 *
 * The Shop trigger is any primary-menu item that either:
 *   - has the CSS class `dsmd-shop-mega` (Appearance > Menus > CSS Classes), or
 *   - is titled "Shop" (case-insensitive) as a fallback.
 *
 * Rendering reuses WP's default nav walker, so the existing mega CSS
 * (.menu-item-has-children) and the mobile accordion JS apply automatically.
 *
 * OPEN — RFI-011 (final approved category tree) and RFI-012 (desktop trigger =
 * hover vs click, and per-category promotional image maintenance). This
 * component renders the live taxonomy and the top-tier CSS image placeholder;
 * real promo images + trigger choice are confirmed at GATE-02 close.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Max category depth rendered inside the mega panel (top + 2 nested = 3 tiers).
 */
const DSMD_MEGA_MAX_DEPTH = 3;

/**
 * Synthetic menu-item ID base. Kept far above any real nav_menu_item post ID so
 * injected items never collide with client-built menu items.
 */
const DSMD_MEGA_ID_BASE = 900000000;

/**
 * Inject product_cat terms under the Shop menu item.
 *
 * @param array    $items Menu item objects (already sorted by menu order).
 * @param stdClass $args  wp_nav_menu args.
 * @return array
 */
function dsmd_inject_shop_categories( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return $items;
	}

	$shop_item = null;
	foreach ( $items as $item ) {
		$classes = is_array( $item->classes ) ? $item->classes : array();
		if ( in_array( 'dsmd-shop-mega', $classes, true )
			|| 0 === strcasecmp( trim( wp_strip_all_tags( $item->title ) ), 'shop' ) ) {
			$shop_item = $item;
			break;
		}
	}
	if ( null === $shop_item ) {
		return $items;
	}

	$default_cat = (int) get_option( 'default_product_cat' );
	$top_terms   = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'parent'     => 0,
		'exclude'    => array_filter( array( $default_cat ) ),
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );

	if ( is_wp_error( $top_terms ) || empty( $top_terms ) ) {
		return $items;
	}

	if ( ! in_array( 'menu-item-has-children', (array) $shop_item->classes, true ) ) {
		$shop_item->classes[] = 'menu-item-has-children';
	}

	$appended = array();
	$counter  = 0;
	dsmd_build_category_items( $top_terms, (int) $shop_item->db_id, 1, $appended, $counter );

	return array_merge( $items, $appended );
}
add_filter( 'wp_nav_menu_objects', 'dsmd_inject_shop_categories', 10, 2 );

/**
 * Recursively build synthetic menu-item objects for a set of terms.
 *
 * @param WP_Term[] $terms        Terms at the current level.
 * @param int       $parent_db_id Parent menu item db_id.
 * @param int       $level        1 = top tier.
 * @param array     $appended     Accumulator (by reference).
 * @param int       $counter      Unique-ID counter (by reference).
 */
function dsmd_build_category_items( $terms, $parent_db_id, $level, &$appended, &$counter ) {
	foreach ( $terms as $term ) {
		$counter++;
		$id   = DSMD_MEGA_ID_BASE + $counter;
		$link = get_term_link( $term );
		if ( is_wp_error( $link ) ) {
			continue;
		}

		$children = array();
		if ( $level < DSMD_MEGA_MAX_DEPTH ) {
			$children = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'parent'     => $term->term_id,
				'orderby'    => 'name',
				'order'      => 'ASC',
			) );
			if ( is_wp_error( $children ) ) {
				$children = array();
			}
		}

		$item                   = new stdClass();
		$item->ID               = $id;
		$item->db_id            = $id;
		$item->menu_item_parent = $parent_db_id;
		$item->object_id        = (int) $term->term_id;
		$item->object           = 'product_cat';
		$item->type             = 'taxonomy';
		$item->type_label       = 'Product category';
		$item->title            = $term->name;
		$item->url              = $link;
		$item->target           = '';
		$item->attr_title       = '';
		$item->description      = '';
		$item->xfn              = '';
		$item->current          = false;
		$item->post_parent      = 0;
		$item->menu_order       = $counter;
		$item->classes          = array( 'menu-item', 'menu-item-type-taxonomy', 'dsmd-mega-tier-' . $level, 'product-cat-' . (int) $term->term_id );
		if ( ! empty( $children ) ) {
			$item->classes[] = 'menu-item-has-children';
		}

		$appended[] = $item;

		if ( ! empty( $children ) ) {
			dsmd_build_category_items( $children, $id, $level + 1, $appended, $counter );
		}
	}
}
