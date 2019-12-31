<?php 
/*
Template Name: 测试单独页面
*/
get_header();?>

<div class="list" id="list">
	<div class="container">
		<div class="row" id="masonry">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'posts_per_page' => 15,// 控制只显示10篇文章，如果将10改成-1将显示所有文章
    'tag__in' => array(2,3,5),
    'paged' => $paged
);
query_posts($args);
while ( have_posts() ) : the_post();
    the_post();
	get_template_part('content', get_post_format()); 
endwhile;
wp_reset_query();
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
<?php get_footer();?>