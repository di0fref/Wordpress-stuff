<?php get_header(); ?>
<div class="bb-tbase">

<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3 search">

	<?php if (have_posts()) : ?>
		<h1>Search Results</h1>

		<?php while (have_posts()) : the_post(); ?>
			<div class="post bb-tbase">
				<h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<p><?php the_time('l, F jS, Y') ?> ‒ <?php the_tags('Tags: ', ', ', '<br />'); ?> 
					Posted in <?php the_category(', ') ?><?php edit_post_link('Edit', ' / ', ''); ?> 
					<?php comments_popup_link('', '1 Comment &#187;', '% Comments &#187;'); ?>
				</p>
			</div>
		<?php endwhile; ?>

	<div class="bb-tbase nav-entry-pages">
		<p class="bb-t10 bb-fa"><?php next_posts_link('&laquo; Older Entries') ?></p>
		<p class="bb-t10 bb-fc next"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
	</div>

	<?php else : ?>

		<h1>No posts found. Try a different search?</h1>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">	
	<?php get_sidebar(); ?>
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>
	<div class="bb-t13 bb-fa"><div class="bbin-c1">
		<?php dynamic_sidebar('sidebar-postnav'); ?>
	</div></div>
	<div class="bb-t17 bb-fc">
		<?php dynamic_sidebar('sidebar-links'); ?><br />
		<?php dynamic_sidebar('sidebar-postrelated'); ?>
	</div>
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>