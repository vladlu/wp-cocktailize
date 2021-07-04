/**
 * Contains common JS routines.
 *
 * @author Vladislav Luzan
 * @since 0.1.0
 */
'use strict';


jQuery( $ => {
    /**
     * Receives the initial data from the server and saves it.
     */
    let data = {
        'action': 'wp_cocktailize_public_init'
    };
    $.post( WPCocktailize.ajaxurl, data, WPCocktailizeData => {
        WPCocktailize.initialdData = JSON.parse( WPCocktailizeData );
    } );

    /*
     * Show cocktails on letter click.
     */
    $( '.wp-cocktailize-shortcode-cocktail-letters .wp-cocktailize-shortcode-cocktail-link' ).on( 'click', function() {
        let $this             = $( this ),
            $container        = $this.closest( '.wp-cocktailize-shortcode-cocktail-container' ),
            $cocktailsLetters = $( '.wp-cocktailize-shortcode-cocktail-letters', $container ),
            $cocktailsListBox = $( '.wp-cocktailize-shortcode-cocktail-cocktails', $container ),
            $cocktailInfoBox  = $( '.wp-cocktailize-shortcode-cocktail-cocktail-info', $container ),
            letter            = $this.text(),
            lastLetter        = $container.data( 'last-letter' );

        $cocktailsListBox.empty();
        $cocktailInfoBox.empty();

        if ( lastLetter ) {
            $( `a:contains(${ lastLetter })`, $cocktailsLetters ).css( 'font-weight', '' );
        }

        if ( lastLetter === letter ) {
            return;
        }

        $this.css( 'font-weight', 'bold' );


        let data = {
            'action':     'wp_cocktailize_get_cocktails',
            'nonceToken':  WPCocktailize.initialdData.nonceToken,
            'letter':      letter,
        };

        $.post( {
            url:  WPCocktailize.ajaxurl,
            data: data,
        } ).done( response => {
            let cocktails = JSON.parse( response );
            if ( cocktails ) {
                cocktails.forEach ( cocktail => {
                    const cocktailName = cocktail[ 'strDrink' ];
                    $cocktailsListBox.append( `<a class="wp-cocktailize-shortcode-cocktail-link">${ cocktailName }</a>` );
                } );

                /*
                 * Show cocktail info on name click.
                 */
                $( '.wp-cocktailize-shortcode-cocktail-cocktails .wp-cocktailize-shortcode-cocktail-link' ).on( 'click', function() {
                    let $this                = $( this ),
                        selectedCocktailName = $this.text(),
                        lastCocktailName     = $container.data( 'last-cocktail-name' );

                    cocktails.forEach ( cocktail => {
                        const cocktailName = cocktail[ 'strDrink' ];
                        if ( cocktailName === selectedCocktailName ) {
                            let instructions = cocktail[ 'strInstructions' ],
                                thumb        = cocktail[ 'strDrinkThumb' ],
                                alcoholic    = cocktail[ 'strAlcoholic' ];

                            $cocktailInfoBox.empty();

                            if ( lastCocktailName ) {
                                $( `a:contains(${ lastCocktailName })`, $cocktailsListBox ).css( 'font-weight', '' );
                            }

                            if ( lastCocktailName === cocktailName ) {
                                return;
                            }

                            $this.css( 'font-weight', 'bold' );

                            let txt = '';

                            /* Thumbnail. */

                            if ( WPCocktailize.initialdData.showThumbnails === '1' ) {
                                txt += `
                                    <img class="wp-cocktailize-cocktail-thumb" alt="${ cocktailName }" src="${ thumb }">
                                `;
                            }

                            /* Name / Is Alcoholic / Instructions. */

                            txt += `
                                <span class="wp-cocktailize-cocktail-name">${ cocktailName } (${ alcoholic })</span>
                                <span class="wp-cocktailize-instructions">${ instructions }</span>
                            `;

                            /* Ingredients. */

                            let i = 1
                            if ( cocktail.hasOwnProperty( 'strIngredient' + i ) && cocktail['strIngredient' + i] ) {
                                txt += '<table class="wp-cocktailize-ingredients">';
                                while ( cocktail.hasOwnProperty( 'strIngredient' + i ) && cocktail['strIngredient' + i] ) {
                                    let ingredient = cocktail[ 'strIngredient' + i ],
                                        measure    = cocktail[ 'strMeasure' + i ] ?? '';
                                    txt += `<tr>
                                            <td>${ ingredient }</td>
                                            <td>${ measure }</td>
                                            </tr>`;
                                    i++;
                                }
                                txt += '</table>';
                            }

                            $cocktailInfoBox.append( txt );

                            /* Scroll to the cocktail. */

                            $( [document.documentElement, document.body] ).animate( {
                                scrollTop: $cocktailInfoBox.offset().top - $cocktailInfoBox.height()
                            }, 200 );
                        }
                    } );

                    $container.data( 'last-cocktail-name', selectedCocktailName );
                } );
            }
        } );

        $container.data( 'last-letter', letter );
    } );
} );