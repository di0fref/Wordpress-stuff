
				<div id="sidebar">


					<h2 class="rss"><a href="<?php bloginfo('wpurl');?>/wp-rss2.php?cat=15">Sidenotes</a></h2>
					<div class="sidenotes">
					<ul>
<?php

$posts = get_posts('numberposts=8&category=15&orderby=post_date&order=DESC'); // We only want the posts from the sidebar category
		if ($posts) : 
			foreach ($posts as $post) : setup_postdata($post); 
			
			preg_match('|\[url\](.*?)\[\/url\]|ims', $post->post_content, $match);
			$post->post_content = preg_replace('|\[url\](.*?)\[\/url\]|ims', "", $post->post_content);?>
			<span><?php the_time('F j, Y'); ?>
			<?php edit_post_link('&#183; Edit');?></span>
			
				<li>
					<a href="<?php echo $match[1];?>">
						<strong><?php the_title(); ?></strong>
						<?php echo $post->post_content;/*the_content('read more')*/; ?>
					</a>
					
				</li>


			<?php endforeach; ?>
			</ul>
			</div>
				<a id="previousnotes" href="<?php echo get_category_link(15);?>">&laquo; Previous Sidenotes</a> 
				
		<?php else :
			echo "<div class='sidenote'>\nSorry, but there are no sidenotes posts to display.\n</div>\n";
		endif;

?>


				</div>



				