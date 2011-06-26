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
	<script src="/mint/?js" type="text/javascript"></script>

</head>
<body>

<div id="header">
	<div id="logo"><a href="<?php bloginfo('home');?>"><img src="<?php bloginfo('template_url');?>/images/logo.png" alt="Back home"/></a></div>
	<?php include(TEMPLATEPATH."/searchform.php");?>
	<div class="clear"></div>
	<ul id="globalnav">
		<?php wp_list_pages("depth=1&title_li=");?>
	</ul>
</div>
<div id="wrap">
	<div id="content">
		<div class="adsense_ad"><?php if(function_exists('adsense_deluxe_ads'))adsense_deluxe_ads('banner_big'); ?></div>
