<?php /*
Author: 
Author URI: 
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ ?>
<?php
if ( post_password_required() ) {
	return;
}
?>
<?php if (get_val('N_TEXT_LABEL_COMMENT') != null) echo '<div class="comment-title"><h2>' . get_val('N_TEXT_LABEL_COMMENT', 'タグ:') . '</h2></div>'; ?>
<div class="data-comment">
<?php if ( have_comments() ) : ?>
	<?php the_comments_navigation(); ?>

	<div class="data-comment-list"><ol class="comment-list">
		<?php
			wp_list_comments(array('style' => 'ol'));
		?>
	</ol></div>

	<?php the_comments_navigation(); ?>
<?php endif; ?>

<?php comment_form(array('label_submit' => get_val('N_TEXT_COMMENT_SUBMIT', 'コメントを送信'))); ?>
</div>
