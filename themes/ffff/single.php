<?php get_header(); ?>
<div id="content">	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry">
		<div class="meta">
			<p class="meta">
				<span class="day"><?php the_time("d") ?></span>
				<span class="month"><?php the_time("M") ?></span>
				<span class="year"><?php the_time("Y") ?></span>
			<p>
		<?php edit_post_link();?>
	</div>
	<div class="entrybody">
    	<h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> </h3>
    	<?php the_content(__('(more...)')); ?>
   </div>
	<div class="more">
		<p><a href="<?php the_permalink();?>">#</a> tagged: <?php the_category(",");?></p>
	</div>
	<div class="clear"></div>
	<div id="comments">
		<?php comments_template(); // Get wp-comments.php template ?>
	</div>
</div>
<?php endwhile; else: ?>
<p>
  <?php _e('Sorry, no posts matched your criteria.'); ?>
</p>
<?php endif; ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
</div>
<?php get_sidebar(); ?>
<!-- The main column ends  -->
<div class="clear"></div>
<?php get_footer(); ?>
