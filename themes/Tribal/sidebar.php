
<div id="sidebar">
	<?php if(is_single()){ ?>
	<div id="sidemeta">

		<?php global $post;
		$cats = wp_get_post_categories($post->ID);
		echo "<div class='metadate'><strong>".mysql2date(get_option('date_format'), $post->post_date)."</strong></div>";?>
        <div class="metacomments>"<a href="#comments" class="comments"><?php echo $post->comment_count?> Comments</a></div>

		<ul class="meta">
         	<?php foreach($cats as $cat){
             	echo "<li class='tag'><a href='".get_category_link($cat)."'>".get_cat_name($cat)."</a></li>";
             }?>           
			<?php edit_post_link(__('Edit'));?>
            </ul>
          </div>
	<?php }?>

	
	<?php if(is_category()){?>
			<div id="sidemeta-arc">
				Currently browsing the '<strong><?php single_cat_title(''); ?>'</strong> archive.
			</div>
		
	<?php } ?>
<?php if(is_search()){?>
			<div id="sidemeta-arc">
				Currently searching for '<strong><?php echo $_GET['s']; ?>'</strong>.
			</div>
		
	<?php } ?>
	<h2>RSS feeds</h2>
		<ul id="feedlist">
			<li class="feed"><a href="<?php bloginfo('rss2_url');?>">Articles</a></li>
			<!--<li class="feed"><a href="http://www.fahlstad.se/wp-rss2.php?cat=15">Sidenotes</a></li>-->
			<li class="feed"><a href="<?php bloginfo('comments_rss2_url');?>">Comments</a></li>
		</ul>

<h2>Sponsored links</h2>
<?php if(function_exists('tla_ads'))tla_ads();?>
<?php include('paypal.php');?> 
<!--<h2>Latest forum activity</h2>
<?php //forum_latest_activity(5)?>-->
<h2>Sidenotes</h2>
		<?php $posts = get_posts('numberposts=5&category=15&orderby=post_date&order=DESC'); 
		if ($posts) : ?>
		
		<div class="sidenotes">
				<?php foreach ($posts as $post) : setup_postdata($post); 	
					preg_match('|\[url\](.*?)\[\/url\]|ims', $post->post_content, $match);
					$post->post_content = preg_replace('|\[url\](.*?)\[\/url\]|ims', "", $post->post_content);?>
					
							<strong><a href="<?php echo $match[1];?>"><?php the_title(); ?></a></strong> <br>
							<?php echo $post->post_content;; ?>
						
								<?php edit_post_link(__('&#183; Edit'));?>
						</p> 
				<?php endforeach; ?>
			</ul>
			</div>
				<p><a id="previousnotes" href="<?php echo get_category_link(15);?>">More Sidenotes &raquo;</a></p>
		<?php else :
			echo "<div class='sidenote'><p>\nSorry, but there are no sidenotes posts to display.</p>\n</div>\n";
		endif;?>


<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>
					
					
			
</div>









































