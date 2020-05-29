<?php
/*
Template Name: 日记页面模版
*/
?>
<?php get_header();?>
	<header class="jumbotron transparent">
		<div class="container">
			<h1><?php single_post_title(); ?></h1>
		</div>
	</header>
	<div class="container single">
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
					the_content();
				}
				
				if (get_current_user_id() > 0) {//登录后才可以回复
					comments_template('/comments-single.php');
				}else{
					echo '<h4>'.__('登录后可查看评论','limiwu').'</h4>';
				}
					$prev_post = get_previous_post();
					$next_post = get_next_post();
				?>
				<hr>
			<?php
			$diaryNumber = get_post_meta($post->ID, 'diary', true);
			if($diaryNumber){
				$args = array(
				  'numberposts'   => 50,
				  'orderby'     => 'post_date',
				  'order'      => 'DESC',
				  'meta_key'    => '_limiwu_dateNumber_url',
				  'meta_value'   => $diaryNumber,
				  'post_status'   => 'publish' );
				$posts_array = get_posts($args);
				if ($posts_array) {
					echo '<ul class="time-line" id="timeline">';
					foreach ($posts_array  as $post) {
						get_template_part('content','diary'); 
					}
					echo '</ul>';
				}
			}
			?>
			</div>
			<!-- 获取侧栏 -->			
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();?>