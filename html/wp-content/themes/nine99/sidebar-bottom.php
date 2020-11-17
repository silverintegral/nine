<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (is_front_page() || is_home()) {
	if (is_active_sidebar('sidebar-front-bottom')) {
		echo '<aside id="widget-front-bottom">';
		dynamic_sidebar('sidebar-front-bottom');
		echo '</aside>';
	}
} else if (is_single()) {
	if (is_active_sidebar('sidebar-post-bottom')) {
		echo '<aside id="widget-post-bottom">';
		dynamic_sidebar('sidebar-post-bottom');
		echo '</aside>';
	}
} else if (is_page()) {
	if (is_active_sidebar('sidebar-page-bottom')) {
		echo '<aside id="widget-page-bottom">';
		dynamic_sidebar('sidebar-page-bottom');
		echo '</aside>';
	}
}
