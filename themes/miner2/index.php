<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post(); ++$loop;?>

	<div class="post">
			<div class="post_date"><p><?php the_date();?><br /><?php edit_post_link();?></p></div>
			<div class="post_title"><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3></div>
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