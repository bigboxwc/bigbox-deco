<?php
/**
 * Load public assets.
 *
 * @since 1.0.0
 *
 * @package BigBox\deco
 * @category Theme
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue styles.
 *
 * @since 1.0.0
 */
function bigbox_deco_enqueue_styles() {
	$version           = bigbox_deco_get_theme_version();
	$stylesheet_parent = bigbox_get_theme_name();
	$stylesheet_deco  = $stylesheet_parent . '-deco';

	wp_dequeue_style( $stylesheet_parent );
	wp_enqueue_style( $stylesheet_deco, get_stylesheet_directory_uri() . '/public/css/app-css.min.css', [], $version );

	wp_enqueue_script( $stylesheet_deco, get_stylesheet_directory_uri() . '/public/js/app.min.js', [], $version );

	// Remove attachment from parent stylesheet and output with our own.
	add_filter( 'bigbox_customize_css_inline', '__return_false' );
	wp_add_inline_style( $stylesheet_deco, bigbox_customize_inline_css() );
}
add_action( 'wp_enqueue_scripts', 'bigbox_deco_enqueue_styles', 30 );

/**
 * Enqueue the "Oswald" font family.
 */
add_filter(
	'bigbox_get_google_fonts_url',
	/**
	 * Enqueue the "Oswald" font family.
	 *
	 * @since 1.0.0
	 *
	 * @param string $url Google font URL.
	 * @return string
	 */
	function( $url ) {
		return $url . '|' . 'Oswald';
	}
);

/**
 * Create a white header/navbar area.
 */
add_action(
	'bigbox_customize_inline_css',
	/**
	 * Create a white header/navbar area.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS builder.
	 */
	function( $css ) {
		$gray300 = bigbox_get_theme_color( 'gray-300' );
		$gray500 = bigbox_get_theme_color( 'gray-500' );
		$gray700 = bigbox_get_theme_color( 'gray-700' );
		$gray800 = bigbox_get_theme_color( 'gray-800' );

		$css->add( [
			'selectors'    => [
				'.navbar',
			],
			'declarations' => [
				'background-color' => 'transparent',
				'border-bottom'    => '0',
				'box-shadow'       => 'none',
			],
		] );

		$css->add( [
			'selectors'    => [
				'.navbar-search',
			],
			'declarations' => [
				'box-shadow' => '0 0 5px rgba(0, 0, 0, 0.10)',
				'border'     => esc_attr( '1px solid ' . $gray300 ),
			],
		] );

		$css->add( [
			'selectors'    => [
				'.site-title a',
				'.site-title a:hover',
				'.navbar-menu--account a',
				'.navbar-menu--account a:hover',
				'.navbar-menu--primary .navbar-menu__items > .menu-item > a'
			],
			'declarations' => [
				'color' => esc_attr( $gray800 ),
			],
		] );

		$css->add( [
			'selectors'    => [
				'.navbar-menu--primary .navbar-menu__items > .menu-item-has-children > a:after',
			],
			'declarations' => [
				'right'            => '4px',
				'border-top-color' => esc_attr( $gray800 ),
			],
		] );

		$css->add( [
			'selectors'    => [
				'.navbar-menu--account .menu-item:hover svg',
				'.navbar-menu--primary .menu-item:hover svg',
				'.navbar-mobile-toggle--open:hover .bigbox-icon',
				'.navbar-mobile-toggle--open .bigbox-icon',
			],
			'declarations' => [
				'fill' => esc_attr( $gray800 ),
			],
		] );
	}
);

/**
 * Add outline to the body.
 */
add_action(
	'bigbox_customize_inline_css',
	/**
	 * Add outline to the body.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS builder.
	 */
	function( $css ) {
		$warning = bigbox_get_theme_color( 'warning' );

		$css->add( [
			'selectors'    => [
				'body',
			],
			'declarations' => [
				'border-color' => esc_attr( $warning ),
			],
		] );
	}
);

/**
 * Primary color usage.
 */
add_action(
	'bigbox_customize_inline_css',
	/**
	 * Add outline to the body.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS builder.
	 */
	function( $css ) {
		$primary = bigbox_get_theme_color( 'primary' );

		$css->add( [
			'selectors'    => [
				'.navbar-search:after',
			],
			'declarations' => [
				'background' => esc_attr( $primary ),
			],
		] );
	}
);

/**
 * Custom button.
 */
add_action(
	'bigbox_customize_inline_css',
	/**
	 * Add outline to the body.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS builder.
	 */
	function( $css ) {
		$primary     = bigbox_get_theme_color( 'primary' );
		$weight_bold = bigbox_get_theme_font_weight( 'bold' );

		$selectors = array_merge(
			bigbox_customize_get_button_selectors(),
			bigbox_customize_get_button_success_selectors(),
			[
				'.wp-block-button .wp-block-button__link.has-primary-background-color',
				'.product__has-variations a',
				'.widget_layered_nav_filters a',
			]
		);

		$css->add( [
			'selectors'    => $selectors,
			'declarations' => [
				'font-weight'    => $weight_bold,
				'text-transform' => 'uppercase',
				'letter-spacing' => '3px',
				'color'          => esc_attr( $primary ),
				'border'         => '4px solid ' . esc_attr( $primary ),
				'box-shadow'     => '8px 8px 0 0 ' . esc_attr( $primary ),
				'background'     => '#fff',
			],
		] );

		$css->add( [
			'selectors'    => array_map(
				function( $selector ) {
					return $selector . ':hover';
				},
				$selectors
			),
			'declarations' => [
				'color'      => esc_attr( $primary ),
				'box-shadow' => '-8px 8px 0 0 ' . esc_attr( $primary ),
				'border'     => '4px solid ' . esc_attr( $primary ),
				'background' => '#fff',
			],
		] );

		$css->add( [
			'selectors'    => array_map(
				function( $selector ) {
					return $selector . ':after';
				},
				$selectors
			),
			'declarations' => [
				'display' => 'none',
			],
		] );

		// Small buttons.
		$small = [
			'.woocommerce-Address-title .edit',
			'.woocommerce-notice-list__item .woocommerce-Button',
			'.woocommerce-notice-list__item .wc-forward',
			'.woocommerce-form-coupon [name="apply_coupon"]',
			'.woocommerce-Message .button',
			'.woocommerce-error .button',
			'.product__has-variations a',
			'.widget_layered_nav_filters a',
		];

		$css->add( [
			'selectors'    => $small,
			'declarations' => [
				'border'     => '2px solid ' . esc_attr( $primary ),
				'box-shadow' => '4px 4px 0 0 ' . esc_attr( $primary ),
			],
		] );

		$css->add( [
			'selectors'    => array_map(
				function( $selector ) {
					return $selector . ':hover';
				},
				$small
			),
			'declarations' => [
				'border'     => '2px solid ' . esc_attr( $primary ),
				'box-shadow' => '-4px 4px 0 0 ' . esc_attr( $primary ),
			],
		] );
	}
);

/**
 * Extra bold.
 */
add_action(
	'bigbox_customize_inline_css',
	/**
	 * Add outline to the body.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS builder.
	 */
	function( $css ) {
		$weight_bold = bigbox_get_theme_font_weight( 'bold' );

		$css->add( [
			'selectors'    => [
				'.navbar-menu--primary .menu-item a',
			],
			'declarations' => [
				'font-weight'    => $weight_bold,
			],
		] );
	}
);
