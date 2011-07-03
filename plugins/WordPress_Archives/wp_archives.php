<?php
/*
	Plugin Name: WordPress Archives
	Author: Fredrik Fahlstad
	Author URI: http://www.fahlstad.se
	Version: 1.0
*/



function wp_archives($content){
	global $wpdb;
	
	if(!preg_match("|<!--WP_archives-->|", $content))
		return $content;


	$sql2 ="select  YEAR(post_date) AS year, MONTH(post_date) AS month, DAY(post_date) AS day, post_title, ID, post_date, comment_count from wp_posts where post_status = 'publish' and post_type = 'post' order by year DESC, month DESC, day DESC";
	$results = $wpdb->get_results($sql2);
	$res = $wpdb->get_results($sql);

	$out = "";
	$arr  = array();
	foreach($results as $res){
		$p = array(
			"title" => $res->post_title,
			"count" => $res->comment_count,
			"time" => $res->post_date
		);
		$arr[$res->year][$res->month][$res->day][] = $p;
	}
	$out ="<div class='arc'>";
	foreach($arr as $year_key => $year){
		$out .= "<h4 class='arc_header'><a href='#'>$year_key</a></h4><ul class='arc_list'>";
		foreach($year as $month_key => $month){
			//$out .= "<h4>Month: $month_key</h4>";
			foreach($month as $day_key => $day){
				foreach($day as $post_key => $post){
					$day 	= date("d", strtotime("$year_key-$month_key-$day_key"));
					$month 	= date("m", strtotime("$year_key-$month_key-$day_key"));
					
					$out .= "<li class='link'>
						<a href='#'>
							<span class='arc_day'>$day.$month</span>
							<span class='arc_title'>{$post["title"]}</span>
							<span class='arc_comment'>Comments: {$post["count"]}</span>
						</a>
					</li>";
				}	
			}
		}
		$out .= "</ul>";
	}
	$out .= "</div>";
	return preg_replace("|<!--WP_archives-->|", $out, $content);
}


add_action('the_content', 'wp_archives');
add_action('wp_head', 'wp_archives_css');

function wp_archives_css(){ ?>

<style type="text/css">
.arc ul{
	margin-left:1em;
}
.arc ul li{
	__padding-bottom:5px;
	list-style-type:none;
	border-bottom:1px solid #eee;
}
.post .panel_content .arc .arc_list a{
	border-bottom:none;
	padding:3px;
}
.post .panel_content .arc .arc_list a:hover{
	border-bottom:none;
	background-color:#eee;
}
.arc_day, .arc_title, .arc_comment{
	border:1px solid #eee;
	display:inline-block;
	
}
.arc_day{
	width:40px;
}
.arc_title{
	width:360px;
}
.arc_comment{
	width:100px;
	font-size:0.9em;
	color:#686868;
	display:none;
}
.arc_list{
	__display:none;
}
</style>
<script type="text/javascript">
	var $j = jQuery.noConflict();
	
	$j(document).ready(function($j) {
		
		$j(".arc_header").click(function(e){
			e.preventDefault();
			$j(this).next().slideToggle("slow");
		});
		
		$j(".arc_list li a").hover(
			function(){
				$j(this).find(".arc_comment").show();
				//$j(this).find("span:last").show();
			
			}, 
			function(){
				$j(this).find(".arc_comment").hide();
			
			}
		);
		

	});
	
</script>
<?php }




