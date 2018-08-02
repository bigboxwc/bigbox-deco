<?php
/**
 * Template tag helpers.
 *
 * @since 1.0.0
 *
 * @package BigBox\Deco
 * @category Theme
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Return the current version of the parent theme.
 *
 * @since 1.0.0
 *
 * @return string
 */
function bigbox_deco_get_theme_version() {
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || ! defined( 'BIGBOX_DECO_VERSION' ) ) {
		return time();
	}

	return BIGBOX_DECO_VERSION;
}

/**
 * Disable output of category dropdown, and account menu items.
 *
 * @since 1.0.0
 */
add_filter( 'navbar_dropdown_search_source', '__return_false' );
add_filter( 'theme_mod_nav-item-account', '__return_false' );
add_filter( 'theme_mod_nav-item-cart', '__return_false' );

/**
 * Add &mdash; before and after text (mainly buttons).
 *
 * @since 1.0.0
 *
 * @param string $text Text to wrap.
 * @return string
 */
function bigbox_deco_add_mdashes_around_text( $text ) {
	return '&mdash; ' . $text . ' &mdash;';
}

/**
 * Comment form defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default arguments.
 * @return array
 */
function bigbox_deco_comment_form_defaults( $defaults ) {
	$defaults['label_submit'] = bigbox_deco_add_mdashes_around_text( $defaults['label_submit'] );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'bigbox_deco_comment_form_defaults', 20 );
