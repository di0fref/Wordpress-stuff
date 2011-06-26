<?php get_header();?>
	<div id="content">
	<?php if(have_posts()): while(have_posts()):the_post();?>
		<div class="post" id="<?php the_ID();?>">
			<h3><a href='<?php the_permalink();?>'><?php the_title();?></a></h3>
				<div class="entry">
					<?php the_content();?>
				</div>

			

			
	<div class="meta">
		<?php the_date();?> // 
		<a href="<?php comments_link();?>"><?php comments_number();?> &raquo;</a> // 
		<?php the_category(",");?>
		<?php edit_post_link();?>
	</div>
			
</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_sidebar();?>
<?php get_footer();?>
		







