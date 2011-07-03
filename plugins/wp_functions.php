<?php
/*
	Plugin name: WP Functions
	Description: Misc functions
*/

function get_download_count($filename){
	global $wpdb;
	$sql = "SELECT count from wp_downloads WHERE file LIKE '%$filename%'";
	$val =  $wpdb->get_var($sql);
	return $val;
}

function get_download_stats(){
	global $wpdb;
	$sql = "SELECT * from wp_downloads ORDER by count DESC";
	$vals =  $wpdb->get_results($sql);
	$out .= "<table cellpadding='0' cellspacing='0' width='300px' style='border-collapse:collapse;'>";
	foreach($vals as $val){
		$alt = ($alt == "odd")?"even":"odd";
		$out .= "<tr class='$alt'>
				<td style='padding:5px;'>$val->file</td>
				<td style='padding:5px'>$val->count</td>
			</tr>";
	}
	$out .= "</table>";
	return $out;
}

function recent_posts($num){
	global $wpdb;
	$posts = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC LIMIT $num");
	echo "<ul>";
	foreach($posts as $post){
		echo "<li><a href='".get_permalink($post->ID)."'>$post->post_title</a></li>";
	}
	echo "</ul>";
}
function recent_comments(){
	global $wpdb;
	$posts = $wpdb->get_results("SELECT * FROM wp_comments WHERE comment_approved = '1' AND comment_type = '' ORDER BY comment_date DESC LIMIT 10");
	echo "<ul>";
	foreach($posts as $post){
		$title = get_the_title($comment_post_ID);
		echo "<li>On: <a href='".get_permalink($post->comment_post_ID)."#comment-$post->comment_ID'>$title</a> by: $post->comment_author</li>";
	}
	echo "</ul>";

}





















