<div id="post-<?php the_ID(); ?>" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 masonrybox">
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>">
			<?php limiwu_post_first_img();?><!-- 获取缩略图 -->
		</a>
		<div class="caption">
			<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<p class="description tags hidden-xs hidden-sm">
				<?php
				if(has_tag()){
					echo '<i class="glyphicon glyphicon-tag"></i> ';
					the_tags('');
					echo '<br>';
				};
				echo '<i class="glyphicon glyphicon glyphicon-th-list"></i> ';
				$category = get_the_category($post->ID);
				foreach ($category as $c) {
					echo ' <a href="'.$c->cat_url.'" title="'.$c->cat_name.'" target="_blank">';
					echo $c->cat_name.'</a>';

				}
				?>
			</p>
			<p class="edit hidden-xs">
				<img class="media-object post-ico" src="<?php echo limiwu_ico_url();?>" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';">
				<?php //文章作者名字
				if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
					echo '<a href="'.get_the_permalink().'" target="_blank" title="'.get_the_title().'">';
					echo get_post_meta( $post->ID, '_limiwu_source_remarks', true );
					echo '</a>';
				}else{
					the_author_posts_link($post->ID);
				}?>
				<span class="float-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i><?php the_time('Y-m-d') ?></span>
			</p>
		</div>
	</div>
</div><!-- item end -->