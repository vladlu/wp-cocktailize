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
    let $form          = $( '.wp-cocktailize-form' ),
        $inputEnabled  = $( '.wp-cocktailize-input-enabled' ),
        $inputLetter   = $( '.wp-cocktailize-input-letter' ),
        $cocktailEmoji = $( '.wp-cocktailize-emoji' );

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
            'action':     'wp_cocktailize_main_menu',
            'nonceToken':  WPCocktailize.nonceToken,
            'enabled':     $inputEnabled.is(':checked') ? 1 : 0,
            'letter':      $inputLetter.val()
        };

        $.post( {
            url: ajaxurl,
            data: data,
        } )
            .done( () => {
                $cocktailEmoji.addClass( "wp-cocktailize-bounce" );
                setTimeout( () => {
                    $cocktailEmoji.removeClass( "wp-cocktailize-bounce" );
                }, 1000 );
            });
    });
});
