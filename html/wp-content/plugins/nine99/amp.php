<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// amp処理
if (get_option('nine_use_amp') == '1') {
	add_action('wp_head', '_nine_amp_init', 999);
	function _nine_amp_init () {
		global $post;

		if (!$post)
			return;

		if (get_post_meta($post->ID, 'nine_dis_amp', true) == '1' || @$_GET['amp'] == '') {
			// amp有効かつampではないページを見ている時はampへのリンクを付ける
			echo '<link rel="amphtml" href="' . get_the_permalink() . "?amp=1\" />\r\n";
			return;
		}

		if (@$_GET['amp'] != '') {
			add_filter('wp_lazy_loading_enabled', '__return_false');
		
			// CSSをリンクではなくタグで出力
			global $nine_output_css_tags;
			include(get_template_directory() . '/nine-style.php');
			$css_name = get_stylesheet_directory() . '/style.css';
			$css_data = nine_create_style() . ' ' . @file_get_contents($css_name) . $nine_output_css_tags;
			$css_data = preg_replace('/\\/\\*.*?\\*\\//s', '', $css_data);
			$css_data = preg_replace('/[\\r\\n\\t ]+/s', ' ', $css_data);
			$css_data = preg_replace('/([:;{}\\(\\)]) +/s', '$1', $css_data);
			echo '<style amp-custom>' . trim($css_data) . "</style>\r\n";
		
			// amp必須タグ
			echo '<link rel="canonical" href="' . get_the_permalink() . "\">\r\n";
			echo "<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>\r\n";
			echo "<script async src=\"https://cdn.ampproject.org/v0.js\"></script>\r\n";
			echo "<script async custom-element=\"amp-script\" src=\"https://cdn.ampproject.org/v0/amp-script-0.1.js\"></script>\r\n";
			echo "<script async custom-element=\"amp-form\" src=\"https://cdn.ampproject.org/v0/amp-form-0.1.js\"></script>\r\n";
		} else {
			echo '<link rel="amphtml" href="' . get_the_permalink() . "?amp=1\" />\r\n";
		}
	}

	// nineテーマが出力しているcssを停止
	add_action('wp_enqueue_scripts', '_nine_dequeue_style' , 999);
	function _nine_dequeue_style() {
		global $post;
		if (!$post)
			return;

		if (get_post_meta($post->ID, 'nine_dis_amp', true) == '1' || @$_GET['amp'] == '')
			return;

		wp_dequeue_style('nine');
		wp_dequeue_style('nine-child');
	}

	// scriptタグをamp-scriptに変換
	add_filter('script_loader_tag', '_nine_edit_script_tags', 999);
	function _nine_edit_script_tags($tag) {
		global $post;
		if (!$post)
			return $tag;

		if (get_post_meta($post->ID, 'nine_dis_amp', true) == '1' || @$_GET['amp'] == '')
			return $tag;

		// 属性削除
		$tag = preg_replace('/((^|\\r|\\n)<script .*?) *type=(["\']).*?\\3 */is', '$1', $tag);
		$tag = preg_replace('/((^|\\r|\\n)<script .*?) *target=(["\']).*?\\3 */is', '$1', $tag);
		$tag = preg_replace('/((^|\\r|\\n)<script .*?) *id=(["\']).*?\\3 */is', '$1', $tag);

		// インライン
		$id = 'ID' . rand(100000, 999999);
		$tag = preg_replace('/(^|\\r|\\n)(<script( +(?!src=)[a-z]+=(["\']).*?\\4)*? *)>/is', '$1<amp-script script="' . $id . '"></amp-script>$2id="' . $id . '" type="text/plain" target="amp-script">', $tag);
		// 外部
		$tag = preg_replace('/(^|\\r|\\n)<script(( +[a-z]+=(["\']).*?\\4)*? *)><\\/script>/i', '$1<amp-script$2></amp-script>', $tag);		

		return $tag;
	}

	// styleタグ展開
	add_filter('style_loader_tag', '_nine_remove_style_tags', 999);
	function _nine_remove_style_tags($tag) {
		global $post;
		if (!$post)
			return $tag;

		if (get_post_meta($post->ID, 'nine_dis_amp', true) == '1' || @$_GET['amp'] == '')
			return $tag;

		global $nine_output_css_tags;

		$css_url = preg_replace('/.*?href=([\'"])(.+?)[\\1\\?].*/is', '$2', $tag);
		$css_path = str_replace(get_home_url(null, '/'), ABSPATH, $css_url);

		$css_data = @file_get_contents($css_path);

		if ($css_data !== '' && $css_data !== false) {
			$nine_output_css_tags .= ' ' . $css_data;
		}

		return '';
	}
}
