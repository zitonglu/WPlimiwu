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
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker3.min.css">
<style>
body{background-color:#455a64;color:#f8f8f8}
.datepicker{color:#333}
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
.left>.form-control,
.left .input-group,
.left .form-group,
.right>.form-control,
.right .input-group,
.right .form-group,
.add_button button{margin-bottom:5px}
.right>.form-control{color:#3c763d;border-color:#3c763d;}
.form-control-feedback{color:#555}
.print-A4{margin:0 auto 10px;padding:0px 2vw;max-width:794px;min-height:1123px;border:1px solid #546e7a;}
table{width:100%;line-height: 2em}
table,th,td{border:1px solid #546e7a;text-align:center}
.tablebg{background-color:#607d8b}

</style>
</head>
<body>
	<?php get_template_part('nav');//顶部导航 ?>
	<!-- body begin -->
	<div class="col-sm-2 left">
		<input type="text" class="form-control" id="project_name" name="project_name" placeholder="专案名称">
		<h5>基本信息</h5>
		<!-- 客户姓名 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_name">客户姓名</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="先生/女士">
          </div>
        </div>
        <!-- 联系方式 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_tel">客户联系方式</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="number" class="form-control" id="customer_tel" name="customer_tel" placeholder="联系方式">
          </div>
        </div>
        <!-- 地址 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_address">项目地址</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="项目地址">
          </div>
        </div>
        <h5>项目节点</h5>
        <!-- 订单编号 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_number">订单编号</label>
          <div class="input-group">
            <span class="input-group-addon">单号</span>
            <input type="text" class="form-control" id="customer_number" name="customer_number">
          </div>
        </div>
        <!-- 下单时间 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_orderTime">下单时间</label>
          <div class="input-group date datepicker">
            <span class="input-group-addon">下单</span>
            <input type="text" class="form-control" id="customer_orderTime" name="customer_orderTime">
          </div>
        </div>
        <!-- 安装时间 -->
		<div class="form-group">
          <label class="control-label sr-only" for="customer_installTime">预约安装时间</label>
          <div class="input-group date datepicker">
            <span class="input-group-addon">安装</span>
            <input type="text" class="form-control" id="customer_installTime" name="customer_installTime">
          </div>
        </div>
        <h5>新建/存储</h5>
        <div class="add_button text-right">
          <button class="btn btn-default" type="submit" name="newProject">新建</button>
          <button class="btn btn-default" type="submit" name="inProject">草稿</button>
          <button class="btn btn-default" type="submit" name="saveProject">保存</button>
      	</div>
	</div>
	<div class="col-sm-8 table-box text-center" contenteditable=true>
		<div class="print-A4">
			<h2>厘米屋空间家具设计报价清单</h2>
			<div class="text-left">
				<p>专案名：XXX小区设计方案 <span>订单号：XXX6️213</span> <span>下单时间：2019年12月12日</span> <span>安装时间：2020年1月18日</span><br>
				客户信息：张女士 - 1524874588 - 紫金花园冲们去古董里</p>
				<table class="text-center">
					<thead>
						<tr class="tablebg">
							<th>序号</th>
							<th>项目名称</th>
							<th>尺寸</th>
							<th>单价</th>
							<th>用量</th>
							<th>总价</th>
							<th>材料/备注</th>
						</tr>
						<tr>
							<td>1</td>
							<td>东南房衣柜</td>
							<td>2400 * 1200 * 600</td>
							<td>760.00</td>
							<td>1</td>
							<td>2188.8</td>
							<td>EO实木颗粒板</td>
						</tr>
						<tr>
							<td>2</td>
							<td>西南房衣柜</td>
							<td>2400 * 1200 * 600</td>
							<td>760.00</td>
							<td>1</td>
							<td>2188.8</td>
							<td>EO实木颗粒板</td>
						</tr>
						<tr>
							<td colspan=4></td>
							<td>合计</td>
							<td>52400</td>
							<td></td>
						</tr>
					</thead>
				</table>
				<p> </p>
				<table id="tablelist">
          <tbody data-name="东南房柜体">
  					<tr>
  						<th># 1</th>
  						<th class="data-name">东南房柜体</th>
  						<th colspan=4>2400 * 1200 * 600</th>
  						<th>1套</th>
  						<th colspan=2>E0实木颗粒板</th>
  					</tr>
  					<tr class="tablebg">
  						<th>序号</th>
  						<th>部件名称</th>
  						<th>长</th>
  						<th>宽</th>
  						<th>厚</th>
  						<th>单价</th>
  						<th>用量</th>
  						<th>金额</th>
  						<th>备注</th>
  					</tr>
  					<tr>
  						<td>1</td>
  						<td>左侧板</td>
  						<td>2400</td>
  						<td>600</td>
  						<td>18</td>
  						<td>200</td>
  						<td>1</td>
  						<td>288</td>
  						<td></td>
  					</tr>
          </tbody>
          <tbody data-name="西南房柜体">
            <tr>
              <th># 1</th>
              <th class="data-name">西南发南房柜体</th>
              <th colspan=4>2400 * 1200 * 600</th>
              <th>1套</th>
              <th colspan=2>E0实木颗粒板</th>
            </tr>
            <tr class="tablebg">
              <th>序号</th>
              <th>部件名称</th>
              <th>长</th>
              <th>宽</th>
              <th>厚</th>
              <th>单价</th>
              <th>用量</th>
              <th>金额</th>
              <th>备注</th>
            </tr>
            <tr id="23">
              <td>1</td>
              <td>左侧板</td>
              <td>2400</td>
              <td>600</td>
              <td>18</td>
              <td>200</td>
              <td>1</td>
              <td>288</td>
              <td></td>
            </tr>
          </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-2 right">
		<form name="rightBox" method="post" action="">
        <input type="text" class="form-control" id="cab_name" name="cab_name" required tabindex="1" placeholder="项目(柜体/门扇)名称">
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
        <!-- 材料 -->
        <div class="form-group">
          <label class="control-label sr-only" for="material">材料名称</label>
          <div class="input-group"> 
            <span class="input-group-addon">材料</span>
            <input type="text" class="form-control" id="material" name="material" placeholder="E0实木颗粒板">
          </div>
        </div>
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
        <div class="form-group">
          <label class="control-label sr-only" for="LM_number">数量</label>
          <div class="input-group"> 
            <span class="input-group-addon">数量</span>
            <input type="number" class="form-control" id="LM_number" name="LM_number" tabindex="6" placeholder="1.00">
          </div>
        </div>
        <h5>计算方式</h5>
        <div class="add_button">
          <button class="btn btn-default" type="submit" name="projectedArea">投影面积</button>
          <button class="btn btn-default" type="submit" name="expandedArea">展开面积</button>
          <button class="btn btn-default" type="submit" name="addOne">增加单项</button>
        </div>
    	</form>
    	<h5>操作按钮</h5>
    	<div>
    		<button id="addtr" class="btn btn-default" type="submit" title="插入一行" disabled="disabled">插入一行</button>
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
<script type="text/javascript" src="<?php echo bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_url')?>/datepickerJS/bootstrap-datepicker.zh-CN.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_url')?>/js/limiwu-page-baojia.js" charset="UTF-8"></script>
<?php echo get_option('limiwu_bottom_javaScript');?>
<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 调用数据库次数：<?php echo get_num_queries(); ?>次 -->