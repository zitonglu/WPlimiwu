<!-- JQ and Bootstrap JS -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script> -->
<!-- 瀑布流 JS -->
<script src="<?php bloginfo('template_url'); ?>/js/masonry.min.js"></script>
<!-- 加载图片 JS -->
<script src="<?php bloginfo('template_url'); ?>/js/imagesloaded.min.js"></script>
<script>
    $(function() {
        var masonryNode = $('#masonry');
        masonryNode.imagesLoaded(function(){
            masonryNode.masonry({
                itemSelector: '.item'
            });
        });   
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 显示次数：<?php echo get_num_queries(); ?>次 -->