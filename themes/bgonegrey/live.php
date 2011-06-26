<div id="sl">
	<h2>Search results</h2>
	<ul id="search" class="recent">
		<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
		<li><a title="Permalink to this post" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; endif; ?>
		<?php if (!have_posts()) { echo('<li>No results to show.</li>'); } ?>
	</ul>
		<h2>More</h2>
		<p>Didn&acute;t you find what you were looking for? <br />Take a look at the full <a href="<?php echo get_bloginfo('wpurl').'/?s='.$_GET['s'];?>">search listing</a>, or you can visit the <a href="/archives">archives</a>.</p> 
</div>

<div id="sr">
	<h2>Recent posts</h2>
	<ul class="recent"><?php wp_get_archives('type=postbypost&limit=10'); ?></ul>
	<h2>Feeds</h2>
	<ul class="recent">
		<li><a href="/feed">Article feed</a></li>	
		<li><a href="<?php bloginfo('wpurl');?>/wp-rss2.php?cat=15">Sidenotes</a></li>
	</ul>
</div>
<div style="height:1%;clear:both"></div>