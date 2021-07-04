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
		    'wp-cocktailize-public-style',
            WP_COCKTAILIZE_URL . 'public/styles/style.css',
            [],
            WP_COCKTAILIZE_VERSION
        );
	}


    private function scripts() {
        wp_enqueue_script(
            'wp-cocktailize-public',
            WP_COCKTAILIZE_URL . 'public/scripts/script.js',
            [ 'jquery' ],
            WP_COCKTAILIZE_VERSION,
            true
        );
    }


    /**
     * Loads data to scripts.
     */
    private function data_to_scripts() {
        wp_localize_script(
            'wp-cocktailize-public',
            'WPCocktailize',
            [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ]
        );
    }
}
