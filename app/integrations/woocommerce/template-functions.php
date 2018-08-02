<?php
/**
 * WooCommerce template functions.
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

/**
 * Remove description tab. Auto output on the product sidebar.
 *
 * @since 1.0.0
 *
 * @param array $tabs Product tabs.
 * @return array
 */
function bigbox_deco_woocommerce_product_tabs( $tabs ) {
	unset( $tabs['description'] );
	unset( $tabs['additional_information'] );

	return $tabs;
}

/**
 * Adjust product gallery thumbnail position.
 *
 * @since 1.0.0
 *
 * @param array $options Carousel options.
 * @return array
 */
function bigbox_deco_woocommerce_single_product_carousel_options( $options ) {
	$options['thumbnailPosition'] = 'bottom';

	return $options;
}
