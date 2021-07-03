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

$cocktailize_settings = get_option( 'wp-cocktailize-settings' );
?>


<h1 class="wp-cocktailize-header">Cocktailize website <span class="wp-cocktailize-emoji">🍹</span></h1>

<form class="wp-cocktailize-form">
	<div class="wp-cocktailize-container">
        <label class="wp-cocktailize-checkbox">
            <span>Enable: </span>
            <input type="checkbox" class="wp-cocktailize-input-enabled" <?php checked( $cocktailize_settings['enabled'] ) ?>>
        </label>
    </div>
    <div class="wp-cocktailize-container">
        <label class="wp-cocktailize-basic-input">
            <span>Cocktail first letter: </span>
            <select class="wp-cocktailize-input-letter">
                <?php foreach( range('a', 'z') as $letter):?>
                   <option <?php selected( $cocktailize_settings['letter'], $letter ) ?>><?php echo $letter ?></option>
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
