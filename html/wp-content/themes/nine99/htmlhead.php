<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php if (is_home() || is_front_page()): ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php elseif (is_category()): ?>
<meta name="description" content="<?php echo category_description(); ?>" />
<?php elseif (is_tag()): ?>
<meta name="description" content="<?php echo tag_description(); ?>" />
<?php else: ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php endif; ?>
<title><?php echo trim(wp_title('', false)) ?></title>
<?php if (is_singular() && pings_open(get_queried_object())) : ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php endif; ?>
<?php if (is_singular()) wp_enqueue_script("comment-reply"); ?>
<?php wp_head(); ?>
</head>
