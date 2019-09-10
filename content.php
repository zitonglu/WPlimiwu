<div id="post-<?php the_ID(); ?>" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 item">
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" target="_blank" title="<?php echo get_the_title(); ?>">
			<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}else {
				echo '<img src="'.get_template_directory_uri().'/image/coffee.jpg" />';
			} ?>
		</a>
		<div class="caption">
			<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php echo get_the_title(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<a href="<?php the_permalink(); ?>" target="_blank" class="hidden-xs"><p class="description"><?php echo get_the_excerpt();?></p></a>
			<p class="tags text-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i><?php the_time('Y-m-d') ?><?php if(has_tag()): ?> <span class="hidden-xs"><i class="glyphicon glyphicon-tags" aria-hidden="true"></i> <?php the_tags('');?></span><?php endif ?></p>
		</div>
	</div>
</div><!-- item end -->