<?php get_header();?>
	<header class="jumbotron">
		<div class="container">
			<h1><?php single_post_title(); ?></h1>
			<div class="media">
				<div class="media-left">
					<img class="media-object post-ico" src="<?php echo limiwu_ico_url();?>" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';" alt="logo">
				</div>
				<div class="media-body">
					<?php if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )):?>
						<h4 class="media-heading"><?php echo get_post_meta( $post->ID, '_limiwu_source_remarks', true )?></h4>
						<?php else: ?>
						<h4 class="media-heading"><?php bloginfo('name'); ?> - <a href="#CopyrightTitle">[<?php _e('原创','limiwu');?>]</a></h4>
					<?php endif ?>
					<p>
						<?php echo get_the_time('Y/m/d H:s');?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
							if(get_post_meta( $post->ID, '_limiwu_source_author', true )){
								echo get_post_meta( $post->ID, '_limiwu_source_author', true );
							}else{
								echo get_bloginfo('name').'-'.get_the_author_meta( 'display_name', $post->post_author );
								if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
									_e('[编译]','limiwu');
								}
							}
							edit_post_link(' [edit]');
						?>
					</p>
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 article">
				<?php 
				if (get_post_meta( $post->ID, __('视频','limiwu'), true )) {
					$video_url = get_post_meta($post->ID, __('视频','limiwu'), true);
					$video_url = str_replace('http:','',$video_url);
					echo '<iframe src="'.$video_url.'" frameborder="0" allowfullscreen="true" width="100%" height="400px"></iframe><hr>';
				}
				while ( have_posts() ) {
					the_post();
					echo '<article id="viewer">';//图片JQ
					the_content();
					echo '</article>';
					get_template_part('input');
					limiwu_echo_copyright();//版权声明
				}
				
				//文章标签
				$tags = wp_get_post_tags($post->ID);
				if (!empty($tags)) {
				?>
					<h4 class="more-text"><?php _e('更多相关内容','limiwu');?></h4>
				<?php
					echo '<div>';
					foreach ($tags as $tag ) {
						echo '<a href="'.get_tag_link($tag->term_id).'" class="btn btn-default" target="_blank" role="button" title="'.$tag->name.'">'.$tag->name.'</a> ';
					}
					echo '</div>';
				}
				if (get_current_user_id() > 0) {//登录后才可以回复
					comments_template('/comments-single.php');
				}else{
					echo '<h4>'.__('登录后可查看评论','limiwu').'</h4>';
				}
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					if (!empty( $prev_post ) || !empty( $next_post )) {
						echo '<hr><nav><ul class="pager">';
						echo ' <li class="previous"><a class="btn btn-default" role="button" href="'. get_permalink($next_post).'" title="'.get_the_title($next_post).'"><i class="glyphicon glyphicon-hand-left"></i> '.__('上一篇','limiwu').'</a></li>';
						echo ' <li class="next"><a class="btn btn-default" role="button" href="'. get_permalink($prev_post).'" title="'.get_the_title($prev_post).'">'.__('下一篇','limiwu').' <i class="glyphicon glyphicon-hand-right"></i></a></li>';

						echo '</ul></nav>';
					}
				?>
				<hr>
			</div>
			<!-- 获取侧栏 -->			
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();?>