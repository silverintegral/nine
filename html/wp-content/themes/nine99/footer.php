<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<footer id="footer" class="footer"><?php get_template_part('content-footer', get_post_format()) ?>
</footer>
<?php wp_enqueue_script('jquery', null, array(), null, true); ?>
<div id="wp-footer">
<?php wp_footer(); ?></div>
