<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// 初期化
add_action('init', '_nine_seo_init', 999);
function _nine_seo_init() {
	// WPのcanonicalを停止
	remove_action('wp_head', 'rel_canonical');

	if (get_option('nine_hide_adminbar') == '1')
		add_filter('show_admin_bar', '__return_false');
}

// 基本ヘッダー追加
add_action('wp_head', '_nine_seo_wp_head');
function _nine_seo_wp_head() {
	global $post;
	if (!isset($post))
		return;

	if (is_front_page() || is_home()) {
		$type = 'website';

		$title = get_option('nine_top_title');
		if ($title == '')
			$title = get_bloginfo('name');

		$desc = get_bloginfo('description');
	} else {
		$type = 'article';

		$title = get_post_meta($post->ID, 'nine_title', true);
		$desc = get_post_meta($post->ID, 'nine_desc', true);
	
		if ($title == '') {
			$title = get_the_title();
		}
	
		if ($desc == '') {
			$desc = get_bloginfo('description');
		}
	}

	$ogp_image_url_1 = get_post_meta($post->ID, 'nine_ogp_image_url', true);
	$ogp_image_url_2 = get_option('nine_ogp_image_url');

	if (get_option('nine_use_ogp') == '1' && ($ogp_image_url_1 != '' || $ogp_image_url_2 != '')) {
?>
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:url" content="<?php echo get_the_permalink() ?>" />
<meta property="og:type" content="<?php echo $type ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name') ?>" />
<meta property="og:description" content="<?php echo $desc ?>" />
<?php if ($ogp_image_url_1 != '') { ?>
<meta property="og:image" content="<?php echo get_home_url() . esc_url($ogp_image_url_1) ?>" />
<?php } ?>
<?php if ($ogp_image_url_2 != '') { ?>
<meta property="og:image" content="<?php echo get_home_url() . esc_url($ogp_image_url_2) ?>" />
<?php } ?>
<?php } ?>
<?php if (get_option('nine_favicon_1_url') != '') { ?>
<link rel="icon" href="<?php echo get_option('nine_favicon_1_url') ?>">
<?php } ?>
<?php if (get_option('nine_favicon_2_url') != '') { ?>
<link rel="apple-touch-icon" sizes="192x192" href="<?php echo get_option('nine_favicon_2_url') ?>">
<?php } ?>
<?php
}

// 不要ヘッダーの削除
if (get_option('nine_del_head') == '1') {
	add_action('init', '_nine_del_non_essential_headers1');
	function _nine_del_non_essential_headers1() {
		// WPのバージョン出力を削除
		remove_action('wp_head', 'wp_generator');
		// shortlinkを削除
		remove_action('wp_head', 'wp_shortlink_wp_head');
		// フィードなどへのリンクを削除
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		// アプリからの投稿リンクを削除
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		// 記事の関係を指定しているリンク
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		// WP標準絵文字の削除
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
	}

	add_action('wp_enqueue_scripts', '_nine_del_non_essential_headers2');
	function _nine_del_non_essential_headers2() {
		// グーテンベルク用CSSの削除
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
	}

	add_filter('wp_resource_hints', '_nine_del_non_essential_headers3', 10, 2);
	function _nine_del_non_essential_headers3($hints, $relation_type) {
		// DNSプリフェッチの削除
		if ($relation_type == 'dns-prefetch') {
			return array_diff(wp_dependencies_unique_hosts(), $hints);
		}
		return $hints;
	}
}

// ページ別で設定されているファイルの追加
add_action('wp_enqueue_scripts', '_nine_add_files');
function _nine_add_files() {
	global $post;
	if (!$post)
		return;

	$scripts = get_post_meta($post->ID, 'nine_file_js', true);
	if ($scripts) {
		$scripts = explode(',', $scripts);
		foreach ($scripts as $script) {
			wp_enqueue_script('nine-seo', trim($script, ' '), array(), null, true);
		}
	}

	$styles = get_post_meta($post->ID, 'nine_file_css', true);
	if ($styles) {
		$styles = explode(',', $styles);
		foreach ($styles as $style) {
			wp_enqueue_style('nine-seo', trim($style, ' '), array(), null);
		}
	}
}

// titleの置換
add_filter('wp_title', '_nine_seo_wp_title', 999);
function _nine_seo_wp_title($title) {
	global $post;
	if (!$post)
		return $title;

	if (is_front_page() || is_home()) {
		$seo_title = get_option('nine_top_title');
		return $seo_title != '' ? $seo_title : $title;
	}

	$seo_title = get_post_meta($post->ID, 'nine_title', true);
	if ($seo_title == '') {
		return $title;
	}

	if (get_post_meta($post->ID, 'nine_title_opt', true) == '1') {
		$seo_title .= '｜' . get_bloginfo('name');
	}

	return $seo_title;
}

// descriptionの置換
function replace_description($info, $show) {
	global $post;

	if (!isset($post) || $show != 'description')
		return $info;

	if (!is_page() && !is_single()) {
		$desc = get_post_meta($post->ID, 'nine_desc', true);
		if ($desc != '')
			$info = $desc;
	}

	return $info;
}
add_filter('bloginfo','replace_description', 999, 2);

// HTML/PHPパススルー
if (get_option('nine_use_html') == '1') {
	add_filter('plugins_loaded', '_nine_plugins_loaded');
	function _nine_plugins_loaded() {
		if ($_SERVER["REQUEST_URI"] == '/')
			$html = '/index';
		else
			$html = rtrim($_SERVER["REQUEST_URI"], '/');

		if (file_exists(WP_CONTENT_DIR . '/html' . $html . '.html')) {
			// HTML、baseタグを追加してリンクの整合性を保つ
			$html_data = file_get_contents(WP_CONTENT_DIR . '/html' . $html . '.html');
			$base = content_url() . '/html' . rtrim($_SERVER["REQUEST_URI"], '/');
			$html_data = preg_replace('/<head(.*?)>/i', "<head$1>\r\n<base href=\"" . $base . "\" target=\"_self\">", $html_data, 1);
	
			// 12Hキャッシュ
			if (get_option('nine_html_cache') == '1') {
				$expires = 43200;
				header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
				header('Cache-Control: public, max-age=' . $expires);
			}
	
			header("Content-type: text/html; charset=utf-8");
			echo $html_data;
			exit();
		} else if (file_exists(WP_CONTENT_DIR . '/html' . $html . '.php')) {
			// PHP

			// 12Hキャッシュ
			if (get_option('nine_html_cache') == '1') {
				$expires = 43200;
				header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
				header('Cache-Control: public, max-age=' . $expires);
			}

			header("Content-type: text/html; charset=utf-8");
			include(WP_CONTENT_DIR . '/html' . $html . '.php');
			exit();
		}
	}
}
