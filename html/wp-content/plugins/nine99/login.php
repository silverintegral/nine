<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// ログインURLの変更
add_action('init', function() {
	$login_path = get_option('nine_login_path');
	if (preg_match('/^[0-9a-zA-Z]+$/', $login_path)) {
		// xmlrpcを無効
		add_filter('xmlrpc_enabled', '__return_false');

		@list($uri, $query) = explode('?', $_SERVER['REQUEST_URI'], 2);

		if (!is_user_logged_in()) {
			if ($uri == '/wp-login.php') {
				header('HTTP/1.1 404 Not Found');
				get_template_part('index', get_post_format());
				exit();
			}
			
			if ($uri == '/' . $login_path) {
				ob_start();
				require_once(ABSPATH . 'wp-login.php');
				$data = ob_get_clean();
				echo str_replace('/wp-login.php', '/' . $login_path, $data);
				exit();
			}
		} else if ($uri == '/' . $login_path) {
			wp_safe_redirect('/wp-admin/');
			exit();
		}
	}
});

// ログアウト後のリダイレクト先変更
add_action('wp_logout', function() {
	$login_path = get_option('nine_login_path');
	if (preg_match('/^[0-9a-zA-Z]+$/', $login_path)) {
		wp_safe_redirect('/' . $login_path);
		exit();
	}
});
