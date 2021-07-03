# About

A WordPress plugin that cocktailizes your WordPress website 🍹.

## Functionality

1. Supports `[cocktail]` shortcode that will display all letters, and when the letter is clicked, all cocktails
   that start with this letter are displayed.
2. Supports website cocktailization when all the words under the text (see **WP Filters** below) that start 
   with the specified letter are cocktailized.  
   For example, `Look at my site with all cool
   drinks! I did my best to create the dopest wordpress site possible.` becomes `Look at my site
   with all cool Daiquiri! I Dry Martini my best to create the Danbooka wordpress site possible.`.

## Use

### APIs

* `https://www.thecocktaildb.com/api/json/v1/1/search.php?f=`

### WP Options

* `wp-cocktailize-cocktailization-settings` - `['enabled', 'letter']`
* `wp-cocktailize-shortcode-settings` - `['show-thumbnails']`


### WP Filters

* `the_title`
* `get_the_excerpt`
* `the_content`
* `comment_text`
* `widget_text`

## Notes

* There are cocktails not for all letters. For example, there are no cocktails for "u" letter. 
  When cocktails are missing, don't cocktailize the website.

#

Version: 0.1.0

License: [MIT](https://github.com/vladlu/wp-cocktailize/blob/master/LICENSE)
