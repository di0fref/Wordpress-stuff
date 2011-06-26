<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats please -->
<style type="text/css" media="screen">
		<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->
		</style>
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/ie.css">
		<![endif]-->

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php wp_head(); ?>
</head>




<body id="home" class="log">
<div id="wrap">

<!-- The header begins  -->
<div id="header">
		<h1><a href="<?php bloginfo('siteurl'); ?>"><?php bloginfo('name'); ?></a></h1>
  <div id="subtitle">
      <!-- Here's the tagline  -->
		<div class="description"><?php bloginfo('description'); ?>
		</div>
  </div>
</div>
<div id="headerimage"></div>
<!-- The header ends  -->

<!-- The main content column begins  -->
