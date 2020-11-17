<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function nine_color_picker_init() {
	function _nine_nine_color_picker_init() {
		wp_enqueue_style('wp-color-picker');
	}
	add_action('admin_print_styles', '_nine_nine_color_picker_init');
}

function nine_color_picker($name, $value, $default, $label) {
	if ($label != '') {
?>
<p><?php echo $label; ?></p><br />
<?php
	}
?>
<input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" /><br />
<?php
	wp_enqueue_script('wp-color-picker');
	$data = '(function($) {
		var options = {
			defaultColor: "' . $default . '",
			change: function(event, ui){},
			clear: function() {},
			hide: true,
			palettes: true
		};
		$("input:text[name=' . $name . ']").wpColorPicker(options);
	})(jQuery);';
	wp_add_inline_script('wp-color-picker', $data);   
}

function nine_image_selector_init($type, $label) {
	wp_enqueue_media();

	$addlen = strlen($type) + 2;

	$data = <<<JAVASCRIPT
(function($) {
	$(function() {
		$('[id^=imgimg-{$type}-]').on('click', function(e) {
			e.preventDefault();
			tar = $(this).attr('id').substring(6 + {$addlen});

			var uploader = wp.media({
				title: '{$label}',
				library: {
					type: 'image'
				},
				button: {
					text: '選択'
				},
				multiple: false
			});

			uploader.on('select', function () {
				var images = uploader.state().get('selection');

				images.each(function(file) {
					//document.write($(this).attr('id'));
					//tar = $(this).attr('id').substring(6 + {$addlen});
					$('#imgurl-{$type}-' + tar).val(file.toJSON().url);
					$('#imgimg-{$type}-' + tar).html('<img src="' + file.toJSON().url + '" style="width:auto;max-width:100%;height:auto;max-height:100%;">');
				});
			});

			uploader.open();
		});

		$('button[id^="imgdel-{$type}-"]').on('click', function(e) {
			var tar = $(this).attr('id').substring(6 + {$addlen});
			//document.write(tar);
			$('#imgurl-{$type}-' + tar).val('');
			$('#imgimg-{$type}-' + tar).html('OGP画像を設定');
		});
	});
})(jQuery);
JAVASCRIPT;
	wp_add_inline_script('jquery', $data);
}

function nine_image_selector($type, $name, $value, $width, $height) {
	if ($value == '') {
		$value_img = 'OGP画像を設定';
	} else {
		$value_img = '<img src="' . $value . '" style="width:auto;max-width:100%;height:auto;max-height:100%;">';
	}
?>
<div>
<button id="imgimg-<?php echo $type ?>-<?php echo $name ?>" type="button" style="padding:0;border:none;width:<?php echo $width ?>px;height:<?php echo $height ?>px;" class="components-button editor-post-featured-image__toggle"><?php echo $value_img ?></button><br>
<input id="imgurl-<?php echo $type ?>-<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" type="hidden">
<button id="imgdel-<?php echo $type ?>-<?php echo $name ?>">画像の削除</button>
</div>
<?php
}

// cron
add_action('nine_daily_action', '_nine_daily_action');
function _nine_daily_action() {
	// 古いキャッシュを削除する（3日間）
	global $wpdb;
	$table_name = $wpdb->prefix . 'nine_cache';
	$sql = "DELETE FROM $table_name WHERE lastmod < \'" . gmdate('Y-m-d H:i:s', time() - 60 * 60 * 24 * 3) . "\'";
	$wpdb->query($sql);
}
if (!wp_next_scheduled('nine_daily_action')) {
    wp_schedule_event(time(), 'daily', 'nine_daily_action');
}

// プラグイン有効化
if(function_exists('register_activation_hook')) {
	register_activation_hook(__DIR__ . '/nine.php', '_nine_register_activation');
}
function _nine_register_activation() {
	wp_unschedule_event(wp_next_scheduled('nine_daily_action'), 'nine_daily_action');

	// テーブルの作成
	global $wpdb;
	$table_name = $wpdb->prefix . "nine_cache";

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id bigint(20) AUTO_INCREMENT NOT NULL PRIMARY KEY,
		uri varchar(200) NOT NULL,
		lastmod datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		content text NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
	$wpdb->query($sql);	
}

// プラグイン無効化
if(function_exists('register_deactivation_hook')) {
	register_deactivation_hook(__DIR__ . '/nine.php', '_nine_register_deactivation');
}
function _nine_register_deactivation() {
	wp_unschedule_event(wp_next_scheduled('nine_daily_action'), 'nine_daily_action');

	// テーブルを空にする
	global $wpdb;
	$table_name = $wpdb->prefix . 'nine_cache';
	$sql = "DELETE FROM $table_name";
	$wpdb->query($sql);
}

// プラグイン削除
if(function_exists('register_uninstall_hook')) {
	register_uninstall_hook(__DIR__ . '/nine.php', '_nine_register_uninstall');
}
function _nine_register_uninstall() {
	// オプションの削除
	delete_option('nine_top_title');
	delete_option('nine_favicon_1_url');
	delete_option('nine_favicon_2_url');
	delete_option('nine_favicon_3_url');
	delete_option('nine_ogp_image_url');
	delete_option('nine_del_head');
	delete_option('nine_use_sitemap');
	delete_option('nine_use_amp');
	delete_option('nine_use_pwa');
	delete_option('nine_use_ogp');
	delete_option('nine_pwa_bgcolor_android');
	delete_option('nine_pwa_bgcolor_iphone');
	delete_option('nine_use_html');
	delete_option('nine_html_cache');
	delete_option('nine_page_cache');
	delete_option('nine_login_path');
	delete_option('nine_hide_adminbar');

	// テーブルの削除
	global $wpdb;
	$table_name = $wpdb->prefix . 'nine_cache';
	$sql = "DROP TABLE IF EXISTS $table_name";
	$wpdb->query($sql);
}
