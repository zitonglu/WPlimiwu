<?php 
/*
Template Name: 报价页面
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>厘米屋空间家具设计|报价计算单独页面清单</title>
<meta name="description" content="厘米屋" />
<meta name="keywords" content="全屋定制设计,报价,拆单,深化" />
<?php wp_head(); ?>
<?php echo get_option('limiwu_top_javaScript');//百度统计?>
<link rel="stylesheet" href="<?php limiwu_echo_CDN_URL('bootstrap.min.css','css')?>">
<style>
/*==== logo ====*/
.logoImg{padding-right:4px}
.logoImg img{width:16px}
/*====.footer 页面底部 ====*/
.footer{
	margin-top: 5em;
	padding: 8px;
    padding-top: 8px;
    padding-bottom: 8px;
	text-align: center;
	background: #212121;
	color: #bdbdbd;
	border-top: 1px solid #757575;
}
.footer a{color:#777}
.footer a:hover{color: #bdbdbd}
</style>
</head>
<body>
	<?php get_template_part('nav');//顶部导航 ?>
	<!-- 代码 -->
	<footer class="footer">
    <p>
        Copyright © 2019-2020 <a href="<?php bloginfo('url'); ?>/wp-admin" target="_blank"><?php bloginfo('name'); ?></a> <span class="glyphicon glyphicon-pencil"></span> 
        <a href="//beian.miit.gov.cn/" rel="nofollow" target="_blank">
			<?php echo get_option( 'limiwu_get_ICP' );?></a> <!--网站备案号-->
        <span class="glyphicon glyphicon-tree-deciduous"></span> <a href="<?php bloginfo('rdf_url'); ?>" target="_blank">RSS</a> 
        Powered By <a href="//cn.wordpress.org" rel="nofollow" target="_blank">WordPress</a>. Theme by <a href="//www.limiwu.com" target="_blank">limiwu.com</a>
        <?php _e('商业授权版','limiwu' );?> 
        <a href="<?php bloginfo('url'); ?>/sitemap.xml" target="_blank">SiteMap</a>
    </p>
</footer>
<script src="<?php limiwu_echo_CDN_URL('jquery.min.js')?>"></script>
<!-- Bootstrap JS -->
<script src="<?php limiwu_echo_CDN_URL('bootstrap.min.js')?>"></script>
<?php echo get_option('limiwu_bottom_javaScript');?>
<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 调用数据库次数：<?php echo get_num_queries(); ?>次 -->