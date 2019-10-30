<?php get_header();?>
	<div class="text-list">
		<div class="container">
			<div class="row content-text">
				<div class="col-sm-6 col-sm-offset-1">
					<?php if ( have_posts() ){
							while ( have_posts() ) {
								the_post();
								get_template_part('content', 'text'); 
							};
						}
					?>
				</div>
				<!-- 获取侧栏 -->			
				<?php get_sidebar('list'); ?>
			</div><!-- row end -->
		</div><!-- container end -->
	</div><!-- list end -->

	<nav id="nav-below">
	  <ul class="pager">
	    <li><?php previous_posts_link(__('上一页','limiwu')) ?></li>
	    <li id="older_posts"><?php next_posts_link(__('下一页','limiwu')) ?></li>
	  </ul>
	</nav><!-- nav-below end -->
<?php get_footer();?>