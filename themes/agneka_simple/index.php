<?php get_header(); ?>
<div class="bb-tbase">

	<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

			<div class="post bb-tbase" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p class="postinfo">
					<em class="date"><?php the_time('F jS, Y') ?></em><br />
					<?php the_category(', ') ?> <?php edit_post_link('Edit', '', ''); ?><br />
					<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
				</p>
				<?php the_content('Read more &raquo;'); ?>
			</div>

		<?php endwhile; ?>

	<div class="bb-tbase nav-entry-pages">
		<p class="bb-t10 bb-fa"><?php next_posts_link('&laquo; Older Entries') ?></p>
		<p class="bb-t10 bb-fc next"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
	</div>

	<?php else : ?>

		<h1>Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>

		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>
	<div class="bb-t13 bb-fa"><div class="bbin-c1">
		<?php dynamic_sidebar('sidebar-postnav'); ?>
	</div></div>
	<div class="bb-t17 bb-fc">
		<?php dynamic_sidebar('sidebar-links'); ?><br />
		<?php dynamic_sidebar('sidebar-postrelated'); ?>
	</div>

	<div class="bb-tbase">
		<?php dynamic_sidebar('sidebar-bottom'); ?>
	</div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>