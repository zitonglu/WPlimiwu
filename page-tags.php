<?php 
/*
Template Name: 测试单独页面
*/
get_header();?>

<div class="list" id="list">
	<div class="container">
<?php
$tags = get_tags();
$html = '<form action="" method="get" role="form">';
if ($_GET['page_id']){
	$html .= '<input class="display-none" name="page_id" value="'.$_GET['page_id'].'">';
}
$html .= '<ul class="list-inline">';
foreach ( $tags as $tag ) {
	if (empty($_GET['allTags'])) {
		$tag_value = $tag->term_id;
		//$tag_class = 'btn-default';
	}else{
		$tag_value_array = explode('-',$_GET['allTags']);
		if (in_array($tag->term_id, $tag_value_array)) {
			$tag_class = 'btn-warning';
			if (count($tag_value_array) == 1) {
				$tag_value = $tag->term_id;
			}else{
				foreach ($tag_value_array as $key => $value) {
					if ($value == $tag->term_id) {
						unset($tag_value_array[$key]);
					}
				}//删除数组中这个id对应的元素
				$tag_value = implode('-',$tag_value_array);
			}
		}else{
			$tag_class = 'btn-default';
			$tag_value_array[] = $tag->term_id;
			$tag_value = implode('-',$tag_value_array);
		}
	}
	//$tag_link = get_tag_link( $tag->term_id );
	$html .= '<li><button name="allTags" class="btn '.$tag_class.'" role="button" title="allTags" value="'.$tag_value.'" type="submit" id="tag-'.$tag->term_id.'">';
	$html .= $tag->name.'</button></li>';
}
$html .= '</ul></form>';
echo $html;
?>
		<hr><div class="row" id="masonry">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'posts_per_page' => -1,// 控制只显示10篇文章，如果将10改成-1将显示所有文章
    'tag__in' => array(2,3,5),
    'paged' => $paged
);
	query_posts($args);
	while ( have_posts() ) : the_post();
		echo '<li><a href="'.$post->guid.'">';
	    the_title();
	    echo '</a></li>';
	endwhile;
	wp_reset_query();
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