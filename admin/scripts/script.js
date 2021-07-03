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
    let $form           = $( '.wp-cocktailize-form' ),
        $input_enabled  = $( '.wp-cocktailize-input-enabled' ),
        $input_letter   = $( '.wp-cocktailize-input-letter' ),
        $cocktail_emoji = $( '.wp-cocktailize-emoji' );

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
            'action':     'cocktailize_execute',
            'nonceToken':  WPCocktailize.nonceToken,
            'enabled':     $input_enabled.is(':checked') ? 1 : 0,
            'letter':      $input_letter.val()
        };

        $.post( {
            url: ajaxurl,
            data: data,
        } )
            .done( () => {
                $cocktail_emoji.addClass( "wp-cocktailize-bounce" );
                setTimeout( () => {
                    $cocktail_emoji.removeClass( "wp-cocktailize-bounce" );
                }, 1000 );
            });
    });
});
