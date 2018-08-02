<?php
/**
 * WooCommerce integration.
 *
 * @since 1.0.0
 *
 * @package BigBox\Deco
 * @category Integration
 * @author Spencer Finnell
 */

namespace BigBox\Deco\Integration;

use BigBox\Deco\Integration as ChildIntegration;
use BigBox\Registerable;
use BigBox\Service;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WooCommerce.
 *
 * @since 1.0.0
 */
class WooCommerce extends ChildIntegration implements Registerable, Service {

	/**
	 * Connect to WordPress.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		include_once $this->get_dir() . '/template-functions.php';
		include_once $this->get_dir() . '/template-hooks.php';
	}

}
