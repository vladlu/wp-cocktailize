<?php
/**
 * Public Assets
 *
 * Loads assets (JS, CSS), adds data for them.
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Assets class.
 *
 * @since 0.1.0
 */
final class WP_Cocktailize_Public_Assets {

	/**
	 * Inits.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		$class = __CLASS__;
		new $class();
	}


	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
        $this->styles();
	}


	/**
	 * Loads styles.
	 *
	 * @since 0.1.0
	 */
	private function styles() {
		wp_enqueue_style(
		    'wp-cocktailize-public-style',
            WP_COCKTAILIZE_URL . 'public/styles/style.css',
            [],
            WP_COCKTAILIZE_VERSION
        );
	}
}
