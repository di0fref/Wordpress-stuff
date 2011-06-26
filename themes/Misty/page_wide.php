
<?php get_header();?>


<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry">
		<!--<div class="meta">
			<p class="date"><?php the_date(); edit_post_link(__(" Edit"));?></p>
			<p class="tags cats"><?php the_category();?></p>
		</div>-->
		<div class="entrytext_page_wide">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<div class="text"><?php the_content();?></div>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_sidebar();?>

<?php get_footer();?>
