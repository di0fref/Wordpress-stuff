<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> <meta name="generator" content="HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<meta http-equiv="content-type" content="text/html; charset=us-ascii" /> 
<meta name="wordpress-theme" content="" /> 

<?php 
wp_enqueue_script("jquery");
if ( !is_admin() ) { 
	wp_register_script('jquery_class', get_bloginfo('template_directory') . '/js/jQuery.class.js', array('jquery'),'1.0' );
	wp_register_script('scaffold', get_bloginfo('template_directory') . '/js/script.js', array('jquery'),'1.0' );
	
	wp_enqueue_script('jquery_class');
	wp_enqueue_script('scaffold');
	
}
 
?>

<style type="text/css" media="screen"> 
	@import url( <?php bloginfo('stylesheet_url'); ?> );
</style> 
<?php wp_head();?>
</head>
<body> 
	
	<div id="container"> 
		<div id="header">
			 
				<h1><a href="<?php bloginfo('home');?>"><?php bloginfo('name');?></a></h1>
				<?php getSearchForm()?></div>
				<div id="page"> 
					<div id="cols"> 
						<div id="content" class="single_col">