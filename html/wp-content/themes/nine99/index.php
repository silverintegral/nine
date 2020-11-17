<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */ ?>
<?php
if (http_response_code() == 404) {
	@list($script, $query) = explode('?', $_SERVER['REQUEST_URI'], 2);
	if ($script == substr(get_template_directory_uri() . '/nine-style.css', strlen(get_home_url()))) {
		// 自動生成CSSを出力する
		$expires = 43200; // 12H

		http_response_code(200);
		header('Content-Type: text/css; charset=utf-8');
		header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
		header('Cache-Control: public, max-age=' . $expires);

		include(__DIR__ . '/nine-style.php');
		echo nine_create_style();
		exit();
	}
}

if (!isset($GLOBALS['NINEDISPLAY'])) {
	if (is_page())
		$GLOBALS['NINEDISPLAY'] = 0; // 固定ページのデフォルトテンプレート（サイドバーなし）
	else
		$GLOBALS['NINEDISPLAY'] = 9; // 投稿やその他リストなどの表示
}
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<?php // HTMLのheadの中身を"htmlhead.php"に任せている ?>
<?php get_template_part('htmlhead', get_post_format()) ?>
<body <?php body_class() ?>>
<?php // ヘッダーを"header.php"に任せている ?>
<?php get_header(); ?>
<?php // 上部サイドバー ?>
<?php if (http_response_code() == 200 && $GLOBALS['NINEDISPLAY'] != 4) get_sidebar('top'); ?>
<div id="body" class="body">
<?php // 左サイドバー ?>
<?php if (http_response_code() == 200 && ($GLOBALS['NINEDISPLAY'] == 9 || $GLOBALS['NINEDISPLAY'] == 1 || $GLOBALS['NINEDISPLAY'] == 3)) get_sidebar('left') ?>
<?php // 主要部分を"content.php"に任せている ?>
<?php get_template_part('content', get_post_format()) ?>
<?php // 右サイドバー  ?>
<?php if (http_response_code() == 200 && ($GLOBALS['NINEDISPLAY'] == 9 || $GLOBALS['NINEDISPLAY'] == 2 || $GLOBALS['NINEDISPLAY'] == 3)) get_sidebar('right'); ?>
</div>
<?php // 下部サイドバー ?>
<?php if (http_response_code() == 200 && $GLOBALS['NINEDISPLAY'] != 4) get_sidebar('bottom') ?>
<?php // フッターを"footer.php"に任せている ?>
<?php get_footer() ?>
</body>
</html>
