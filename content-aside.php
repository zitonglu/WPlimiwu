<div id="post-<?php the_ID(); ?>" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 item">
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>">
			<?php limiwu_post_first_img();?><!-- 获取缩略图 -->
		</a>
		<div class="caption">
			<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<a href="<?php the_permalink(); ?>" target="_blank" class="hidden-xs hidden-sm"><p class="description aside"><?php echo get_the_excerpt();?></p></a>
			<p class="edit hidden-xs">
				<?php if(get_post_meta( $post->ID, '_limiwu_source', true ))://作者头像?>
					<img class="media-object post-ico" src="//<?php echo get_post_meta( $post->ID, '_limiwu_source', true )?>/favicon.ico" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';">
					<?php else: ?>
					<img class="media-object post-ico" src="<?php bloginfo('template_url'); ?>/image/favicon.ico" alt="<?php bloginfo('name'); ?>">
				<?php endif ?>
				<?php //文章作者名字
				if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
					echo get_post_meta( $post->ID, '_limiwu_source_remarks', true );
				}else{
					the_author_posts_link($post->ID);
				}?>
				<span class="float-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i><?php the_time('Y-m-d') ?></span>
			</p>
		</div>
	</div>
</div><!-- item end -->