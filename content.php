<div id="post-<?php the_ID(); ?>" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 masonrybox">
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>">
			<div class="imgbox"><?php limiwu_post_first_img();?><!-- 获取缩略图 --></div>
		</a>
		<div class="caption">
			<a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
			<!-- <p class="description tags hidden-xs hidden-sm"> -->
				<?php
				// if(has_tag()){
				// 	echo '<i class="glyphicon glyphicon-tag"></i> ';
				// 	the_tags('');
				// 	echo '<br>';
				// };
				// echo '<i class="glyphicon glyphicon glyphicon-th-list"></i> ';
				// $category = get_the_category($post->ID);
				// foreach ($category as $c) {
				// 	echo ' <a href="'.$c->cat_url.'" title="'.$c->cat_name.'" target="_blank">';
				// 	echo $c->cat_name.'</a>';

				// }
				?>
			<!-- </p> -->
			<p class="edit hidden-xs">
				<img class="media-object post-ico" src="<?php echo limiwu_ico_url();?>" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';" alt="favicon.ico">
				<?php limiwu_echo_list_editName();//文章作者?>
				<span class="float-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i><?php the_time('Y-m-d') ?></span>
			</p>
		</div>
	</div>
</div><!-- item end -->