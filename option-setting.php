<?php/** * * 主题相关参数设置，尽量少， * * @uses add_theme_page()    * @uses add_action() * * * @return null */function limiwu_ad_theme_setting(){  if($_POST['limiwu_update_themeoptions']=='true') {limiwu_themeoptions_update();}  add_theme_page(__('网站主题设置','limiwu'),__('网站主题设置','limiwu'), 'administrator', 'theme_setting','limiwu_theme_setting'); }   add_action('admin_menu', 'limiwu_ad_theme_setting');/** * theme setting * * @since 2019-9-27 * @return HTML */function limiwu_themeoptions_update(){  update_option('limiwu_homeKeyword', $_POST['homeKeyword']);  update_option('limiwu_homeDescription', $_POST['homeDescription']);  update_option('limiwu_index_list', $_POST['index_list']);  update_option('limiwu_favicon_ico', $_POST['favicon_ico']);  update_option('limiwu_top_posts', $_POST['top_posts']);  update_option('limiwu_index_bg', $_POST['index_bg']);  update_option('limiwu_style_css_url', $_POST['style_css_url']);  update_option('limiwu_home_top', $_POST['home_top']);  update_option('limiwu_jquery_url', $_POST['jquery_url']);  update_option('limiwu_bootstrap_css_url', $_POST['bootstrap_css_url']);  update_option('limiwu_bootstrap_js_url', $_POST['bootstrap_js_url']);  update_option('limiwu_other_js_url', $_POST['other_js_url']);  update_option('limiwu_load_home', $_POST['limiwu_load_home']);  update_option('limiwu_load_index', $_POST['limiwu_load_index']);  update_option('limiwu_load_single', $_POST['limiwu_load_single']);  update_option('limiwu_top_javaScript', stripslashes($_POST['top_javaScript']));  update_option('limiwu_bottom_javaScript', stripslashes($_POST['bottom_javaScript']));  update_option('limiwu_hometop_url_array', stripslashes($_POST['bottom_javaScript']));  if ($_POST['add_img_table'] == 'new') {    limiwu_add_imgTable();    limiwu_add_telTable();  }}function limwu_checked($check){  if (get_option($check)) {    echo ' checked="cheched"';  }}function limiwu_theme_setting(){ ?><div class="wrap">  <h1><?php _e('网站主题设置','limiwu')?></h1>  <hr>  <form method="POST" action="" style="padding-left:20px;">  <input type="hidden" name="limiwu_update_themeoptions" value="true" /><!-- hidden -->  <table class="form-table" role="presentation">    <tbody>      <tr>        <th scope="row"><label for="homeKeyword"><?php _e('首页关键词','limiwu')?></label></th>        <td>          <input name="homeKeyword" type="text" id="homeKeyword" value="<?php echo get_option('limiwu_homeKeyword'); ?>" class="regular-text">          <p class="description"><?php _e('多个词请使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 首页关键词 end -->      <tr>        <th scope="row"><label for="homeDescription"><?php _e('首页描述','limiwu')?></label></th>        <td>          <textarea type="text" name="homeDescription" cols="60" rows="3"><?php echo get_option('limiwu_homeDescription'); ?></textarea>        </td>      </tr><!-- 首页描述 end -->      <tr>        <th scope="row"><label for="home_top"><?php _e('自定义首页头部','limiwu')?></label></th>        <td>          <?php bloginfo('template_directory');?>/<input name="home_top" type="text" id="home_top" value="<?php echo get_option('limiwu_home_top'); ?>" class="regular-text" placeholder="文件名" style="width:6em">.php          <p class="description"><?php _e('可以自定义首页头部界面，有区别与WP自带的主页设置','limiwu')?></p>        </td>      </tr><!-- 自定义首页 end -->      <tr>        <th scope="row"><label for="limiwu_load_box"><?php _e('网页加载动画','limiwu')?></label></th>        <td><input name="limiwu_load_home" type="checkbox" value="limiwu_load_home"<?php limwu_checked('limiwu_load_home');?>/><?php _e('首页','limiwu');?> <input name="limiwu_load_index" type="checkbox" value="limiwu_load_index"<?php limwu_checked('limiwu_load_index');?>/><?php _e('列表页','limiwu');?> <input name="limiwu_load_single" type="checkbox" value="limiwu_load_single"<?php limwu_checked('limiwu_load_single');?>/><?php _e('内容页','limiwu');?>          <p class="description"><?php _e('可自行在首页、列表页、内容页面预设置加载动画','limiwu')?></p>        </td>      </tr><!-- 网页加载动画 end -->      <tr>        <th scope="row"><label for="index_bg"><?php _e('首页body背景图片','limiwu')?></label></th>        <td>          <input name="index_bg" type="url" id="index_bg" value="<?php echo get_option('limiwu_index_bg'); ?>" class="regular-text" placeholder="http(s)://">          <p class="description"><?php _e('在index.php模版页面里增加body背景图片','limiwu')?></p>        </td>      </tr><!-- index 背景图片URL end -->      <tr>        <th scope="row"><label for="top_posts"><?php _e('置顶幻灯片文章ID','limiwu')?></label></th>        <td>          <input name="top_posts" type="text" id="top_posts" value="<?php echo get_option('limiwu_top_posts'); ?>" class="regular-text" placeholder="12,24,45">          <p class="description"><?php _e('输入置顶的文章ID，添加到顶部幻灯片，多个使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 调用文章置顶为幻灯片 end -->      <tr>        <th scope="row"><label for="index_list"><?php _e('普通列表页面','limiwu')?></label></th>        <td>          <input name="index_list" type="text" id="index_list" value="<?php echo get_option('limiwu_index_list'); ?>" class="regular-text" placeholder="2,4,5">          <p class="description"><?php _e('如分类只需要普通列表页面，请输入相应分类的ID或者别名，多个使用英文半角逗号隔开','limiwu')?></p>        </td>      </tr><!-- 分类目录普通模版 end -->      <tr>        <th scope="row"><label for="favicon_ico">ICO<?php _e('图标加速','limiwu')?></label></th>        <td>          <input name="favicon_ico" type="text" id="favicon_ico" value="<?php echo get_option('limiwu_favicon_ico'); ?>" class="regular-text" placeholder="<?php _e('不包括','limiwu')?> http(s)://">          <p class="description"><?php _e('配合“文章来源”-“来源网址”使用，改变后文章图标最终输出路径为：//图标加速/来源网址/favicon.ico','limiwu')?></p>        </td>      </tr><!-- favicon_ico end -->      <tr>        <th scope="row">CDN<?php _e('加速','limiwu')?></th>        <td>          <input name="style_css_url" type="url" id="style_css_url" value="<?php echo get_option('limiwu_style_css_url'); ?>" class="regular-text" placeholder="http(s)://">/style.css<br>          <input name="jquery_url" type="url" id="jquery_url" value="<?php echo get_option('limiwu_jquery_url'); ?>" class="regular-text" placeholder="http(s)://">/jquery.min.js<br>          <input name="bootstrap_css_url" type="url" id="bootstrap_css_url" value="<?php echo get_option('limiwu_bootstrap_css_url'); ?>" class="regular-text" placeholder="http(s)://">/bootstrap.min.css<br>          <input name="bootstrap_js_url" type="url" id="bootstrap_js_url" value="<?php echo get_option('limiwu_bootstrap_js_url'); ?>" class="regular-text" placeholder="http(s)://">/bootstrap.min.js<br>          <input name="other_js_url" type="url" id="other_js_url" value="<?php echo get_option('limiwu_other_js_url'); ?>" class="regular-text" placeholder="http(s)://">/*****.js|css          <p><?php _e('相应位置插入类似代码','limiwu')?>:<br><code>&lt;?php limiwu_echo_CDN_URL('bootstrap.min.js')?&gt;<br>&lt;?php limiwu_echo_CDN_URL('bootstrap.min.css','css')?&gt;</code></p>        </td>      </tr><!-- favicon_ico end -->      <tr>        <th scope="row"><label for="top_javaScript"><?php _e('顶部JS/JQ','limiwu')?></label></th>        <td>          <textarea name="top_javaScript" cols="60" rows="5"><?php echo get_option('limiwu_top_javaScript'); ?></textarea>          <p class="description"><?php _e('网站顶部的JS/JQ代码','limiwu')?></p>        </td>      </tr><!-- 顶部JS/JQ end -->      <tr>        <th scope="row"><label for="bottom_javaScript"><?php _e('底部JS/JQ','limiwu')?></label></th>        <td>          <textarea name="bottom_javaScript" cols="60" rows="5"><?php echo get_option('limiwu_bottom_javaScript'); ?></textarea>          <p class="description"><?php _e('网站底部的JS/JQ代码','limiwu')?></p>        </td>      </tr><!-- 底部JS/JQ end -->      <tr>        <th scope="row"><label for="add_img_table"><?php _e('收藏数据表操作','limiwu')?></label></th>        <td><input type="radio" name="add_img_table" value="new" /><?php _e('新建收藏数据库','limiwu');?>  <input type="radio" name="add_img_table" value="no" checked="checked" /><?php _e('正常运行','limiwu');?>          <p class="description"><?php _e('新主题运行请先新建数据库','limiwu')?></p>        </td>      </tr><!-- 数据库创建 end -->      <?php if(get_option('limiwu_home_top') == 'hometop'):?>      <tr>        <th scope="row"><label for="hometop_url_array">hometop<?php _e('页面网址','limiwu')?></label></th>        <td>          <textarea name="hometop_url_array" cols="60" rows="5"><?php echo get_option('limiwu_hometop_url_array'); ?></textarea>          <p class="description">hometop<?php _e('对应的9个图标的网址','limiwu')?></p>        </td>      </tr><!-- hometop页面网址 end -->      <?php endif;?>    </tbody>  </table>    <p><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('提交修改','limiwu') ?>">    </p>  </form></div><?php }?>