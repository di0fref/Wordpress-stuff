<div class="clear"></div>

<div id="recent">
<div class="recentcol">
	<h4>Recent posts</h4>
	 <?php
		global $post;
		$myposts = get_posts('numberposts=10&offset=10');
		foreach($myposts as $post) :?>
	    	<div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
	 	<?php endforeach; ?>
 </div>
 
 <div class="recentcol">

 <h4>Categories</h4>
 <?php
	global $post, $wpdb;
	$cats = get_categories('style=none&title_li=&echo=false');
	foreach($cats as $cat){
		echo "<div><a href='".get_category_link($cat->cat_ID)."'>$cat->name</a></div>";
	}
	
?>
 </div> 
</div>