<?php get_header();?>
	<div id="content">
	<?php if(have_posts()): while(have_posts()):the_post();?>
		<div class="post" id="post-<?php the_ID();?>">
			<h3><a href='<?php the_permalink();?>'><?php the_title();?></a></h3>
				<div class="entry">
					<?php the_content();?>
				</div>

			

			
						
		</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_sidebar();?>
<?php get_footer();?>
		







