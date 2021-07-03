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
 * AJAX handler for Main menu.
 *
 * @since 0.1.0
 */
function wp_cocktailize_ajax_main_menu() {
	/*
	 * Nonce check.
	 */
	check_ajax_referer( 'main-menu', 'nonceToken' );

	$data = [
	    'enabled' => $_POST['enabled'],
        'letter'  => $_POST['letter'],
    ];
    update_option( 'wp-cocktailize-cocktailization-settings', $data );

	wp_die();
}


/**
 * AJAX handler for Shortcode Settings menu.
 *
 * @since 0.1.0
 */
function wp_cocktailize_ajax_shortcode_settings_menu() {
    /*
     * Nonce check.
     */
    check_ajax_referer( 'shortcode-settings-menu', 'nonceToken' );

    $data = [
        'show-thumbnails' => $_POST['show-thumbnails']
    ];
    update_option( 'wp-cocktailize-shortcode-settings', $data );

    wp_die();
}
