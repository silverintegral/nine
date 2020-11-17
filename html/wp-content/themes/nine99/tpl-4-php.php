<?php /*
Template Name: 全画面PHP
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//$GLOBALS['NINEDISPLAY'] = 4;
//get_template_part('index', get_post_format());

@list($path, $query) = explode('?', $_SERVER["REQUEST_URI"]);
$id = get_page_by_path($path);

if (!$id) {
	echo 'NOT FOUND';
	return;
}

header('Content-type: text/html; charset=utf-8');
$code = '?>' . @get_post($id)->post_content;
try {
	eval($code);
} catch (Throwable $t) {
	echo "PHPエラーが発生しました。";
}

exit();
