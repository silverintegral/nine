<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// pwa処理
// ampページ表示中は無効
if (get_option('nine_use_pwa') == '1') {
	add_action('wp_head', '_nine_pwa_init', 999);
	function _nine_pwa_init () {
		global $post;
		if (get_post_meta($post->ID, 'nine_dis_pwa', true) == '1')
			return;

		// amp出力の際は無効
		if (get_option('nine_use_amp') == '1' && get_post_meta($post->ID, 'nine_dis_amp', true) != '1' && @$_GET['amp'] != '')
			return;

		// アイコンがない
		if ((get_option('nine_favicon_2_url') == '' || get_option('nine_favicon_3_url') == '') && get_site_icon_url() == '')
			return;

		// iOS
		echo "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />\r\n";
		echo "<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"" . get_option('nine_pwa_bgcolor_iphone') . "\" />\r\n";
		echo "<meta name=\"apple-mobile-web-app-title\" content=\"" . get_bloginfo('name') . "\" />\r\n";

		// Android
		$script_data = <<<HTML
<script type="text/javascript">
if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/pwa/sw.js')
	.then(function (registration) {
		if (typeof registration.update == 'function') {
			registration.update();
		}
	})
	.catch(function (error) {
	//console.log("Error Log: " + error);
	});
}
</script>

HTML;
		echo "<link rel=\"manifest\" href=\"/pwa/manifest.json\" />\r\n";
		echo $script_data;
	}

	// android用ファイル出力
	add_filter('plugins_loaded', '_nine_pwa_android');
	function _nine_pwa_android() {
		if ($_SERVER["REQUEST_URI"] == '/pwa/manifest.json') {
			// 12Hキャッシュ
			if (get_option('nine_html_cache') == '1') {
				$expires = 43200;
				header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
				header('Cache-Control: public, max-age=' . $expires);
			}

			if (get_option('nine_favicon_2_url') == '')
				$icon1 = get_site_icon_url(192);
			else
				$icon1 = get_option('nine_favicon_2_url');

			if (get_option('nine_favicon_3_url') == '')
				$icon2 = get_site_icon_url(512);
			else
				$icon2 = get_option('nine_favicon_3_url');

			$name = get_bloginfo('name');
			$url = get_home_url();
			$color = get_option('nine_pwa_bgcolor_android');
	
			header('Content-type: application/json; charset=utf-8');
			$json_data = <<<JSON
{
"name":"{$name}",
"short_name":"{$name}",
"icons": [{
	"src": "{$icon1}",
	"sizes": "192x192",
	"type": "image/png"
}, {
	"src": "{$icon2}",
	"sizes": "512x512",
	"type": "image/png"
}],
	"start_url": "{$url}",
	"display": "standalone",
	"background_color": "{$color}",
	"theme_color": "{$color}"
}
JSON;
			echo $json_data;
			exit();
		} else if ($_SERVER["REQUEST_URI"] == '/pwa/sw.js') {
			// 12Hキャッシュ
			if (get_option('nine_html_cache') == '1') {
				$expires = 43200;
				header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
				header('Cache-Control: public, max-age=' . $expires);
			}

			$name = get_bloginfo('name');

			$urls = array("'" . get_home_url() . "'");
			$query = new WP_Query('post_type=page&posts_per_page=-1&post_status=publish');
			foreach($query->posts as $post) {
				$urls[] = "'" . get_home_url() . '/' . $post->post_name . "/'";
			}
			$urls = implode(",\n", $urls);

			$script_data = <<<JAVASCRIPT
var CACHE_NAME  = "{$name}-v1";
var urlsToCache = [
{$urls}
];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(
            function(cache){
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request)
        .then(
        function (response) {
            if (response) {
                return response;
            }
            return fetch(event.request);
        })
    );
});
JAVASCRIPT;
			header('Content-type: text/javascript; charset=utf-8');
			echo $script_data;
			exit();
		}
	}
}

/*
function _nine_content_save_pre($content) {
	return $content;
}
if (isset($_GET['amp']) && get_option('nine_use_amp') == '1') {
	add_filter('content_save_pre', '_nine_content_save_pre', 99, 1);
}
*/
