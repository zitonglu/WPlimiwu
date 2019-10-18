<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
<!-- Bootstrap -->
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
<?php if(is_single()  || is_page()):?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/viewer.min.css">
<?php endif ?>
<!--[if lt IE 9]>
  <script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
  <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<title><?php if ( is_home() ) {
        bloginfo('name'); echo "|"; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo "|"; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "search result:"; echo "|"; bloginfo('name');
    } elseif (is_404() ) {
        echo '404 | '.__('您所浏览的页面错误','limiwu');
    } else {
		wp_title( '|', true, 'right' ); 
}?></title>

<?php get_template_part( 'option-seo');//SEO ?>

<?php if(get_option('limiwu_index_bg'))://index背景图片?>
    <style>
        body{background-image:url(<?php echo get_option('limiwu_index_bg');?>)}
        .ppt{background:none}
    </style>
<?php endif?>
</head>

<body <?php body_class();?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'nav', get_post_format() );//顶部导航 ?>