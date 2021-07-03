<?php
/**
 * The template for Cocktailize
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_cocktailize_shortcode_settings = get_option( 'wp-cocktailize-shortcode-settings' );

/*
 * If option is empty, add default values.
 */
if ( ! $wp_cocktailize_shortcode_settings ) {
    $wp_cocktailize_shortcode_settings = [
        'show-thumbnails' => '1',
    ];
    add_option( 'wp-cocktailize-shortcode-settings', $wp_cocktailize_shortcode_settings );
}
?>


<h1 class="wp-cocktailize-header">Shortcode Settings<span class="wp-cocktailize-emoji">🍹</span></h1>

<form class="wp-cocktailize-form">
    <div class="wp-cocktailize-container">
        <label class="wp-cocktailize-checkbox">
            <span>Show Thumbnails: </span>
            <input type="checkbox" class="wp-cocktailize-input-show-thumbnails" <?php checked( $wp_cocktailize_shortcode_settings['show-thumbnails'] ) ?>>
        </label>
    </div>

	<div class="wp-cocktailize-container" data-gramm_editor="false">
		<div class="wp-cocktailize-column">
			<?php submit_button( 'Save', [ 'primary', 'cocktailize__submit' ] ); ?>
		</div>
	</div>
</form>