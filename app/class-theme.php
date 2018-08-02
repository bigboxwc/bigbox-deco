<?php
/**
 * WordPress theme.
 *
 * @since 1.0.0
 *
 * @package BigBox\Deco
 * @category Bootstrap
 * @author Spencer Finnell
 */

namespace BigBox\Deco;
use BigBox\Registerable as Registerable;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme class.
 *
 * @since 1.0.0
 */
final class Theme implements Registerable {

	/**
	 * Register the theme with the WordPress system.
	 *
	 * @since 1.0.0
	 *
	 * @throws Exception\InvalidService If a service is not valid.
	 */
	public function register() {
		add_filter( 'bigbox_integrations', [ $this, 'add_integrations' ] );
		add_action( 'after_setup_theme', [ $this, 'load_helpers' ], 25 );
	}

	/**
	 * Load functional helpers.
	 *
	 * @since 1.0.0
	 */
	public function load_helpers() {
		$helpers = [
			'template-tags',
			'assets',
		];

		foreach ( $helpers as $file ) {
			require_once get_stylesheet_directory() . '/app/theme/' . $file . '.php';
		}
	}

	/**
	 * Register further integrations.
	 *
	 * @since 1.0.0
	 */
	public function add_integrations( $integrations ) {
		$integrations['woocommerce-bigbox-deco'] = [
			'slug'         => 'woocommerce',
			'class'        => Integration\WooCommerce::class,
			'dependencies' => [
				defined( 'WC_PLUGIN_FILE' ) && WC_PLUGIN_FILE,
			],
		];

		return $integrations;
	}

}
