<div id="sidebar">
		<h2>Feeds</h2>
		<ul>
			<li class="feed"><a href="<?php bloginfo('rss2_url');?>">RSS Articles complete</a></li>
			<li class="feed"><a href="http://www.fahlstad.se/wp-rss2.php?cat=15">RSS Sidenotes only</a></li>
			<li class="feed"><a href="<?php bloginfo('comments_rss2_url');?>">RSS Comments complete</a></li>
		</ul>
			<?php include(TEMPLATEPATH ."/searchform.php")?>
			<?php //include('wp-content/ads.php');?>
<h2>Sponsored links</h2>
		<ul id='ads'>
			<?php tla_ads();?>
			</ul>
		<h2>Sidenotes</h2>
		<?php $posts = get_posts('numberposts=5&category=15&orderby=post_date&order=DESC'); 
		if ($posts) : ?>
		
		<div class="sidenotes">
			<ul>
				<?php foreach ($posts as $post) : setup_postdata($post); 	
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
			echo "<div class='sidenote'><p>\nSorry, but there are no sidenotes posts to display.</p>\n</div>\n";
		endif;?>
	
		
			<?php include( 'paypal.php' );?>

			<?php //adsense_deluxe_ads('sidebar'); ?>
				<h2>Latest forum activity</h2>

		<?php forum_latest_activity(5)?>

			<h2>Meta</h2>
			<ul>
					<li class="register"><?php wp_register('',''); ?></li>
					<li class="loginout"><?php wp_loginout(); ?></li>
					<li class="wp"><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
			</ul>
</div>