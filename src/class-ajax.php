<?php
/**
 * AJAX handlers
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Manages AJAX.
 *
 * @since 0.1.0
 */
class WP_Cocktailize_Ajax {

	/**
	 * Settings object.
	 *
	 * @since 0.1.0
	 * @var WP_Cocktailize $wp_cocktailize
	 */
	private WP_Cocktailize $wp_cocktailize;


	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Cocktailize $wp_cocktailize Settings Object.
	 */
	public function __construct( WP_Cocktailize $wp_cocktailize ) {
		$this->wp_cocktailize = $wp_cocktailize;
		$this->add_ajax_events();
	}


	/**
	 * Loads public assets.
	 *
	 * @since 0.1.0
	 */
	private function add_ajax_events() {

		$ajax_events_nopriv = [
			'get_cocktails'
		];

		foreach ( $ajax_events_nopriv as $ajax_event ) {
			add_action( 'wp_ajax_wp_cocktailize_'        . $ajax_event, [ $this, $ajax_event ] );
			add_action( 'wp_ajax_nopriv_wp_cocktailize_' . $ajax_event, [ $this, $ajax_event ] );
		}

		$ajax_events = [
			'main_menu',
			'shortcode_settings_menu',
		];

		foreach ( $ajax_events as $ajax_event ) {
			add_action( 'wp_ajax_wp_cocktailize_' . $ajax_event, [ $this, $ajax_event ] );
		}
	}


    /**
     * AJAX handler to get cocktails.
     *
     * @since 0.1.0
     */
    public function get_cocktails() {
        /*
         * Nonce check.
         */
        check_ajax_referer( 'wp-cocktailize-public', 'nonceToken' );

        $cocktails = $this->wp_cocktailize->get_cocktails( $_POST['letter'] );
        echo json_encode( $cocktails );

        wp_die();
    }


    /**
     * AJAX handler to save Main menu settings.
     *
     * @since 0.1.0
     */
    public function main_menu() {
        /*
         * Nonce check.
         */
        check_ajax_referer( 'wp-cocktailize-main-menu', 'nonceToken' );

        $data = [
            'enabled' => $_POST['enabled'],
            'letter'  => $_POST['letter'],
        ];
        update_option( 'wp-cocktailize-cocktailization-settings', $data );

        wp_die();
    }


    /**
     * AJAX handler to save Shortcode Settings menu settings.
     *
     * @since 0.1.0
     */
    public function shortcode_settings_menu() {
        /*
         * Nonce check.
         */
        check_ajax_referer( 'wp-cocktailize-shortcode-settings-menu', 'nonceToken' );

        $data = [
            'show-thumbnails' => $_POST['show-thumbnails']
        ];
        update_option( 'wp-cocktailize-shortcode-settings', $data );

        wp_die();
    }
}
