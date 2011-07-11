<?php get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	<div class="entry">
		<h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> </h3>
  		<div class="entrymeta"> 
      			<?php the_time('F dS Y') ?> Posted to <?php the_category(',') ?> <?php edit_post_link(__('<strong>Edit</strong>')); ?>
				<a href="" class="comment_cloud"><img src="wp-content/themes/fdawn/images/bg_comment_cloud.gif"></a>
		</div>
		<div class="entrybody">
			<?php the_content(__('Continue &raquo;')); ?>
		</div>

			<p class="comments_link">
      			<?php $comments_img_link = '<img src="' . get_stylesheet_directory_uri() . '/images/comments.gif"  title="comments" alt="*" />'; comments_popup_link(' Comments(0)', $comments_img_link . ' Comments(1)', $comments_img_link . ' Comments(%)'); ?>
			</p>
	</div>
	<?php endwhile; else: ?>
<p>
	<?php _e('Sorry, no posts matched your criteria.'); ?>
</p>
<?php endif; ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>
</div>
<?php get_sidebar(); ?>
<!-- The main column ends  -->
<?php get_footer(); ?>
