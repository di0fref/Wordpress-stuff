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
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/tabs.js"></script>
	<?php wp_head(); ?>
</head>

<body>
<div id="wrap">	

	<div id="header">
		<div id="logo" onclick="location.href='<?php bloginfo('home');?>';" style="cursor:pointer;"></div>
		<div class="clear"></div>
			<ul id="menu">
				<?php wp_list_pages("depth=1&title_li=");?>
			</ul>
	</div>
	<?php if(is_home()){?>
	<div id="featured">
	<?php the_post();?>
	<div class="entry_featured">
		<div class="topad">
<script type="text/javascript">
Vertical1235543 = false;
ShowAdHereBanner1235543 = true;
RepeatAll1235543 = false;
NoFollowAll1235543 = false;
BannerStyles1235543 = new Array(
	"a{display:block;font-size:11px;color:#888;font-family:verdana,sans-serif;margin:0 4px 10px 0;text-align:center;text-decoration:none;overflow:hidden;}",
	"img{border:0;clear:right;}",
	"a.adhere{color:#666;font-weight:bold;font-size:12px;border:1px solid #ccc;background:#e7e7e7;text-align:center;}",
	"a.adhere:hover{border:1px solid #999;background:#ddd;color:#333;}"
);

document.write(unescape("%3Cscript src='"+document.location.protocol+"//s3.buysellads.com/1235543/1235543.js?v="+Date.parse(new Date())+"' type='text/javascript'%3E%3C/script%3E"));
</script></div>
		<div class="entrytext">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<div class="meta">
			<p class="date"><?php the_date();?> 
			<a href="<?php comments_link();?>"><?php comments_number(__('No Comment'), __('1 Comment'), __('% Comments')); ?></a></p>

			<?php edit_post_link(" Edit");?>
		</div>

				<div class="text"><?php the_content();?></div>
		</div>
	</div>
	</div>
	<?php } ?>
	<div id="content">

	<div class="banner_big">			     
		<?php if(function_exists('adsense_deluxe_ads'))adsense_deluxe_ads('banner_big'); ?>
	</div>
