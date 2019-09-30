<?php
/*
Template Name: 单页面模版
*/
?>
<?php get_header();?>
	<div class="container content">
		<div class="cow">
			<?php 
				while(have_posts()){
					the_post();
					the_content();
			}?>
		</div>
	<?php comments_template();?>
	</div>
<?php get_footer();?>