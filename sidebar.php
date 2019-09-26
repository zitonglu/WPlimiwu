<div class="col-sm-4 sidebar">
	<aside class="theiaStickySidebar"><!-- 侧栏滚动 -->
	<section class="widget widget_theme_news">
		<?php
			echo '<h3>'.__('NewesPosts','limiwu').'</h3>';
			$posts = get_posts('numberposts=3&orderby=post_date');
			foreach($posts as $post) {
				setup_postdata($post);
				echo '<p><a href="' . get_permalink() . '">' . get_the_title() . '</a>';
				echo '<span class="news-date">'.get_the_time('Y-m-d').'</span></p>';
				echo '<p class="news-thumbnail"><a href="' . get_permalink() . '" title="'. get_the_title() .'" target="_blank">';
				limiwu_post_first_img();
				echo '</a></p>';
				
			}
			$post = $posts[0];
		?>
	</section>

	<?php dynamic_sidebar('RightSidebar');?>
	</aside>
</div><!-- #sider end -->