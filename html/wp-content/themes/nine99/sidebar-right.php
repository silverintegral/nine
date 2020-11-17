<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (is_front_page() || is_home()) {
	if (is_active_sidebar('sidebar-front-right')) {
		echo '<aside id="widget-front-right">';
		dynamic_sidebar('sidebar-front-right');
		echo '</aside>';
	}
} else if (is_page()) {
	if (is_active_sidebar('sidebar-page-right')) {
		echo '<aside id="widget-page-right">';
		dynamic_sidebar('sidebar-page-right');
		echo '</aside>';
	}
} else if (is_single()) {
	if (is_active_sidebar('sidebar-post-right')) {
		echo '<aside id="widget-post-right">';
		dynamic_sidebar('sidebar-post-right');
		echo '</aside>';
	}
} else {
	if (is_active_sidebar('sidebar-other-right')) {
		echo '<aside id="widget-other-right">';
		dynamic_sidebar('sidebar-other-right');
		echo '</aside>';
	}
}
