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
        'description'   => __('临时决定，暂留位','limiwu'),
        'before_widget' => '<div id="indexAD" class="col-lg-wu1 col-md-3 col-sm-4 col-xs-6 item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
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
add_theme_support( 'post-thumbnails' );
// 开启文章相关形式
add_theme_support('post-formats', array('aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery') );
/**
 * 获取文章的缩略图
 * 如果设置了缩略图，则显示，没有找文章的第一张图片，还没有的话就用默认图片
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 * @since 2019-9-10
 */
function limiwu_post_first_img() {
	global $post;
	if (has_post_thumbnail()) {
			return the_post_thumbnail();
		}else{// 获取缩略图
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post->post_content), $matches);
		if(empty($output)){ 
			$first_img = get_template_directory_uri().'/image/coffee.jpg';
		}else {
			$first_img = $matches [1][0];
		}
		echo '<img src="'.$first_img.'" alt="'.get_the_title().'" />';
	}
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
 * 文章编辑侧板增加文章来源功能
 * 如果设置了缩略图，则显示，没有找文章的第一张图片，还没有的话就用默认图片
 *
 * @package limiwuCom
 * @author //www.boke8.net/wordpress-post-type-meta-box.html
 * @since 2019-9-12
 */
//添加设置区域的函数
function limiwu_add_source_box (){
	add_meta_box('source', __('文章来源','limiwu'), 'limiwu_add_source','post','side');
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
    <label for="limiwu_source"><?php _e('来源网址','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source" name="limiwu_source" value="<?php echo esc_attr( $limiwu_source_value ); ?>" placeholder="<?php _e('输入网址，不含http','limiwu');?>">
    <label for="limiwu_source_remarks"><?php _e('来源网站名称','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source_remarks" name="limiwu_source_remarks" value="<?php echo esc_attr( $limiwu_source_remarks_value ); ?>" placeholder="<?php _e('来源网站名称','limiwu');?>">
    <label for="limiwu_source_author"><?php _e('作者/发布者','limiwu');?>:</label>
    <input style="width: 100%" type="text" id="limiwu_source_author" name="limiwu_source_author" value="<?php echo esc_attr( $limiwu_source_author_value ); ?>" placeholder="<?php _e('发布者或单位名称','limiwu');?>">
<?php
}

add_action( 'save_post', 'limiwu_add_source_save_meta_box' );//验证保存内容

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
 * 七牛图片自动添加瘦身命令
 * WordPress版本 //www.aeink.com/454.html
 * 这个命令中的网址是写死的，其他主题需要自行修改
**/
function QiNiuShouShen(){
    function Rewrite_URI($htmlSS){
        /* 七牛图片瘦身目前仅支持jpg|png|jpeg,前面是引用七牛图片的自定义地址，如abc.qiniudn.com */
        $patternSS ='/\/\/img\.limiwu\.com\/([^"\']*?)\.(jpg|png|jpeg)/i';
        /* 自动添加七牛图片瘦身命令?imageslim */
        $replacementSS = '//img.limiwu.com/$1.$2?imageslim';
    $htmlSS = preg_replace($patternSS, $replacementSS,$htmlSS);
    return $htmlSS;
    }
    if(!is_admin()){
        ob_start("Rewrite_URI");
    }
}
add_action('init', 'QiNiuShouShen');