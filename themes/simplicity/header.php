<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?><?php wp_title("&bull;", true, ""); ?></title>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		@import url( <?php bloginfo('template_url'); ?>/style.colors.css );
	</style>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo("template_url");?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo("template_url");?>/js/jquery.incsearch.js"></script>
	<script type="text/javascript" src="<?php bloginfo("template_url");?>/js/jquery.accordion.js"></script>
	<script type="text/javascript" src="<?php bloginfo("template_url");?>/com.js"></script>


	
	
<script>
jQuery('#menu').accordion(); 
$(function(){
	$('#quickSearch')
		.incrementalSearch({
			items: 'dl.entryList > dt',
			foundCounter: '#resultCount',
			totalCounter: '#totalCounter'
		})
		.focus();
})
</script></head>
<body>

	<div id="header">
		<div id="logo"><h1><a href="<?php bloginfo("home");?>">FahlstadDesign</a></h1></div>
		<div id="nav">
				
				<div class="navitem">
					<p class="cat">ABOUT ME</p>
					<ul id="wp">
						<li><a href="contact">Contact</a></li>
						<li><a href="about">About me</a></li>
						<li><a href="services">Portfolio</a></li>
					</ul>
				</div>
				
				<div class="navitem">
					<p class="cat">WORDPRESS</p>
					<ul id="me">
						<li><a href="wp-forum">Forum</a></li>
						<li><a href="wp-plugins">Plugins</a></li>
						<li><a href="wp-themes">Themes</a></li>
					</ul>
				</div>
		
				<div class="navitem">
					<p class="cat">MISC</p>
					<ul id="misc">
						<li><a href="archive">Archives</a></li>
						<li><a href="feeds">Feeds</a></li>
						<li><a href="#">Forum</a></li>
					</ul>
				</div>
				
				
			<!--<ul><?php wp_list_pages("depth=1&title_li=");?></ul><br />-->
			
		
		</div>
		<div class="clear"></div>
	</div>	
	<div id="content">
	
	
	
	
	
	
	
	
	
	
	
	
	
