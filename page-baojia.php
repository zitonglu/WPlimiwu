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
<link rel="stylesheet" type="text/css" href="<?php limiwu_echo_CDN_URL('bootstrap.min.css','css')?>">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/css/baojia.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker3.min.css">
</head>
<?php
function limiwu_setValue($post){
  if ($post) {echo ' value = "'.$post.'"';}
}
if ($_POST['newProject']) {
  $about = '专案名：'.$_POST['project_name'];
  $about .= ' 订单号：'.$_POST['customer_number'];
  $about .= ' 下单时间：'.$_POST['customer_orderTime'];
  $about .= ' 安装时间：'.$_POST['customer_installTime'];
  $about .= '<br>客户信息：'.$_POST['customer_name'].' - '.$_POST['customer_tel'].' - '.$_POST['customer_address'];
}
?>
<body id="baojia">
	<?php get_template_part('nav');//顶部导航 ?>
	<!-- body begin -->
	<div class="col-sm-2 left" id="left">
    <form name="leftBox" method="post" action="">
		<input type="text" class="form-control" id="project_name" name="project_name" placeholder="专案名称" required tabindex="1"<?php limiwu_setValue($_POST['project_name']);?>>
		<h5>基本信息</h5>
		<!-- 客户姓名 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_name">客户姓名</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="先生/女士" required tabindex="2"<?php limiwu_setValue($_POST['customer_name']);?>>
          </div>
        </div>
        <!-- 联系方式 -->
		<div class="form-group">
           <label class="control-label sr-only" for="customer_tel">客户联系方式</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="number" class="form-control" id="customer_tel" name="customer_tel" placeholder="联系方式" required tabindex="3"<?php limiwu_setValue($_POST['customer_tel']);?>>
          </div>
        </div>
        <!-- 地址 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_address">项目地址</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="项目地址" required tabindex="4"<?php limiwu_setValue($_POST['customer_address']);?>>
          </div>
        </div>
        <h5>项目节点</h5>
        <!-- 订单编号 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_number">订单编号</label>
          <div class="input-group">
            <span class="input-group-addon">单号</span>
            <input type="text" class="form-control" id="customer_number" name="customer_number" tabindex="5"<?php limiwu_setValue($_POST['customer_number']);?>>
          </div>
        </div>
        <!-- 下单时间 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_orderTime">下单时间</label>
          <div class="input-group date datepicker">
            <span class="input-group-addon">下单</span>
            <input type="text" class="form-control" id="customer_orderTime" name="customer_orderTime" tabindex="6"<?php limiwu_setValue($_POST['customer_orderTime']);?>>
          </div>
        </div>
        <!-- 安装时间 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_installTime">预约安装时间</label>
          <div class="input-group date datepicker">
            <span class="input-group-addon">安装</span>
            <input type="text" class="form-control" id="customer_installTime" name="customer_installTime" tabindex="7"<?php limiwu_setValue($_POST['customer_installTime']);?>>
          </div>
        </div>
        <h5>新建/存储</h5>
        <div class="add_button text-right">
          <button class="btn btn-default" type="submit" name="newProject" value="newProject" disabled="disabled" tabindex="8">新建</button>
          <a class="btn btn-default" name="saveProject" tabindex="9">更新</a>
      	</div>
      </form>
	</div>
	<div class="col-sm-8 table-box text-center" contenteditable=true>
		<div class="print-A4">
			<h2 id="titleID">厘米屋家居空间设计报价清单</h2>
			<div class="text-left">
				<p name="about"><?php echo $about;?></p>
				<table class="text-center" id="summaryList">
					<thead>
						<tr class="tablebg">
							<th>序号</th>
							<th>项目名称</th>
							<th>尺寸</th>
							<th>单价</th>
							<th>套数</th>
							<th>总价</th>
							<th>材料/备注</th>
						</tr>
          </thead>
          <tbody>
						<tr data-name="东南房衣柜">
							<td name="orderNumber">1</td>
							<td>东南房衣柜</td>
							<td>2400 * 1200 * 600</td>
							<td name="cabV">2880</td>
							<td name="cabN">1</td>
							<td name="cabP">2880</td>
							<td>EO实木颗粒板</td>
						</tr>
						<tr>
							<td colspan=4></td>
							<td>合计</td>
							<td name="totalprice">2880</td>
							<td></td>
						</tr>
					</tbody>
				</table>
				<p> </p>
		<table id="tableList"><!-- 柜体清单部分 -->
            <thead data-name="东南房衣柜" class="cabhead">
              <tr>
                <th data-name="cabNo"># 1</th>
                <th data-name="cabName">东南房衣柜</th>
                <th data-name="cabSize" colspan=5>2400 * 1200 * 600</th>
                <th data-name="cabNumber">1套</th>
                <th data-name="cabData" colspan=2>E0实木颗粒板</th>
              </tr>
              <tr class="tablebg">
                <th>序号</th>
                <th>部件名称</th>
                <th>长</th>
                <th>宽</th>
                <th>厚</th>
                <th>用量</th>
                <th>单价</th>
                <th>数量</th>
                <th>金额</th>
                <th>备注</th>
              </tr>
            </thead>
            <tbody data-name="东南房衣柜" class="cab">
            <tr>
              <td name="orderNumber">1</td>
              <td>东南房衣柜</td>
              <td name="cabX">2400</td>
              <td name="cabY">1200</td>
              <td name="cabD">600</td>
              <td name="cabA">2.88</td>
              <td name="cabU">1000</td>
              <td name="cabN">1</td>
              <td name="cabP">2880</td>
              <td>EO实木颗粒板</td>
            </tr>
            <tr>
				<td colspan=5></td>
				<td colspan=2>小计</td>
				<td name="totals">1</td>
				<td name="totalprice">2880</td>
				<td></td>
			</tr>
          </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-2 right">
        <input type="text" class="form-control" id="cab_name" name="cab_name" placeholder="项目(柜体/门扇)名称" tabindex="10">
        <h5>柜体/门扇/板材尺寸</h5>
        <!-- 柜体高度 -->
		<div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Height">柜体高度</label>
          <div class="input-group">
            <span class="input-group-addon">高(长)</span>
            <input type="number" class="form-control" id="cab_Height" name="cab_Height"  placeholder="0" tabindex="11">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <!-- 柜体宽度 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Width">柜体宽度</label>
          <div class="input-group">
            <span class="input-group-addon">宽(宽)</span>
            <input type="number" class="form-control" id="cab_Width" name="cab_Width" placeholder="0" tabindex="12">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <!-- 柜体深度 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="cab_Depth">柜体深度</label>
          <div class="input-group">
            <span class="input-group-addon">深(厚)</span>
            <input type="number" class="form-control" id="cab_Depth" name="cab_Depth" placeholder="0" tabindex="13">
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
        <h5>材料及价格</h5>
        <!-- 材料 -->
        <div class="form-group">
          <label class="control-label sr-only" for="material">材料名称</label>
          <div class="input-group"> 
            <span class="input-group-addon">材料</span>
            <input type="text" class="form-control" id="material" name="material" placeholder="E0实木颗粒板" tabindex="14">
          </div>
        </div>
        <!-- 面积单价 -->
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="sheetPrice">面积单价</label>
          <div class="input-group"> 
            <span class="input-group-addon">单价</span>
            <input type="number" class="form-control" id="sheetPrice" name="sheetPrice" placeholder="0.00" tabindex="15">
          </div> 
          <span class="form-control-feedback"><small>元/m²</small></span>
        </div>
        <!-- 数量 -->
        <div class="form-group">
          <label class="control-label sr-only" for="LM_number">数量</label>
          <div class="input-group"> 
            <span class="input-group-addon">数量</span>
            <input type="number" class="form-control" id="LM_number" name="LM_number" placeholder="0.00" tabindex="16">
          </div>
        </div>
        <!-- 竖板 -->
        <div class="form-group" id="cabRiserBox">
          <label class="control-label sr-only" for="cabRiser">竖板</label>
          <div class="input-group"> 
            <span class="input-group-addon">竖板</span>
            <input type="number" class="form-control" id="cabRiser" name="cabRiser" placeholder="0.00" tabindex="17">
          </div>
        </div>
        <!-- 层板 -->
        <div class="form-group" id="cabLaminateBox">
          <label class="control-label sr-only" for="cabLaminate">层板</label>
          <div class="input-group"> 
            <span class="input-group-addon">层板</span>
            <input type="number" class="form-control" id="cabLaminate" name="cabLaminate" placeholder="0.00" tabindex="18">
          </div>
        </div>
        <h5>计算方式</h5>
        <div class="add_button">
	      <input style="display:none" name="themeUrl" value="<?php echo bloginfo('template_url')?>">
	      <select class="form-control" name="cabModel" tabindex="50">
	        <option value="">按投影面积</option>
	        <option value="limiwu18jia9">厘米屋展开面积18+9</option>
	        <option value="limiwu18jia5">厘米屋展开面积18+5</option>
	      </select>
        </div>
    	<h5 id="selectH5">操作按钮<span id="selectProject"></span></h5>
    	<div class="add_button">
	      <button id="newcab" class="btn btn-default" type="submit" tabindex="51">增加柜</button>
	    	<button id="delcab" class="btn btn-danger" type="submit" disabled="disabled" tabindex="52">删除柜</button><br>
	    	<button id="addtr" class="btn btn-default" type="submit" disabled="disabled" tabindex="53">插入行</button>
	        <button id="deltr" class="btn btn-default" type="submit" disabled="disabled" tabindex="54">删除行</button>
    	</div>
	</div><!-- right end -->
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
<!-- datepickerJS -->
<script type="text/javascript" src="<?php bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker.zh-CN.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php bloginfo('template_url')?>/js/limiwu-page-baojia.js?v=1.6" charset="UTF-8"></script>
<?php echo get_option('limiwu_bottom_javaScript');?>
<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 调用数据库次数：<?php echo get_num_queries(); ?>次 -->