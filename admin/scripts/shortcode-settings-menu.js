/**
 * Contains common JS routines.
 *
 * @author Vladislav Luzan
 * @since 0.1.0
 */
'use strict';


jQuery( $ => {
    /*
     * Defines variables.
     */
    let $form                 = $( '.wp-cocktailize-form' ),
        $inputShowThumbnails  = $( '.wp-cocktailize-input-show-thumbnails' ),
        $cocktailEmoji        = $( '.wp-cocktailize-emoji' );

    /**
     * Sends an AJAX with the form content to the the server for the execution, and displays the result.
     *
     * @since 0.1.0
     *
     * @listens $form:submit
     */
    $form.submit( event => {
        event.preventDefault();

        let data = {
            'action':         'wp_cocktailize_shortcode_settings_menu',
            'nonceToken':      WPCocktailize.nonceToken,
            'show-thumbnails': $inputShowThumbnails.is(':checked') ? 1 : 0,
        };

        $.post( {
            url: ajaxurl,
            data: data,
        } ).done( () => {
            $cocktailEmoji.addClass( "wp-cocktailize-bounce" );
            setTimeout( () => {
                $cocktailEmoji.removeClass( "wp-cocktailize-bounce" );
            }, 1000 );
        });
    });
});
