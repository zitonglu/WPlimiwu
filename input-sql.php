<?php 
  if (is_user_logged_in() && $_POST['userID']) {
    if (!$_POST['src']) {
      echo '<p class="text-right bg-danger" id="returnOK">'.__('未收藏任何东西','limiwu').'</p>';
    }else{
      echo '<p class="text-right bg-success" id="returnOK">'.__('提交成功','limiwu').'</p>';
      limiwu_INSERT_INTO($_POST['src'],$_POST['userID'],$_POST['postID'],$_POST['customerID']);
    }
  }
  
?>