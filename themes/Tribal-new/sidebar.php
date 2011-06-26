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

	<strong>
	<?php if(is_category()){?>
			<div id="sidemeta-arc">
				You are currently browsing the <?php single_cat_title(''); ?> category.
			</div>
	<?php } 
		
		elseif(is_search()){?>
			<div id="sidemeta-arc">
				You have searched the archives for <?php the_search_query(); ?>.
			</div>
	<?php }
		
		elseif (is_day()) { ?>
			<div id="sidemeta-arc">
				You are currently browsing the archives for the day <?php the_time('l, F jS, Y'); ?>
			</div>
	<?php } 
	
		elseif (is_month()) { ?>
			<div id="sidemeta-arc">
				You are currently browsing the archives for <?php the_time('F, Y'); ?>.
			</div>
	<?php } 
	
		elseif (is_year()) { ?>
			<div id="sidemeta-arc">
				You are currently browsing the archives for the year <?php the_time('Y'); ?>.
			</div>
	
	<?php } ?>
	</strong>
	<h2>RSS feeds</h2>
		<ul id="feedlist">
			<li class="feed"><a href="<?php bloginfo('rss2_url');?>">Articles</a></li>
			<!--<li class="feed"><a href="http://www.fahlstad.se/wp-rss2.php?cat=15">Sidenotes</a></li>-->
			<li class="feed"><a href="<?php bloginfo('comments_rss2_url');?>">Comments</a></li>
		</ul>

<h2>Great sites</h2>
<?php if(function_exists('tla_ads'))tla_ads();?>
<?php include('wp-content/tnx.php');?> 

<?php include('wp-content/paypal.php');?> 
<?php if(function_exists('adsense_deluxe_ads'))adsense_deluxe_ads('square'); ?>


<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>
					
					
												<?php include(TEMPLATEPATH ."/searchform.php")?>

</div>









































