<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes( 'html' ) ?>>
<head>
	<?php if ( is_front_page() ) : ?>
		<title><?php bloginfo('name'); ?></title>
	<?php elseif ( is_404() ) : ?>
		<title><?php _e('Page Not Found |'); ?> | <?php bloginfo('name'); ?></title>
	<?php elseif ( is_search() ) : ?>
		<title><?php printf(__ ("Search results for '%s'"), get_search_query()); ?> | <?php bloginfo('name'); ?></title>
	<?php else : ?>
		<title><?php wp_title($sep = ''); ?> | <?php bloginfo('name');?></title>
	<?php endif; ?>

	<!-- Basic Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="copyright" content="<?php
		esc_attr( sprintf(
			__( 'Design is copyright %1$s Fahlstad Design', 'sQuirrl' ),
			date( 'Y' )
		) );
	?>" />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.corner.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/cufon.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/cufon.fref.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />

	<!-- WordPress -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<style type="text/css" media="screen"> 
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		<div id="header">
			<div id="header_inner">
				<div id="logo">
					<h1>
						<a href="<?php bloginfo('siteurl'); ?>"><?php bloginfo('name'); ?></a>
					</h1>
				</div>
				<div id="nav">
					<ul><?php wp_list_pages('sort_column=menu_order&title_li=' ); ?></ul>
				</div>
			</div>
		</div><!--end header-->
	<div id="wrapper" >
	<div id="content">