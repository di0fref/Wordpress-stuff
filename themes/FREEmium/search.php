<?php get_header(); ?>
<div id="search_data">
</div>
<div id="content" class="search">
	<h2>for: <strong>“<?php the_search_query(); ?>”</strong></h2>
	<?php if (have_posts()) : ?>
		<ul id="results">
		<?php while (have_posts()) : the_post();
		foreach((get_the_category()) as $category) {
			$categories[] = $category->cat_name;
		}
		$cats = implode(", ", $categories);
		?>
			<li <?php post_class() ?>>
				<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<small><?php comments_number('0', '1', '%'); ?></small>
					<strong><?php the_title(); ?></strong>
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
		
		<ul class="nav">
			<li class="prev"><?php next_posts_link('&laquo; Previous Entries') ?></li>
			<li class="next"><?php previous_posts_link('Next Entries &raquo;') ?></li>
		</ul>

		<h3>not what you were looking for?</h3>
		<h4>take a look at the latest articles on <?php bloginfo('name'); ?></h4>
	<?php else : ?>

		<h2 class="no_posts">No posts found</h2>
		<h3>don't know where to search?</h3>
		<h4>take a look at the latest articles on <?php bloginfo('name'); ?></h4>

	<?php endif; ?>

	<ul id="recent">
	<?php query_posts('showposts=5'); $i = 0; while (have_posts()) : the_post();?>
	<li<?php if ( ++$i == 5 ) { ?> class="last"<?php } ?>><a href="<?php the_permalink() ?>">
		<strong><?php the_title(); ?></strong>
		<span><?php the_time('jS F Y') ?></span>
	</a></li>
	<?php endwhile; ?>
	</ul>
	</div>

<?php include ('sidebar2.php'); ?>

<?php get_footer(); ?>