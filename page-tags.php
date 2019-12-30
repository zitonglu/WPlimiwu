<?php 
/*
Template Name: 测试单独页面
*/
get_header();
$args = array('include' => '2');
$tags = get_tags($args);
foreach ($tags as $tag) {
	$tagid = $tag->term_id;
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'tag_id' => $tagid,
		'posts_per_page' => 7,
		'paged' => $paged
	);
}
	query_posts($args);
// 循环
while ( have_posts() ) : the_post();
    echo '<li>';
    the_title();
    echo '</li>';
endwhile;

wp_reset_query();

?>
<div>1</div>
<?php get_footer();?>