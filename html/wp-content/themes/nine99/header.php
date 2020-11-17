<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<header id="header" class="header"><?php get_template_part('content-header', get_post_format()) ?>

<nav id="nav-global"><?php wp_nav_menu(array('theme_location' => 'global', 'container' => '', 'depth' => 1));?></nav>
</header>
