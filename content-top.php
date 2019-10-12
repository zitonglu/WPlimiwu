<?php 
if (get_option('limiwu_top_posts')) {
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
		<div class="title-img"><a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>">
	<?php if(get_post_meta($post->ID, 'PPT', true)){
        echo '<img src="'.get_post_meta($post->ID, 'PPT', true).'" alt="'.get_the_title().'" onerror="javascript:this.src=\''.get_template_directory_uri().'/image/sandwich.jpg\';"/>';
	}else{?>
			<?php limiwu_post_first_img();
	}?>		
		</a></div>
	    <h3><a href="<?php the_permalink(); ?>" target="_blank" class="title"><?php echo get_the_title(); ?></a></h3>
	    <p class="excerpt hidden-xs"><a href="<?php the_permalink(); ?>" target="_blank"><?php echo get_the_excerpt();?></a></p>
		<div class="edit hidden-xs">
			<img class="media-object post-ico" src="<?php echo limiwu_ico_url();?>" onerror="javascript:this.src='<?php bloginfo('template_url'); ?>/image/favicon.ico';">
			<?php //文章作者名字
			if(get_post_meta( $post->ID, '_limiwu_source_remarks', true )){
				echo '<a href="'.get_the_permalink().'" target="_blank" title="'.get_the_title().'">';
				echo get_post_meta( $post->ID, '_limiwu_source_remarks', true );
				echo '</a>';
			}else{
				the_author_posts_link($post->ID);
			}?>
			<span class="float-right"><i class="glyphicon glyphicon-time" aria-hidden="true"></i> <?php the_time('Y-m-d') ?></span>
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