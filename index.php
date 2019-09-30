<?php 
	$list_array = explode(',',get_option('limiwu_index_list'));
	if (is_home() || (is_category() && !in_category($list_array))) {
		get_header();?>
	<div class="list">
		<div class="container">
			<div class="row" id="masonry">
				<?php if ( have_posts() ){
						while ( have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() ); 
						};
					}
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
	<?php get_footer();
	}else{
		require(TEMPLATEPATH . '/index-list.php');
}?>