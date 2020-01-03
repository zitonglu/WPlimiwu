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
body{background-color:#455a64;color:#f8f8f8}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {-webkit-appearance: none}
input[type="number"]{-moz-appearance: textfield}

/*==== logo ====*/
.logoImg{padding-right:4px}
.logoImg img{width:16px}
/*====.footer 页面底部 ====*/
.footer{
	padding: 8px;
	text-align: center;
	background: #212121;
	color: #bdbdbd;
	border-top: 1px solid #757575;
}
.footer a{color:#777}
.footer a:hover{color: #bdbdbd}
/*====.left 页面左部 ====*/
.left,.table-box,.right{min-height:100vh}
.right>.form-control,
.right .input-group,
.right .form-group,
.add_button button{margin-bottom:5px}
.right>.form-control{color:#3c763d;border-color:#3c763d;}
.form-control-feedback{color:#555}

</style>
</head>
<body>
	<?php get_template_part('nav');//顶部导航 ?>
	<!-- body begin -->
	<div class="col-sm-2 left"></div>
	<div class="col-sm-8 table-box"></div>
	<div class="col-sm-2 right">
        <input type="text" class="form-control has-success" id="cab_name" name="cab_name" required tabindex="1" placeholder="项目(柜体/门扇)名称">
        <h5>柜体/门扇/板材尺寸</h5>
        <!-- 柜体高度 -->
		<div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Height">柜体高度</label>
          <div class="input-group">
            <span class="input-group-addon">高(长)</span>
            <input type="number" class="form-control" id="cab_Height" name="cab_Height" required="" tabindex="1" placeholder="0">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <!-- 柜体宽度 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Width">柜体宽度</label>
          <div class="input-group">
            <span class="input-group-addon">宽(宽)</span>
            <input type="number" class="form-control" id="cab_Width" name="cab_Width" required="" tabindex="2" placeholder="0">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <!-- 柜体深度 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Depth">柜体深度</label>
          <div class="input-group">
            <span class="input-group-addon">深(厚)</span>
            <input type="number" class="form-control" id="cab_Depth" name="cab_Depth" tabindex="3" placeholder="0">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <h5>价格</h5>
        <!-- 面积单价 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="sheetPrice">面积单价</label>
          <div class="input-group"> 
            <span class="input-group-addon">单价</span>
            <input type="number" class="form-control" id="sheetPrice" name="sheetPrice" tabindex="6" placeholder="0.00">
          </div> 
          <span class="form-control-feedback"><small>元/m²</small></span>
        </div>
        <!-- 数量 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="LM_number">数量</label>
          <div class="input-group"> 
            <span class="input-group-addon">数量</span>
            <input type="number" class="form-control" id="LM_number" name="LM_number" tabindex="6" placeholder="1.00">
          </div>
        </div>
        <h5>计算方式</h5>
        <div class="add_button text-center">
          <button class="btn btn-default" type="submit">增加单项</button>
          <button class="btn btn-default" type="submit">增加单项</button>
          <button class="btn btn-default" type="submit">增加单项</button>
          <button class="btn btn-default" type="submit">增加单项</button>
          <button class="btn btn-default" type="submit">增加单项</button>
        </div>
	</div>
	<!-- body end -->
	<footer class="col-sm-12 footer">
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