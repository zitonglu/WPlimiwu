<?php 	//普通列表页面?>
<li class="item" id="post-<?php the_ID(); ?>">
	<div>
		<span class="glyphicon glyphicon-star glyphicon-dian"></span>
		<a href="<?php the_permalink();?>" target="_blank" title="<?php the_title_attribute(); ?>">
		<?php the_time('y-m-d');//发布时间?>
		</a>
	</div>
	<?php if(has_post_thumbnail()):?>
		<a href="<?php the_permalink();?>" class="anka-thumbnail" target="_blank" title="<?php the_title_attribute(); ?>">	
			<?php the_post_thumbnail('thumbnail');?>
		</a>
	<?php endif?>
	<h4 class="list-title"><a href="<?php the_permalink();?>" target="_blank" title="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></a></h4>
</li>