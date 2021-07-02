<?php
/**
 * The template for Cocktailize
 *
 * @package Cocktailize
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>


<h1 class="cocktailize-header">Cocktailize website <span class="cocktailize__emoji">🍹</span></h1>

<form class="cocktailize__form">
	<div class="cocktailize-container">
        <label>
            <span>Cocktail first letter: </span>
            <select class="cocktailize__input">
                <?php foreach( range('a', 'z') as $letter):?>
                   <option <?php selected( get_option( 'cocktailize-letter'), $letter ) ?>><?php echo $letter ?></option>
                <?php endforeach; ?>
            </select>
        </label>
	</div>

	<div class="cocktailize-container" data-gramm_editor="false">
		<div class="cocktailize-column">
			<?php submit_button( 'Save', [ 'primary', 'cocktailize__submit' ] ); ?>
		</div>
	</div>
</form>
