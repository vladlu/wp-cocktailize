<?php
/**
 * WP Cocktailize Uninstall
 *
 * Deletes WP Cocktailize options and other data.
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


/*
 * Deletes options.
 */
delete_option( 'wp-cocktailize-cocktailization-settings' );
delete_option( 'wp-cocktailize-shortcode-settings' );