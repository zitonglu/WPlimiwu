<footer class="footer">
    <p>
        Copyright © 2019-2020 <a href="<?php bloginfo('url'); ?>/wp-admin" target="_blank"><?php bloginfo('name'); ?></a> <span class="glyphicon glyphicon-pencil"></span> 
        <a href="//beian.miit.gov.cn/" rel="nofollow" target="_blank">
<?php echo get_option( 'limiwu_get_ICP' );?></a> <!--网站备案号-->
        <span class="glyphicon glyphicon-tree-deciduous"></span> <a href="<?php bloginfo('rdf_url'); ?>" target="_blank">RSS</a> 
        Powered By <a href="//cn.wordpress.org" rel="nofollow" target="_blank">WordPress</a>. Theme by <a href="//limiwu.com" target="_blank">limiwu.com</a>
    </p>
</footer>
<!-- JQ and Bootstrap JS -->
<script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script> -->
<?php if( is_single() || is_page()):?>
    <!-- 侧栏滚动 -->
    <script src="<?php bloginfo('template_url'); ?>/js/theia-sticky-sidebar.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        jQuery('.sidebar').theiaStickySidebar({
          // Settings
          additionalMarginTop: 30
        });
      });
    </script>
<?php else:?>
    <!-- 瀑布流 JS -->
    <script src="<?php bloginfo('template_url'); ?>/js/masonry.min.js"></script>
    <!-- 无限下拉 JS -->
    <script src="<?php bloginfo('template_url'); ?>/js/infinitescroll.min.js"></script>
    <!-- 加载图片 JS -->
    <script src="<?php bloginfo('template_url'); ?>/js/imagesloaded.min.js"></script>
    <script type="text/javascript">
        var $container = $('#masonry');
        $('#masonry').imagesLoaded(function(){
            $('#masonry').masonry({
                itemSelector: '.item',
            });
        });
        $('#masonry').infinitescroll({
                navSelector : "#nav-below",
                nextSelector: "#nav-below #older_posts a",
                itemSelector: "#masonry div.item",
                extraScrollPx: 10, //滚动条距离底部多少像素的时候开始加载，默认150
                bufferPx     : 40,//载入信息的显示时间，时间越大，载入信息显示时间越短
                animate      : true, //当有新数据加载进来的时候，页面是否有动画效果，默认没有
            },function(newElements) {
        　　　　　//先隐藏
                var $newElems = $( newElements ).css({ opacity: 0 });
                $newElems.imagesLoaded(function(){
        　　　　　　//图片显示后再进行masonry渲染
                  $newElems.animate({ opacity: 1 });
                  $container.masonry( 'appended', $newElems, true );
                });
            });
    </script>
<?php endif ?>
<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 显示次数：<?php echo get_num_queries(); ?>次 -->