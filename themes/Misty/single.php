<?php get_header();?>


<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry_single">
		<div class="entrytext">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<div class="meta">
		
			<p class="date"><?php the_date();?> <small>Posted to: 
			
			<?php the_category(" &bull; ");?>
			
			<?php edit_post_link(__(" Edit"));?></small></p>
		</div>

			<div class="text"><?php the_content();?></div>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>
</div>
<?php get_sidebar();?>

<?php get_footer();?>
