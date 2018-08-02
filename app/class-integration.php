<?php
/**
 * Manage an integration with a 3rd-party application.
 *
 * @since 1.0.0
 *
 * @package BigBox\Deco
 * @category Integration
 * @author Spencer Finnell
 */

namespace BigBox\Deco;
use BigBox\Integration as ParentIntegration;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Integration
 *
 * @since 1.0.0
 */
abstract class Integration extends ParentIntegration {

	/**
	 * Setup integration.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Integration slug.
	 * @param array  $dependencies List of required dependencies.
	 */
	public function __construct( $slug, $dependencies ) {
		parent::__construct( $slug, $dependencies );

		$this->dir = get_stylesheet_directory() . $this->get_local_path();
	}

}
