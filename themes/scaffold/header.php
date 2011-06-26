<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> <meta name="generator" content="HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<meta http-equiv="content-type" content="text/html; charset=us-ascii" /> 
<meta name="tumblr-theme" content="8951" /> 
<link rel="shortcut icon" href="http://24.media.tumblr.com/avatar_f9851fea7203_16.png" /> 
<link rel="alternate" type="application/rss+xml" href="http://mitchellhashimoto.com/rss" /> 

<?php 
wp_enqueue_script("jquery");
if ( !is_admin() ) { 
	wp_register_script('jquery_class', get_bloginfo('template_directory') . '/js/jQuery.class.js', array('jquery'),'1.0' );
	wp_register_script('scaffold', get_bloginfo('template_directory') . '/js/script.js', array('jquery'),'1.0' );
	
	wp_enqueue_script('jquery_class');
	wp_enqueue_script('scaffold');
	
}
wp_head(); 
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<style type="text/css" media="screen"> 
	@import url( <?php bloginfo('stylesheet_url'); ?> );
</style> 

</head>
<body> 
	<div id="container"> 
		<div id="header"> 
				<h1><a href="<?php bloginfo('home');?>"><?php bloginfo('name');?></a></h1>
				<form action="search.php" method="get" id="search"> <fieldset> <input type="text" name="q" id="search_field" value="" /> <input type="submit" id="search_button" value="Search" /> </fieldset> </form> </div>
				<div id="page"> 
					<div id="cols"> 
						<div id="content" class="single_col">