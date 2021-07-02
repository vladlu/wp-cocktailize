<?php
/**
 * Plugin Name: WP Cocktailize
 * Description: Cocktailize your WordPress website 🍹
 * Version:     0.1.0
 * Plugin URI:  https://github.com/vladlu/cocktailize
 * Author:      Vladislav Luzan
 * Author URI:  https://vlad.lu/
 * Text Domain: cocktailize
 * License:     MIT
 *
 * @package Cocktailize
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

		// Menu.
		add_action( 'admin_menu', 'cocktailize_admin_menu' );

		// AJAX Handler.
		if ( wp_doing_ajax() ) {
			add_action( 'wp_ajax_cocktailize_execute', 'cocktailize_ajax_execute' );
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
		define( 'COCKTAILIZE_URL', plugin_dir_url( __FILE__ ) );

		/**
		 * The filesystem directory path to the plugin.
		 *
		 * @since 0.1.0
		 * @var string COCKTAILIZE_DIR
		 */
		define( 'COCKTAILIZE_DIR', plugin_dir_path( __FILE__ ) );

		/**
		 * The version of the plugin.
		 *
		 * @since 0.1.0
		 * @var string COCKTAILIZE_VERSION
		 */
		define( 'COCKTAILIZE_VERSION', get_file_data( __FILE__, [ 'Version' ] )[0] );
	}


	/**
	 * Imports files.
	 *
	 * @since 0.1.0
	 */
	private function import_files() {
		require_once COCKTAILIZE_DIR . 'src/ajax.php';
		require_once COCKTAILIZE_DIR . 'src/menu.php';
		require_once COCKTAILIZE_DIR . 'src/class-assets.php';
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
