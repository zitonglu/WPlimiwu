<?php 
/*
Template Name: 标签聚合页面
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
$html .= '<ul class="list-inline tags-list">';
foreach ( $tags as $tag ) {
	if (empty($_GET['allTags'])) {
		$tag_value = $tag->term_id;
		$tag_class = 'btn-default';
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
		<hr>
		<div class="row" id="masonry">
		<?php //属性相关内容
		$tag_value_Arr = explode('-',$_GET['allTags']);
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$limit = (get_query_var('posts_per_page')) ? get_query_var('posts_per_page') : get_option('posts_per_page');
		$args = array(
			'limit' => $limit,
		    'posts_per_page' => 20,// 控制只显示10篇文章，如果将10改成-1将显示所有文章
		    'tag__in' => $tag_value_array,
		    'paged' => $paged
		);
			query_posts($args);
			while ( have_posts() ) : the_post();
				require('content.php');
			endwhile;
			wp_reset_query();
		?>
		</div><!-- row end -->
	</div><!-- container end -->
</div><!-- list end -->
<?php get_footer();?>