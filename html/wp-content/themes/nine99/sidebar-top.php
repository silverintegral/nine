<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (is_front_page() || is_home()) {
	if (is_active_sidebar('sidebar-front-top')) {
		echo '<aside id="widget-front-top">';
		dynamic_sidebar('sidebar-front-top');
		echo '</aside>';
	}
} else if (is_single()) {
	if (is_active_sidebar('sidebar-post-top')) {
		echo '<aside id="widget-post-top">';
		dynamic_sidebar('sidebar-post-top');
		echo '</aside>';
	}
} else if (is_page()) {
	if (is_active_sidebar('sidebar-page-top')) {
		echo '<aside id="widget-page-top">';
		dynamic_sidebar('sidebar-page-top');
		echo '</aside>';
	}
}
?>
