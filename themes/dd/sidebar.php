	<div id="sidebar">
	
		<h2>Sidenotes</h2>
		
		<div class="sidenotes">
			<ul>
			<?php $posts = get_posts('numberposts=10&category=15&orderby=post_date&order=DESC'); 
			if ($posts) : 
				foreach ($posts as $post) : setup_postdata($post); 	
					preg_match('|\[url\](.*?)\[\/url\]|ims', $post->post_content, $match);
					$post->post_content = preg_replace('|\[url\](.*?)\[\/url\]|ims', "", $post->post_content);?>
					
					<li>
							<strong><a href="<?php echo $match[1];?>"><?php the_title(); ?></a></strong> 
							<?php echo $post->post_content;; ?>
						
						<p class="more_note">
								<?php comments_popup_link('No comments', '1 comment', '% comments', 'cc'); ?>
								<?php edit_post_link(__('&#183; Edit'));?>
						</p>
					</li>
				<?php endforeach; ?>
			</ul>
			</div>
				<p><a id="previousnotes" href="<?php echo get_category_link(15);?>">More Sidenotes &raquo;</a></p>
		<?php else :
			echo "<div class='sidenote'>\nSorry, but there are no sidenotes posts to display.\n</div>\n";
		endif;?>
	

</div>