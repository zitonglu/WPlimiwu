<form action="#savebox" method="post" role="form" id="savebox">
<input class="hidden" type="number" id="userID" name="userID" value="<?php echo get_current_user_id(); ?>">
<input class="hidden" type="number" id="postID" name="postID" value="<?php echo get_the_ID();?>">
<input class="hidden" type="text" id="src" name="src">
<div class="input-group col-sm-4 col-sm-offset-8">
  <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i> <?php _e('客户','limiwu');?></span>
  <select class="form-control" name="customerID" id="customerID">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
  </select>
  <span class="input-group-btn">
    <button title="<?php _e('登录后可保存在后台','limiwu');?>" class="btn btn-default" name="submit" type="submit" id="saveButtom" <?php if(!is_user_logged_in()){echo ' disabled="disabled"';}?>><?php _e('收藏','limiwu');?></button>
  </span>
</div>
</form>
<br>
<?php //limiwu_select_dbtable(get_the_ID());?>
<?php get_template_part('input-sql');?>