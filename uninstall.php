<?php
/**
 * WP Cocktailize Uninstall
 *
 * Deletes WP Cocktailize options.
 *
 * @package The Guide
 * @version 2.3.0
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


/*
 * Deletes options.
 */
delete_option( 'cocktailize-letter' );