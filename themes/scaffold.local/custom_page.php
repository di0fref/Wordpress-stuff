<?php 
/* Template Name: Forum Template */ 
?>
<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="single_wrapper"> 
		<div class="post_wide narrow text">
				<div class="panel_head_wide"></div> 
			<div class="panel_content base_format"> 
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2> 
				<?php the_content();?>
			</div>
			<div class="meta_foot"><?php edit_post_link(); ?></div>
			<div class="panel_foot"></div>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
										
		</div> 
	</div> 
</div>	
<?php get_sidebar();?>
<?php get_footer();?>