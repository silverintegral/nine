<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function nine_create_style() {
	// PC用設定
	$pc_min_width = get_val('PC_MIN_WIDTH', 769);
	$pc_body_width = get_val('PC_BODY_MAX_WIDTH', get_val('PC_MIN_WIDTH', 1024));
	$pc_header_width = get_val('PC_HEADER_MAX_WIDTH', get_val('PC_MIN_WIDTH', 1024));
	$pc_footer_width = get_val('PC_FOOTER_MAX_WIDTH', get_val('PC_MIN_WIDTH', 1024));
	$pc_content_margin_left = get_val('PC_CONTENT_MARGIN_LEFT', 20);
	$pc_content_margin_right = get_val('PC_CONTENT_MARGIN_RIGHT', 20);
	$pc_content_margin_top = get_val('PC_CONTENT_MARGIN_TOP', 20);
	$pc_content_margin_bottom = get_val('PC_CONTENT_MARGIN_BOTTOM', 20);
	$pc_sidebar_left_width = get_val('PC_SIDEBAR_LEFT_WIDTH', 200);
	$pc_sidebar_left_margin_top = get_val('PC_SIDEBAR_LEFT_MARGIN_TOP', 20);
	$pc_sidebar_left_margin_bottom = get_val('PC_SIDEBAR_LEFT_MARGIN_BOTTOM', 20);
	$pc_sidebar_right_width = get_val('PC_SIDEBAR_RIGHT_WIDTH', 200);
	$pc_sidebar_right_margin_top = get_val('PC_SIDEBAR_RIGHT_MARGIN_TOP', 20);
	$pc_sidebar_right_margin_bottom = get_val('PC_SIDEBAR_RIGHT_MARGIN_BOTTOM', 20);
	$pc_sidebar_top_width = get_val('PC_SIDEBAR_TOP_WIDTH', 0);
	$pc_sidebar_top_margin_top = get_val('PC_SIDEBAR_TOP_MARGIN_TOP', 20);
	$pc_sidebar_bottom_width = get_val('PC_SIDEBAR_BOTTOM_WIDTH', 0);
	$pc_sidebar_bottom_margin_bottom = get_val('PC_SIDEBAR_BOTTOM_MARGIN_BOTTOM', 20);

	// PC版サイドバーの表示非表示
	$pc_sidebar_page_left_display = $pc_sidebar_post_left_display = $pc_sidebar_front_left_display = $pc_sidebar_other_left_display = $pc_sidebar_left_width == 0 ? 'none' : 'block';
	$pc_sidebar_page_right_display = $pc_sidebar_post_right_display = $pc_sidebar_front_right_display = $pc_sidebar_other_right_display = $pc_sidebar_right_width == 0 ? 'none' : 'block';
	$pc_sidebar_page_top_display = $pc_sidebar_post_top_display = $pc_sidebar_front_top_display = $pc_sidebar_top_width == 0 ? 'none' : 'block';
	$pc_sidebar_page_bottom_display = $pc_sidebar_post_bottom_display = $pc_sidebar_front_bottom_display = $pc_sidebar_bottom_width == 0 ? 'none' : 'block';

	if ($pc_min_width == 0) {
		// PC版を利用しない
		$pc_min_width = 10000;
	}

	// タブレット用設定
	$tab_min_width = get_val('TAB_MIN_WIDTH', 481);
	$tab_header_width = get_val('TAB_HEADER_MAX_WIDTH', get_val('TAB_MIN_WIDTH', 769));
	$tab_footer_width = get_val('TAB_FOOTER_MAX_WIDTH', get_val('TAB_MIN_WIDTH', 769));
	$tab_content_margin_left = get_val('TAB_CONTENT_MARGIN_LEFT', 20);
	$tab_content_margin_right = get_val('TAB_CONTENT_MARGIN_RIGHT', 20);
	$tab_content_margin_top = get_val('TAB_CONTENT_MARGIN_TOP', 20);
	$tab_content_margin_bottom = get_val('TAB_CONTENT_MARGIN_BOTTOM', 20);
	$tab_sidebar_left_width = get_val('TAB_SIDEBAR_LEFT_WIDTH', 0);
	$tab_sidebar_left_margin_top = get_val('TAB_SIDEBAR_LEFT_MARGIN_TOP', 20);
	$tab_sidebar_left_margin_bottom = get_val('TAB_SIDEBAR_LEFT_MARGIN_BOTTOM', 20);
	$tab_sidebar_right_width = get_val('TAB_SIDEBAR_RIGHT_WIDTH', 300);
	$tab_sidebar_right_margin_top = get_val('TAB_SIDEBAR_RIGHT_MARGIN_TOP', 20);
	$tab_sidebar_right_margin_bottom = get_val('TAB_SIDEBAR_RIGHT_MARGIN_BOTTOM', 20);
	$tab_sidebar_top_width = get_val('TAB_SIDEBAR_TOP_WIDTH', 0);
	$tab_sidebar_top_margin_top = get_val('TAB_SIDEBAR_TOP_MARGIN_TOP', 20);
	$tab_sidebar_bottom_width = get_val('TAB_SIDEBAR_BOTTOM_WIDTH', 0);
	$tab_sidebar_bottom_margin_bottom = get_val('TAB_SIDEBAR_BOTTOM_MARGIN_BOTTOM', 20);

	// タブレット版サイドバーの表示非表示
	$tab_sidebar_page_left_display = $tab_sidebar_post_left_display = $tab_sidebar_front_left_display = $tab_sidebar_other_left_display = $tab_sidebar_left_width == 0 ? 'none' : 'block';
	$tab_sidebar_page_right_display = $tab_sidebar_post_right_display = $tab_sidebar_front_right_display = $tab_sidebar_other_right_display = $tab_sidebar_right_width == 0 ? 'none' : 'block';
	$tab_sidebar_page_top_display = $tab_sidebar_post_top_display = $tab_sidebar_front_top_display = $tab_sidebar_top_width == 0 ? 'none' : 'block';
	$tab_sidebar_page_bottom_display = $tab_sidebar_post_bottom_display = $tab_sidebar_front_bottom_display = $tab_sidebar_bottom_width == 0 ? 'none' : 'block';

	if ($tab_min_width == 0) {
		// タブレット版を使用しない
		$tab_min_width = $pc_min_width;
	}

	// スマホ用設定
	$sp_min_width = get_val('SP_MIN_WIDTH', 1);
	$sp_content_margin_top = get_val('SP_CONTENT_MARGIN_TOP', 10);
	$sp_sidebar_left_use = get_val('SP_SIDEBAR_LEFT_USE', 0);
	$sp_sidebar_left_margin_top = get_val('SP_SIDEBAR_LEFT_MARGIN_TOP', 0);
	$sp_sidebar_right_use = get_val('SP_SIDEBAR_RIGHT_USE', 0);
	$sp_sidebar_right_margin_top = get_val('SP_SIDEBAR_RIGHT_MARGIN_TOP', 10);
	$sp_sidebar_top_margin_top = get_val('SP_SIDEBAR_TOP_MARGIN_TOP', 10);
	$sp_sidebar_bottom_margin_top = get_val('SP_SIDEBAR_BOTTOM_MARGIN_TOP', 10);
	$sp_sidebar_top_width = get_val('SP_SIDEBAR_TOP_WIDTH', 0);
	$sp_sidebar_top_margin_top = get_val('SP_SIDEBAR_TOP_MARGIN_TOP', 20);
	$sp_sidebar_bottom_width = get_val('SP_SIDEBAR_BOTTOM_WIDTH', 0);
	$sp_sidebar_bottom_margin_bottom = get_val('SP_SIDEBAR_BOTTOM_MARGIN_BOTTOM', 20);

	// スマホ版サイドバーの表示非表示
	$sp_sidebar_page_left_display = $sp_sidebar_post_left_display = $sp_sidebar_front_left_display = $sp_sidebar_other_left_display = $sp_sidebar_left_use == 0 ? 'none' : 'block';
	$sp_sidebar_page_right_display = $sp_sidebar_post_right_display = $sp_sidebar_front_right_display = $sp_sidebar_other_right_display = $sp_sidebar_right_use == 0 ? 'none' : 'block';
	$sp_sidebar_page_top_display = $sp_sidebar_post_top_display = $sp_sidebar_front_top_display = $sp_sidebar_top_width == 0 ? 'none' : 'block';
	$sp_sidebar_page_bottom_display = $sp_sidebar_post_bottom_display = $sp_sidebar_front_bottom_display = $sp_sidebar_bottom_width == 0 ? 'none' : 'block';

	if ($tab_min_width == 0) {
		// スマホ版を使用しない
		$sp_min_width = $tab_min_width;
	}

	if (!is_active_sidebar('sidebar-page-left')) {
		// 固定ページサイドバー左が利用されていない
		$sp_sidebar_page_left_display = 'none';
		$tab_sidebar_page_left_display = 'none';
		$pc_sidebar_page_left_display = 'none';
	}

	if (!is_active_sidebar('sidebar-page-right')) {
		// 固定ページサイドバー右が利用されていない
		$sp_sidebar_page_right_display = 'none';
		$tab_sidebar_page_right_display = 'none';
		$pc_sidebar_page_right_display = 'none';
	}

	if (!is_active_sidebar('sidebar-post-left')) {
		// 投稿サイドバー左が利用されていない
		$sp_sidebar_post_left_display = 'none';
		$tab_sidebar_post_left_display = 'none';
		$pc_sidebar_post_left_display = 'none';
	}

	if (!is_active_sidebar('sidebar-post-right')) {
		// 投稿サイドバー右が利用されていない
		$sp_sidebar_post_right_display = 'none';
		$tab_sidebar_post_right_display = 'none';
		$pc_sidebar_post_right_display = 'none';
	}

	if (!is_active_sidebar('sidebar-front-left')) {
		// フロントページサイドバー左が利用されていない
		$sp_sidebar_front_left_display = 'none';
		$tab_sidebar_front_left_display = 'none';
		$pc_sidebar_front_left_display = 'none';
	}

	if (!is_active_sidebar('sidebar-front-right')) {
		// フロントページその他サイドバー右が利用されていない
		$sp_sidebar_front_right_display = 'none';
		$tab_sidebar_front_right_display = 'none';
		$pc_sidebar_front_right_display = 'none';
	}

	if (!is_active_sidebar('sidebar-other-left')) {
		// その他サイドバー左が利用されていない
		$sp_sidebar_other_left_display = 'none';
		$tab_sidebar_other_left_display = 'none';
		$pc_sidebar_other_left_display = 'none';
	}

	if (!is_active_sidebar('sidebar-other-right')) {
		// その他サイドバー右が利用されていない
		$sp_sidebar_other_right_display = 'none';
		$tab_sidebar_other_right_display = 'none';
		$pc_sidebar_other_right_display = 'none';
	}

	if (!is_active_sidebar('sidebar-page-top')) {
		// 固定ページサイドバー上が利用されていない
		$sp_sidebar_page_top_display = 'none';
		$tab_sidebar_page_top_display = 'none';
		$pc_sidebar_page_top_display = 'none';
	}

	if (!is_active_sidebar('sidebar-page-bottom')) {
		// 固定ページサイドバー下が利用されていない
		$sp_sidebar_page_bottom_display = 'none';
		$tab_sidebar_page_bottom_display = 'none';
		$pc_sidebar_page_bottom_display = 'none';
	}

	if (!is_active_sidebar('sidebar-post-top')) {
		// 投稿サイドバー上が利用されていない
		$sp_sidebar_post_top_display = 'none';
		$tab_sidebar_post_top_display = 'none';
		$pc_sidebar_post_top_display = 'none';
	}

	if (!is_active_sidebar('sidebar-post-bottom')) {
		// 投稿サイドバー下が利用されていない
		$sp_sidebar_post_bottom_display = 'none';
		$tab_sidebar_post_bottom_display = 'none';
		$pc_sidebar_post_bottom_display = 'none';
	}

	if (!is_active_sidebar('sidebar-front-top')) {
		// フロントページサイドバー上が利用されていない
		$sp_sidebar_front_top_display = 'none';
		$tab_sidebar_front_top_display = 'none';
		$pc_sidebar_front_top_display = 'none';
	}

	if (!is_active_sidebar('sidebar-front-bottom')) {
		// フロントページサイドバー下が利用されていない
		$sp_sidebar_front_bottom_display = 'none';
		$tab_sidebar_front_bottom_display = 'none';
		$pc_sidebar_front_bottom_display = 'none';
	}

	$editor_width = 1280 + 30; // margin:15x2

	$css = <<<CSS
/* RESET */
* {
	box-sizing: border-box;
	letter-spacing: normal;
}

html, body {
	color: black;
	background-color: white;
	margin: 0;
	padding: 0;
	border: none;
}

h1,
h2,
h3,
h4,
h5,
h6,
p,
blockquote,
address,
big,
cite,
code,
em,
font,
img,
small,
strike,
sub,
sup,
li,
ol,
ul,
fieldset,
form,
label,
legend,
button,
table,
caption,
tr,
th,
td {
	border: none;
	font-size: inherit;
	line-height: inherit;
	margin: 0;
	padding: 0;
	text-align: inherit;
}

/* WP */
.size-auto, 
.size-full,
.size-large,
.size-medium,
.size-thumbnail {
	max-width: 100%;
	height: auto;
}

/* EDITOR */
.wp-block {
    width: 100%;
    max-width: {$editor_width}px;
}

/* ALL */
img {
	max-width: 100%;
	height: auto;
}

#nav-global {
	overflow: hidden;
}

#nav-global .menu {
	width: 100%;
}

#nav-global li {
	list-style: none;
	float: left;
}

#nav-global li a {
	text-decoration: none;
}

.data-category li {
	list-style: none;
}

.data-tag li {
	list-style: none;
}

#widget-page-left li,
#widget-page-right li,
#widget-post-left li,
#widget-post-right li,
#widget-front-left li,
#widget-front-right li,
#widget-other-left li,
#widget-other-right li,
#widget-page-top li,
#widget-page-bottom li,
#widget-post-top li,
#widget-post-bottom li,
#widget-front-top li,
#widget-front-bottom li {
	list-style: none;
}

/** SP **/
@media only screen and (min-width: {$sp_min_width}px) {
	body {
		letter-spacing: -1em;
	}

	#header {
		width: 100%;
	}

	#body {
		width: 100%;
		margin: 0;
		vertical-align: top;
		letter-spacing: normal;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: -o-flex;
		display: flex;
		flex-flow: column wrap;
	}

	#footer {
		width: 100%;
	}

	#content {
		margin-top: {$sp_content_margin_top}px;
		order:-1;
	}

	#catch {
		width: 100%;
		height :auto;
		margin-bottom: {$sp_content_margin_top}px;
	}

	#widget-page-left {
		width: 100%;
		margin-top: {$sp_sidebar_left_margin_top}px;
		display: {$sp_sidebar_page_left_display};
		order: 2;
	}

	#widget-page-right {
		width: 100%;
		margin-top: {$sp_sidebar_right_margin_top}px;
		display: {$sp_sidebar_page_right_display};
		order: 3;
	}

	#widget-post-left {
		width: 100%;
		margin-top: {$sp_sidebar_left_margin_top}px;
		display: {$sp_sidebar_post_left_display};
		order: 2;
	}

	#widget-post-right {
		width: 100%;
		margin-top: {$sp_sidebar_right_margin_top}px;
		display: {$sp_sidebar_post_right_display};
		order: 3;
	}

	#widget-front-left {
		width: 100%;
		margin-top: {$sp_sidebar_left_margin_top}px;
		display: {$sp_sidebar_front_left_display};
		order: 2;
	}

	#widget-front-right {
		width: 100%;
		margin-top: {$sp_sidebar_right_margin_top}px;
		display: {$sp_sidebar_front_right_display};
		order: 3;
	}

	#widget-other-left {
		width: 100%;
		margin-top: {$sp_sidebar_left_margin_top}px;
		display: {$sp_sidebar_other_left_display};
		order: 2;
	}

	#widget-other-right {
		width: 100%;
		margin-top: {$sp_sidebar_right_margin_top}px;
		display: {$sp_sidebar_other_right_display};
		order: 3;
	}

	#widget-page-top {
		width: {$sp_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$sp_sidebar_top_margin_top}px;
		display: {$sp_sidebar_page_top_display};
	}

	#widget-page-bottom {
		width: {$sp_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$sp_sidebar_bottom_margin_bottom}px auto;
		display: {$sp_sidebar_page_bottom_display};
	}

	#widget-post-top {
		width: {$sp_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$sp_sidebar_top_margin_top}px;
		display: {$sp_sidebar_post_top_display};
	}

	#widget-post-bottom {
		width: {$sp_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$sp_sidebar_bottom_margin_bottom}px auto;
		display: {$sp_sidebar_post_bottom_display};
	}

	#widget-front-top {
		width: {$sp_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$sp_sidebar_top_margin_top}px;
		display: {$sp_sidebar_front_top_display};
	}

	#widget-front-bottom {
		width: {$sp_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$sp_sidebar_bottom_margin_bottom}px auto;
		display: {$sp_sidebar_front_bottom_display};
	}
}

/** TAB **/
@media only screen and (min-width: {$tab_min_width}px) {
	body {
	}

	#header {
		width: 100%;
	}

	#body {
		width: 100%;
		display: flex;
		flex-flow: inherit;
		margin: auto;
	}
	
	#footer {
		width: 100%;
	}

	#content {
		margin-top: {$tab_content_margin_top}px;
		margin-bottom: {$tab_content_margin_bottom}px;
		display: inline-block;
		order: 2;
		flex: 1;
	}

	#catch {
		margin-bottom: {$tab_content_margin_top}px;
		display: inline-block;
	}

	#widget-page-left {
		width: {$tab_sidebar_left_width}px;
		margin-top: {$tab_sidebar_left_margin_top}px;
		margin-bottom: {$tab_sidebar_left_margin_bottom}px;
		margin-right: {$tab_content_margin_right}px;
		display: {$tab_sidebar_page_left_display};
		order: 1;
	}

	#widget-page-right {
		width: {$tab_sidebar_right_width}px;
		margin-top: {$tab_sidebar_right_margin_top}px;
		margin-bottom: {$tab_sidebar_right_margin_bottom}px;
		margin-left: {$tab_content_margin_left}px;
		display: {$tab_sidebar_page_right_display};
		order: 3;
	}

	#widget-post-left {
		width: {$tab_sidebar_left_width}px;
		margin-top: {$tab_sidebar_left_margin_top}px;
		margin-bottom: {$tab_sidebar_left_margin_bottom}px;
		margin-right: {$tab_content_margin_right}px;
		display: {$tab_sidebar_post_left_display};
		order: 1;
	}

	#widget-post-right {
		width: {$tab_sidebar_right_width}px;
		margin-top: {$tab_sidebar_right_margin_top}px;
		margin-bottom: {$tab_sidebar_right_margin_bottom}px;
		margin-left: {$tab_content_margin_left}px;
		display: {$tab_sidebar_post_right_display};
		order: 3;
	}

	#widget-front-left {
		width: {$tab_sidebar_left_width}px;
		margin-top: {$tab_sidebar_left_margin_top}px;
		margin-bottom: {$tab_sidebar_left_margin_bottom}px;
		margin-right: {$tab_content_margin_right}px;
		display: {$tab_sidebar_front_left_display};
		order: 1;
	}

	#widget-front-right {
		width: {$tab_sidebar_right_width}px;
		margin-top: {$tab_sidebar_right_margin_top}px;
		margin-bottom: {$tab_sidebar_right_margin_bottom}px;
		margin-left: {$tab_content_margin_left}px;
		display: {$tab_sidebar_front_right_display};
		order: 3;
	}

	#widget-other-left {
		width: {$tab_sidebar_left_width}px;
		margin-top: {$tab_sidebar_left_margin_top}px;
		margin-bottom: {$tab_sidebar_left_margin_bottom}px;
		margin-right: {$tab_content_margin_right}px;
		display: {$tab_sidebar_other_left_display};
		order: 1;
	}

	#widget-other-right {
		width: {$tab_sidebar_right_width}px;
		margin-top: {$tab_sidebar_right_margin_top}px;
		margin-bottom: {$tab_sidebar_right_margin_bottom}px;
		margin-left: {$tab_content_margin_left}px;
		display: {$tab_sidebar_other_right_display};
		order: 3;
	}

	#widget-page-top {
		width: {$tab_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$tab_sidebar_top_margin_top}px;
		display: {$tab_sidebar_page_top_display};
	}

	#widget-page-bottom {
		width: {$tab_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$tab_sidebar_bottom_margin_bottom}px auto;
		display: {$tab_sidebar_page_bottom_display};
	}

	#widget-post-top {
		width: {$tab_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$tab_sidebar_top_margin_top}px;
		display: {$tab_sidebar_post_top_display};
	}

	#widget-post-bottom {
		width: {$tab_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$tab_sidebar_bottom_margin_bottom}px auto;
		display: {$tab_sidebar_post_bottom_display};
	}

	#widget-front-top {
		width: {$tab_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$tab_sidebar_top_margin_top}px;
		display: {$tab_sidebar_front_top_display};
	}

	#widget-front-bottom {
		width: {$tab_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$tab_sidebar_bottom_margin_bottom}px auto;
		display: {$tab_sidebar_front_bottom_display};
	}
}


/** PC **/
@media only screen and (min-width: {$pc_min_width}px) {
	#header {
		width: {$pc_header_width}px;
		max-width: 100%;
		margin: auto;
	}

	#body {
		width: {$pc_body_width}px;
		max-width: 100%;
		margin: auto;
	}
	
	#footer {
		width: {$pc_footer_width}px;
		max-width: 100%;
		margin: auto;
	}

	#content {
		margin-top: {$pc_content_margin_top}px;
		margin-bottom: {$pc_content_margin_bottom}px;
	}

	#catch {
		margin-bottom: {$pc_content_margin_top}px;
	}

	#widget-page-left {
		width: {$pc_sidebar_left_width}px;
		margin-top: {$pc_sidebar_left_margin_top}px;
		margin-bottom: {$pc_sidebar_left_margin_bottom}px;
		margin-right: {$pc_content_margin_right}px;
		display: {$pc_sidebar_page_left_display};
	}

	#widget-page-right {
		width: {$pc_sidebar_right_width}px;
		margin-top: {$pc_sidebar_right_margin_top}px;
		margin-bottom: {$pc_sidebar_right_margin_bottom}px;
		margin-left: {$pc_content_margin_left}px;
		display: {$pc_sidebar_page_right_display};
	}

	#widget-post-left {
		width: {$pc_sidebar_left_width}px;
		margin-top: {$pc_sidebar_left_margin_top}px;
		margin-bottom: {$pc_sidebar_left_margin_bottom}px;
		margin-right: {$pc_content_margin_right}px;
		display: {$pc_sidebar_post_left_display};
	}

	#widget-post-right {
		width: {$pc_sidebar_right_width}px;
		margin-top: {$pc_sidebar_right_margin_top}px;
		margin-bottom: {$pc_sidebar_right_margin_bottom}px;
		margin-left: {$pc_content_margin_left}px;
		display: {$pc_sidebar_post_right_display};
	}

	#widget-front-left {
		width: {$pc_sidebar_left_width}px;
		margin-top: {$pc_sidebar_left_margin_top}px;
		margin-bottom: {$pc_sidebar_left_margin_bottom}px;
		margin-right: {$pc_content_margin_right}px;
		display: {$pc_sidebar_front_left_display};
	}

	#widget-front-right {
		width: {$pc_sidebar_right_width}px;
		margin-top: {$pc_sidebar_right_margin_top}px;
		margin-bottom: {$pc_sidebar_right_margin_bottom}px;
		margin-left: {$pc_content_margin_left}px;
		display: {$pc_sidebar_front_right_display};
	}

	#widget-other-left {
		width: {$pc_sidebar_left_width}px;
		margin-top: {$pc_sidebar_left_margin_top}px;
		margin-bottom: {$pc_sidebar_left_margin_bottom}px;
		margin-right: {$pc_content_margin_right}px;
		display: {$pc_sidebar_other_left_display};
	}

	#widget-other-right {
		width: {$pc_sidebar_right_width}px;
		margin-top: {$pc_sidebar_right_margin_top}px;
		margin-bottom: {$pc_sidebar_right_margin_bottom}px;
		margin-left: {$pc_content_margin_left}px;
		display: {$pc_sidebar_other_right_display};
	}

	#widget-page-top {
		width: {$pc_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$pc_sidebar_top_margin_top}px;
		display: {$pc_sidebar_page_top_display};
	}

	#widget-page-bottom {
		width: {$pc_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$pc_sidebar_bottom_margin_bottom}px auto;
		display: {$pc_sidebar_page_bottom_display};
	}

	#widget-post-top {
		width: {$pc_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$pc_sidebar_top_margin_top}px;
		display: {$pc_sidebar_post_top_display};
	}

	#widget-post-bottom {
		width: {$pc_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$pc_sidebar_bottom_margin_bottom}px auto;
		display: {$pc_sidebar_post_bottom_display};
	}

	#widget-front-top {
		width: {$pc_sidebar_top_width}px;
		margin: auto;
		max-width: 100%;
		margin-top: {$pc_sidebar_top_margin_top}px;
		display: {$pc_sidebar_front_top_display};
	}

	#widget-front-bottom {
		width: {$pc_sidebar_bottom_width}px;
		max-width: 100%;
		margin: 0 auto {$pc_sidebar_bottom_margin_bottom}px auto;
		display: {$pc_sidebar_front_bottom_display};
	}
}
CSS;

	return $css;
}
