<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post();?>
	<div class="post">
		<div class="post_header">
			<div class="post_date"><?php edit_post_link("Edit this");?>&nbsp;</div>
			<div class="post_title"><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3></div>

		</div>
		<div class="post_text"><?php the_content();?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>
</div>

<?php get_sidebar();?>
<?php get_footer();?>