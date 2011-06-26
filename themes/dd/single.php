<?php get_header();?>
<div id="left">

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="entry" id="post-<?php the_ID();?>">
			<h3><a href="<?php the_permalink() ?>"><?php the_title();?></a> </h3>
		
				<div class="latest">
					<div class="time">
						<div class="month"><?php the_time('M')?></div>
						<div class="day"><?php the_time('d')?></div>
						<div class="year"><?php the_time('Y')?></div>
					</div>
				</div>
			<div class="entry-text"><?php the_content();?></div>
					<?php adsense_deluxe_ads(); ?>
				<div class="meta">
					<div class="mspan">
							<p>This article is posted to: <?php the_category(',') ?> <?php edit_post_link(__('&#183; Edit'));?></p>
					</div>
					<div class="digg"><?php if(function_exists('wp_notable'))wp_notable();?></div>
				</div>
				
		</div>
		<?php endwhile;?>
	<?php endif; ?>
	

		<?php comments_template();?>

	
		  	</div> <!-- content -->
		<?php get_sidebar(); ?>
		</div> <!-- left -->
			<?php include(TEMPLATEPATH."/side.php")?>
		<?php get_footer(); ?>

