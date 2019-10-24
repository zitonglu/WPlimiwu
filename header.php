<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>

<link rel="stylesheet" href="<?php limiwu_echo_CDN_URL('bootstrap.min.css','css')?>">
<link rel="stylesheet" href="<?php limiwu_echo_CDN_URL('style.css')?>">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/load.min.css">
<?php if(is_single()  || is_page()):?>
<link rel="stylesheet" href="<?php limiwu_echo_CDN_URL('viewer.min.css','css')?>">
<?php endif ?>
<script src="<?php limiwu_echo_CDN_URL('jquery.min.js')?>"></script>
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
    @media (min-width: 767px){
        body.home,body.category{
            background-image:url("<?php bloginfo('template_url'); ?>/image/shadow_light.png"),url("<?php bloginfo('template_url'); ?>/image/pixels.png"),url(<?php echo get_option('limiwu_index_bg');?>);
            background-position:0 50px,0 50px,0 0;
            background-repeat:repeat-x,repeat,repeat;
        }
    }
</style>
<?php endif?>
</head>

<body <?php body_class();?>>
<?php wp_body_open(); ?>

<!-- 网站加载loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
    <div class="load_title"><?php _e('网站加载中....','limiwu');?><br><span>design by limiwu.com</span></div>
</div>
<script type="text/javascript">         
    // 等待所有加载
    $(window).load(function(){
        $('body').addClass('loaded');
        $('#loader-wrapper .load_title').remove();
    }); 
</script>

<?php get_template_part('nav');//顶部导航 ?>