<?php get_header();?>
	<div class="jumbotron">
		<div class="container">
			<h2><?php single_post_title(); ?></h2>
			<div class="media">
				<div class="media-left">
					<?php if(get_post_meta( $post->ID, '_limiwu_source', true )):?>
						<img class="media-object post-ico" src="//<?php echo get_post_meta( $post->ID, '_limiwu_source', true )?>/favicon.ico" alt="<?php echo get_post_meta( $post->ID, '_limiwu_source_remarks', true )?>">
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
							edit_post_link(' [编辑]');
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
					<h3>更多内容</h3>
				<?php
					echo '<div>';
					foreach ($tags as $tag ) {
						echo '<a href="'.get_tag_link($tag->term_id).'" class="btn btn-default btn-lg" target="_blank" role="button" title="'.$tag->name.'">'.$tag->name.'</a> ';
					}
					echo '</div>';
				}?>
			</div>
			<div class="col-sm-4 side">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php get_footer();?>