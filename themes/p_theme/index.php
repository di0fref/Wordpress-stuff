	<?php if (isset($_GET['ajax'])) { ?>
		<?php include(TEMPLATEPATH."/live.php");?>
	<?php } 
	else { ?>
		<?php get_header();?>
			<div id="content">
				<?php if(!is_search() && !is_paged()) { ?>
					<?php query_posts('showposts=5&cat=-15'); ?>
				<?php } ?>

				<?php if(is_search()){ ?>
					<h2 class="archives">Search results</h2>
				<?php }?>

	
				<?php if (have_posts()) : 
					while (have_posts()) : the_post(); ?>
					<?php if(!in_category(15)):?>
						<div class="entry" id="post-<?php the_ID();?>">
							<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a> </h3>
						
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
						</div>
						<?php endif; ?>
					<?php endwhile;?>
				<?php endif; ?>
			<p class="pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
  	</div> <!-- content -->
	<?php get_sidebar(); ?>
		<?php get_footer(); ?>
<?php } ?>