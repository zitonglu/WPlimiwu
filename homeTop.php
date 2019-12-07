<?php
/**
 * 专门的增加联系方式的数据库表函数
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-12-6
 * @return false or true
 */
function limiwu_homeTop_INSERT_INTO($name,$tel){
    global $wpdb;
    $name = $wpdb->escape($name);
    $tel = $wpdb->escape($tel);
    $table_name = $wpdb->prefix . "telTable";
    $table_name = $wpdb->escape($table_name);
    $sql = $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'tel' => $tel
        )
    );
    if ($sql == 0) {
        echo '已提交，请勿重复刷新页面';
    }
}
?>
<div class="jumbotron home-top" id="hometop">
    <div id="page-head-effect" class="page-head-effect">
        <canvas id="demo-canvas" style="width:100% !important"></canvas><!-- 气泡动画JS -->
    </div>
    <div class="page-head-social">
        <div class="social-title text-uppercase">
            <span>厘米屋空间</span>
        </div>
        <div class="page-head-social-item ul-li">
            <ul class="page-head-social-list">
                <li><a href="#" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="关于网站作者" data-placement="top" data-content="一个全屋定制设计师，一个web的技术宅 (..•˘_˘•..)"><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="#list"><span class="glyphicon glyphicon-th-large"></span></a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-qrcode"></span></a></li>
                <li><a target="_blank" href="//wpa.qq.com/msgrd?v=3&uin=910109610&site=qq&menu=yes"><span class="glyphicon glyphicon-comment"></span></a></li>
            </ul><!-- /.page-head-social-list -->
        </div><!-- /.page-head-social-item -->
        <div id="contentUS" class="contentUS">
            <?php if(isset($_POST['LIMIWUsubmit'])){
                if (preg_match("/^1[34578]\d{9}$/", $_POST['LIMIWUTel'])) {
                    limiwu_homeTop_INSERT_INTO($_POST['LIMIWUName'],$_POST['LIMIWUTel']);//插入数据
                    echo '<p class="addOK">提交成功，亲๑乛◡乛๑，我们会尽快安排人员联系您，请耐心等待(｡￫‿￩｡)，谢谢捧场！</p>';
                }else{
                    echo '<p class="addOK">抱歉，您的电话填写不正确！</p>';
                }
            }else{
            ?>
            <form action="" method="post" role="form">
                <input name="LIMIWUName" type="text" class="btn" placeholder="称呼/小区地址" required="required">
                <input name="LIMIWUTel" type="number" class="btn" placeholder="电话号码" required="required">
                <input name="LIMIWUsubmit" type="submit" class="button btn btn-warning" value="｡:.ﾟヽ(｡◕‿◕｡)ﾉﾟ.:｡+ﾟ约谈">
            </form>
            <?php }?>  
       </div><!-- 联系我们 end -->
   </div>
   <div class="container">
    <div class="col-sm-6 left">
        <h1>厘米屋家居空间设计</h1>
        <p class="text">本网站提供家装效果图片收藏服务，主要服务于家装设计师、全屋定制设计师。使设计师们在与客户沟通时，可以根据客户喜好收藏精品效果图，以便视觉化的把握客户所需，从而更好的服务于客户。</p>
        <p class="text-right"><a class="btn btn-warning" href="about-limiwu" role="button" target="_blank">♪(^∇^*)了解更多</a></p>
   </div>
   <div class="col-sm-6 right">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#measure" aria-controls="home" role="tab" data-toggle="tab" class="btn-warning">(●´ϖ`●)</a></li>
        <li role="presentation"><a href="#aboutUs" aria-controls="profile" role="tab" data-toggle="tab" class="btn-warning"><span class="glyphicon glyphicon-comment"></span>联系我们</a></li>
        <li role="presentation"><a href="#loginIn" aria-controls="settings" role="tab" data-toggle="tab" class="btn-warning"><span class="glyphicon glyphicon-edit"></span>注册&登录</a></li>
    </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="measure">
<!-- 第一个分页面 -->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#nantong" aria-expanded="true" aria-controls="nantong">
          全屋定制设计师：解工(南通市区/开发区/海安市)
        </a>
      </h4>
    </div>
    <div id="nantong" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        2002年初开始从事衣柜定制工作，在当地“好莱客衣柜”从事产品设计。先后在科达木业、爱得家私工厂担任深化设计、拆单工作，对衣柜、橱柜、木门制作生产工艺十分了解，尤其对板式定制家深入研究。能根据客户需求提供合理优秀的设计方案，满足客户各种家装风格的需求。
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          其他地区募集中
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        如果您也是当地有名的家装、全屋定制的设计师，烦请加入我们。我们可以一起构建一个全屋定制的平台。
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          其他地区募集中
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        如果您也是当地有名的家装、全屋定制的设计师，烦请加入我们。我们可以一起构建一个全屋定制的平台。
      </div>
    </div>
  </div>
  <h3 class="needme">(ง •̀_•́)ง 全屋定制找我们！</h3>
</div><!-- panel-group end -->
            </div>
            <div role="tabpanel" class="tab-pane" id="aboutUs">
                <div style="width:360px;height:200px;border:#ccc solid 1px;" id="dituContent"></div>
                <ul>
                    <li>地址：江苏南通工业博览城</li>
                    <li>电话：153518XXXX0</li>
                    <li>邮箱：admin..<a>@</a>limiwu.com</li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="loginIn">登录界面，制作中</div>
        </div>
    
    </div>
</div><!--container end--->
</div><!--hometop end--->
<!-- 网站二维码相关 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">可以用手机浏览哦！≖‿≖✧</h4>
      </div>
      <div class="modal-body text-center">
        <p>通过手机浏览器或者微信扫描下面二维码可以直接浏览本网站！<br>可以输入我们的网址：<a>www.limiwu.com</a></p>
        <img src="<?php echo bloginfo('template_url');?>/image/erweima.png" alt="二维码图">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">(￣ω￣;) 阅</button>
      </div>
    </div>
  </div>
</div>

<!-- 百度地图 相关 -->
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript">
function initMap(){createMap();setMapEvent();addMapControl()}function createMap(){var map=new BMap.Map("dituContent");var point=new BMap.Point(120.9313,31.979132);map.centerAndZoom(point,16);window.map=map}function setMapEvent(){map.enableDragging();map.enableScrollWheelZoom();map.enableDoubleClickZoom();map.enableKeyboard()}function addMapControl(){}initMap();
</script>