<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://nine.devel.ws/theme.json', __FILE__, 'nine99'
);

if (!defined('N_LAYOUT_PAGE')) define('N_LAYOUT_PAGE', 'title,content');
if (!defined('N_LAYOUT_POST')) define('N_LAYOUT_POST', 'title,content');
if (!defined('N_LAYOUT_LIST')) define('N_LAYOUT_LIST', 'title,content');

// 固定ページでの抜粋を有効にする
add_post_type_support('page','excerpt');

// ショートコードを<p>で囲わない
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 99);
add_filter('the_content', 'shortcode_unautop', 100);
/*add_filter('the_content', function($content) {
	$array = array('<p>[' => '[', ']</p>' => ']', ']<br />' => ']');
	return strtr($content, $array);
});*/

function _nine_after_setup_theme() {
	// メニュー作成画面の初期化
	register_nav_menus(array(
		'global' => 'グローバルナビ',
	));

	add_theme_support('disable-custom-font-sizes');
	add_theme_support('editor-styles');
	add_editor_style(get_template_directory_uri() . '/nine-style.css');
	add_editor_style(get_stylesheet_directory_uri() . '/style.css');

	add_theme_support('align-wide');
	add_theme_support('responsive-embeds');

	// 投稿ページでアイキャッチ画像を有効
	add_theme_support('post-thumbnails');

	// フィードのlink要素を自動出力する
	//add_theme_support('automatic-feed-links');

	// html5対応
	/*
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	// 投稿フォーマット
	add_theme_support(
	'post-formats',
	array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));
	*/
}
add_action('after_setup_theme', '_nine_after_setup_theme');

// サイドバー作成
function _nine_widgets_init() {
	register_sidebar(
		array(
			'name' => 'ページ左',
			'id' => 'sidebar-page-left',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ページ右',
			'id' => 'sidebar-page-right',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ページ上',
			'id' => 'sidebar-page-top',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ページ下',
			'id' => 'sidebar-page-bottom',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ブログ左',
			'id' => 'sidebar-post-left',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ブログ右',
			'id' => 'sidebar-post-right',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ブログ上',
			'id' => 'sidebar-post-top',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'ブログ下',
			'id' => 'sidebar-post-bottom',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'フロント左',
			'id' => 'sidebar-front-left',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'フロント右',
			'id' => 'sidebar-front-right',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'フロント上',
			'id' => 'sidebar-front-top',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'フロント下',
			'id' => 'sidebar-front-bottom',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'その他左',
			'id' => 'sidebar-other-left',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);

	register_sidebar(
		array(
			'name' => 'その他右',
			'id' => 'sidebar-other-right',
			'before_title' => '<div class="widget-title">',
			'after_title' => '</div>',
			'before_widget' => '<div id="%1$s" class="widget-content %2$s">',
			'after_widget' => '</div>',
		)
	);
}
add_action('widgets_init', '_nine_widgets_init');

// カスタムワードウィジェット
class nine_widget_customword extends WP_Widget {
	function __construct() {
		parent::__construct (
			'nine-customword',
			'NINE：カスタムワード',
			array('classname' => 'nine_widget_customword', 'description' => 'TXT/HTML/PHPのカスタムワード。')
		);
	}

	// 描画側
	public function widget($args, $instance) {
		$title = @$instance['title'];
		$word = @$instance['word'];
		$type = @$instance['type'];

		if ($title) {
			echo $args['before_title'];
			echo esc_attr($title);
			echo $args['after_title'];
		}

		echo $args['before_widget'];

		// PHP/HTMLの実行
		if ($type == '1') {
			echo esc_attr($word);
		} else {
			try {
				eval('?>' . do_shortcode($word));
			} catch (Throwable $t) {
				echo "PHPエラーが発生しました。";
			}
		}

		echo $args['after_widget'];
	}

	// 管理画面側
	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$title_id = $this->get_field_id('title');
		$title_name = $this->get_field_name('title');
		$word = !empty($instance['word']) ? $instance['word'] : '';
		$word_id = $this->get_field_id('word');
		$word_name = $this->get_field_name('word');
		$type = !empty($instance['type']) ? $instance['type'] : '';
		$type_id = $this->get_field_id('type');
		$type_name = $this->get_field_name('type');
		?>
		<p>
			<label for="<?php echo $title_id; ?>">タイトル:</label>
			<input class="widefat" id="<?php echo $title_id ?>" name="<?php echo $title_name ?>" type="text" value="<?php echo esc_attr( $title ) ?>">
		</p>
		<p>
			<label for="<?php echo $word_id; ?>">ワード:</label>
			<textarea class="widefat" id="<?php echo $word_id ?>" name="<?php echo $word_name ?>"><?php echo esc_attr( $word ) ?></textarea>
		</p>
		<p>
			<input id="<?php echo esc_attr($type_id) ?>" class="checkbox" name="<?php echo esc_attr($type_name) ?>" type="checkbox" value="1" <?php checked($type, '1') ?> /> 
			<label for="<?php echo esc_attr($type_id) ?>">プレーンテキスト</label> 
		</p>
		<?php
	}

	// 新しい設定データの適正チェック
	function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = !empty($new_instance['title']) ? trim($new_instance['title']) : '';
		$instance['word'] = !empty($new_instance['word']) ? trim($new_instance['word']) : '';
		$instance['type'] = !empty($new_instance['type']) ? $new_instance['type'] : '';
		return $instance;
	}
}

// PHPインクルードウィジェット
class nine_widget_include extends WP_Widget {
	function __construct() {
		parent::__construct (
			'nine-include',
			'NINE：PHPインクルード',
			array('classname' => 'nine_widget_include', 'description' => 'サーバー内のPHPファイルのechoを表示。')
		);
	}

	// 描画側
	public function widget($args, $instance) {
		$path = @$instance['path'];
		$once = @$instance['once'];
		if (!$path)
			return;

		if ($once == '1')
			@include_once(__DIR__ . '/../../../' . $path);
		else
			@include(__DIR__ . '/../../../' . $path);
	}

	// 管理画面側
	public function form($instance) {
		$path = !empty($instance['path']) ? $instance['path'] : '';
		$path_id = $this->get_field_id('path');
		$path_name = $this->get_field_name('path');
		$once = !empty($instance['once']) ? $instance['once'] : '';
		$once_id = $this->get_field_id('once');
		$once_name = $this->get_field_name('once');
		?>
		<p>
			<label for="<?php echo $path_id; ?>">パス（WPルートからの相対）:</label>
			<input class="widefat" id="<?php echo $path_id ?>" name="<?php echo $path_name ?>" type="text" value="<?php echo esc_attr( $path ) ?>">
		</p>
		<p>
			<input id="<?php echo esc_attr($once_id) ?>" class="checkbox" name="<?php echo esc_attr($once_name) ?>" type="checkbox" value="1" <?php checked($once, '1') ?> /> 
			<label for="<?php echo esc_attr($once_id) ?>">１度しか読み込まない</label>
		</p>
		<?php
	}

	// 新しい設定データの妥当性チェック
	// HACK:エラーはどうやって出す？
	function update($new_instance, $old_instance) {
		$instance = array();
		$instance['path'] = !empty($new_instance['path']) ? trim($new_instance['path']) : '';
		$instance['once'] = !empty($new_instance['once']) ? trim($new_instance['once']) : '';
		return $instance;
	}
}

// 固定記事挿入ウィジェット
class nine_widget_embed extends WP_Widget {
	function __construct() {
		parent::__construct (
			'nine-embed',
			'NINE：ページ埋め込み',
			array('classname' => 'nine_widget_embed', 'description' => '指定された固定ページの記事部分を埋め込む。')
		);
	}

	public function widget($args, $instance) {
		$path = @$instance['path'];
		
		if (!$path) {
			//echo 'ERROR';
			return;
		}

		$id = get_page_by_path($path);
		if (!$id) {
			echo 'NOT FOUND';
			return;
		}

		echo do_shortcode(get_post($id)->post_content);
	}

	public function form($instance) {
		$path = !empty($instance['path']) ? $instance['path'] : '';
		$path_id = $this->get_field_id('path');
		$path_name = $this->get_field_name('path');
		?>
		<p>
			<label for="<?php echo $path_id; ?>">スラッグ:</label>
			<input class="widefat" id="<?php echo $path_id ?>" name="<?php echo $path_name ?>" type="text" value="<?php echo esc_attr($path) ?>">
		</p>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = array();
		$instance['path'] = !empty($new_instance['path']) ? trim($new_instance['path'], ' /') : '';
		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('nine_widget_customword');
	register_widget('nine_widget_include');
	register_widget('nine_widget_embed');
});

// PHPショートコード
add_shortcode('php', function($atts) {
	ob_start();
	@eval(implode(' ', $atts));
	return ob_get_clean();
});

// script includeショートコード
add_shortcode('js', function($atts) {
	if ($atts[0][0] != '/')
		$atts[0] = '/' . $atts[0];

	wp_enqueue_script('nine-seo', $atts[0], array(), null, true);
	return '';
});

// style includeショートコード
add_shortcode('css', function($atts) {
	if ($atts[0][0] != '/')
		$atts[0] = '/' . $atts[0];

	wp_enqueue_style('nine-seo', $atts[0], array(), null);
	return '';
});

// 外部 includeショートコード
add_shortcode('inc', function($atts) {
	return @file_get_contents($atts[0]);
});

// titleの内容
function _nine_wp_title($title) {
	if (is_front_page() && is_home()) {
		return get_bloginfo('name');
	} else {
		return $title . '｜' . get_bloginfo('name');
	}
}
add_filter('wp_title', '_nine_wp_title');

// WPのヘッダー内のCSSとJSの出力を調整
function _nine_wp_enqueue_scripts() {
	wp_enqueue_style('nine', get_template_directory_uri() . '/nine-style.css', array(), null);
	wp_enqueue_script('nine', get_template_directory_uri() . '/script.js', array(), null, true);
	wp_enqueue_style('nine-child', get_stylesheet_directory_uri() . '/style.css', array('nine'), null);
	wp_enqueue_script('nine-child', get_stylesheet_directory_uri() . '/script.js', array('nine'), null, true);
}
add_action('wp_enqueue_scripts', '_nine_wp_enqueue_scripts');

function get_val($key, $def = null) {
	if (defined('N_' . $key) && constant('N_' . $key) !== null)
		return constant('N_' . $key);
	else
		return $def;
}
