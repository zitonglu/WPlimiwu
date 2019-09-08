<?php get_header();?>
	<div class="jumbotron">
		<div class="container">
			<h2><?php single_post_title(); ?></h2>
			<p><?php the_time('Y-h-d'); ?></p>
		</div>
	</div>
	<div class="container">
		<p>http://baijiahao.baidu.com/s?id=1643985803757774318</p>
		<?php the_content(); ?>
	</div>
<?php get_footer();?>