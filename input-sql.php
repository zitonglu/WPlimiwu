<?php 
  if (is_user_logged_in() && $_POST['src']) {
    if (!empty($_POST['src']) || ($_POST['customerID'])!=0 ) {
      echo '<p class="text-right bg-success" id="returnOK">'.__('提交成功','limiwu').'</p>';
    }else{
      echo '<p class="text-right bg-danger" id="returnOK">'.__('未收藏任何东西或未选择客户ID','limiwu').'</p>';
    }
  }
?>