<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// ヘッダーを含む全出力データのバッファリング
if ((@$_GET['amp'] != '' && get_option('nine_use_amp') == '1') || get_option('nine_html_cache') == '1' || get_option('nine_page_cache') == '1') {
	add_action('after_setup_theme', function() {
		ob_start('_nine_output_callback');
	});
	
	add_action('shutdown', function() {
		if (ob_get_length()) {
			ob_end_flush();
		}
	});

	function _nine_output_callback($content) {
		global $post;

		// amp
		if (@$_GET['amp'] != '' && get_option('nine_use_amp') == '1' && get_post_meta($post->ID, 'nine_dis_amp', true) != '1') {
			// htmlヘッダーの改ざん
			$content = preg_replace('/^<\\!DOCTYPE html>[\\r\\n]*<html /is', '$0amp ', $content, 1);
			// imgタグの置換
			$content = preg_replace('/<img(( +[a-z]+| +[a-z]+=(["\']).*?\\3)*? *\\/?>)/is', '<amp-img$1', $content);
			// マナーの悪いstyleタグの削除
			$content = preg_replace('/<style(( +[a-z]+=(["\']).*?\\3)*? *)>.*?<\\/style>[\\r\\n]*/is', '', $content);
			// マナーの悪いscriptタグの削除
			$content = preg_replace('/<script(( +(?!id=)[a-z]+=(["\']).*?\\3)*? *)>.*?<\\/script>[\\r\\n]*/is', '', $content);

			// formの改ざん
			$content = preg_replace_callback('/<form(( +(?!id=)[a-z]+=(["\']).*?\\3)*? *)>/is', function($matches) {
				$matches = $matches[0];
				$matches = preg_replace('/((^|\\r|\\n)<form .*?) *target=(["\']).*?\\3 */is', '$1', $matches);
				$matches = str_ireplace('<form ', '<form target="_top" ', $matches);

				if (stripos($matches, 'method="post"') !== false || stripos($matches, 'method=\'post\'') !== false) {
					$matches = str_ireplace(' action=', ' action-xhr=', $matches);
				}

				return $matches;
			}, $content);
		}

		// ページキャッシュ
		if ($post && $post->post_type == 'page') {
			if (get_option('nine_page_cache') == '1' && get_post_meta($post->ID, 'nine_dis_page_cache', true) != '1') {
				nine_cache_set($_SERVER['REQUEST_URI'], $post->post_modified_gmt, $content);
			}

			// キャッシュ時の初回はこっちでヘッダーを出す
			$lastmod = gmdate('D, d M Y H:i:s T', strtotime($post->post_modified_gmt));
			header('Last-Modified: ' . $lastmod);
		}

		// 12Hキャッシュ
		if (get_option('nine_html_cache') == '1') {
			$expires = 43200;
			header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
			header('Cache-Control: public, max-age=' . $expires);
		}
	
		return $content;
	}
}
