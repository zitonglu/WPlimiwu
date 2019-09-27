<div id="post-<?php the_ID(); ?>" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 item">
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>">
			<?php limiwu_post_first_img();?><!-- 获取缩略图 -->
		</a>
		<div class="caption">
			<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<a href="<?php the_permalink(); ?>" target="_blank" class="hidden-xs"><p class="description"><?php echo get_the_excerpt();?></p></a>
			<p class="tags text-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i><?php the_time('Y-m-d') ?><?php if(has_tag()): ?> <span class="hidden-xs"><i class="glyphicon glyphicon-tags" aria-hidden="true"></i> <?php the_tags('');?></span><?php endif ?></p>
		</div>
	</div>
</div><!-- item end -->