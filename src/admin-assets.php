<?php
/**
 * Admin Assets
 *
 * Functionality to load assets (JS, CSS), and data for them.
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Loads styles.
 */
function wp_cocktailize_admin_styles() {
    wp_enqueue_style(
        'wp-cocktailize-admin-main-menu',
        WP_COCKTAILIZE_URL . 'admin/styles/style.css',
        [],
        WP_COCKTAILIZE_VERSION
    );
}

/**
 * Loads assets for Main menu.
 *
 * @since 0.1.0
 */
function wp_cocktailize_load_main_menu_assets() {
    add_action( 'admin_enqueue_scripts', function() {
        /**
         * Loads scripts.
         */
        function scripts() {
            wp_enqueue_script(
                'wp-cocktailize-admin-main-menu',
                WP_COCKTAILIZE_URL . 'admin/scripts/main-menu.js',
                [ 'jquery' ],
                WP_COCKTAILIZE_VERSION,
                true
            );
        }

        /**
         * Loads data to scripts.
         */
        function data_to_scripts() {
            wp_localize_script(
                'wp-cocktailize-admin-main-menu',
                'WPCocktailize',
                [
                    'nonceToken' => wp_create_nonce( 'wp-cocktailize-main-menu' ),
                ]
            );
        }

        scripts();
        data_to_scripts();
        wp_cocktailize_admin_styles();
    } );
}


/**
 * Loads assets for Shortcode Settings menu.
 *
 * @since 0.1.0
 */
function wp_cocktailize_load_shortcode_settings_menu_assets() {
    add_action( 'admin_enqueue_scripts', function() {
        /**
         * Loads scripts.
         */
        function scripts() {
            wp_enqueue_script(
                'wp-cocktailize-admin-shortcode-settings-menu',
                WP_COCKTAILIZE_URL . 'admin/scripts/shortcode-settings-menu.js',
                [ 'jquery' ],
                WP_COCKTAILIZE_VERSION,
                true
            );
        }

        /**
         * Loads data to scripts.
         */
        function data_to_scripts() {
            wp_localize_script(
                'wp-cocktailize-admin-shortcode-settings-menu',
                'WPCocktailize',
                [
                    'nonceToken' => wp_create_nonce( 'wp-cocktailize-shortcode-settings-menu' ),
                ]
            );
        }

        scripts();
        data_to_scripts();
        wp_cocktailize_admin_styles();
    } );
}