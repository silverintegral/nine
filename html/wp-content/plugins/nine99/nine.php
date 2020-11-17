<?php
/*
Plugin Name: NINE TOOLKIT
Plugin URI: 
Text Domain: ninetoolkit
Description: Exclusive to NINE theme. All easily customizable plugins.
Version: 0.1.0
Author: Anonymous
Author URI: 

License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
** All files, unless otherwise stated, are released
** under the GNU General Public　License version 2.0
*/

//define('ENABLE_FRO_ALL_THEMES', true);

$nine_output_css_tags = '';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://nine.devel.ws/plugin.json', __FILE__, 'nine99'
);

require_once(plugin_dir_path(__FILE__) . 'common.php');
if (is_admin()) {
	// 管理画面
	// https://developer.wordpress.org/reference/hooks/admin_notices/
	if (wp_get_theme(get_template())->get('TextDomain') != 'nine99' && !defined('ENABLE_FRO_ALL_THEMES')) {
		add_action('admin_notices', function() {
			global $pagenow;
			if ($pagenow == 'index.php' || $pagenow == 'plugins.php') {
				echo '<div class="notice notice-error"><p>現在 <strong>NINE TOOLKIT</strong> は無効です。テーマに <strong>NINEの子テーマ</strong> を利用するか、プラグインを無効にして下さい。</p></div>';
			}
		});
	} else {
		require_once(plugin_dir_path(__FILE__) . 'admin.php');
		require_once(plugin_dir_path(__FILE__) . 'setting.php');	
	}
} else if (wp_get_theme(get_template())->get('TextDomain') == 'nine99' || defined('ENABLE_FRO_ALL_THEMES')) {
	// 親テーマがNINEの時だけ有効
	require_once(plugin_dir_path(__FILE__) . 'std.php');
	require_once(plugin_dir_path(__FILE__) . 'cache.php');
	require_once(plugin_dir_path(__FILE__) . 'amp.php');
	require_once(plugin_dir_path(__FILE__) . 'pwa.php');
	require_once(plugin_dir_path(__FILE__) . 'output.php');
	require_once(plugin_dir_path(__FILE__) . 'login.php');
	require_once(plugin_dir_path(__FILE__) . 'sitemap.php');
}
