<?php
/*
	Plugin Name: Live Archives
	Author: Fredrik Fahlstad
	Author URI: http://www.fahlstad.se
	Plugin URI: http://www.fahlstad.se
	Version: 1.0
*/

function livearchive($content){
	if(!preg_match("|<!--LIVEARCHIVE-->|", $content))
		return $content;
		
	$posts = get_posts("showposts=-1&orderby=date");
	
	$out .= "<div id='live'>
				<h4>All Articles By Date</h4>
				<form method='get' id='livesearchform' action='#'>
					<label for='q'>Filter:</label>
					<input type='text' value='' name='q' id='q' />
				</form>
			</div>";
			
	$out .= "<ul id='posts'>";
						
	foreach($posts as $post){
		$out .= "<li>
					<small>".mysql2date("F j, Y", $post->post_date)."</small>
						<a href='".get_permalink($post->ID)."'>$post->post_title</a>
				</li>";
	}
	$out .= "</ul>";
	return preg_replace("|<!--LIVEARCHIVE-->|", $out, $content);
}


add_action("the_content", "livearchive");
add_action("wp_head", "livearchive_head");


function livearchive_head(){?>

<style type="text/css">
	#posts{
		margin: 0;
		padding: 0;
		clear: both;
	}
	#posts li{
		list-style: none;
		__border-bottom: 1px solid #eee;
		padding: 5px;
	}
	.base_format #posts a{
		__font-weight: bold;
		text-decoration:none;
	}
	#posts small{
		font-size: 100%;
		float: right;
	}
	#live h4 {
		float: left;
	}
	#live{
		text-align: right;
		vertical-align: middle;
	}
</style>

	<script type="text/javascript" src="<?php bloginfo('url')?>/wp-content/plugins/livearchive/prototype.js"></script>
	<script type="text/javascript" src="<?php bloginfo('url')?>/wp-content/plugins/livearchive/quicksilver.js"></script>
	<script type="text/javascript" src="<?php bloginfo('url')?>/wp-content/plugins/livearchive/livesearch.js"></script>
	
<script type="text/javascript">
		
	document.observe('dom:loaded', function() { 
			new QuicksilverLiveSearch('q', 'posts');
			$('q').activate();
		});

</script>
<?php } ?>