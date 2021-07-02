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
    let $form           = $( '.cocktailize__form' ),
        $input          = $( '.cocktailize__input' ),
        $cocktail_emoji = $( '.cocktailize__emoji' );

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
            'nonceToken':  cocktailize.nonceToken,
            'letter': $input.val()
        };

        $.post( {
            url: ajaxurl,
            data: data,
        } )
            .done( () => {
                $cocktail_emoji.addClass( "cocktailize-bounce" );
                setTimeout( () => {
                    $cocktail_emoji.removeClass( "cocktailize-bounce" );
                }, 1000 );
            });
    });
});
