<?php
/*
* 单篇文章的评论模版
*
*/
if ( post_password_required() )
	return;
?>
<?php if(have_comments()): ?>
<br><h4 id="comment"><?php _e('评论内容','limiwu')?></h4>
<!-- 评论内容 -->
<div class="panel-group comment-texts" id="accordion" role="tablist" aria-multiselectable="true">
<?php function limiwu_comment($comment, $args, $depth){ $GLOBALS['comment'] = $comment; ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="comment-<?php comment_ID(); ?>">
      <p class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php comment_ID(); ?>" aria-expanded="false" aria-controls="collapse<?php comment_ID(); ?>">
          <?php if ($comment->comment_approved == '0'): ?><code><span class="glyphicon glyphicon-tower"></span> <?php _e('审核中','limiwu')?></code><?php endif?>
          <?php comment_text();?>
        </a>
      </p>
    </div>
    <div id="collapse<?php comment_ID(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="comment-<?php comment_ID(); ?>">
      <div class="panel-body">
		<?php echo get_avatar(get_comment_author_email(), 24); ?>&nbsp;
        <?php echo get_comment_author_link()?>&nbsp;
		<?php echo get_comment_time('Y-m-d'); ?> <span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo get_comment_time('H:i'); ?>&nbsp;
		<span class="glyphicon glyphicon-heart-empty"></span>&nbsp;<?php comment_reply_link(array_merge( $args, array('reply_text' => __('回复','limiwu'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>&nbsp;<?php edit_comment_link(__('编辑','limiwu')); ?>
      </div>
    </div>
  </div>
<?php } wp_list_comments('type=comment&callback=limiwu_comment');//输出评论列表?>
</div>
	<?php if(get_comment_pages_count()>1 && get_option('page_comments'))://评论翻页 ?>
	<div class="text-center">
		<?php previous_comments_link( __( '之前评论','limiwu') ); ?>&nbsp;|&nbsp;
		<?php next_comments_link( __( '最新留言','limiwu') ); ?>
	</div>
	<?php endif; ?>
<?php endif; // have_comments() ?>
<!-- 下面是之前的文章 -->
<div class="comment-post" id="respond">

<?php if ( !comments_open() ) :
// If registration required and not logged in.
	elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
?>
<p><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Sign in','limiwu') ?></a><?php _e('Comment','limiwu') ?></p>
<?php else: ?>
<!-- Comment Form -->
<br><h4><?php _e('评论栏','limiwu') ?></h4>
<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-horizontal" role="form">
<?php if ( !is_user_logged_in() ) : ?>
	<div class="form-group">
		<label for="comment" class="col-sm-2 control-label"><?php _e('评论内容','limiwu') ?>(*)</label>
		<div class="col-sm-10">
			<textarea name="comment" id="message comment" rows="3" tabindex="1" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="author" class="col-sm-2 control-label"><?php _e('称呼','limiwu') ?>(*)</label>
		<div class="col-sm-10">
			<input type="text" name="author" id="author" placeholder="<?php _e('您的称呼','limiwu') ?>" value="<?php echo $comment_author; ?>" tabindex="2" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email(*)</label>
		<div class="col-sm-10">
			<input type="email" name="email" id="email" placeholder="@" value="<?php echo $comment_author_email; ?>" tabindex="3" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="url" class="col-sm-2 control-label"><?php _e('个人博客','limiwu') ?></label>
		<div class="col-sm-10">
			<input type="text" name="url" id="url" placeholder="http(s)://" value="<?php echo $comment_author_url; ?>" tabindex="4" class="form-control">
		</div>
	</div>
<?php else: ?>
	<div class="form-group">
		<label for="comment" class="col-sm-2 control-label">
		<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>:</label>
		<div class="col-sm-10">
			<textarea name="comment" id="message comment" rows="3" tabindex="2" class="form-control"></textarea>
		</div>
	</div>
<?php endif; ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default" name="sumbit" tabindex="7" onclick="Javascript:document.forms['commentform'].submit()"><?php _e('提交评论','limiwu') ?></button>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('登出','limiwu') ?>" class="btn btn-default"><?php _e('登出','limiwu') ?></a>
			<?php endif; ?>
		</div>
	</div>
	<?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form><!-- Comment Form End -->
<?php endif; ?>

</div><!-- #comments -->