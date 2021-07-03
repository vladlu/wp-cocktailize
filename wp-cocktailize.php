<?php
/**
 * Plugin Name: WP Cocktailize
 * Description: Cocktailize your WordPress website 🍹
 * Version:     0.1.0
 * Plugin URI:  https://github.com/vladlu/cocktailize
 * Author:      Vladislav Luzan
 * Author URI:  https://vlad.lu/
 * Text Domain: wp-cocktailize
 * License:     MIT
 *
 * @package WP Cocktailize
 * @author  Vladislav Luzan <hey@vlad.lu>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Main Cocktailize class.
 *
 * @since 0.1.0
 */
final class Cocktailize {

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->define_constants();
		$this->import_files();

		// Public Assets.
        add_action( 'wp_enqueue_scripts', [ 'WP_Cocktailize_Public_Assets', 'init' ] );

        // Menus.
		add_action( 'admin_menu', 'wp_cocktailize_admin_menus');

		// AJAX Handler.
		if ( wp_doing_ajax() ) {
			add_action( 'wp_ajax_wp_cocktailize_main_menu',              'wp_cocktailize_ajax_main_menu' );
            add_action( 'wp_ajax_wp_cocktailize_shortcode_settings_menu', 'wp_cocktailize_ajax_shortcode_settings_menu' );
        }

		// Text Cocktailization.
        if ( ! is_admin() && get_option( 'wp-cocktailize-cocktailization-settings' )['enabled'] ) {
                $this->cocktailize_text();
        }
    }


	/**
	 * Defines constants.
	 *
	 * @since 0.1.0
	 */
	private function define_constants() {

		/**
		 * The URL to the plugin.
		 *
		 * @since 0.1.0
		 * @var string COCKTAILIZE_URL
		 */
		define( 'WP_COCKTAILIZE_URL', plugin_dir_url( __FILE__ ) );

		/**
		 * The filesystem directory path to the plugin.
		 *
		 * @since 0.1.0
		 * @var string COCKTAILIZE_DIR
		 */
		define( 'WP_COCKTAILIZE_DIR', plugin_dir_path( __FILE__ ) );

		/**
		 * The version of the plugin.
		 *
		 * @since 0.1.0
		 * @var string COCKTAILIZE_VERSION
		 */
		define( 'WP_COCKTAILIZE_VERSION', get_file_data( __FILE__, [ 'Version' ] )[0] );
	}


	/**
	 * Imports files.
	 *
	 * @since 0.1.0
	 */
	private function import_files() {
		require_once WP_COCKTAILIZE_DIR . 'src/ajax.php';
		require_once WP_COCKTAILIZE_DIR . 'src/menus.php';
		require_once WP_COCKTAILIZE_DIR . 'src/admin-assets.php';
        require_once WP_COCKTAILIZE_DIR . 'src/class-public-assets.php';
    }

    /**
     * Adds Cocktails names.
     *
     * Supports:
     *
     * - Post Title;
     * - Excerpt;
     * - Post Content;
     * - Comment Text;
     * - Text Widget.
     *
     * @since 0.1.0
     */
	private function cocktailize_text() {
	    function get_cocktails( $first_letter ) {
            $request_url = "https://www.thecocktaildb.com/api/json/v1/1/search.php?f=$first_letter";
            $response = wp_remote_get( $request_url );
            if ( wp_remote_retrieve_response_code( $response ) === 200 ) {
                return json_decode( wp_remote_retrieve_body( $response ), true )['drinks'];
            } else {
                wp_die( $response );
            }
        }
        $cocktailize_letter = get_option( 'wp-cocktailize-cocktailization-settings' )['letter'];
	    $cocktails = get_cocktails( $cocktailize_letter );

        $filters = [
            'the_title',       // Post Title.
            'get_the_excerpt', // Excerpt.
            'the_content',     // Post Content.
            'comment_text',    // Comment Text.
            'widget_text'      // Text Widget
        ];
        if ( $cocktails ) {
            foreach ( $filters as $filter ) {
                add_filter( $filter, function ($txt) use ($cocktailize_letter, $cocktails ) {
                    $pattern = "/(?<=^|\s|(?<!\"wp-cocktailize-replaced\")>)$cocktailize_letter\w+/i";

                    while ( preg_match( $pattern, $txt ) ) {
                        $replacement = '<b class="wp-cocktailize-replaced">' . $cocktails[array_rand($cocktails)]['strDrink'] . '</b>';
                        $txt = preg_replace( $pattern, $replacement, $txt, 1 );
                    }
                    return $txt;
                });
            }
        }
    }
}


add_action(
	'init',
	function() {
		if ( current_user_can( 'list_users' ) ) {
			new Cocktailize();
		}
	}
);
