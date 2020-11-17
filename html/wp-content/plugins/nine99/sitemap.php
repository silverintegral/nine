<?php /*
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// ユーザー別サイトマップを隠す
add_filter('wp_sitemaps_add_provider', function($provider, $name) {
	if ('posts' == $name) {
		return $provider;
	}
}, 10, 2);

// 出力するサイトマップをpostとpageだけにする
add_filter('wp_sitemaps_taxonomies', function($taxonomies){ 
	unset($taxonomies['category']);
	unset($taxonomies['post_tag']);
	unset($taxonomies['post_format']);
	return $taxonomies;
});

// 最終更新日と優先度を追加
add_filter('wp_sitemaps_posts_entry', function($entry, $post) {
	$entry['lastmod'] = get_the_modified_time('c', $post);
	$entry['priority'] = '1.0';
	return $entry;
}, 10, 2);

// サイトマップからの除外設定
add_filter('wp_sitemaps_posts_query_args', function($args) {
	$args['meta_query'] = array(array('key' => 'nine_dis_sitemap', 'value' => '1', 'compare' => 'NOT EXISTS'));
	return $args;
});

if (get_option('nine_use_sitemap') == '') {
	// 標準サイトマップを無効にする
	add_filter('wp_sitemaps_enabled', '__return_false');
}
