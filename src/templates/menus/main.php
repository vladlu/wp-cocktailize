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


<h1 class="wp-cocktailize-header">Cocktailize Website <span class="wp-cocktailize-emoji">🍹</span></h1>

<form class="wp-cocktailize-form">
	<div class="wp-cocktailize-container">
        <label class="wp-cocktailize-checkbox">
            <span>Enable: </span>
            <input type="checkbox" class="wp-cocktailize-input-enabled" <?php checked( $wp_cocktailize_cocktailization_settings['enabled'] ) ?>>
        </label>
    </div>
    <div class="wp-cocktailize-container">
        <label class="wp-cocktailize-basic-input">
            <span>Cocktail first letter: </span>
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
