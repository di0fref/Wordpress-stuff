<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
		
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
	    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
	    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.easing.min.js"></script>
    	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.lavalamp.min.js"></script>
    	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"></script>
		
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		
		<?php wp_head(); ?>
	</head>
	<body<?php if ( is_tag() || is_home() || is_404() || is_category() || is_day() || is_month() || is_year() ) { ?> id="home"<? } ?>>
		<div id="container">
			<div id="header">
				<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				<div class="subtitle"><?php bloginfo('description'); ?></div>
				
				<ul id="subscribe">
					<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><strong>Subscribe via RSS,</strong> New posts in your reader</a></li>
					<!--<li class="email"><a href="http://www.feedburner.com/fb/a/emailverifySubmit?feedId={FeedBurner ID}"><strong>Subscribe via E-mail,</strong> Get new posts on your e-mail</a></li>-->
				</ul>
			</div>
			<div id="menu">
				<ul>
					<li<?php if ( is_home() ) { ?> class="current_page_item"<? } ?>><a href="<?php echo get_option('home'); ?>/">Home</a></li>
					<?php wp_list_pages("title_li=&depth=1") ?>
				</ul>
				<?php if ( function_exists("get_search_form")) get_search_form(); else include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>