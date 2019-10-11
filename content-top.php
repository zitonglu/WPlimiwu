<?php 
if (!get_option('limiwu_top_posts')) {
	$top_posts = get_posts("include=".get_option('limiwu_top_posts'));
	if($top_posts){
		$number = count($top_posts);
		echo '<div class="jumbotron ppt"><div class="container"><div id="myCarousel" class="carousel slide">';
		echo '<ol class="carousel-indicators">';
		for ($i=0; $i < $number; $i++) { 
			echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"';
			if($i == 0){echo ' class="active"></li>';}else{echo '></li>';};
		}//Indicators
		echo '</ol><div class="carousel-inner" role="listbox">';
		$n = 0;
		foreach ($top_posts as $post) {
			setup_postdata($post);
			if($n == 0){$active = ' active';}else{$active = null;}
			$n ++;
?>
	<div class="item media<?php echo $active;?>" id="post-<?php the_ID(); ?>">
	  <div class="media-left">
	    <a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>">
	      <?php limiwu_post_first_img();?>
	    </a>
	  </div>
	  <div class="media-body">
	    <h4 class="media-heading"><a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><?php echo get_the_title(); ?></a></h4>
	    <p><a href="<?php the_permalink(); ?>" target="_blank" class="title" title="<?php the_title_attribute(); ?>"><?php echo get_the_excerpt();?></a></p>
	  </div>
	</div>
<?php }//end while?>
</div><!-- end Wrapper for slides -->
<!-- Controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
</a>
		</div><!-- end myCarousel -->
	</div><!-- end container -->
</div><!-- end jumbotron -->
<?php }//$top_posts end
}?>