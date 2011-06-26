<?php get_header(); ?>
<div class="bb-tbase">

<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">

		<h1><?php the_title(); ?></h1>
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>

		<?php endwhile; endif; ?>
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div></div>

<div id="content-sub" class="bb-t11 bb-fc"><div class="bbin-a1">
	<?php get_sidebar(); ?>	<?php dynamic_sidebar('sidebar-page'); ?>
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>