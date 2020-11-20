<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<header id="header" class="header"><?php get_template_part('content-header', get_post_format()) ?>

<?php has_nav_menu('pc') ? wp_nav_menu(array('theme_location' => 'pc', 'menu' => 'pc', 'container' => 'nav', 'container_id' => 'nav-pc', 'container_class' => 'nav-pc', 'depth' => 1)) : ''; ?>

<?php has_nav_menu('tab') ? wp_nav_menu(array('theme_location' => 'tab', 'menu' => 'tab', 'container' => 'nav', 'container_id' => 'nav-tab', 'container_class' => 'nav-tab', 'depth' => 1)) : ''; ?>

<?php has_nav_menu('sp') ? wp_nav_menu(array('theme_location' => 'sp', 'menu' => 'sp', 'container' => 'nav', 'container_id' => 'nav-sp', 'container_class' => 'nav-sp', 'depth' => 1)) : ''; ?>

</header>
