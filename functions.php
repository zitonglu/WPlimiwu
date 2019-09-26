<?php
/**
 * limiwu.com functions and definitions
 * 本主题所用到的相关函数
 * 所有自定义函数请使用limiuw_为前缀
 *
 * @package limiwuCom
 * @author annanzi/910109610@qq.com
 */

// 开启主题的小工具
if( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<li>', // widget 的开始标签
        'after_widget' => '</li>', // widget 的结束标签
        'before_title' => '<h3>', // 标题的开始标签
        'after_title' => '</h3>' // 标题的结束标签
    ));
}
// 开启缩略图功能
add_theme_support( 'post-thumbnails' );
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
	add_meta_box('source', '文章来源', 'limiwu_add_source','post','side');
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
    <label for="limiwu_source">来源网址：</label>
    <input style="width: 100%" type="url" id="limiwu_source" name="limiwu_source" value="<?php echo esc_attr( $limiwu_source_value ); ?>" placeholder="输入文章来源地址">
    <label for="limiwu_source_remarks">来源网站名称：</label>
    <input style="width: 100%" type="text" id="limiwu_source_remarks" name="limiwu_source_remarks" value="<?php echo esc_attr( $limiwu_source_remarks_value ); ?>" placeholder="备注说明">
    <label for="limiwu_source_author">作者/发布者：</label>
    <input style="width: 100%" type="text" id="limiwu_source_author" name="limiwu_source_author" value="<?php echo esc_attr( $limiwu_source_author_value ); ?>" placeholder="发布者或单位名称">
<?php
}

add_action( 'save_post', 'limiwu_add_source_save_meta_box' );//验证保存内容

function limiwu_add_source_save_meta_box($post_id){
    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if ( ! isset( $_POST['limiwu_add_source_nonce'] ) ) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if ( ! wp_verify_nonce( $_POST['limiwu_add_source_nonce'], 'limiwu_add_source' ) ) {
        return;
    }
    // 判断该用户是否有权限
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 
    // 判断 Meta Box 是否为空
    if ( ! isset( $_POST['limiwu_source'] ) ) {
        return;
    }
 
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
        add_settings_field('fav_color', '<label for="limiwu_get_ICP">'.__('备案号' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'limiwu_get_ICP', '' );
        echo '<input type="text" id="limiwu_get_ICP" name="limiwu_get_ICP" value="'.$value.'" />';
    }
}

require_once( dirname(__FILE__) . '/widgets/test.php' );//测试小侧栏