<?php
/**
 * Admin Assets
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
final class WP_Cocktailize_Admin_Assets {

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
        $this->scripts();
        $this->data_to_scripts();
	}


	/**
	 * Loads styles.
	 *
	 * @since 0.1.0
	 */
	private function styles() {
		wp_enqueue_style(
		    'wp-cocktailize-admin-style',
            COCKTAILIZE_URL . 'admin/styles/style.css',
            [],
            COCKTAILIZE_VERSION
        );
	}


	/**
	 * Loads scripts.
	 *
	 * @since 0.1.0
	 */
	private function scripts() {
		wp_enqueue_script(
			'wp-cocktailize-admin-script',
			COCKTAILIZE_URL . 'admin/scripts/script.js',
			[ 'jquery' ],
			COCKTAILIZE_VERSION,
			true
		);
	}


	/**
	 * Loads data to scripts.
	 *
	 * @since 0.1.0
	 */
	private function data_to_scripts() {
		wp_localize_script(
			'wp-cocktailize-admin-script',
			'WPCocktailize',
			[
				'nonceToken' => wp_create_nonce( 'cocktailize-execute' ),
			]
		);
	}
}