<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/image/favicon.ico" type="image/x-icon" />
<!-- Bootstrap -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet">

<!--[if lt IE 9]>
  <script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
  <script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- SEO -->
<?php if( is_single() || is_page()):?>
<title><?php single_post_title(); ?> - <?php bloginfo('name'); ?></title>
<meta name="description" content="<?php if (has_excerpt()) {
        echo $description = get_the_excerpt(); //文章编辑中的摘要
    }else {
      //文章编辑中若无摘要，自定截取文章内容字数做为摘要
        echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"……"); 
    } ?>">
<?php else:?>
<title><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="author" content="<?php the_author(); ?>">
<?php endif ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'nav', get_post_format() );//顶部导航 ?>