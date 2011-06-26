<?php get_header(); ?>

			<div id="content">
				<?php if ( is_category() ) { ?>
				<h2 class="special">
					<span>Category</span>
					<strong><?php single_cat_title() ?></strong>
				</h2>
				<?php } elseif ( is_tag() ) { ?>
				<h2 class="special">
					<span>Tag</span>
					<strong><?php single_cat_title() ?></strong>
				</h2>
				<?php } elseif ( is_day() || is_month() || is_year() ) { ?>
				<h2 class="special">
					<span>Archive</span>
					<strong><?php single_month_title(" ") ?></strong>
				</h2>
				<?php } else { ?>
				<h2><span>recently featured posts</span> <small>we've got <?php $count_posts = wp_count_posts(); echo $count_posts->publish; ?> articles so far</small></h2>
				<?php } ?>
				
				<?php while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span><?php the_title(); ?></span> <small><?php comments_number('0','1','%'); ?></small></a></h3>
					
					<?php if ( $img = get_post_meta($post->ID, "image", true) ) { ?>
					<div class="headline">
						<a href="<?php the_permalink() ?>">
							<img src="<?=$img?>" alt="" />
							<span><?php the_time("M<b\i\g>j</b\i\g>") ?></span>
						</a>
					</div>
					<? } else { ?>
					<div class="date">
						<span><?php the_time("M<b\i\g>j</b\i\g>") ?></span>
					</div>
					<? } ?>
					
					<div class="text">
						<?php the_content('continue reading &raquo;'); ?>
					</div>
				</div>
				<?php endwhile; ?>
				
				<ul class="nav">
					<li class="prev"><?php next_posts_link('Previous Entries') ?></li>
					<li class="next"><?php previous_posts_link('Next Entries &raquo;') ?></li>
				</ul>
			</div>
			
<?php get_sidebar(); ?>

<?php include ('sidebar2.php'); ?>

<?php get_footer(); ?>