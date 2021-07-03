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

$wp_cocktailize_cocktailization_settings = get_option( 'wp-cocktailize-cocktailization-settings' );

/*
 * If option is empty, add default values.
 */
if ( ! $wp_cocktailize_cocktailization_settings ) {
    $wp_cocktailize_cocktailization_settings = [
        'enabled' => '0',
        'letter'  => 'a'
    ];
    add_option( 'wp-cocktailize-cocktailization-settings', $wp_cocktailize_cocktailization_settings );
}
?>


<h1 class="wp-cocktailize-header"><?php _e('Cocktailize Website', 'wp-cocktailize') ?><span class="wp-cocktailize-emoji">🍹</span></h1>

<form class="wp-cocktailize-form">
	<div class="wp-cocktailize-container">
        <label class="wp-cocktailize-checkbox">
            <span><?php _e('Enable', 'wp-cocktailize') ?>: </span>
            <input type="checkbox" class="wp-cocktailize-input-enabled" <?php checked( $wp_cocktailize_cocktailization_settings['enabled'] ) ?>>
        </label>
    </div>
    <div class="wp-cocktailize-container">
        <label class="wp-cocktailize-basic-input">
            <span><?php _e('Cocktail first letter', 'wp-cocktailize') ?>: </span>
            <select class="wp-cocktailize-input-letter">
                <?php foreach( range('a', 'z') as $letter):?>
                   <option <?php selected( $wp_cocktailize_cocktailization_settings['letter'], $letter ) ?>><?php echo $letter ?></option>
                <?php endforeach; ?>
            </select>
        </label>
	</div>

	<div class="wp-cocktailize-container" data-gramm_editor="false">
		<div class="wp-cocktailize-column">
			<?php submit_button( 'Save', [ 'primary', 'cocktailize__submit' ] ); ?>
		</div>
	</div>
</form>
