<?php
/**
 * WooCommerce template hooks.
 *
 * @since 1.0.0
 *
 * @package BigBox\Deco
 * @category Integration
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Remove rounded corners.
add_filter( 'bigbox_is_rounded', '__return_false' );

// Add description and information below purchase form.
add_filter( 'woocommerce_product_tabs', 'bigbox_deco_woocommerce_product_tabs', 30 );

add_action( 'bigbox_purchase_form_after', 'woocommerce_product_description_tab' );

// Move gallery thumbnails below main.
add_filter( 'woocommerce_single_product_carousel_options', 'bigbox_deco_woocommerce_single_product_carousel_options', 20 );

// Remove variation link.
remove_action( 'woocommerce_after_shop_loop_item_title', 'bigbox_woocommerce_template_loop_variations', 8 );

// Adjust "Pay for order" text.
add_filter( 'woocommerce_order_button_text', 'bigbox_deco_add_mdashes_around_text' );
add_filter( 'woocommerce_pay_order_button_text', 'bigbox_deco_add_mdashes_around_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bigbox_deco_add_mdashes_around_text' );
add_filter( 'woocommerce_product_review_comment_form_args', 'bigbox_deco_comment_form_defaults' );
