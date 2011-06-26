<?php get_header();?>
<h2 class="indent">Archives</h2>
	<?php if(is_category()){?>
			<p class='indent'>
				You are currently browsing the <?php single_cat_title(''); ?> category.
				<br /><img src="<?php bloginfo('template_url');?>/images/rss.png"<a href="feed" title="Category feed"> Subscribe</a> (RSS).
			</p>
	<?php } 
		
		elseif(is_search()){?>
			<p class='indent'>
				You have searched the archives for <?php the_search_query(); ?>.
			</p>
	<?php }
		
		elseif (is_day()) { ?>
			<p class='indent'>
				You are currently browsing the archives for the day <?php the_time('l, F jS, Y'); ?>
			</p>
	<?php } 
	
		elseif (is_month()) { ?>
			<p class='indent'>
				You are currently browsing the archives for <?php the_time('F, Y'); ?>.
			</p>
	<?php } 
	
		elseif (is_year()) { ?>
			<p class='indent'>
				You are currently browsing the archives for the year <?php the_time('Y'); ?>.
			</p>
	
	<?php } ?>
	

<?php if(have_posts()):while(have_posts()):the_post(); ++$loop;?>

	<div class="post">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<p class="meta"><?php the_date();?> Posted to: <?php the_category(", ");?> <?php edit_post_link();?></p>
		<div class="post_text">
			<?php the_content();?>
		</div>

	</div>
<?php endwhile;?>
<?php endif;?>
	<p class="indent pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
</div>
<?php get_sidebar();?>
<?php get_footer();?>