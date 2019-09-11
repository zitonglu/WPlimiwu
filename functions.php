<?php
/**
 * limiwu.com functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

// 获取文章第一张缩略图 
function limiwu_post_first_img() {
	global $post;
	if (has_post_thumbnail()) {
			return the_post_thumbnail();
		}else{// 获取缩略图
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post->post_content), $matches);
		if(empty($output)){ 
			$first_img = get_template_directory_uri().'/image/coffee.jpg';
		}else {
			$first_img = $matches [1][0];
		}
		echo '<img src="'.$first_img.'" alt="'.get_the_title().'" />';
	}
}

// 开启缩略图功能
add_theme_support( 'post-thumbnails' );