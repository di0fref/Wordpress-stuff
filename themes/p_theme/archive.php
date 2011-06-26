<?php
get_header();
?>
<div id="left">

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
	  	<div class="latest">
			<div class="time">
				<div class="month"><?php the_time('M')?></div>
				<div class="day"><?php the_time('d')?></div>
				<div class="year"><?php the_time('Y')?></div>
			</div>
		</div>
		
		<div class="entry-text"><?php the_content(__('Read more &raquo;'));?></div>
		<div class="meta">
			<p><b>"<?php the_title();?>"</b> has <?php comments_popup_link('No responses', '1 response', '% responses', 'comments_popup'); ?></p>
			<p>This article is posted to: <?php the_category(',') ?> <?php edit_post_link(__('&#183; Edit'));?></p>
		</div>
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>
  <?php endwhile; else: ?>
  <p class="pageing"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>
  <p class="pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
	  	</div> <!-- content -->
	<?php get_sidebar(); ?>
	</div> <!-- left -->
		<?php //include(TEMPLATEPATH."/side.php")?>
	<?php get_footer(); ?>