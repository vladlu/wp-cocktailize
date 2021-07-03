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
 * AJAX handler that executes arbitrary code.
 *
 * @since 0.1.0
 */
function cocktailize_ajax_execute() {
	/*
	 * Nonce check.
	 */
	check_ajax_referer( 'cocktailize-execute', 'nonceToken' );

	$data = [
	    'enabled' => $_POST['enabled'],
        'letter' => $_POST['letter']
    ];
    update_option( 'wp-cocktailize-settings', $data );

	wp_die();
}
