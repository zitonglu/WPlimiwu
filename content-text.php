<article id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><?php echo get_the_title(); ?></a>
	<p class="description"><?php echo get_the_excerpt();?></p>
	<p class="more">
		<?php if(get_post_meta( $post->ID, '_limiwu_source', true )):?>
			<img class="media-object post-ico" src="<?php echo limiwu_ico_url();?>" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';" alt="favicon.ico">
			<?php if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
				limiwu_echo_list_editName();//文章作者
			 }?>
			<span><i class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></i>
			<i class="glyphicon glyphicon-time" aria-hidden="true"></i> <?php the_time('Y-m-d') ?></span>
		<?php else: ?>
			<p class="more"><?php the_author(); ?> - <span><?php the_permalink(); ?></span></p>
		<?php endif ?>
	</p>
</article><!-- item end -->