<?php get_header();?>
	<div class="jumbotron">
		<div class="container">
			<h2><?php single_post_title(); ?></h2>
			<div class="media">
				<div class="media-left">
					<?php if(get_post_meta( $post->ID, '_limiwu_source', true )):?>
						<img class="media-object post-ico" src="//<?php echo get_post_meta( $post->ID, '_limiwu_source', true )?>/favicon.ico">
						<?php else: ?>
						<img class="media-object post-ico" src="<?php bloginfo('template_url'); ?>/image/favicon.ico?>" alt="<?php bloginfo('name'); ?>">
					<?php endif ?>
				</div>
				<div class="media-body">
					<?php if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )):?>
						<h4 class="media-heading"><?php echo get_post_meta( $post->ID, '_limiwu_source_remarks', true )?></h4>
						<?php else: ?>
						<h4 class="media-heading"><?php bloginfo('name'); ?></h4>
					<?php endif ?>
					<p>
						<?php echo get_the_time('m/d h:s');?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
							if(get_post_meta( $post->ID, '_limiwu_source_author', true )){
								echo get_post_meta( $post->ID, '_limiwu_source_author', true );
							}else{
								echo get_the_author_meta( 'display_name', $post->post_author );
							}
							edit_post_link(' [edit]');
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="cow">
			<div class="col-sm-8 article">
				<?php 
				while ( have_posts() ) {
					the_post();
					the_content();
				}

				$tags = wp_get_post_tags($post->ID);
				if (!empty($tags)) {
				?>
					<h3><?php _e('更多相关内容','limiwu');?></h3>
				<?php
					echo '<div>';
					foreach ($tags as $tag ) {
						echo '<a href="'.get_tag_link($tag->term_id).'" class="btn btn-default btn-lg" target="_blank" role="button" title="'.$tag->name.'">'.$tag->name.'</a> ';
					}
					echo '</div>';

					comments_template('/comments-single.php');

					$prev_post = get_previous_post();
					$next_post = get_next_post();
					if (!empty( $prev_post ) || !empty( $next_post )) {
						echo '<hr><nav><ul class="pager">';
						echo ' <li class="previous"><a class="btn btn-default" role="button" href="'. get_permalink($prev_post).'" title="'.get_the_title($prev_post).'"><i class="glyphicon glyphicon-hand-left"></i> '.__('前一篇','limiwu').'</a></li>';
						echo ' <li class="next"><a class="btn btn-default" role="button" href="'. get_permalink($next_post).'" title="'.get_the_title($ext_post).'">'.__('下一篇','limiwu').' <i class="glyphicon glyphicon-hand-right"></i></a></li>';
						echo '</ul></nav>';
					}
				}?>
			</div>
			<!-- 获取侧栏 -->			
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();?>