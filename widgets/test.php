<?php
/**
 * 给主题增加了小工具（widget）侧栏
 * 参考文章：//blog.csdn.net/hanshileiai/article/details/38444903
 * 参考文章：//zhidao.baidu.com/question/1510965831139235700.html
 *
 * @package limiwuCom
 * @author //blog.csdn.net/hanshileiai/article/details/38444903
 * @since 2019-9-26
 */
class My_Widget extends WP_Widget { //继承了 WP_Widget 这个类来创建新的小工具(Widget)
    function My_Widget() {
        // 主要内容方法
        $widget_ops = array('description' => '一个简单的小测试');
        $control_ops = array('width' => 400, 'height' => 300);
        parent::WP_Widget(false,$name='一个简单的Widget',$widget_ops,$control_ops);  
        //parent::直接使用父类中的方法
        //$name 这个小工具的名称,
        //$widget_ops 可以给小工具进行描述等等。
        //$control_ops 可以对小工具进行简单的样式定义等等。
    }
 
    function form($instance) {
         // 给小工具(widget) 添加表单内容
        $title = esc_attr($instance['title']);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php
    }
 
    function update($new_instance, $old_instance) {
         // 进行更新保存
        return $new_instance;
    }
 
    function widget($args, $instance) {
        // 输出显示在页面上
            extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('小测试') : $instance['title']);

        echo $before_widget;
        if ( $title ){
            echo $before_title . $title . $after_title;
        }else{
            echo $after_widget;
        }
    }
 
}

register_widget('My_Widget');//输出侧栏

?>