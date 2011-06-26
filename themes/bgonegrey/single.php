
<?php get_header();?>
<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="entry" id="post-<?php the_ID();?>">
			<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a> </h3>
			<p class="meta">
				<span class="date"><?php the_time('F j, Y'); ?></span>
				<?php edit_post_link(__('&#183; Edit'));?>
				</p>
			<div class="entry-text"><?php the_content();?></div>
			<?php if(function_exists('wp_notable')) :?>
			<?php wp_notable();?>
			<?php endif; ?>
		</div>
		<?php endwhile;?>
	<?php endif; ?>
	

		<?php comments_template();?>

	
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>



