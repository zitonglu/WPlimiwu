<?php
/**
 * limiwu.com functions and definitions
 * 本主题所用到的相关函数
 * 所有自定义函数请使用limiuw_为前缀
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 */

// 加载语言包-这个记得最后弄
// add_action('after_setup_theme', 'limiwu_language_setup');
// function limiwu_language_setupp(){
//     load_theme_textdomain('limiwu', get_template_directory() . '/languages');
// }

// 主题相关设置参数
require_once(TEMPLATEPATH . '/option-setting.php');
// 收藏图片功能
require_once(TEMPLATEPATH . '/option-savepic.php');
// 电话信息统计页面，只有管理员能看
require_once(TEMPLATEPATH . '/option-tel.php');
// 开启主题的小工具
if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => __('文章右侧栏','limiwu'),
        'description'   => __('放置在文章页面右侧，随滚动','limiwu'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('普通列表右侧栏','limiwu'),
        'description'   => __('放置在列表右侧','limiwu'),
        'before_widget' => '<section class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('首页AD广告位','limiwu'),
        'description'   => __('建议用250PX宽的，只在大屏显示','limiwu'),
        'before_widget' => '<div class="col-lg-wu1 visible-lg-inline masonrybox" style="overflow:hidden">',
        'after_widget' => '</div>',
        'before_title' => '<h2 style="display:none">',
        'after_title' => '</h2>'
    ));
    register_nav_menus( array(
    'primary' => __('顶部导航', 'limiwu'),
    'link' => __('友情链接', 'limiwu')
    ));
}

require_once( dirname(__FILE__) . '/widgets/test.php' );//测试小侧栏
require_once( dirname(__FILE__) . '/option-walker.php' );//重新生产bootstrap顶部导航

//移除评论文本自动P标签
remove_filter( 'comment_text', 'wpautop',  30 );
// 开启缩略图功能
add_theme_support('post-thumbnails');
// 开启文章相关形式
add_theme_support('post-formats', array('chat','aside','image', 'video', 'link') );
/**
 * 根据文章格式调用不同的模版
 * 设置了相关文章形式后，如果对应文件存在就调用，没有就调用默认的。
**/
function limiwu_load_single_style() {
    global $post;
    $this_post_format = get_post_format($post);
    $have_post_format = array('image');
    $path = TEMPLATEPATH . '/single-'.$this_post_format.'.php';
    if (in_array($this_post_format, $have_post_format) && file_exists($path)){
        return $path;
    }else{
        return TEMPLATEPATH . '/single.php';
    }
}
add_filter('single_template', 'limiwu_load_single_style');
/**
 * CDN加速
 * 直接输出返回CDN的URL地址
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-10-20
 * @return url
 */
function limiwu_echo_CDN_URL($name,$type='js'){
    $options = array(
        'style.css' => 'limiwu_style_css_url',
        'jquery.min.js' => 'limiwu_jquery_url',
        'bootstrap.min.css' => 'limiwu_bootstrap_css_url',
        'bootstrap.min.js' => 'limiwu_bootstrap_js_url',
        'other' => 'limiwu_other_js_url'
    );
    if (!empty($options[$name])) {
        $url = $options[$name];
    }else{
        $url = $options['other'];
    }

    if($name == 'style.css'){
        $blog_url = get_bloginfo('template_url').'/'.$name;
    }else{
        $blog_url = get_bloginfo('template_url').'/'.$type.'/'.$name;
    }
    if (get_option($url)) {
        $test_url = get_option($url).'/'.$name;
        // if (@fopen($test_url,'r')) {
        $blog_url = $test_url;
        // }
    }
    echo $blog_url;
}
/**
 * 版权申明
 * 直接输出部分
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-10-17
 */
function limiwu_echo_copyright() {
    global $post;
    echo '<h4 class="Copyright" id="CopyrightTitle">'.__('版权声明','limiwu').'</h4>';
    if(!get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
        echo '<p class="Copyright">'.__('本文来源','limiwu').get_bloginfo('name').__('，经','limiwu').get_bloginfo('name').__('授权发布，版权归作者','limiwu');
        the_author_posts_link();
        _e('所有。转载或内容合作请查阅转载说明，违规转载法律必究。','limiwu');
        echo '</p>';
    }else{
        echo '<p class="Copyright">'.__('本文来源于网络','limiwu');
        if(!get_post_meta( $post->ID, '_limiwu_source_author', true )){
            echo __('，经','limiwu');
            the_author_posts_link();
            echo __('编译创作','limiwu');
        }
        _e('，如若涉及版权问题，请联系网站管理员。','limiwu');
        echo '</p>';
    }
}
/**
 * 文章页面作者相关信息
 * 直接输出部分
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-10-19
 */
function limiwu_echo_list_editName(){
    global $post;
    //文章作者名字
    if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
        echo '<a href="'.get_the_permalink().'" target="_blank" title="'.get_the_title().'">';
        echo get_post_meta( $post->ID, '_limiwu_source_remarks', true );
        echo '</a>';
            if(!get_post_meta( $post->ID, '_limiwu_source_author', true )){
                echo ' <i class="glyphicon glyphicon-random" aria-hidden="true"></i>';
                _e('编译','limiwu');
            }
    }else{
        the_author_posts_link($post->ID);
        echo ' <i class="glyphicon glyphicon-paperclip" aria-hidden="true"></i>';
        _e('原创','limiwu');
    }
}
/**
 * ICO图标加速
 * 如果设置了ICO图标加速，则ICO用加速上的，没有就用别人网站上的，别人网站也没有就用自己网站上的
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-10-11
 */
function limiwu_ico_url(){
    global $post;
    if(get_post_meta( $post->ID, '_limiwu_source', true )){
        $ICO_url = get_post_meta( $post->ID, '_limiwu_source', true );
        $ICO_url = $ICO_url.'/favicon.ico';
        if(get_option('limiwu_favicon_ico')){
            $ICO = 'http://'.get_option('limiwu_favicon_ico').'/'.$ICO_url;
            if (@fopen($ICO,'r')) {
                $ICO_url = get_option('limiwu_favicon_ico').'/'.$ICO_url;
            }
        }
    }else{
        $ICO_url = bloginfo('template_url').'/image/favicon.ico';
    }
    return '//'.$ICO_url;
}
/**
 * 获取文章别名函数
 * 直接调取文章的别名功能
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-9-12
 */
function limiwu_the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}
/**
 * 获取自定义首页头部界面
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-11-24
 */
function limiwu_homeTop_page($home_top='',$php='php') {
    //$home_top = get_option('limiwu_home_top');
    if (!empty($home_top) && is_home()) {
        $url = get_bloginfo('template_directory').'/'.$home_top.'.'.$php;
        $home_url = '/'.preg_replace('/\//','\/',home_url('/')).'/';
        $file_url = preg_replace($home_url,'',$url);//费劲的正则，因为反斜杠的原因
        if (file_exists($file_url)) {
            require_once($file_url);
        }else{
            echo '<div class="alert alert-danger" role="alert">';
            _e('未找到对应的文件路径，请检查','limiwu');
            echo $url;
            _e('路径是否正确','limiwu');
            echo '</div>';
        }
    }
}
/**
 * 让主题增加识别webp格式图片
 * 
 * @package limiwuCom
 * @author //blog.csdn.net/sunboy_2050/article/details/103722422
 * @since 2020-4-4
 */
//添加可以上传
function limiwu_add_webp( $array ) {
    $array['webp'] = 'image/webp';
    return $array;
}
add_filter('mime_types','limiwu_add_webp',10,1);
//添加媒体识别
function limiwu_add_image_webp($result, $path) {
    $info = @getimagesize($path);
    if($info['mime'] == 'image/webp') {
        $result = true;
    }
    return $result;
}
add_filter('file_is_displayable_image','limiwu_add_image_webp',10,2);

/**
 * 文章编辑侧板增加文章来源、缩略图网址功能
 * * 文章来源用户展示文章出处
 * * 缩略图功能用于手动输入文章缩略图、置顶PPT图的网址 
 * 
 * @package limiwuCom
 * @author //www.boke8.net/wordpress-post-type-meta-box.html
 * @since 2019-10-14
 */
//添加设置区域的函数
function limiwu_add_source_box (){
	add_meta_box('source', __('文章来源','limiwu'), 'limiwu_add_source','post','side');
    add_meta_box('dateNumber', __('日记编号','limiwu'), 'limiwu_add_dateNumber','post','side');
};

add_action('add_meta_boxes','limiwu_add_source_box');//挂上
//显示设置区域的回调函数
function limiwu_add_source($post,$boxargs){
	// 创建临时隐藏表单，为了安全
    wp_nonce_field( 'limiwu_add_source', 'limiwu_add_source_nonce' );
    // 获取之前存储的值
    $limiwu_source_value = get_post_meta( $post->ID, '_limiwu_source', true );
    $limiwu_source_remarks_value = get_post_meta( $post->ID, '_limiwu_source_remarks', true );
    $limiwu_source_author_value = get_post_meta( $post->ID, '_limiwu_source_author', true );
?>
    <label for="limiwu_source"><?php _e('来源网站网址','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source" name="limiwu_source" value="<?php echo esc_attr( $limiwu_source_value ); ?>" placeholder="<?php _e('输入网址，不含http','limiwu');?>">
    <label for="limiwu_source_remarks"><?php _e('来源网站名称','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source_remarks" name="limiwu_source_remarks" value="<?php echo esc_attr( $limiwu_source_remarks_value ); ?>" placeholder="<?php _e('来源网站名称','limiwu');?>">
    <label for="limiwu_source_author"><?php _e('作者/发布者','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source_author" name="limiwu_source_author" value="<?php echo esc_attr( $limiwu_source_author_value ); ?>" placeholder="<?php _e('发布者或单位名称','limiwu');?>">
<?php
}
function limiwu_add_dateNumber($post,$boxargs){
    // 创建临时隐藏表单，为了安全
    wp_nonce_field( 'limiwu_add_dateNumber', 'limiwu_add_dateNumber_nonce' );
    // 获取之前存储的值
    $limiwu_dateNumber_url_value = get_post_meta( $post->ID, '_limiwu_dateNumber_url', true );
?>
    <input style="width: 100%" type="url" id="limiwu_dateNumber_url" name="limiwu_dateNumber_url" value="<?php echo esc_attr($limiwu_dateNumber_url_value); ?>" placeholder="ID0000">
<?php
}

add_action( 'save_post', 'limiwu_add_source_save_meta_box' );//验证保存内容
add_action( 'save_post', 'limiwu_add_dateNumber_save_meta_box' );//验证保存内容

function limiwu_add_source_save_meta_box($post_id){
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if (!isset($_POST['limiwu_add_source_nonce'])){return;}
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['limiwu_add_source_nonce'],'limiwu_add_source')){return;}
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)){return;}
    // 判断 Meta Box 是否为空
    if (!isset( $_POST['limiwu_source'])){return;}
 
    $limiwu_source = sanitize_text_field( $_POST['limiwu_source'] );
    update_post_meta( $post_id, '_limiwu_source', $limiwu_source );
    $limiwu_source_remarks = sanitize_text_field( $_POST['limiwu_source_remarks'] );
    update_post_meta( $post_id, '_limiwu_source_remarks', $limiwu_source_remarks );
    $limiwu_source_author = sanitize_text_field( $_POST['limiwu_source_author'] );
    update_post_meta( $post_id, '_limiwu_source_author', $limiwu_source_author );
}

function limiwu_add_dateNumber_save_meta_box($post_id){
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if (!isset($_POST['limiwu_add_dateNumber_nonce'])){return;}
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['limiwu_add_dateNumber_nonce'],'limiwu_add_dateNumber')){return;}
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)){return;}
    // 判断 Meta Box 是否为空
    if (!isset( $_POST['limiwu_source'])){return;}
 
    $limiwu_dateNumber_url = sanitize_text_field( $_POST['limiwu_dateNumber_url'] );
    update_post_meta( $post_id, '_limiwu_dateNumber_url', $limiwu_dateNumber_url );
    $limiwu_PPT_url = sanitize_text_field( $_POST['limiwu_PPT_url'] );
    update_post_meta( $post_id, '_limiwu_PPT_url', $limiwu_PPT_url );
}
/**
 * WordPress 添加额外选项字段到常规设置页面
 * www.wpdaxue.com/add-field-to-general-settings-page.html
 */
$new_general_setting = new new_general_setting();
class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'limiwu_get_ICP', 'esc_attr' );
        add_settings_field('fav_color', '<label for="limiwu_get_ICP">'.__('备案号','limiwu').'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option('limiwu_get_ICP','');
        echo '<input type="text" id="limiwu_get_ICP" name="limiwu_get_ICP" value="'.$value.'" />';
    }
}
//WordPress 5.0+移除 block-library CSS
function fanly_remove_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'fanly_remove_block_library_css', 100 );

/**
 * WordPress 修改时间的显示格式为XXX秒、分钟、小时、天前
 * form www.chendexin.com/archives/137.html
 */
function past_date(){
    $suffix=__('前','limiwu');
    $endtime='2419200';
    $day = __('天','limiwu');
    $hour = __('小时','limiwu');
    $minute = __('分钟','limiwu');
    $second = __('秒','limiwu');
    if ($_SERVER['REQUEST_TIME'])
        $now_time = $_SERVER['REQUEST_TIME'];
    else
        $now_time = time();
        $m = 60; // 一分钟
        $h = 3600; //一小时有3600秒
        $d = 86400; // 一天有86400秒
        $endtime = (int)$endtime; // 结束时间
        $post_time = get_post_time('U', true);
        $past_time = $now_time - $post_time; // 文章发表至今经过多少秒
        if($past_time < $m){ //小于1分钟
            $past_date = $past_time . $second;
        }else if ($past_time < $h){ //小于1小时
            $past_date = $past_time / $m;
            $past_date = floor($past_date);
            $past_date .= $minute;
        }else if ($past_time < $d){ //小于1天
            $past_date = $past_time / $h;
            $past_date = floor($past_date);
            $past_date .= $hour;
        }else if ($past_time < $d*8){
            $past_date = $past_time / $d;
            $past_date = floor($past_date);
            $past_date .= $day;
        }else{
            echo get_post_time('Y-m-d');
            return;
        }
    echo $past_date . $suffix;
}
add_filter('the_time', 'past_date');
//修改文章形成的名字
function rename_post_formats($safe_text){
    if($safe_text == '聊天' ) return '问答';
        return $safe_text;
    } 
add_filter('esc_html','rename_post_formats');
/**
 * 去除window._wpemojiSettings
 * WordPress版本 zhangwenbao.com/wordpress-window-wpemojisettings.html
 * 查看Wordpress源文件的时候，会看到head头部加载了一大片window._wpemojiSettings开头的JS和CSS代码，这是用于支持emjo表情的脚本。对于大部分国内站长来说，这个是十分鸡肋的功能
**/
remove_action( 'admin_print_scripts', 'print_emoji_detection_script');
remove_action( 'admin_print_styles', 'print_emoji_styles');
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles', 'print_emoji_styles');
remove_filter( 'the_content_feed', 'wp_staticize_emoji');
remove_filter( 'comment_text_rss', 'wp_staticize_emoji');
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email');
/**
 * 加入图片收藏数据库表limiwu_add_imgTable();
 * 加入信息收藏表limiwu_add_telTable();
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-12-6
 */
function limiwu_add_imgTable(){
    global $wpdb;
    $table_name = $wpdb->prefix . "imgTable";
    // $sql = "TRUNCATE TABLE `". $table_name."`;";好像无法删除数据库表中内容
    $sql = "CREATE TABLE `" . $table_name . "`(
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        user_id Integer NOT NULL,
        post_id Integer NOT NULL,
        customer_id Integer NOT NULL,
        src Text DEFAULT '' NOT NULL,
        UNIQUE KEY id (id),
        CONSTRAINT uc_PersonID UNIQUE (user_id,post_id,customer_id)
    );";
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    dbDelta($sql);
}
function limiwu_add_telTable(){
    global $wpdb;
    $table_name = $wpdb->prefix . "telTable";
    $sql = "CREATE TABLE `" . $table_name . "`(
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        name char(50) NOT NULL,
        tel char(30) NOT NULL,
        address char(50) DEFAULT '0',
        state char(50) DEFAULT 'Limiwu',
        UNIQUE KEY id (id),
        CONSTRAINT tel_PersonID UNIQUE (tel)
    );";
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    dbDelta($sql);
}
/**
 * 更新数据库表中的内容，有就更新，没有返回
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-11-9
 * @return dbtalbe 0 or 1
 */
function limiwu_update($src,$user,$post,$customer){
    global $wpdb;
    $src = $wpdb->escape($src);
    $user = $wpdb->escape($user);
    $post = $wpdb->escape($post);
    $customer = $wpdb->escape($customer);
    $table_name = $wpdb->prefix . "imgTable";
    $table_name = $wpdb->escape($table_name);

    $sql = $wpdb->update(
        $table_name,
        array(
            'src' => $src,
            'time' => date('Y-m-d h:i:s')
        ),
        array(
            'user_id' => $user,
            'post_id' => $post,
            'customer_id' => $customer
        )
    );
    return $sql;
}
/**
 * 增加数据库表
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-11-9
 * @return dbtalbe 0 or 1
 */
function limiwu_INSERT_INTO($src,$user,$post,$customer){
    global $wpdb;
    if(limiwu_update($src,$user,$post,$customer) == 0){
        $src = $wpdb->escape($src);
        $user = $wpdb->escape($user);
        $post = $wpdb->escape($post);
        $customer = $wpdb->escape($customer);
        $table_name = $wpdb->prefix . "imgTable";
        $table_name = $wpdb->escape($table_name);

        $sql = $wpdb->insert(
            $table_name,
            array(
                'src' => $src,
                'user_id' => $user,
                'post_id' => $post,
                'customer_id' => $customer
            )
        );

        if ($sql == 0) {
            echo '没有插入成功';
        }
    }
}
/**
 * 查询数据库，返回用户收藏图片和客户ID的数组值
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-11-10
 * @return array
 */

function limiwu_select_dbtable($post,$user){
    global $wpdb;
    $post = $wpdb->escape($post);
    $user = $wpdb->escape($user);
    $table_name = $wpdb->prefix . "imgTable";
    $table_name = $wpdb->escape($table_name);

    $sql = $wpdb->get_results("SELECT `src`,`customer_id` FROM $table_name WHERE `post_id` = $post AND `user_id`= $user order by `time` DESC limit 1");
    foreach ($sql as $array) {
        $arr['src'] = $array->src;
        $arr['cid'] = $array->customer_id;
    }
    return $arr;
}

/**
 * 后台增加style和JS
 * www.518theme.com/wpcourse/wordpress-admin-my.html
 * www.boke8.net/wordpress-wp_enqueue_script.html
 *
 */
function admin_mycss() {
    wp_enqueue_style( "admin-stlye", get_template_directory_uri() . "/css/admin.css" );
    wp_enqueue_style( "viewer-style", get_template_directory_uri() . "/css/viewer.min.css" );
}
add_action('admin_head', 'admin_mycss');
function admin_scripts() {
    wp_enqueue_script( "jqueryUI", get_template_directory_uri()."/js/jquery.min.js" , '', false, true);
    wp_enqueue_script( "viewer-jquery", get_template_directory_uri()."/js/viewer-jquery.min.js" , '', false, true);
    wp_enqueue_script( "viewer-jquery-id", get_template_directory_uri()."/js/viewer-jquery-id.js" , '', false, true);
}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );
/**
 * 修改wordpress网站登录界面
 * 隐藏H1界面，背板变更为默认的
 *
**/
function limiwu_custom_loginlogo() {
  echo '<style type="text/css">h1 a {display:none !important}body{background-image:url('.get_bloginfo('template_directory').'/image/pixels.png)}</style>';
}
add_action('login_head', 'limiwu_custom_loginlogo');
/**
 * 七牛图片自动添加瘦身命令
 * WordPress版本 www.aeink.com/454.html
 * 网址是写死的,必须放在fun最后
**/
function QiNiuShouShen(){
    function Rewrite_URI($htmlSS){
        /* 七牛图片瘦身目前仅支持jpg|png|jpeg,前面是引用七牛图片的自定义地址，如abc.qiniudn.com */
        $patternSS ='/src=\"https?:\/\/img\.limiwu\.com\/([^"\']*?)\.(jpg|png|jpeg)/i';
        /* 自动添加七牛图片瘦身命令?imageslim */
        $replacementSS = 'src="http://img.limiwu.com/$1.$2?imageslim';
    $htmlSS = preg_replace($patternSS, $replacementSS,$htmlSS);
    return $htmlSS;
    }
    if(!is_admin()){
        ob_start("Rewrite_URI");
    }
}
add_action('init', 'QiNiuShouShen');
?>