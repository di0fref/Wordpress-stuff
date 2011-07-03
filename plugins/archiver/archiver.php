<?php
/*
	Plugin name: Archiver
*/

function archiver($content){
	global $wpdb;
	if(!preg_match('|<!--archiver-->|', $content))
		return $content;
	$years = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year FROM wp_posts WHERE post_status = 'publish'  ORDER BY year DESC");
	

		
	$cats = $wpdb->get_results("SELECT cat_name, category_count, cat_ID FROM wp_categories ORDER BY cat_name DESC");
	/*$out .= "<h4>Categories</h4>";
	
	$out .= "<ul id='catlist'>";
	foreach( $cats as $cat ){
		$out .="<li><a href='".get_category_link($cat->cat_ID)."'>$cat->cat_name</a>($cat->category_count)</li>";
	}
	$out .= "</ul>";*/
	
	$out .= "<div class='col'><h4>Weblog</h4>";
	
	$out .= "<ul id='bloglist'>";
	
	foreach( $years as $year ){
		$out .= "<li id='$year->year' class='year'><a href='#'>$year->year</a></li>";
	}
	$out .= "</ul></div>";
	

	
	/*echo "<pre>";
	print_r($years2);
	echo "</pre>";*/
	return preg_replace('|<!--archiver-->|', $out, $content);
}


function archiver_head(){ 
	?>
	<script src="<?php bloginfo('wpurl');?>/wp-content/plugins/archiver/script.js" type="text/javascript" charset="utf-8"></script>
<!--link rel="stylesheet" href="<?php bloginfo('wpurl');?>/wp-content/plugins/archiver/archiver.css" type="text/css" />-->
	
<?php 
}

add_filter('the_content', 'archiver');
add_filter('wp_head', 'archiver_head');