<?php
/**
 * AJAX handlers
 *
 * @package Cocktailize
 * @since 1.0.0
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

    update_option( 'cocktailize-letter', $_POST['letter'] );

	wp_die();
}
