<?php get_header();?>


<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry">
		<div class="entrytext">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<div class="meta">
			<p class="date"><?php the_date();?> 
			<a href="<?php comments_link();?>"><?php comments_number(__('No Comment'), __('1 Comment'), __('% Comments')); ?></a></p>

			<?php edit_post_link(__(" Edit"));?>
		</div>

			<div class="text"><?php the_content();?></div>
		</div>

	</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_sidebar();?>

<?php get_footer();?>
