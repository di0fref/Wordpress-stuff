<?php
get_header();
?>

<div id="content">
  <?php if (have_posts())  : the_post(); ?>
  <div class="entry" id="post-<?php the_ID();?>">
    <h3 class="single"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	  <div class="meta">
			<p>
			<?php if($post->comment_count > 0 && $post->comment_status == 'open'):?>
				<a href="#comments">Jump to comments</a> &#183 <a href="#respond">Add comment</a>
			<?php endif;?>
			<?php edit_post_link(__('&#183; Edit'));?></p>
		</div>
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
<?php get_sidebar(); ?>
<!-- The main column ends  -->
<?php get_footer(); ?>
