<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only"><?php bloginfo('name'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logoImg" href="<?php echo home_url('/');?>"><img alt="Brand" src="<?php bloginfo('template_url'); ?>/image/favicon.ico"></a> 
      <a class="navbar-brand logoText" href="<?php echo home_url('/');?>"><?php bloginfo('name'); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php 
        if ( has_nav_menu( 'primary' )) {
           wp_nav_menu( array(  
            'theme_location' => 'primary',  
            'depth' => 2,   
            'container' => false,   
            'menu_class' => 'nav navbar-nav navbar-right',   
            'fallback_cb' => 'wp_page_menu',   
            //添加或更改walker参数   
            'walker' => new wp_bootstrap_navwalker())   
            );
        }
      ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>