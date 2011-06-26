<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php 
		if (is_archive()) : ?>Archive: <?php endif; 
		if (is_home()) : bloginfo('name') ?> /  <?php bloginfo('description'); endif;
		if (is_search()) : ?>Search results for: &laquo;<?php print wp_specialchars($s, 1); ?>&raquo; in <?php endif;
		wp_title(''); 
		if (!is_404() && !is_search() && !is_home()) : print ' / '; endif; 
		if (!is_home()) : bloginfo('name'); endif; ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/konstruktors.css" type="text/css" media="Screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="Screen" />
	<!--[if lt IE 7.]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie-fix.css" type="text/css" /><![endif]-->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<?php wp_head(); ?>
</head>
<body>
<div id="soul">

<div id="header" class="bb-tbase">
	<p class="logo"><strong><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></strong></p>
	<p class="slogan"><em><?php bloginfo('description'); ?></em></p>
	<div id="nav-main" class="nav-h">
		<ul>
			<?php wp_list_pages('depth=1&title_li='); // &exclude=7 ?>
		</ul>
	</div>
</div><!--header--><hr />
