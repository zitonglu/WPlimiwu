<footer class="footer">
    <p>
        Copyright © 2019-2020 <a href="<?php bloginfo('url'); ?>/wp-admin" target="_blank"><?php bloginfo('name'); ?></a> <span class="glyphicon glyphicon-pencil"></span> 
        <a href="//beian.miit.gov.cn/" rel="nofollow" target="_blank">
<?php echo get_option( 'limiwu_get_ICP' );?></a> <!--网站备案号-->
        <span class="glyphicon glyphicon-tree-deciduous"></span> <a href="<?php bloginfo('rdf_url'); ?>" target="_blank">RSS</a> 
        Powered By <a href="//cn.wordpress.org" rel="nofollow" target="_blank">WordPress</a>. Theme by <a href="//www.limiwu.com" target="_blank">limiwu.com</a>
        <?php _e('商业授权版','limiwu' );?> 
        <a href="<?php bloginfo('url'); ?>/sitemap.xml" target="_blank">SiteMap</a>
    </p>
</footer>

<!-- Bootstrap JS -->
<script src="<?php limiwu_echo_CDN_URL('bootstrap.min.js')?>"></script>

<?php if( is_single() || is_page()):?>
    <!-- 侧栏滚动 -->
    <script src="<?php limiwu_echo_CDN_URL('theia-sticky-sidebar.js')?>"></script>
    <!-- 图片大图JS -->
    <script src="<?php limiwu_echo_CDN_URL('viewer-jquery.min.js')?>"></script>
    <!-- 本模版使用的limiwu-single-JS -->
    <script src="<?php bloginfo('template_url')?>/js/limiwu-single.js"></script>
<?php elseif(is_home() || is_category()):?>
    <!-- 瀑布流 JS -->
    <script src="<?php limiwu_echo_CDN_URL('masonry.min.js')?>"></script>
    <!-- 无限下拉 JS -->
    <script src="<?php limiwu_echo_CDN_URL('infinitescroll.min.js')?>"></script>
    <!-- 加载图片 JS -->
    <script src="<?php limiwu_echo_CDN_URL('imagesloaded.min.js')?>"></script>
    <?php if(get_option('limiwu_home_top') == 'hometop'){ ?>
        <!-- 小气球上升动画 JS -->
        <script src="<?php limiwu_echo_CDN_URL('circle-effect.js')?>"></script>
        <!-- 计算器 JS -->
        <script src="<?php echo bloginfo('template_url')?>/js/calculator.min.js"></script>
    <?php } ?>
    <!-- 本模版使用的limiwu-index-JS -->
    <script src="<?php bloginfo('template_url')?>/js/limiwu-index.js"></script>
<?php endif ?>
<?php echo get_option('limiwu_bottom_javaScript');?>
<?php wp_footer(); ?>
</body>
</html>
<!-- 网页打开时间：<?php timer_stop(1); ?>秒 -->
<!-- 调用数据库次数：<?php echo get_num_queries(); ?>次 -->