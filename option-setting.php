<?php/** * * 主题相关参数设置，尽量少， * * @uses add_theme_page()    * @uses add_action() * * * @return null */function limiwu_ad_theme_setting(){  if($_POST['limiwu_update_themeoptions']=='true') {limiwu_themeoptions_update();}  add_theme_page(__('网站主题设置','limiwu'),__('网站主题设置','limiwu'), 'administrator', 'theme_setting','limiwu_theme_setting'); }   add_action('admin_menu', 'limiwu_ad_theme_setting');/** * theme setting * * @since 2019-9-27 * @return HTML */function limiwu_themeoptions_update(){  update_option('limiwu_homeKeyword', $_POST['homeKeyword']);  update_option('limiwu_homeDescription', $_POST['homeDescription']);  update_option('limiwu_index_list', $_POST['index_list']);  update_option('limiwu_favicon_ico', $_POST['favicon_ico']);  update_option('limiwu_top_posts', $_POST['top_posts']);}function limiwu_theme_setting(){ ?>  <div class="wrap">  <h1><?php _e('网站主题设置','limiwu')?></h1>  <hr>  <form method="POST" action="" style="padding-left:20px;">  <input type="hidden" name="limiwu_update_themeoptions" value="true" /><!-- hidden -->  <table class="form-table" role="presentation">    <tbody>      <tr>        <th scope="row"><label for="homeKeyword"><?php _e('首页关键词','limiwu')?></label></th>        <td>          <input name="homeKeyword" type="text" id="homeKeyword" value="<?php echo get_option('limiwu_homeKeyword'); ?>" class="regular-text">          <p class="description"><?php _e('多个词请使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 首页关键词 end -->      <tr>        <th scope="row"><label for="homeDescription"><?php _e('首页描述','limiwu')?></label></th>        <td>          <textarea type="text" name="homeDescription" cols="60" rows="3"><?php echo get_option('limiwu_homeDescription'); ?></textarea>        </td>      </tr><!-- 首页描述 end -->      <tr>        <th scope="row"><label for="top_posts"><?php _e('置顶幻灯片文章ID','limiwu')?></label></th>        <td>          <input name="top_posts" type="text" id="top_posts" value="<?php echo get_option('limiwu_top_posts'); ?>" class="regular-text" placeholder="12,24,45">          <p class="description"><?php _e('输入置顶的文章ID，添加到顶部幻灯片，多个使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 调用文章置顶为幻灯片 end -->      <tr>        <th scope="row"><label for="index_list"><?php _e('普通列表页面','limiwu')?></label></th>        <td>          <input name="index_list" type="text" id="index_list" value="<?php echo get_option('limiwu_index_list'); ?>" class="regular-text" placeholder="2,4,5">          <p class="description"><?php _e('如分类只需要普通列表页面，请输入相应分类的ID或者别名，多个使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 分类目录普通模版 end -->      <tr>        <th scope="row"><label for="favicon_ico">ICO<?php _e('图标加速','limiwu')?></label></th>        <td>          <input name="favicon_ico" type="text" id="favicon_ico" value="<?php echo get_option('limiwu_favicon_ico'); ?>" class="regular-text" placeholder="<?php _e('不包括','limiwu')?> http(s)://">          <p class="description"><?php _e('配合“文章来源”-“来源网址”使用，改变后文章图标最终输出路径为：//图标加速/来源网址/favicon.ico','limiwu')?></p>        </td>      </tr><!-- favicon_ico end -->    </tbody>  </table>    <p><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('提交修改','limiwu') ?>"></p>  </form></div>  <?php }?>