<?php
// WP用
$content_width = 1300;

// ページ構成の設定
// 以下から必要なパーツを好きな順番に並べる
// title,date,category,tag,content,link,edit
define('N_LAYOUT_PAGE', 'title,content');
define('N_LAYOUT_POST', 'title,date,category,tag,content');
define('N_LAYOUT_LIST', 'date,title,content');

// ページ内ラベル表記
define('N_TEXT_LABEL_DATE', null);
define('N_TEXT_LABEL_TAG', null);
define('N_TEXT_LABEL_CATEGORY', null);
define('N_TEXT_LINK_EDIT', null);
define('N_TEXT_LINK_MORE', null);
define('N_TEXT_LINK_PREV', null);
define('N_TEXT_LINK_NEXT', null);

// 利用するサイドバー
define('N_SIDEBAR_LEFT', true);
define('N_SIDEBAR_RIGHT', true);
define('N_SIDEBAR_TOP', true);
define('N_SIDEBAR_BOTTOM', true);

// 自動レイアウトCSS作成の設定（※モバイルファースト）
// 全て整数で指定する（ほぼpx）
define('N_PC_MIN_WIDTH', 769);						// PCブレークポイント、769推奨
define('N_PC_BODY_MAX_WIDTH', 1360);				// コンテンツ部分とサイドバーのエリアの最大幅（px指定、最大100%まで）
define('N_PC_HEADER_MAX_WIDTH', 1360);				// ヘッダーの最大幅（px指定、最大100%まで）
define('N_PC_FOOTER_MAX_WIDTH', 1360);				// フッターの最大幅（px指定、最大100%まで）
define('N_PC_CONTENT_MARGIN_LEFT', 0);
define('N_PC_CONTENT_MARGIN_RIGHT', 0);
define('N_PC_CONTENT_MARGIN_TOP', 20);
define('N_PC_CONTENT_MARGIN_BOTTOM', 0);
define('N_PC_SIDEBAR_LEFT_WIDTH', 180);				// 左サイドバーのサイズ、0で非表示（表示設定してもウィジェットが無いなら表示されない）
define('N_PC_SIDEBAR_LEFT_MARGIN_TOP', 20);
define('N_PC_SIDEBAR_LEFT_MARGIN_BOTTOM', 20);
define('N_PC_SIDEBAR_RIGHT_WIDTH', 180);			// 右サイドバーのサイズ、0で非表示（表示設定してもウィジェットが無いなら表示されない）
define('N_PC_SIDEBAR_RIGHT_MARGIN_TOP', 20);
define('N_PC_SIDEBAR_RIGHT_MARGIN_BOTTOM', 20);
define('N_PC_SIDEBAR_TOP_WIDTH', 1200);				// 上サイドバーのサイズ、0で非表示（表示設定してもウィジェットが無いなら表示されない）
define('N_PC_SIDEBAR_TOP_MARGIN_TOP', 20);
define('N_PC_SIDEBAR_BOTTOM_WIDTH', 1200);			// 下サイドバーのサイズ、0で非表示（表示設定してもウィジェットが無いなら表示されない）
define('N_PC_SIDEBAR_BOTTOM_MARGIN_BOTTOM', 20);

define('N_TAB_MIN_WIDTH', 0);						// タブレットブレークポイント、0で未使用、481推奨
define('N_TAB_HEADER_MAX_WIDTH', 481);
define('N_TAB_FOOTER_MAX_WIDTH', 481);
define('N_TAB_CONTENT_MARGIN_LEFT', 20);
define('N_TAB_CONTENT_MARGIN_RIGHT', 20);
define('N_TAB_CONTENT_MARGIN_TOP', 20);
define('N_TAB_CONTENT_MARGIN_BOTTOM', 20);
define('N_TAB_SIDEBAR_LEFT_WIDTH', 0);
define('N_TAB_SIDEBAR_LEFT_MARGIN_TOP', 0);
define('N_TAB_SIDEBAR_LEFT_MARGIN_BOTTOM', 20);
define('N_TAB_SIDEBAR_RIGHT_WIDTH', 180);
define('N_TAB_SIDEBAR_RIGHT_MARGIN_TOP', 20);
define('N_TAB_SIDEBAR_RIGHT_MARGIN_BOTTOM', 20);
define('N_TAB_SIDEBAR_TOP_WIDTH', 0);
define('N_TAB_SIDEBAR_TOP_MARGIN_TOP', 0);
define('N_TAB_SIDEBAR_BOTTOM_WIDTH', 0);
define('N_TAB_SIDEBAR_BOTTOM_MARGIN_TOP', 0);

define('N_SP_MIN_WIDTH', 1);						// スマホブレークポイント、通常は1、0で未使用
define('N_SP_CONTENT_MARGIN_TOP', 10);
define('N_SP_SIDEBAR_LEFT_USE', 0);					// 0=左サイドバー非表示、1=左サイドバー表示（実際はコンテンツの下に表示される）
define('N_SP_SIDEBAR_LEFT_MARGIN_TOP', 10);
define('N_SP_SIDEBAR_RIGHT_USE', 0);				// 0=右サイドバー非表示、1=右サイドバー表示（実際はコンテンツの下に表示される）
define('N_SP_SIDEBAR_RIGHT_MARGIN_TOP', 10);
define('N_SP_SIDEBAR_TOP_MARGIN_TOP', 10);
define('N_SP_SIDEBAR_BOTTOM_MARGIN_TOP', 10);

add_action('admin_menu', function() {
	global $menu;
	$menu[19] = $menu[10]; // メディア移動
	unset($menu[10]);
	//unset($menu[5]); // 通常を削除
});

add_action('init', function() {
	register_post_type(
		'news', array(
			'labels' => array(
				'name' => '新着情報',
				'add_new_item' => '新着情報の作成',
				'edit_item' => '新着情報の編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 11,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'event', array(
			'labels' => array(
				'name' => 'イベント情報',
				'add_new_item' => 'イベント情報の作成',
				'edit_item' => 'イベント情報の編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 12,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'house', array(
			'labels' => array(
				'name' => 'ショールーム',
				'add_new_item' => 'ショールーム・モデルハウスの作成',
				'edit_item' => 'ショールーム・モデルハウスの編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 13,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'sekou', array(
			'labels' => array(
				'name' => '施工事例',
				'add_new_item' => '施工事例の作成',
				'edit_item' => '施工事例の編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 14,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'staff', array(
			'labels' => array(
				'name' => 'スタッフ',
				'add_new_item' => 'スタッフの作成',
				'edit_item' => 'スタッフの編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 15,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'column', array(
			'labels' => array(
				'name' => '家づくりコラム',
				'add_new_item' => '家づくりコラムの作成',
				'edit_item' => '家づくりコラムの編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 16,
			'rewrite' => array('with_front' => false),
		)
	);
	register_post_type(
		'blog', array(
			'labels' => array(
				'name' => 'スタッフブログ',
				'add_new_item' => 'スタッフブログの作成',
				'edit_item' => 'スタッフブログの編集',
			),
			'public' => true, 'hierarchical' => true, 'has_archive' => true, 'supports' => array(
				'title', 'editor', 'thumbnail',
			),
			'menu_position' => 17,
			'rewrite' => array('with_front' => false),
		)
	);
});
