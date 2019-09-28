<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package  paipk1
 * @since paipk1 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div class="comment-post" id="SOHUCS">

<h4><span class="glyphicon glyphicon-share-alt"></span>&nbsp;<?php _e('Comment','paipk1') ?></h4>

<?php if ( !comments_open() ) :
// If registration required and not logged in.
	elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
?>
<p><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Sign in','paipk1') ?></a><?php _e('Comment','paipk1') ?></p>
<?php else: ?>
<!-- Comment Form -->
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-horizontal" role="form">
<?php if ( !is_user_logged_in() ) : ?>
	<div class="form-group">
		<label for="author" class="col-sm-2 control-label"><?php _e('Observer','paipk1') ?>(*)</label>
		<div class="col-sm-10">
			<input type="text" name="author" id="author" placeholder="<?php _e('Your name','paipk1') ?>" value="<?php echo $comment_author; ?>" tabindex="1" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email(*)</label>
		<div class="col-sm-10">
			<input type="email" name="email" id="email" placeholder="@" value="<?php echo $comment_author_email; ?>" tabindex="2" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="url" class="col-sm-2 control-label"><?php _e('Website','paipk1') ?></label>
		<div class="col-sm-10">
			<input type="text" name="url" id="url" placeholder="http://" value="<?php echo $comment_author_url; ?>" tabindex="3" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="comment" class="col-sm-2 control-label"><?php _e('Comment','paipk1') ?>(*)</label>
		<div class="col-sm-10">
			<textarea name="comment" id="message comment" rows="3" tabindex="5" class="form-control"></textarea>
		</div>
	</div>
<?php else: ?>
	<div class="form-group">
		<label for="comment" class="col-sm-2 control-label">
		<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>:</label>
		<div class="col-sm-10">
			<textarea name="comment" id="message comment" rows="3" tabindex="5" class="form-control"></textarea>
		</div>
	</div>
<?php endif; ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default" name="sumbit" tabindex="7" onclick="Javascript:document.forms['commentform'].submit()"><?php _e('Submit Comments','paipk1') ?></button>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Sign out','paipk1') ?>" class="btn btn-default"><?php _e('Sign out','paipk1') ?></a>
			<?php endif; ?>
		</div>
	</div>
	<?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form><!-- Comment Form End -->
<?php endif; ?>

<?php if(have_comments()): ?>
<div class="comment-box" id="comment">
<h4><span class="glyphicon glyphicon-comment"></span>&nbsp;<?php _e('Comment','paipk1') ?><?php _e('List','paipk1') ?></h4>

<?php function qiuye_comment($comment, $args, $depth){ $GLOBALS['comment'] = $comment; ?>
<div class="media" id="comment-<?php comment_ID(); ?>">
	<div class="media-left">
		<a href="#comment" onclick="RevertComment('{$comment.ID}')">
			<?php if (function_exists('get_avatar') && get_option('show_avatars')) { 
				echo get_avatar($comment,48); } ?>
		</a>
	</div>
	<div class="media-body">
		<h4 class="media-heading">
		<?php echo get_comment_author_link()?>&nbsp;
		<b><?php echo get_comment_time('Y-m-d'); ?> <span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo get_comment_time('H:i'); ?>&nbsp;
		<span class="glyphicon glyphicon-heart-empty"></span>&nbsp;<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','paipk1'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>&nbsp;<?php edit_comment_link(__('Edit','paipk1')); ?>
		</b>
		</h4>
		<?php comment_text(); ?>
		<p><?php if ($comment->comment_approved == '0'): ?>
			<?php _e('Your comments are being reviewed and will be shown later','paipk1')?><?php endif?>
		</p>	
	</div>
</div>
<?php } wp_list_comments('type=comment&callback=qiuye_comment');?>

		<?php if(get_comment_pages_count()>1 && get_option('page_comments')): ?>
		<div class="text-center">
<?php previous_comments_link( __( '&larr; Prev') ); ?>&nbsp;
<?php next_comments_link( __( 'Next &rarr;') ); ?>
		</div>
		<?php endif; ?>
</div>
<?php endif; // have_comments() ?>

</div><!-- #comments -->