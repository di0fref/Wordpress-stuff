<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<link rel="stylesheet" href="http://www.showoffrankings.com/showoffrankings.css" type="text/css" />
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/bg.jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/tabs.js"></script>
	<script type="text/javascript">
	</script>
	<?php wp_head(); ?>
</head>

<body>
<?php 
if(is_home())
	echo "<div id='wrap_index'>";
else 
	echo "<div id='wrap'>";
?>

	<div id="header">
		<div id="logo" onclick="location.href='<?php bloginfo('home');?>';" style="cursor:pointer;"></div>
		<div class="clear"></div>
		<div id="nav">
			<ul id="menu">
				<?php wp_list_pages("depth=1&title_li=");?>
			</ul>
		</div>
	</div>
<div id="bg">