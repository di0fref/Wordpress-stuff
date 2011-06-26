<?php 
/*
Template Name: Archive page
Description:  Used the archives
*/
?>
<?php get_header();?>

<div id="content_arc">
  <?php if (have_posts())  : the_post(); ?>
  <div class="entry" id="post-<?php the_ID();?>">
    <h3 class="single"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
		<p class="meta">
			<?php edit_post_link(__('&#183; Edit'));?></p>
		<div class="entry-text"><?php the_content(__('Read more &raquo;'));?></div>
    <!--
	<?php trackback_rdf(); ?>
	-->

  </div>
  <?php comments_template(); // Get wp-comments.php template ?>
  <?php  else: ?>
  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>
  <p><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
</div>
<?php //get_sidebar(); ?>
<!-- The main column ends  -->
<?php get_footer(); ?>
