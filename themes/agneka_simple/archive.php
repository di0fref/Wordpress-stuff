<?php get_header(); ?>
<div class="bb-tbase">

	<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3">

	<?php is_tag(); ?>
	<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h4 class="pagetitle">Archive for <em><?php single_cat_title(); ?></em></h4>

 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h4 class="pagetitle">Posts Tagged <em>&#8216;<?php single_tag_title(); ?>&#8217;</em></h4>

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h4 class="pagetitle">Archive for <em><?php the_time('F jS, Y'); ?></em></h4>

 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h4 class="pagetitle">Archive for <em><?php the_time('F, Y'); ?></em></h4>

 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h4 class="pagetitle">Archive for <em><?php the_time('Y'); ?></em></h4>

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h4 class="pagetitle">Author Archive</h4>

 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h4 class="pagetitle">Blog Archives</h4>

 	  <?php } ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post bb-tbase" id="post-<?php the_ID(); ?>">
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>				<p class="postinfo"><em class="date"><?php the_time('F jS, Y') ?></em> <?php the_category(', ') ?><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php edit_post_link('Edit', ' / ', ''); ?></p>				
				<?php the_content('Read more &raquo;'); ?>
			</div>
		<?php endwhile; ?>

	<div class="bb-tbase nav-entry-pages">
		<p class="bb-t10 bb-fa"><?php next_posts_link('&laquo; Older Entries') ?></p>
		<p class="bb-t10 bb-fc next"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
	</div>

	<?php else : ?>
		<h1>Not Found</h1>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>

	</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>

	<div class="bb-t13 bb-fa"><div class="bbin-c1">
		<?php dynamic_sidebar('sidebar-postnav'); ?>
	</div></div>
	<div class="bb-t17 bb-fc">
		<?php dynamic_sidebar('sidebar-postrelated'); ?>
		<?php dynamic_sidebar('sidebar-links'); ?>
	</div>

	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>