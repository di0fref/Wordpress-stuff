<?php @include_once( $_SERVER["DOCUMENT_ROOT"]."/slimstat/inc.stats.php" ); ?>
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
<meta name="description" content="Fahlstad.se, home of the fMoblog plugin for WordPress and the personal website of the computer engineer/programmer Fredrik Fahlstad. " />
<meta name="keywords" content="fredrik, fahlstad, design, apple, windows, windows xp, linux, ipod,programming, c++,c cjava, c#, assembler, computer, gadgets, tech, journal, showroom, articles, forum, textmate, lifesaver, isnip, weblog, blog, fmoblog, fMoblog, farc, fArc, themes, wordpress themes, fdawn, fDawn" />
<meta name="author" content="Fredrik Fahlstad" />
<meta name="publisher" content="Fredrik Fahlstad" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />
<link rel="shortcut icon" href="<?php bloginfo('wpurl');?>/wp-content/favicon.ico" type="image/x-icon" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<!-- leave this for stats please -->
<style type="text/css" media="screen">
		<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->
		</style>
	

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/prototype.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/general.js"></script>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>

</head>
<body>




<div id="wrap">
<!--<div id="top"><a href="#morenav">Skip to navigation</a></div>-->
		<div id="header">
		<div id="logo"></div>
		
		<div id="rss" onclick="location.href='/feeds';" style="cursor: pointer;">	</div>
		<div id="nav">
			<ul>
				<li <?php if(is_home()) echo "class='current_page_item'";?>><a href="<?php bloginfo('url'); ?>">Home</a></li>
  				<?php wp_list_pages('depth=1&title_li=&exclude=5,95,279' ); ?>
  				<li <?php if(defined('FIM')) echo "class='current_page_item'";?>> <a href="/photos">Photos</a></li>
			</ul>
			<?php include(TEMPLATEPATH ."/searchform.php")?>
		</div>	
		</div>
		<div id="searchresults"></div>
		<?php adsense_deluxe_ads('banner'); ?>
		
	<!--<div class="shadow"></div>-->