<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// 設定エリアの作成
add_action('admin_menu', function() {
	add_action('admin_init', '_nine_admin_init');
	add_submenu_page('options-general.php', 'NINE TOOLKIT', 'NINE TOOLKIT', 'manage_options', 'nine', '_nine_page');
});

function _nine_admin_init() {
	register_setting('nine', 'nine_top_title');
	register_setting('nine', 'nine_favicon_1_url');
	register_setting('nine', 'nine_favicon_2_url');
	register_setting('nine', 'nine_favicon_3_url');
	register_setting('nine', 'nine_ogp_image_url');
	register_setting('nine', 'nine_del_head');
	register_setting('nine', 'nine_use_sitemap');
	register_setting('nine', 'nine_use_ogp');
	register_setting('nine', 'nine_use_amp');
	register_setting('nine', 'nine_use_pwa');
	register_setting('nine', 'nine_pwa_bgcolor_android');
	register_setting('nine', 'nine_pwa_bgcolor_iphone');
	register_setting('nine', 'nine_use_html');
	register_setting('nine', 'nine_html_cache');
	register_setting('nine', 'nine_page_cache');
	register_setting('nine', 'nine_login_path');
	register_setting('nine', 'nine_hide_adminbar');
}

function _nine_page() {
?>

<div class="wrap">
<h1>NINE TOOLKIT</h1>
<?php if (wp_get_theme(get_template())->get('TextDomain') != 'nine99') { ?>
	<br><p>このプラグインはNINEテーマ専用プラグインです。</p>
<?php return; } ?>

<form method="post" action="options.php">
<?php settings_fields('nine'); do_settings_sections('nine'); ?>
<p>NINEテーマを拡張するTOOLKITの設定です。全ての項目は未設定でも問題なく動作します。<br />
本TOOLKITと「All in one SEO pack」を併用しないで下さい。設定内容次第でコンフリクトが発生します。</p>

<h2 class="title">ビジュアルの設定</h2>
<table class="form-table" role="presentation"><tbody>

<tr>
<th scope="row">faviconのURL1 (.ico)</th>
<td><input name="nine_favicon_1_url" type="text" id="nine_favicon_1_url"  class="regular-text" value="<?php echo get_option('nine_favicon_1_url') ?>" placeholder="/favicon.ico"><br><p>※16px,32px,192pxを含むico。ドメインを含めない絶対パス</p></td>
</tr>

<tr>
<th scope="row">faviconのURL2 (.png)</th>
<td><input name="nine_favicon_2_url" type="text" id="nine_favicon_2_url"  class="regular-text" value="<?php echo get_option('nine_favicon_2_url') ?>" placeholder="/path/to/file.png"><br><p>※192x192pxのpng。ドメインを含めない絶対パス。未指定の場合はWPから設定するサイトアイコンが利用されます。</p></td>
</tr>

<tr>
<th scope="row">faviconのURL3 (.png)</th>
<td><input name="nine_favicon_3_url" type="text" id="nine_favicon_3_url"  class="regular-text" value="<?php echo get_option('nine_favicon_3_url') ?>" placeholder="/path/to/file.png"><br><p>※512x512pxのpng。ドメインを含めない絶対パス。未指定の場合はWPから設定するサイトアイコンが利用されます。</p></td>
</tr>

<tr>
<th scope="row">OGP対応</th>
<td><input name="nine_use_ogp" type="checkbox" id="nine_use_ogp" value="1" <?php echo get_option('nine_use_ogp') == '1' ? ' checked="checked"' : '' ?>><label for="nine_use_ogp">OGPタグの追加。OGP画像が存在しない場合は自動追加されません</label><br>
<br>
<p>デフォルトOGP画像のURL<p>
<input name="nine_ogp_image_url" type="text" id="nine_ogp_image_url"  class="regular-text" value="<?php echo get_option('nine_ogp_image_url') ?>" placeholder="//domain/path/to/file.jpg"><br><p>※1200x630px（2:1）のjpg/png。ドメインを含める（他のドメインでも構わない）<br />
</td></tr>

</tbody></table>
<br>
<h2 class="title">SEOの設定</h2>
<table class="form-table" role="presentation"><tbody>

<tr>
<th scope="row">INDEX専用タイトル</th>
<td><input name="nine_top_title" type="text" id="nine_top_title" value="<?php echo get_option('nine_top_title') ?>" class="regular-text"></td>
</tr>

<tr>
<th scope="row">不要ヘッダーの削除</th>
<td><input name="nine_del_head" type="checkbox" id="nine_del_head" value="1" <?php echo get_option('nine_del_head') == '1' ? ' checked="checked"' : '' ?>><label for="nine_del_head">WPバージョン、ショートリンク、フィード、アプリ投稿リンク、関連記事リンク、絵文字スクリプト、DNSプリフェッチの削除</label></td>
</tr>

<tr>
<th scope="row">ブラウザキャッシュ</th>
<td><input name="nine_html_cache" type="checkbox" id="nine_html_cache" value="1" <?php echo get_option('nine_html_cache') == '1' ? ' checked="checked"' : '' ?>><label for="nine_html_cache">HTML出力を12時間キャッシュする（ブラウザ依存）</label></td>
</tr>

<tr>
<th scope="row">ページキャッシュ</th>
<td><input name="nine_page_cache" type="checkbox" id="nine_page_cache" value="1" <?php echo get_option('nine_page_cache') == '1' ? ' checked="checked"' : '' ?>><label for="nine_page_cache">固定ページの完全なキャッシュを保持してブラウザに通知する。ウィジェットなども含めて全てキャッシュされるので注意（遅くなる事もあります）</label></td>
</tr>

<tr>
<th scope="row">XMLサイトマップ</th>
<td><input name="nine_use_sitemap" type="checkbox" id="nine_use_sitemap" value="1" <?php echo get_option('nine_use_sitemap') == '1' ? ' checked="checked"' : '' ?>><label for="nine_use_sitemap">サイトマップの自動生成と最適化を行う</label></td>
</tr>

<tr>
<th scope="row">AMP対応</th>
<td><input name="nine_use_amp" type="checkbox" id="nine_use_amp" value="1" <?php echo get_option('nine_use_amp') == '1' ? ' checked="checked"' : '' ?>><label for="nine_use_amp">AMPページの生成（imgタグの変換、styleの展開、scriptの修正、formの修正、および必須ヘッダの追加のみ）</label></td>
</tr>

<tr>
<th scope="row">PWA対応（HOME追加のみ）</th>
<td>
<input name="nine_use_pwa" type="checkbox" id="nine_use_pwa" value="1" <?php echo get_option('nine_use_pwa') == '1' ? ' checked="checked"' : '' ?>><label for="nine_use_pwa">TOPと全ての固定ページにPWAを実装する（有効にするにはビジュアルの設定でpng形式のfaviconを設定、もしくはサイトアイコンの設定を行う必要があります）<br>※WPのサイトアイコン設定を利用する場合は必ずpng形式のファイルを指定して下さい</label><br>
<br />
<?php nine_color_picker('nine_pwa_bgcolor_android', get_option('nine_pwa_bgcolor_android') != '' ? get_option('nine_pwa_bgcolor_android') : '#ffffff', '#ffffff', 'Android用のテーマカラー'); ?>
<br />
<?php nine_color_picker('nine_pwa_bgcolor_iphone', get_option('nine_pwa_bgcolor_iphone') != '' ? get_option('nine_pwa_bgcolor_iphone') : '#000000', '#000000', 'iPhone用のテーマカラー'); ?>
</td>
</tr>

</tbody></table>
<br>
<h2 class="title">その他の設定</h2>
<table class="form-table" role="presentation"><tbody>

<tr>
<th scope="row">外部コンテンツ出力</th>
<td><input name="nine_use_html" type="checkbox" id="nine_use_html" value="1" <?php echo get_option('nine_use_html') == '1' ? ' checked="checked"' : '' ?>><label for="nine_use_html">WPをパススルーしてwp-content/html内の.html/.phpをWPの一部であるかのように出力します</label><p>拡張子を外して後ろに/を付けてアクセスをして下さい。htmlファイルが優先されます</p></td>
</tr>

<tr>
<th scope="row">ログインページの変更</th>
<td><input name="nine_login_path" type="text" id="nine_login_path"  class="regular-text" value="<?php echo get_option('nine_login_path') ?>"><br><p>※英数字のみの文字列。同時にxmlrpcを無効にしてアプリからのログインを禁止します</p></td>
</tr>

<tr>
<th scope="row">AdminBarの非表示</th>
<td><input name="nine_hide_adminbar" type="checkbox" id="nine_hide_adminbar" value="1" <?php echo get_option('nine_hide_adminbar') == '1' ? ' checked="checked"' : '' ?>><label for="nine_hide_adminbar">無条件に全ユーザーのAdminBarを非表示にする（※デバッグ用）</label></td>
</tr>

</tbody></table>
<?php submit_button(); ?>
</form>
</div>

<?php
}

if (is_admin()) {
	// 設定リンクを付ける
	add_filter('plugin_row_meta', function($links, $file) {
		$links[] = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=nine">設定</a>';
		return $links;
	}, 10, 2);
}

nine_color_picker_init();
