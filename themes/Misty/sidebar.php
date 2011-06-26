<div id="sidebar">

<?php $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type <> 'pingback' AND comment_type <> 'trackback' ORDER BY comment_date_gmt DESC LIMIT 5");?>

<h2>Feeds</h2>
<ul id="feeds">
	<li><a href="<?php bloginfo('rss2_url');?>"><?php _e("Subscribe via RSS");?></a></li>
	<li><a href="<?php bloginfo('atom_url');?>"><?php _e("Subscribe via ATOM");?></a></li>
</ul>


	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>
		
		
<div class="box2">
	<div class="top"></div>
        
        <ul class="nav1 idTabs">
			<li><a class="" href="#cat"><span>Categories</span></a></li>
            <li><a class="" href="#forum"><span>Search</span></a></li>
            <li><a class="" href="#comm"><span>Comments</span></a></li>
        </ul>
        
        <div class="spacer white">

            <ul style="display: block;" class="list1" id="cat">
            	<?php wp_list_categories("title_li=");?>
            </ul>

			<div style="display: none;" class="list1" id="forum">
					<form method="get" id="searchform" action="<?php bloginfo('url');?>">
		<input type="text" value="Enter search keyword" onclick="this.value='';" name="s" id="s" />
		<input name="" type="submit" value="Go" class="btn" />
	</form>
 			</div>	

			<ul style="display: none;" class="list1" id="comm">
				<?php foreach($comments as $comment):?>
			<li>
					<a href="<?php echo get_permalink($comment->comment_post_ID)."#comment-$comment->comment_ID"; ?>">
						<cite><?php echo $comment->comment_author; ?></cite> on <?php echo get_the_title($comment->comment_post_ID); ?>
					</a>
	    </li>
		<?php endforeach;?>

			</ul>
            

        </div>               
        <!--/spacer -->
        
        <div class="bot"></div>
        
    </div>
    <!--/box2 -->

	
</div>









































