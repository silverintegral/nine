<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<div id="content" <?php post_class(); ?>>
<?php
// アイキャッチ
if (http_response_code() == 200 && (is_page() || is_single()) && has_post_thumbnail()) {
	echo get_the_post_thumbnail(null, 'full', array('id' => 'catch', 'class' => 'catch'));
}

if (is_page()) :
	$layout = explode(',', N_LAYOUT_PAGE);
	$tlink = false;
elseif (is_single()) :
	$layout = explode(',', N_LAYOUT_POST);
	$tlink = false;
else :
	$layout = explode(',', N_LAYOUT_LIST);
	$tlink = true;
endif;

if (have_posts()) :
	while (have_posts()) :
		the_post();
?>
<article>
<?php
		// ここからコンテンツ

		foreach ($layout as $part) :
			if ($part == 'title') :
				if ($tlink) :
?>
<div class="data-title"><h1><a href="<?php echo esc_url(get_permalink()) ?>"><?php the_title() ?></a></h1></div>
<?php
				else :
?>
<div class="data-title"><h1><?php the_title() ?></h1></div>
<?php
				endif;
			elseif ($part == 'date') :
				if (get_val('TEXT_LABEL_DATE') != null) echo '<div class="date-label">' . get_val('TEXT_LABEL_DATE', 'タグ:') . '</div>';
?>
<div class="data-date"><?php echo get_the_date() ?></div>
<?php
			elseif ($part == 'category') :
				if (get_val('TEXT_LABEL_CATEGORY') != null) echo '<div class="category-label">' . get_val('TEXT_LABEL_CATEGORY', 'タグ:') . '</div>';
?>
<div class="data-category"><?php echo get_the_category_list() ?></div>
<?php
			elseif ($part == 'tag') :
				if (get_val('TEXT_LABEL_TAG') != null) echo '<div class="tag-label">' . get_val('TEXT_LABEL_TAG', 'タグ:') . '</div>';
?>
<div class="data-tag"><?php echo get_the_tag_list('<ul><li>', '</li><li>', '</li></ul>') ?></div>
<?php
			elseif ($part == 'content') :
?>
<div class="data-content">
<?php
if (is_front_page() || is_home() || is_page() || is_single()) {
	if (get_post_meta(get_the_ID(), 'nine_use_php', true) == '') {
		the_content();
	} else {
		$content = get_the_content(get_val('LINK_MORE', '<div class="content-more">続きを読む</div>'));
		try {
			eval('?>' . $content); // do_shortcode
		} catch (Throwable $t) {
			echo "PHPエラーが発生しました。";
		}
	}
} else {
	$excerpt = get_the_excerpt();

	if ($excerpt == '')
		$excerpt = get_post_meta(get_the_ID(), 'nine_desc', true);
	
	if ($excerpt == '')
		$excerpt = do_shortcode(get_the_content(get_val('LINK_MORE', '<div class="content-more">続きを読む</div>')));

	echo $excerpt;
}
?>

</div>
<?php
			elseif ($part == 'link') :
wp_link_pages('before=<div class="content-link">&after=</div>');
			elseif ($part == 'edit') :
edit_post_link(get_val('LINK_EDIT', '編集'), '<div class="content-edit">', '</div>');
			endif;
		endforeach;

		// ここまでコンテンツ
?>
</article>
<?php comments_template(); ?>
<?php
	endwhile;
else:
?>
<article><div class="content">
ページが見つかりませんでした。
</div></article>
<?php
endif;
?>
</div>
<?php the_posts_pagination(array('prev_text' => get_val('LINK_PREV', '戻る'), 'next_text' => get_val('LINK_NEXT', '次へ'))) ?>
