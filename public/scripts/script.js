/**
 * Contains common JS routines.
 *
 * @author Vladislav Luzan
 * @since 0.1.0
 */
'use strict';


jQuery( $ => {
    /*
     * Show cocktails on link click.
     */
    $( '.wp-cocktailize-shortcode-cocktail-link' ).on( 'click', function() {
        let $this   = $( this ),
            letter =  $this.text();

        let data = {
            'action':     'wp_cocktailize_get_cocktails',
            'nonceToken':  WPCocktailize.nonceToken,
            'letter':      letter,
        };

        $.post( {
            url:  WPCocktailize.ajaxurl,
            data: data,
        } ).done( ( response ) => {
            // console.log( response );
            console.log( JSON.parse( response ) )
        });
    } );
});
