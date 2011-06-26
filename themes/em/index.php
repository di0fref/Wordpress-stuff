<?php get_header();?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php the_content();?>
			<p class="date">
				Posted: <?php the_date();?> in <?php the_category(" &bull; ");?><br /><a href='<?php comments_link();?>'><?php comments_number(__('No Comment'), __('1 Comment'), __('% Comments')); ?></a> <?php edit_post_link(__('&#183; Edit'));?>
			</p>
		<?php endwhile;?>
	<?php endif; ?> 

</div><!-- .cmain -->

<?php get_sidebar();?>
</div><!-- .cc -->

<?php get_footer();?>