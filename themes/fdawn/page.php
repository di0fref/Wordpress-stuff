<?php 
get_header();
?><div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <div class="entry"> 
  <!--
				<h2 class="entrydate"><?php the_date() ?></h2>
			--> 
  <h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark"> 
    <?php the_title(); ?> 
    </a> </h3> 
	<?php edit_post_link(__('Edit')); ?>
  <div class="entrybody"> 
     <div class="entrymeta"> 
    </div> 
     <?php the_content(__('(more...)')); ?> 
   </div> 
  <!--
	<?php trackback_rdf(); ?>
	--> 
</div> 
<?php comments_template(); ?>

<?php endwhile; else: ?> 
<p> 
  <?php _e('Sorry, no posts matched your criteria.'); ?> 
</p> 
<?php endif; ?> 
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?> 


</div> 

<!-- The main content column ends  --> 
<?php get_sidebar(); ?> 
<?php get_footer(); ?> 
