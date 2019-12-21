<aside class="col-sm-4 sidebar">
	<aside class="theiaStickySidebar"><!-- 侧栏滚动 -->
		<?php
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
		if (is_plugin_active('open-social/open-social.php')) {
			if (get_current_user_id() > 0) {
				echo open_social_profile_html();
				echo open_social_bind_html();
			}else{
				echo '<section class="widget">';
				echo '<h3>'.__('用户登录','limiwu').'</h3>';
				echo open_social_login_html();
				echo '</section>';
			}
		}?>
	<section class="widget widget_theme_news">
		<h3><?php _e('相关文章','limiwu') ?></h3>
		
		<?php
		/*
		* 侧栏获取文章列表，根据标签进行相关判断，有就获取标签的，没有就获取最新的三篇文章
		*
		*/
		$post_tags = wp_get_post_tags($post->ID);
	
		if ($post_tags) {
			foreach ($post_tags as $tag){    
    			$tag_list[] .= $tag->term_id;// 获取标签列表
    		}
		// 随机获取标签列表中的一个标签
		$post_tag = $tag_list[ mt_rand(0, count($tag_list)-1) ];
		// 该方法使用 query_posts() 函数来调用相关文章，以下是参数列表
		$args = array(
			'tag__in' => array($post_tag),
			'category__not_in' => array(NULL),// 不包括的分类ID
			'post__not_in' => array($post->ID),
			'showposts' => 3,// 显示相关文章数量
			'caller_get_posts' => 1
		);
		query_posts($args);

		if (have_posts()) {
			while (have_posts()){ 
				the_post();
				update_post_caches($posts); ?>
				<p><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="news-date"><?php echo get_the_time('Y-m-d');?></span></p>
		<?php }//end while
		};//end have posts
			wp_reset_query(); 
		}else{// 暂无相关文章情况下显示最近文章
		$new_posts = get_posts('numberposts=3&orderby=post_date');
		foreach($new_posts as $post) {
			setup_postdata($post);
			echo '<p><a rel="bookmark" href="' . get_permalink() . '">' . get_the_title() . '</a>';
			echo '<span class="news-date">'.get_the_time('Y-m-d').'</span></p>';
			}
		}
		?>
	</section>
		<?php
		if (is_plugin_active('open-social/open-social.php')) {
			echo '<section class="widget">';
			echo open_social_share_html();
			echo '</section>';
		}?>
	<?php dynamic_sidebar(__('文章右侧栏','limiwu'));?>
	</aside>
</aside><!-- #sider end -->