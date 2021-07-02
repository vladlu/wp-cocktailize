<?php
/**
 * Menus
 *
 * Adds new menus.
 *
 * @package Cocktailize
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the menu and inits assets loading for it.
 *
 * @since 0.1.0
 */
function cocktailize_admin_menu() {
	$page = add_menu_page(
		'Cocktailize',
		'Cocktailize',
		'manage_options',
		'cocktailize',
		function () {
			require_once COCKTAILIZE_DIR . 'src/templates/wp-cocktailize.php';
		},
		'dashicons-palmtree'
	);

	add_action( 'load-' . $page, [ 'Cocktailize_Menu_Assets', 'init' ] );
}
