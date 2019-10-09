<article id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><?php echo get_the_title(); ?></a>
	<p class="description"><?php echo get_the_excerpt();?></p>
	<p class="more">
		<?php if(get_post_meta( $post->ID, '_limiwu_source', true )):?>
			<img class="post-ico" src="//<?php echo get_post_meta( $post->ID, '_limiwu_source', true )?>/favicon.ico" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';">
			<?php if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )):?>
				<?php echo get_post_meta( $post->ID, '_limiwu_source_remarks', true )?>
			<?php endif ?>
			<span><i class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></i>
			<i class="glyphicon glyphicon-time" aria-hidden="true"></i> <?php the_time('Y-m-d') ?></span>
		<?php else: ?>
			<p class="more"><?php the_author(); ?> - <span><?php the_permalink(); ?></span></p>
		<?php endif ?>
	</p>
</article><!-- item end -->