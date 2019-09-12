<?php get_header();?>
	<div class="jumbotron">
		<div class="container">
			<h2><?php single_post_title(); ?></h2>
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="<?php echo get_avatar( get_the_author_email(), '60' );?>" alt="...">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading"><?php echo the_slug();?></h4>
					<p></p>
				</div>
			</div>
			
		</div>
	</div>
	<div class="container">
		<div class="cow">
			<div class="col-sm-8">
				<?php 
				while ( have_posts() ) {
					the_post();
					the_content();
				}
				?>
			</div>
			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php get_footer();?>