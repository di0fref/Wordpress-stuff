<?php
get_header();
?>

<div id="content">
  <?php if (have_posts()) : ?>
  	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php 
	if (is_category()) { ?>				
		<h2 class='archives'>Archive for the '<?php echo single_cat_title(); ?>' Category</h2>
	<?php }
	 
	elseif (is_day()) { ?>
		<h2 class='archives'>Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php }
	
	elseif (is_month()) { ?>
		<h2 class='archives'>Archive for <?php the_time('F, Y'); ?></h2>
	<?php } 
	
	elseif (is_year()) { ?>
		<h2 class='archives'>Archive for <?php the_time('Y'); ?></h2>
	<?php } 
	
	elseif (is_author()) { ?>
		<h2 class='archives'>Author Archive</h2>
	<?php }
	 
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2>Blog Archives</h2>
	<?php } ?>
<?php while (have_posts()) : the_post(); ?>
  <div class="entry" id="post-<?php the_ID();?>">
	<!--<?php //if(in_category('15')):?>
		<h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php echo get_post_meta($post->ID, 'url', TRUE); ?>" rel="bookmark">
	<?php //else: ?>-->
    	<h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark">
	<?php //endif;?>

      <?php the_title(); ?>
      </a> </h3>
	  	<p class="meta">
				<span class="date"><?php the_time('F j, Y'); ?></span>
				<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments_popup'); ?>
				<?php edit_post_link(__('&#183; Edit'));?>
				</p>
		<div class="entry-text"><?php echo the_content(__('Read more &raquo;'));?></div>
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>
  <?php endwhile; else: ?>
  <p class="pageing"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>
  <p class="pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
</div>
<?php get_sidebar(); ?>

<!-- The main column ends  -->
<?php get_footer(); ?>
