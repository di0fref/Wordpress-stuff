<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?><?php wp_title("&bull;", true, ""); ?></title>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>

</head>

<body>
<div id="header-wrap"><div id="header">
			
			<div id="logo">

				<h1><a href="http://astuteo.com/" title="Return to Home Page">Astuteo: Graphic Design, Web Development, and Creative Strategy</a></h1>

			</div>

                             <ul id="nav">
                             	<li id="thome"><a href="http://www.astuteo.com" title="Home" >Overview</a></li>
                             	<li id="tadvice"><a href="http://astuteo.com/blog/" title="Free Advice" class="selected">The Free Advice Blog</a></li>
                             	<li id="tcontact"><a href="http://astuteo.com/contact/" rel="nofollow" title="Contact" >Get In Touch</a></li>
                             </ul>
			
			<div class="clearfix"></div>

		</div></div> <!-- end header-wrap & header -->
