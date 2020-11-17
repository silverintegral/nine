<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// 設定エリアの作成
add_action('admin_menu', function() {
	add_meta_box('nine_setting', 'NINE TOOLKIT', '_nine_insert_post_fields', 'post', 'normal', 'high');
	add_meta_box('nine_setting', 'NINE TOOLKIT', '_nine_insert_post_fields', 'page', 'normal', 'high');

	nine_image_selector_init('ogp','OGPイメージの選択');
});

// データのロードと表示
function _nine_insert_post_fields() {
	global $post;
	$title = get_post_meta($post->ID, 'nine_title', true);
	$desc = get_post_meta($post->ID, 'nine_desc', true);
	
	if (get_post_meta($post->ID, 'nine_title_opt', true) == '1') {
        $nine_title_opt = "checked";
    } else {
		$nine_title_opt = '';
	}
	
	if (get_post_meta($post->ID, 'nine_use_php', true) == '1') {
        $nine_use_php = "checked";
    } else {
		$nine_use_php = '';
	}
	
	if (get_post_meta($post->ID, 'nine_dis_sitemap', true) == '1') {
        $nine_dis_sitemap = "checked";
    } else {
		$nine_dis_sitemap = '';
	}
	
	if (get_post_meta($post->ID, 'nine_dis_amp', true) == '1') {
        $nine_dis_amp = "checked";
    } else {
		$nine_dis_amp = '';
	}
	
	if (get_post_meta($post->ID, 'nine_dis_pwa', true) == '1') {
        $nine_dis_pwa = "checked";
    } else {
		$nine_dis_pwa = '';
	}

	$nine_ogp_image_url = get_post_meta($post->ID, 'nine_ogp_image_url', true);
	if ($nine_ogp_image_url != '') {
		$nine_ogp_image_url = get_home_url() . $nine_ogp_image_url;
	}

	$nine_file_js = get_post_meta($post->ID, 'nine_file_js', true);
	$nine_file_css = get_post_meta($post->ID, 'nine_file_css', true);

	if (wp_get_theme(get_template())->get('TextDomain') != 'nine99') {
?>
<table class="basicTable">
	<tbody>
		<tr>
			<td>
				<span style="color:blue">このプラグインはNINEテーマ専用プラグインです。</span><br>
			</td>
		</tr>
	</tbody>
</table>
<?php
		return;
	}
?>
<table class="basicTable">
	<tbody>
		<tr>
			<td>
				<strong>TITLEタグ＆OGPタイトル:</strong><br>
				<span style="color:blue">サイト名含めて32文字までが理想（OGPタイトルにサイト名は含まれない）</span><br>
				<input type="text" size="100" name="nine_title" value="<?php echo esc_html($title) ?>" /><br>
				<input type="checkbox" id="nine_title_opt" name="nine_title_opt" value="1" <?php echo $nine_title_opt ?>><label for="nine_title_opt">TITLEタグは後ろに「<?php echo get_bloginfo('name') ?>」を付ける</label><br>
				<br>
				<strong>サイト説明:</strong><br>
				<span style="color:blue">各descriptionに反映されます。60文字程度が理想</span><br>
				<input type="text" size="100" name="nine_desc" value="<?php echo esc_html($desc) ?>" /><br>
				<br>
				<strong>OGP画像:</strong><br>
				<span style="color:blue">1200x630（2:1）が理想</span><br>
<?php nine_image_selector('ogp', 'nine_ogp_image_url', $nine_ogp_image_url, 200, 100) ?>
				<br>
				<strong>外部JSファイル:</strong><br>
				<span style="color:blue">カンマ区切り</span><br>
				<input type="text" size="100" name="nine_file_js" value="<?php echo esc_html($nine_file_js) ?>" /><br>
				<br>
				<strong>外部CSSファイル:</strong><br>
				<span style="color:blue">カンマ区切り</span><br>
				<input type="text" size="100" name="nine_file_css" value="<?php echo esc_html($nine_file_css) ?>" /><br>
				<br>
				<strong>機能制限:</strong><br>
				<?php if (get_option('nine_use_amp') == '1') { echo '<input type="checkbox" id="nine_dis_amp" name="nine_dis_amp" value="1" ' . $nine_dis_amp . '><label for="nine_dis_amp">AMPを無効にする</label><br>'; } ?>
				<?php if (get_option('nine_use_pwa') == '1') { echo '<input type="checkbox" id="nine_dis_pwa" name="nine_dis_pwa" value="1" ' . $nine_dis_pwa . '><label for="nine_dis_pwa">PWAを無効にする</label><br>'; } ?>
				<?php if (get_option('nine_use_sitemap') == '1') { echo '<input type="checkbox" id="nine_dis_sitemap" name="nine_dis_sitemap" value="1" ' . $nine_dis_sitemap . '><label for="nine_dis_sitemap">サイトマップから外す</label><br>'; } ?>
				<br>
				<strong>実行処理:</strong><br>
				<input type="checkbox" id="nine_use_php" name="nine_use_php" value="1" <?php echo $nine_use_php ?>><label for="nine_use_php">コンテンツ部分をPHPとして実行する</label><br>
			</td>
		</tr>
	</tbody>
</table>
<?php
}

// データの保存
add_action('save_post', '_nine_save_post_fields', 1, 2);
function _nine_save_post_fields($post_id) {
    // 自動保存
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // クイックポスト
    if(isset($_POST['action']) && $_POST['action'] == 'inline-save') {
        return;
	}

	if (!empty($_POST['nine_title'])) {
        update_post_meta($post_id, 'nine_title', $_POST['nine_title']);
    } else {
        delete_post_meta($post_id, 'nine_title');
	}

	if (!empty($_POST['nine_title']) && !empty($_POST['nine_title_opt'])) {
        update_post_meta($post_id, 'nine_title_opt', $_POST['nine_title_opt']);
    } else {
        delete_post_meta($post_id, 'nine_title_opt');
	}

	if (!empty($_POST['nine_desc'])) {
        update_post_meta($post_id, 'nine_desc', $_POST['nine_desc']);
    } else {
        delete_post_meta($post_id, 'nine_desc');
	}

	if (!empty($_POST['nine_use_php'])) {
        update_post_meta($post_id, 'nine_use_php', $_POST['nine_use_php']);
    } else {
        delete_post_meta($post_id, 'nine_use_php');
	}

	if (!empty($_POST['nine_dis_sitemap'])) {
        update_post_meta($post_id, 'nine_dis_sitemap', $_POST['nine_dis_sitemap']);
    } else {
        delete_post_meta($post_id, 'nine_dis_sitemap');
	}

	if (!empty($_POST['nine_dis_amp'])) {
        update_post_meta($post_id, 'nine_dis_amp', $_POST['nine_dis_amp']);
    } else {
        delete_post_meta($post_id, 'nine_dis_amp');
	}

	if (!empty($_POST['nine_dis_pwa'])) {
        update_post_meta($post_id, 'nine_dis_pwa', $_POST['nine_dis_pwa']);
    } else {
        delete_post_meta($post_id, 'nine_dis_pwa');
	}

	if (!empty($_POST['nine_ogp_image_url'])) {
		$_POST['nine_ogp_image_url'] = substr($_POST['nine_ogp_image_url'], strlen(get_home_url()));
        update_post_meta($post_id, 'nine_ogp_image_url', $_POST['nine_ogp_image_url']);
    } else {
        delete_post_meta($post_id, 'nine_ogp_image_url');
	}

	if (!empty($_POST['nine_file_js'])) {
        update_post_meta($post_id, 'nine_file_js', $_POST['nine_file_js']);
    } else {
        delete_post_meta($post_id, 'nine_file_js');
	}

	if (!empty($_POST['nine_file_css'])) {
        update_post_meta($post_id, 'nine_file_css', $_POST['nine_file_css']);
    } else {
        delete_post_meta($post_id, 'nine_file_css');
	}
}
