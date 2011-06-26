<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
  <head profile="http://gmpg.org/xfn/11">

   <?php load_theme_textdomain('youare', get_template_directory().'/lang'); ?>

	<?php if( is_front_page() ) : ?>
	<title><?php bloginfo('name'); ?> | <?php bloginfo('description');?></title>
	<?php elseif( is_404() ) : ?>
	<title><?php _e('Page not found', 'youare'); ?> | <?php bloginfo('name'); ?></title>
    <?php elseif( is_search() ) : ?>
    <title><?php  print __('Search Results for ') . wp_specialchars($s); ?> | <?php bloginfo('name'); ?></title>
		<?php else : ?>
		<title><?php wp_title($sep = ''); ?> | <?php bloginfo('name');?></title>
		<?php endif; ?>

	<!-- Basic Meta Data -->
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
        <?php csv_tags(); ?>
         <?php endwhile; endif; elseif(is_home()) : ?>
         <meta name="description" content="<?php bloginfo('description'); ?>" />
         <?php endif; ?>

         <?php if (is_category()) : ?>
         <meta name="description" content="<?php $category = get_the_category(); echo $category[0]->category_description; ?>" />
         <?php endif; ?>

	<!--Stylesheets-->

	<link href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" rel="stylesheet" />

	<?php 	$y_alt_stylesheet = get_option('Y_alt_stylesheet'); if ( $y_alt_stylesheet && !($y_alt_stylesheet == 'Select a stylesheet:') ) {
				echo '<link rel="stylesheet" href="' . get_bloginfo('template_directory') . '/' . $y_alt_stylesheet . '" type="text/css" media="screen" />';
			} else {
  ?>
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/1_default_colors.css" type="text/css" media="screen" />
  <?php
      }
	?>


        <link href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print" rel="stylesheet"  />


	<!-- Feeds -->
	<?php $rss_url = get_option('Y_feedburner_username');
		if ($rss_url != "") { ?>
		 <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>RSS 2.0 Feed" href="http://feeds.feedburner.com/<?php echo $rss_url; ?>" />
		<?php } else { ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<?php } ?>	
	
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e('Comments RSS 2.0 Feed'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
	
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--WP Hook-->
         <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

       <?php wp_head(); ?>
	

</head>
<body<?php if (is_single() || is_archive()) echo(' id="archives_page"');?>>
  <div id="header">
    <div class="container_24">
      <div class="grid_24 vcard">
        <a class="photo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php echo get_avatar( get_settings('admin_email'), '55' ); ?></a>
        <?php if (is_home()) echo('<h1 id="logo">'); else echo('<div id="logo">');?><a class="url" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><span class="fn"><?php bloginfo('name'); ?></span></a><?php if (is_home()) echo('</h1>'); else echo('</div>');?>
     
        <ul class="nav">
        <!-- Header navigation recommended: Home | Archives | About | Contact 
               Excludes pages selected in YouAre Theme options. -->
<?php 
  $exclude_pages = get_option('Y_pages_to_exclude');
  $hide_pages = get_option('Y_hide_pages');
  if ($hide_pages != 'true') {
?>
          <li class="home page_item <?php if (is_home()) echo('current_page_item');?>"><a href="<?php bloginfo('url'); ?>" accesskey="1" title="<?php _e('Home'); ?> (Alt+1)"><?php _e('Home'); ?></a></li>
          <li<?php if ( is_page('arxius') || is_page('archives') || is_page('archivos') || is_archive() || is_search() || is_single()) { echo ' class="current"'; } ?>><a href="<?php bloginfo('url'); ?>/<?php _e('archives', 'youare'); ?>" accesskey="2" title="<?php _e('Archives', 'youare'); ?> (Alt+2)"><?php _e('Archives', 'youare'); ?></a></li>

          <?php
             $my_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".__('Archives', 'youare')."'");
            wp_list_pages('depth=-1&title_li=&exclude='. $exclude_pages.','.$my_id);
             }
          ?>

        </ul>

      </div><!--end vcard-->
    </div><!--end container_24-->
  </div><!--end header-->


  <div class="splash">
    <div class="container_24">
       <div class="grid_24">
