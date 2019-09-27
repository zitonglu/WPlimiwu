<?php 
/**
 * 网站SEO优化代码
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-9-27
 */
$description = '';
$keywords = '';
if (is_home() || is_page()) {
    $description = get_option('limiwu_homeDescription');
    $keywords = get_option('limiwu_homeKeyword');
}
elseif (is_single()) {
   $description1 = get_post_meta($post->ID, "description", true);
   $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
   $description = $description1 ? $description1 : $description2;
   $keywords = get_post_meta($post->ID, "keywords", true);
   if($keywords == '') {
      $tags = wp_get_post_tags($post->ID);
      foreach ($tags as $tag ) {
         $keywords = $keywords . $tag->name . ", ";
      }
      $keywords = rtrim($keywords, ', ');
   }
}
elseif (is_category()) {
   $description = category_description();
   $keywords = single_cat_title('', false);
}
elseif (is_tag()){
   $description = tag_description();
   $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<!-- seo end -->