<?php 
get_header();
?>
<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="entry">
  <!--
				<h2 class="entrydate"><?php the_date() ?></h2>
			-->
  <h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark">
    <?php the_title(); ?>
    </a> </h3>
  <div class="entrybody">
    <?php the_content(__('(more...)')); ?>
	
	
	<ul class="meta">
				<li class="clear">
					<div class="title">Posted</div>
					<div class="text"><?php the_time('F d, Y');?> <?php edit_post_link();?></div>
				</li>

				<li class="clear">
					<div class="title">Responses</div>
					<div class="text"><a href="<?php comments_link();?>"><?php comments_number();?> &raquo; </a></div>
				</li>
				
				<li class="clear sharethis">
					<div class="title">Categories</div>
					<div class="text"><?php the_category(",");?></div>
				</li>
			</ul>

	

    
      
	
  </div>
  <!--
	<?php trackback_rdf(); ?>
	-->
</div>
<?php comments_template(); // Get wp-comments.php template ?>
<?php endwhile; else: ?>
<p>
  <?php _e('Sorry, no posts matched your criteria.'); ?>
</p>
<?php endif; ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
</div>
<?php get_sidebar(); ?>
<!-- The main column ends  -->
<?php get_footer(); ?>
