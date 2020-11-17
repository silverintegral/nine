<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

HINT:
Search Form
*/ ?>
<form id="search" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
<input type="search" class="search-field" placeholder="<?php print_val('search-hint', '検索') ?>" value="<?php echo get_search_query(); ?>" name="s" />
<button type="submit" class="search-submit"><?php print_val('search-button', '検索') ?></button>
</form>
