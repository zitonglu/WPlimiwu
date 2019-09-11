<?php get_header();?>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-xs-12"><?php get_template_part('carousel'); ?></div>
			<div class="col-sm-3 col-xs-12">相关信息</div>
		</div>
	</div>
	<div class="list">
		<div class="container">
			<div class="row" id="masonry">
				<?php if ( have_posts() ){
						while ( have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() ); 
						};
					}else{
						get_template_part('404'); 
					}
				?>
			</div><!-- row end -->
		</div><!-- container end -->
	</div><!-- list end -->

	<nav id="nav-below">
	  <ul class="pager">
	    <li><?php previous_posts_link(__('Newer posts')) ?></li>
	    <li id="older_posts"><?php next_posts_link(__('Older posts')) ?></li>
	  </ul>
	</nav><!-- nav-below end -->

<?php get_footer();?>