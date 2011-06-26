<?php get_header();?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="entry">
			<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<div class="date"><?php the_date(); ?></div>
			
			<div class="entry-content">
				<?php if(!is_search())the_content();?>
				<p class="entry-meta">This article is posted to: <?php the_category(',') ?> | <a href='<?php comments_link();?>'><?php comments_number(__('No Comment'), __('1 Comment'), __('% Comments')); ?></a> <?php edit_post_link(__('&#183; Edit'));?></p>
						
			</div>

		</div>
		
	<?php endwhile ?> 
	<?php else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	<p class="pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
  	
</div> <!-- End content -->
<?php get_sidebar();?>

<?php //include (TEMPLATEPATH . '/recent.php'); ?>


<?php get_footer();?>

