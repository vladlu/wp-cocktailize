<?php
/**
 * Menus
 *
 * Adds new menus.
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the menus and inits assets loading for it.
 *
 * @since 0.1.0
 */
function wp_cocktailize_admin_menus() {
	add_menu_page(
		'WP Cocktailize',
		'WP Cocktailize',
		'manage_options',
		'wp-cocktailize',
		function () {
			require_once WP_COCKTAILIZE_DIR . 'src/templates/menus/main.php';
		},
		'dashicons-palmtree'
	);

    // Cocktailize Website.

    $menu_main = add_submenu_page(
        'wp-cocktailize',
        __( 'Cocktailize Website', 'wp-cocktailize' ),
        __( 'Cocktailize Website', 'wp-cocktailize' ),
        'manage_options',
        'cocktailize-website',
        function () {
            require_once WP_COCKTAILIZE_DIR . 'src/templates/menus/main.php';
        }
    );
    add_action( 'load-' . $menu_main, 'wp_cocktailize_load_main_menu_assets' );

    // Shortcode Settings.

    $menu_shortcode_settings = add_submenu_page(
        'wp-cocktailize',
        __( 'Shortcode Settings', 'wp-cocktailize' ),
        __( 'Shortcode Settings', 'wp-cocktailize' ),
        'manage_options',
        'wp-cocktailize-shortcode-settings',
        function () {
            require_once WP_COCKTAILIZE_DIR . 'src/templates/menus/shortcode-settings.php';
        }
    );
    add_action( 'load-' . $menu_shortcode_settings, 'wp_cocktailize_load_shortcode_settings_menu_assets' );

    // Removes duplicate first menu (there is no easier way to "Rename" it than creating the same submenu and deleting the main one).

    remove_submenu_page('wp-cocktailize', 'wp-cocktailize');
}
