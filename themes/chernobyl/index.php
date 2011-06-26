<?php get_header();?>


<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry">
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<p class="date"><?php the_date(); edit_post_link("Edit");?></p>
		<div class="entrytext">
			<?php the_content();?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_footer();?>
