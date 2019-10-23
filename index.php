<?php 
	$list_array = explode(',',get_option('limiwu_index_list'));
	if (is_home() || (is_category() && !in_category($list_array))) {
		get_header();
		get_template_part( 'content', 'top'); //获取置顶文章
?>
<h1 style="display:none"><?php bloginfo('name');echo "-";bloginfo('description');?></h1><!-- seo -->
	<div class="list">
		<div class="container">
			<div class="row" id="masonry">
				<?php if ( have_posts() ){
						while ( have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() ); 
						};
					}
					dynamic_sidebar(__('首页AD广告位','limiwu'));//AD广告
				?>

			</div><!-- row end -->
		</div><!-- container end -->
	</div><!-- list end -->

	<nav id="nav-below">
	  <ul class="pager">
	    <li><?php previous_posts_link(__('上一页','limiwu')) ?></li>
	    <li id="older_posts"><?php next_posts_link(__('下一页','limiwu')) ?></li>
	  </ul>
	</nav><!-- nav-below end -->
	<div class="text-center"><?php _e('下拉自动加载中','limiwu')?>...</div>
	<?php get_footer();
	}else{
		require(TEMPLATEPATH . '/index-list.php');
}?>