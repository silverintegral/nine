<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function nine_cache_set($uri, $lastmod, $data) {
	global $wpdb;

	nine_cache_del($uri);

	$wpdb->insert(
		$wpdb->prefix . "nine_cache",
		array(
			'uri' => $uri,
			'lastmod' => $lastmod,
			'content' => $data
		)
	);
}

function nine_cache_del_all() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'nine_cache';
	$sql = "DELETE FROM $table_name";
	$wpdb->query($sql);	
}

function nine_cache_del($uri) {
	global $wpdb;
	$wpdb->delete($wpdb->prefix . "nine_cache", array('uri' => $uri), array('%s'));
}

function nine_cache_get($uri, $lastmod) {
	global $wpdb;

	$table_name = $wpdb->prefix . "nine_cache";
	$sql = "SELECT content, lastmod FROM $table_name WHERE uri = %s";
	$row = $wpdb->get_results($wpdb->prepare($sql, $uri), "ARRAY_A");
	if (!$row)
		return null;

	if ($row[0]['lastmod'] != $lastmod) {
		nine_cache_del($uri);
		return null;
	} else {
		return $row[0];
	}
}

if (get_option('nine_page_cache') == '1') {
	add_action('setup_theme', function() {

		$post_id = url_to_postid($_SERVER['REQUEST_URI']);
		$post = get_post($post_id);

		if ($post && $post->post_type == 'page') {
			$cache = nine_cache_get($_SERVER['REQUEST_URI'], $post->post_modified_gmt);
			if ($cache) {
				$lastmod = gmdate('D, d M Y H:i:s T', strtotime($cache['lastmod']));

				if (@$_SERVER['HTTP_IF_MODIFIED_SINCE'] != '' && @$_SERVER['HTTP_IF_MODIFIED_SINCE'] == $lastmod) {
					header('HTTP/1.1 304 Not Modified');
					exit();
				}

				// 12Hキャッシュ
				if (get_option('nine_html_cache') == '1') {
					$expires = 43200;
					header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
					header('Cache-Control: public, max-age=' . $expires);
				}

				header('Last-Modified: ' . $lastmod);
				echo $cache['content'];
				exit();
			}
		}
	});
}

add_action('save_post', function($post_id) {
	$post = get_post($post_id);
	if ($post->post_type == 'post') {
		nine_cache_del_all();
	}
}, 10, 1);

add_action('delete_post', function($post_id) {
	$post = get_post($post_id);
	if ($post->post_type == 'post') {
		nine_cache_del_all();
	}
}, 10, 1);

add_action('edited_term', function($term_id, $tt_id, $taxonomy) {
	nine_cache_del_all();
}, 10, 3);
