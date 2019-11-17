<?php/** * * 相关图片收藏页面， * * @uses add_theme_page()    * @uses add_action() * * @return html */function limiwu_savepic_setting(){  add_theme_page(__('收藏的图片','limiwu'),__('收藏的图片','limiwu'), 'subscriber', 'savepic_setting_subscriber','limiwu_savepic_page');  add_theme_page(__('收藏的图片','limiwu'),__('收藏的图片','limiwu'), 'contributor', 'savepic_setting_contributor','limiwu_savepic_page');  add_theme_page(__('收藏的图片','limiwu'),__('收藏的图片','limiwu'), 'author', 'savepic_setting_author','limiwu_savepic_page');  add_theme_page(__('收藏的图片','limiwu'),__('收藏的图片','limiwu'), 'editor', 'savepic_setting_editor','limiwu_savepic_page');  add_theme_page(__('收藏的图片','limiwu'),__('收藏的图片','limiwu'), 'administrator', 'savepic_setting','limiwu_savepic_page');}   add_action('admin_menu', 'limiwu_savepic_setting');/** * 查询数据库，返回用户收藏图片 * * @package limiwuCom * @author annanzi/910109610@qq.com * @since 2019-11-10 * @return array */function limiwu_select_pic($user,$customer_id =''){    global $wpdb;    $i = 0;        $user = $wpdb->escape($user);    $table_name = $wpdb->prefix . "imgTable";    $table_name = $wpdb->escape($table_name);    $customer_id = $wpdb->escape($customer_id);    if ($customer_id == '' or $customer_id == '0') {	    $sql = $wpdb->get_results("SELECT * FROM $table_name WHERE `user_id`= $user order by `time` DESC");    }else{      $sql = $wpdb->get_results("SELECT * FROM $table_name WHERE `user_id`= $user and `customer_id` = $customer_id order by `time` DESC");    }    if (empty($sql)) {      return;    }else{      foreach ($sql as $array) {        $arr[$i]['src'] = $array->src;        $arr[$i]['cid'] = $array->customer_id;        $arr[$i]['time'] = $array->time;        $arr[$i]['pid'] = $array->post_id;        $i ++;    }          return $arr;    }}/** * 删除图片提示 * * @package limiwuCom * @author annanzi/910109610@qq.com * @since 2019-11-17 * @return html */function limiwu_delete_tips($clear=''){    $tips = '<p class="claerTipText">'.__('您确定清空该用户收藏的图片吗？','limiwu').'</p>';    $tips .= '<form class="clearbox" action="'.admin_url().'themes.php?page=savepic_setting" method="post">';    $tips .= '<input class="noView" name="cid" value="'.$clear.'">';    $tips .= '<button class="button" type="submit" name="deletedb" value="yes">'.__('确定','limiwu').'</button>';    $tips .= ' <button class="button" type="submit" name="deletedb" value="all">'.__('全部清空','limiwu').'</button>';    $tips .= '</form>';    echo $tips;}/** * 删除图片提示 * * @package limiwuCom * @author annanzi/910109610@qq.com * @since 2019-11-17 * @return html */function limiwu_delete_save($cid,$deletedb){    global $wpdb;    $uid = $wpdb->escape(get_current_user_id());    $cid = $wpdb->escape($cid);    $table_name = $wpdb->prefix . "imgTable";    $table_name = $wpdb->escape($table_name);    switch ($deletedb) {      case 'yes':        $echo = $wpdb->query("DELETE FROM $table_name WHERE `customer_id`= $cid and `user_id` = $uid");        break;      case 'all':        $echo = $wpdb->query("DELETE FROM $table_name WHERE `user_id` = $uid");        break;      default:        # code...        break;    }    if ($echo) {      _e('已清空用户收藏','limiwu');    }else{      _e('删除数据表错误，改用户收藏为空','limiwu');    }}/** * 输出收藏的图片 */function limiwu_savepic_page(){  global $post;    if ($_GET['clear']) {//删除收藏提示    limiwu_delete_tips($_GET['clear']);  }  if ($_POST['deletedb']) {    limiwu_delete_save($_POST['cid'],$_POST['deletedb']);  }  $array = limiwu_select_pic(get_current_user_id(),$_GET['cid']);    $return = '<h2>'.__('收藏的图片','limiwu').'</h2><hr><div id="viewer">';  $return .= '<ul class="cidButton">';  $return .= '<form action="'.admin_url().'themes.php" method="get">';  $return .= '<li class="name">'.__('查看客户ID：','limiwu').'</li>';  $return .= '<li><input name="page" value="savepic_setting" class="noView"></li>';  for ($i=1; $i <=10 ; $i++) {     $return .= '<li><button class="button" type="submit" name="cid" value="'.$i.'">'.$i.'</button></li>';  }  $return .= '<li><button class="button" type="submit" name="cid" value="0">'.__('全部','limiwu').'</button></li>';  $return .= '</form></ul>';  if (!empty($array)) {    foreach ($array as $arr) {      $return .= '<h3>';      $return .= '<a href="'.get_post($arr['pid'])->guid.'" target="_blank">'.get_post($arr['pid'])->post_title.'</a>';      $return .= ':<span class="time">'.$arr['time'].'</span>';      $return .= '<span class="time">'.__('客户ID：','limiwu').$arr['cid'].'</span>';      $return .= '<h3>';      $imgArray = explode(",", $arr['src']);//图片      $return .= '<p>';      foreach ($imgArray as $imgURL) {        $return .= '<img class="img" src="'.$imgURL.'">';      }      $return .= '</p>';    }  }  if ($_GET['cid']) {    if ($_GET['cid'] >= 1 && $_GET['cid'] <= 10) {      $return .= '<form action="'.admin_url().'themes.php" method="get">';      $return .= '<input name="page" value="savepic_setting" class="noView">';      $return .= '<input name="cid" value="'.$_GET['cid'].'" class="noView">';      $return .= '<button class="button" type="submit" name="clear" value="'.$_GET['cid'].'">'.__('清空该客户收藏','limiwu').'</button>';      $return .= '</form>';    }  }  $return .= '</div>';  echo $return;}?>