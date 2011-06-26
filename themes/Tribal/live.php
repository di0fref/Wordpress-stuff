<div class="searchcolumn">
	<h2>Search results</h2>
	<ul id="search" class="recent">
		<?php if (have_posts()) : 
			while (have_posts()) : the_post(); 
				if(!in_category(15)){?>
				<li><a title="Permalink to this post" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php } ?>
			<?php endwhile; 
		endif; ?>
		
		<?php if (!have_posts()) { echo('<li>No results to show.</li>'); } ?>
	</ul>
		<h2>More</h2>
		<p>Didn&acute;t you find what you were looking for? Take a look at the full <a href="<?php echo get_bloginfo('wpurl').'/?s='.$_GET['s'];?>">search listing</a>, or you can visit the <a href="/archives">archives</a>.</p> 
</div>

<div class="searchcolumn">
	<h2>Sidenotes</h2>
	<ul class="recent">
	<?php if (have_posts()) : 
		while (have_posts()) : the_post(); 
			if(in_category(15)){?>
			<li><a title="Permalink to this post" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php } ?>
		<?php endwhile; 
	endif; ?>
	<?php if (!have_posts()) { echo('<li>No results to show.</li>'); } ?>
	
	</ul>
</div>
<div style="height:1%;clear:both"></div>