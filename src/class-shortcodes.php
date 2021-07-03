<?php
/**
 * Shortcodes
 *
 * @package WP Cocktailize
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Shortcodes.
 *
 * @since 0.1.0
 */
class WP_Cocktailize_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		// It's impossible to use is_singular() before WP object is initialized.
		add_action( 'wp', [ $this, 'init_shortcodes' ] );
	}


	/**
	 * Inits shortcodes.
	 *
	 * @since 0.1.0
	 *
	 * @global WP_Post $post
	 */
	public function init_shortcodes() {
		global $post;

        add_shortcode( 'cocktail', [ $this, 'shortcode_cocktail' ] );

		if ( is_singular() ) {
			$content            = $post->post_content;
			$post->post_content = do_shortcode( $content );
		}
	}


    /**
     * "cocktail" shortcode callback.
     *
     * @since 0.1.0
     *
     * @return string
     */
    public function shortcode_cocktail(): string {
        $out = '<div class="wp-cocktailize-shortcode-cocktail-container">
                <div class="wp-cocktailize-shortcode-cocktail-subcontainer">';
        foreach( range('a', 'z') as $num => $letter) {
            if ( $num > 0 ) {
                $out .= " ";
            }
            if ( $num === 13 ) {
                $out .= "<br>";
            }
            $out .= "<a class='wp-cocktailize-shortcode-cocktail-link'>$letter</a>";
        }
        $out .= "</div>
                 </div>";
        return $out;
    }
}
