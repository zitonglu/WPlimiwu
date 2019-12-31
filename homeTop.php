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
/**
 * 板材计算
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-12-10
 * @return array(area,)
 */
//基础公式:算面积
function limiwu_area_m2($x,$y,$n = 2){
  $area = round($x*$y*$n/1000000,2);
  return $area;
}
//基础公式:算总价格
function limiwu_allV($x,$y,$n = 2,$v = 0){
  $area = limiwu_area_m2($x,$y,$n);
  $allV = $area * $v;
  return $allV;
}
//成数组
function limiwu_tr_array($name,$x,$y,$n = 2 ,$v = 0, $t = 18){
  $area = limiwu_area_m2($x,$y,$n);
  $allV = limiwu_allV($x,$y,$n,$v);
  $arr = array(
    'name' => $name,  //板材名称
    'x' => $x,        //长度
    'y' => $y,        //宽度
    'n' => $n,        //数量
    'area' => $area,  //面积
    'v' => $v,        //单价
    'allV' => $allV,  //总价
    't' => $t         //板材厚度
  );
  return $arr;
}
/**
 * 提交按钮操作
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-12-10
 */
if ($_POST['LIMIWUs']) {
  if($_POST['LIMIWUName2'] && preg_match("/^1[345789]\d{9}$/", $_POST['LIMIWUTel2'])){
    limiwu_homeTop_INSERT_INTO($_POST['LIMIWUName2'],$_POST['LIMIWUTel2']);
  }//插入客户信息到数据表

  $cab_X = $_POST['cab_Width'];//柜宽尺寸
  $cab_Y = $_POST['cab_Height'];//柜高尺寸
  $cab_Z = $_POST['cab_Depth'];//柜深尺寸
  $cab_L = $_POST['cab_Laminate'] ? $_POST['cab_Laminate'] : 2.5;//中横板数量
  $cab_R = $_POST['cab_Riser'] ? $_POST['cab_Riser'] : 1;//中竖板数量
  $cab_T = $_POST['cab_Thickness'] ? $_POST['cab_Thickness'] : 18;//板材厚度
  $cab_BT = $_POST['backplaneV'] ? 9 : 0;//背板厚度
  $cab_I = $_POST['cab_Indent'] && $cab_BT ? 20 : 0;//柜体层板前后内缩进尺寸mm
  $cab_V = $_POST['sheetPrice'] ? $_POST['sheetPrice'] : 0;//柜体板价格
  $cab_BV = $_POST['backplaneV'] ? $_POST['backplaneV'] : 0;//柜体背板价格
  $cab_TL = $_POST['haveTopLine'] ? 60 : 0;//顶线高度
  $cab_FL = $_POST['haveFootLine'] ? 80 : 0;//脚线高度
  $cab_EC = $_POST['haveEndCap'] ? 2 : 0;//收口条数量
  $cab_DV = $_POST['doorPlank'] ? $_POST['doorPlank'] : 0;//门板单价

  $cab_table = array();
  array_push($cab_table,limiwu_tr_array('外侧板',$cab_Y,$cab_Z,2,$cab_V,$cab_T));
  array_push($cab_table,limiwu_tr_array('中侧板',$cab_Y-2*$cab_T-$cab_TL-$cab_FL,$cab_Z,$cab_R,$cab_V,$cab_T));
  array_push($cab_table,limiwu_tr_array('顶底板',$cab_X-2*$cab_T,$cab_Z,2,$cab_V,$cab_T));
  array_push($cab_table,limiwu_tr_array('中横板',$cab_X-2*$cab_T,$cab_Z-$cab_I-$cab_BT,$cab_L,$cab_V,$cab_T));
  array_push($cab_table,limiwu_tr_array('背拉条',$cab_X-2*$cab_T,100,2,$cab_V,$cab_T));
  if ($cab_TL){
    array_push($cab_table,limiwu_tr_array('顶线',$cab_X-2*$cab_T,$cab_TL,2,$cab_V,$cab_T));
  }
  if ($cab_FL){
    array_push($cab_table,limiwu_tr_array('脚线',$cab_X-2*$cab_T,$cab_FL,2,$cab_V,$cab_T));
    array_push($cab_table,limiwu_tr_array('支撑',$cab_Z-2*$cab_T,$cab_FL,2,$cab_V,$cab_T));
  }
  array_push($cab_table,limiwu_tr_array('收口条',$cab_Y,60,2,$cab_V,$cab_T));
  if ($cab_DV){
    array_push($cab_table,limiwu_tr_array('门板',$cab_Y-$cab_TL-$cab_FL,$cab_X,1,$cab_DV,$cab_T));
  }
  array_push($cab_table,limiwu_tr_array('背板',$cab_Y-$cab_TL-$cab_FL,$cab_X,1,$cab_BV,$cab_BT));
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
                if (preg_match("/^1[345789]\d{9}$/", $_POST['LIMIWUTel'])) {
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
        <li role="presentation"><a href="#tagcloud" aria-controls="tagcloud" role="tab" data-toggle="tab" class="btn-warning"><span class="glyphicon glyphicon-heart "></span>猜你喜欢</a></li>
        <?php if(get_current_user_id() == 0): ?>
          <li role="presentation"><a href="<?php echo wp_login_url(home_url());?>" class="btn-warning"><span class="glyphicon glyphicon-edit"></span>注册&登录</a></li>
        <?php else: ?>
          <li role="presentation"><a href="<?php echo get_author_posts_url(get_current_user_id()); ?>" class="btn-warning"><?php the_author_meta('display_name',get_current_user_id()); ?></a></li>
        <?php endif?>
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
            <div role="tabpanel" class="tab-pane" id="tagcloud">
              <?php wp_tag_cloud('smallest=9&largest=14');?>
            </div>
        </div>
    </div>
</div><!-- container end -->
</div><!-- hometop end -->
<div class="homeIco">
  <div class="col-sm-9"><a href="<?php bloginfo('template_url')?>/index-list.php" target="_blank"><i class="zxlc_ico3"></i><span>家装规划</span></a></div>
  <div class="col-sm-9"><i class="zxlc_ico8"></i><span>定制需求</span></div>
  <div class="col-sm-9"><i class="zxlc_ico2"></i><span>咨询了解</span></div>
  <div class="col-sm-9"><i class="zxlc_ico1"></i><span>上门测量</span></div>
  <div class="col-sm-9"><i class="zxlc_ico4"></i><span>深化设计</span></div>
  <div class="col-sm-9"><i class="zxlc_ico5"></i><span>拆单报价</span></div>
  <div class="col-sm-9"><i class="zxlc_ico9"></i><span>确认付款</span></div>
  <div class="col-sm-9"><i class="zxlc_ico6"></i><span>到货安装</span></div>
  <div class="col-sm-9"><i class="zxlc_ico7"></i><span>完成交付</span></div>
  <div class="clearfix"></div>
</div><!-- homeIco end -->
<div id="Calculator" class="Calculator">
  <div class="container">
  <div class="col-sm-5 material">
    <h4 class="text-center"><b>投影面积与展开面积对比</b></h4>
    <form action="#Calculator" method="post" role="form">
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="cab_Height">柜体高度</label>
          <div class="input-group">
            <span class="input-group-addon">高</span>
            <input type="number" class="form-control" id="cab_Height" name="cab_Height" required tabindex="1" <?php echo $_POST['cab_Height'] ? 'value='.$_POST['cab_Height'] : 'placeholder="0"' ?>>
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
      </div><!-- 柜体高度 -->
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="cab_Width">柜体宽度</label>
          <div class="input-group">
            <span class="input-group-addon">宽</span>
            <input type="number" class="form-control" id="cab_Width" name="cab_Width" required tabindex="2" <?php echo $_POST['cab_Width'] ? 'value='.$_POST['cab_Width'] : 'placeholder="0"' ?>>
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
      </div><!-- 柜体宽度 -->
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="cab_Depth">柜体深度</label>
          <div class="input-group">
            <span class="input-group-addon">深</span>
            <input type="number" class="form-control" id="cab_Depth" name="cab_Depth" required tabindex="3" <?php echo $_POST['cab_Depth'] ? 'value='.$_POST['cab_Depth'] : 'placeholder="0"' ?>>
          </div>
          <span class="form-control-feedback">mm</span>
        </div>
      </div><!-- 柜体深度 -->
      <div class="col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="cab_Riser">柜体竖板数量</label>
          <div class="input-group">
            <span class="input-group-addon">中竖板</span>
            <input type="number" step="0.01" class="form-control" id="cab_Riser" name="cab_Riser" tabindex="4" <?php echo $_POST['cab_Riser'] ? 'value='.$_POST['cab_Riser'] : 'placeholder="1.00"' ?>>
          </div>
          <span class="form-control-feedback">块</span>
        </div>
      </div><!-- 柜体竖板数量 -->
      <div class="col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="cab_Laminate">柜体层板数量</label>
          <div class="input-group">
            <span class="input-group-addon">中横板</span>
            <input type="number" step="0.01" class="form-control" id="cab_Laminate" name="cab_Laminate" tabindex="5" <?php echo $_POST['cab_Laminate'] ? 'value='.$_POST['cab_Laminate'] : 'placeholder="2.50"' ?>>
          </div>
          <span class="form-control-feedback">块</span>
        </div>
      </div><!-- 柜体层板数量 -->
      <div class="col-sm-12 text-right">
        <label class="checkbox-inline">
          <input type="checkbox" name="haveEndCap" value="haveEndCap" <?php echo !$_POST['haveEndCap'] ? $_POST['haveEndCap'] : 'checked=checked' ?>> 2根收口条
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="haveTopLine" value="haveTopLine" <?php echo !$_POST['haveTopLine'] ? $_POST['haveTopLine'] : 'checked=checked' ?>> 6cm顶线
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="haveFootLine" value="haveFootLine" <?php echo !$_POST['haveFootLine'] ? $_POST['haveFootLine'] : 'checked=checked' ?>> 8cm脚线
        </label>
      </div><!-- 柜体选择参数 -->
      <hr>
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="sheetPrice">柜体展开面积单价</label>
          <div class="input-group">
            <span class="input-group-addon">柜体</span>
            <input type="number" class="form-control" id="sheetPrice" name="sheetPrice" tabindex="6" <?php echo $_POST['sheetPrice'] ? 'value='.$_POST['sheetPrice'] : 'placeholder="0.00"' ?>>
          </div>
          <span class="form-control-feedback"><small>元/m²</small></span>
        </div>
      </div><!-- 柜体展开面积单价 -->
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="backplaneV">背板单价</label>
          <div class="input-group">
            <span class="input-group-addon">背板</span>
            <input type="number" class="form-control" id="backplaneV" name="backplaneV" tabindex="7" <?php echo $_POST['backplaneV'] ? 'value='.$_POST['backplaneV'] : 'placeholder="0.00"' ?>>
          </div>
          <span class="form-control-feedback"><small>元/m²</small></span>
        </div>
      </div><!-- 背板展开面积单价 -->
      <div class="col-md-4 col-sm-6">
        <div class="form-group has-feedback">
          <label class="control-label sr-only" for="doorPlank">门板单价</label>
          <div class="input-group">
            <span class="input-group-addon">门板</span>
            <input type="number" class="form-control" id="doorPlank" name="doorPlank" tabindex="8" <?php echo $_POST['doorPlank'] ? 'value='.$_POST['doorPlank'] : 'placeholder="0.00"' ?>>
          </div>
          <span class="form-control-feedback"><small>元/m²</small></span>
        </div>
      </div><!-- 门板单价 -->
      <div class="col-sm-12 calculationTips">
        <p>本模块用于对标准柜体进行<span>展开面积</span>的初步计算，不含五金配件、测量、运输安装等费用，具体明细由设计师详细说明。</p>
      </div>
      <div class="col-sm-4">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="LIMIWUName2">客户名称</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="number" class="form-control" id="LIMIWUName2" name="LIMIWUName2" tabindex="9" <?php echo $_POST['LIMIWUName2'] ? 'value='.$_POST['LIMIWUName2'] : 'placeholder="称呼/小区"' ?>>
          </div>
        </div>
      </div><!-- 客户称呼或者小区信息 -->
      <div class="col-sm-6">
        <div class="form-group has-warning has-feedback">
          <label class="control-label sr-only" for="LIMIWUTel2">电话号码</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input type="number" class="form-control" id="LIMIWUTel2" name="LIMIWUTel2" tabindex="10" <?php echo $_POST['LIMIWUTel2'] ? 'value='.$_POST['LIMIWUTel2'] : 'placeholder="电话号码"' ?>>
          </div>
        </div>
      </div><!-- 客户电话号码 -->
      <input class="col-sm-2 col-xs-12 button btn btn-primary" name="LIMIWUs" type="submit" value="计算" tabindex="11">
      <div class="clearfix"></div>
    </form>
  </div>
  <div class="col-sm-4 Calculator-results text-right">
    <h4 class="text-center">(｡･ω･｡) <b>运算清单</b> ↓</h4>
    <div class="tableDiv">
      <table>
        <tbody id="results_list">
        </tbody>
      </table>
    </div>
    <a id="result_clear" class="btn btn-default">,,Ծ‸Ծ,, 清空</a>
  </div><!-- calculator result end -->
  <div class="col-sm-3 Calculator-interface">
    <form name="calculator" class="display">
      <p>&nbsp;<em id="operationProcess"></em></p>
      <span id="total">0</span>
    </form>
    <div>
      <button class="btn btn-danger" type="submit" id="calc_clear" value="C/E">C/E</button>
      <button class="btn btn-danger" type="submit" id="calc_back" value="&larr;">&larr;</button>
      <button class="btn btn-default" type="submit" id="calc_neg" value="-/+">-/+</button>
      <button class="btn btn-default calc_op" type="submit" value="/">&divide;</button>
      <button class="btn btn-default calc_int" value="7" >7</button>
      <button class="btn btn-default calc_int" value="8" >8</button>
      <button class="btn btn-default calc_int" value="9" >9</button>
      <button class="btn btn-default calc_op" value="*" >&times;</button>
      <button class="btn btn-default calc_int" value="4" >4</button>
      <button class="btn btn-default calc_int" value="5" >5</button>
      <button class="btn btn-default calc_int" value="6" >6</button>
      <button class="btn btn-default calc_op" value="-" >-</button>
      <button class="btn btn-default calc_int" value="1" >1</button>
      <button class="btn btn-default calc_int" value="2" >2</button>
      <button class="btn btn-default calc_int" value="3" >3</button>
      <button class="btn btn-default calc_op" value="+" >+</button>
      <button class="btn btn-default calc_int" id="calc_zero" value="0" >0</button>
      <button class="btn btn-default" id="calc_decimal" value="." >.</button>
      <button class="btn btn-warning" id="calc_eval" value="=" >=</button>
      <hr>
      <button class="btn btn-default" id="calc_denom" value="1/x" >1/<span class="denom-btm">x</span></button>
      <button class="btn btn-default" id="calc_sqrt" value="&radic;" >&radic;</button>
      <button class="btn btn-default" id="calc_square" value="x2" >x<span class="exponent">2</span></button>
      <button class="btn btn-default calc_op" id="calc_powerof" value="^" >y<span class="exponent">x</span></button>
      <div class="clearfix"></div>
    </div>
  </div><!-- calculator interface end -->
<?php if($_POST['LIMIWUs']){?>
  <div class="col-sm-12" id="calculatorTableBox"><!-- 计算的结果 -->
    <div class="panel-group" role="tablist" aria-multiselectable="true">
      <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="ctbox">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#calculatorTable" href="#calculatorTable" aria-expanded="true" aria-controls="calculatorTable">
              厘米屋家居空间设计柜体板材用料及费用清单
            </a>
          </h4>
        </div>
        <div id="calculatorTable" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="ctbox">
          <div class="panel-body">
            <table id="tableToExcel">
              <caption><h3>厘米屋家居空间设计柜体板材用料及费用清单</h3></caption>
              <thead>
                <tr>
                  <th>序号</th>
                  <th>部件名称</th>
                  <th>长度</th>
                  <th>宽度</th>
                  <th>厚度</th>
                  <th>数量</th>
                  <th>用量</th>
                  <th>单价</th>
                  <th>总金额</th>
                  <th>备注</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $table_allV = 0;
                  foreach ($cab_table as $cab_html) {
                    $cab_html_text = '<tr><td>'.$i.'</td>';
                    $cab_html_text .= '<td>'.$cab_html['name'].'</td>';
                    $cab_html_text .= '<td>'.$cab_html['x'].'</td>';
                    $cab_html_text .= '<td>'.$cab_html['y'].'</td>';
                    $cab_html_text .= '<td>'.$cab_html['t'].'</td>';
                    $cab_html_text .= '<td>'.sprintf('%.2f',$cab_html['n']).'</td>';
                    $cab_html_text .= '<td>'.$cab_html['area'].'</td>';
                    $cab_html_text .= '<td>'.sprintf('%.2f',$cab_html['v']).'</td>';
                    $cab_html_text .= '<td>'.sprintf('%.2f',$cab_html['allV']).'</td>';
                    $cab_html_text .= '<td></td></tr>';
                    echo $cab_html_text;
                    $i++;
                    $table_allV += $cab_html['allV'];
                  }
                  $cab_all_area = $cab_X*$cab_Y/1000000;
                  $projectedArea = '柜体'.$cab_X.' mm宽，'.$cab_Y.'mm高，共计'.$cab_all_area.' 平方米，洞口(投影)面积单价约为：<b>'.floor($table_allV/$cab_all_area).'</b> 元';
                ?>
                <tr>
                  <td colspan="7"><?php echo $projectedArea;?></td>
                  <td><b>板材总价</b></td>
                  <td><b><?echo floor($table_allV);?></b></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <!-- 转换为excel表，其他格式需调整：github：https://github.com/huanz/tableExport 保留 -->
            <?php if(get_current_user_id() > 0): ?>
            <p class="text-right savebox">
              <button type="button" name="button" id="saveasexcel" class="btn btn-default"><?php _e('导出','limiwu');?> Excel</button>
            </p>
            <form action="<?php bloginfo('template_url')?>/save/saveasexcel.php" method="post" id="excelfromtable" target="_blank">
              <input name="savebutton" type="hidden" autocomplete="off"/>
            </form>
            <script type="text/javascript">
              $(function(){
                $('#saveasexcel').click(function(){
                  var excelContent = $('#tableToExcel').html(); //获取表格内容
                  $('input[name=savebutton]').val(excelContent);//赋值给表单
                  $('#excelfromtable').submit();//表单提交，提交到php
                })
              })
            </script>
            <?php endif ?>
            </div><!-- panel-body end -->
        </div><!-- calculatorTable end -->
      </div>
    </div>
  </div><!-- calculatorTable end -->
<?php }?>
<div class="clearfix"></div>
</div><!-- container end -->
</div><!-- calculator end -->

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