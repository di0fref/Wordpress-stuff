<?php get_header();?>
<h3>Search results</h3>
<?php if(have_posts()):while(have_posts()):the_post();?>
	<div class="post">
		<div class="post_header">
			<div class="post_date"><p><?php the_date();?></p></div>
			<div class="post_title"><p><a href="<?php the_permalink();?>"><?php the_title();?></a></p></div>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
	<p class="indent pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>

</div>

<?php get_sidebar();?>
<?php get_footer();?>