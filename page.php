<?php get_header();?>
	<div class="container content">
		<div class="cow">
			<?php 
				while(have_posts()){
					the_post();
					the_content();
			}?>
		</div>
	<?php comments_template();//打开评论 ?>
	</div>
<?php get_footer();?>