<?php if (isset($_GET['ajax'])) { ?>
	<?php include(TEMPLATEPATH."/live.php");?>
<?php } else { ?>
<?php get_header();?>
<div id="content">
<?php if(!is_search() && !is_paged()) { ?>
	<?php query_posts('showposts=5&cat=-15'); ?>
<?php } ?>

<?php if(is_search()){ ?>
	<h2 class="archives">Search results</h2>
<?php }?>
<?php if(is_home()){ ?>
	<h2 class="rss"><a href="<?php bloginfo('rss2_url'); ?> ">Latest entries</a></h2>
<?php }?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 
		<div class="entry" id="post-<?php the_ID();?>">
			
			<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a> </h3>
			
			<p class="meta">
				<span class="date"><?php the_time('F j, Y'); ?></span>
				<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments_popup'); ?>
				<?php edit_post_link(__('&#183; Edit'));?>
				</p>
			
					
			<div class="entry-text"><?php the_content(__('Read more &raquo;'));?></div>
		
	
		</div>
		
		<?php endwhile;?>
	<?php endif; ?>
	
  <p class="pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
  
		</div>

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<?php } ?>