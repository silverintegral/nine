<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (is_front_page() || is_home()) {
	if (is_active_sidebar('sidebar-front-left')) {
		echo '<aside id="widget-front-left">';
		dynamic_sidebar('sidebar-front-left');
		echo '</aside>';
	}
} else if (is_page()) {
	if (is_active_sidebar('sidebar-page-left')) {
		echo '<aside id="widget-page-left">';
		dynamic_sidebar('sidebar-page-left');
		echo '</aside>';
	}
} else if (is_single()) {
	if (is_active_sidebar('sidebar-post-left')) {
		echo '<aside id="widget-post-left">';
		dynamic_sidebar('sidebar-post-left');
		echo '</aside>';
	}
} else {
	if (is_active_sidebar('sidebar-other-left')) {
		echo '<aside id="widget-other-left">';
		dynamic_sidebar('sidebar-other-left');
		echo '</aside>';
	}
}
?>
