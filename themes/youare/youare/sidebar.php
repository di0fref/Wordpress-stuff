<div id="sidebar" class="grid_7 omega">

<?php 
  if (is_page(2)) {
?>
 

  <div id="photo_author">

      <!-- Go to YouAre Options in WordPress Dashboard to paste a URL Photo in your About Page -->

       <img src="<?php $photo = get_option('Y_photo_url_about'); echo $photo?$photo: bloginfo('template_url').'/images/sidebar/photo_default_about.jpg' ?>" alt="Photo" />

    <?php include (TEMPLATEPATH . '/follow_links.php'); ?>
  </div>
<?php
    include (TEMPLATEPATH . '/searchform.php');
  } else {
    $about = get_option('Y_about');
?>
  <div class="bg_side">
      <div><strong><a class="more" href="<?php echo get_permalink('2') ?>"><?php _e('About the author', 'youare'); ?></a></strong>
<?php
    if ($about != '') {
?>
    
      <?php echo stripslashes($about); ?>  <a class="more" href="<?php echo get_permalink('2') ?>"><?php _e('Read more', 'youare'); ?></a>
<?php 
    } else {
?>
      <?php _e('Go to YouAre Options menu in your WP Dashboard and check out the Author Box Sidebar section.', 'youare'); ?>
<?php 
    }
    include (TEMPLATEPATH . '/follow_links.php');
?>    
    </div>
  </div> <!--end bg_side-->


  <div id="rss_links" class="clear">
  
	<?php $rss_url = get_option('y_feedburner_username'); 
	if ($rss_url != "") {
    $rsscounter = get_option('Y_feedburner_counter');
    echo $rsscounter?$rsscounter:'<a class="rss" href="http://feeds.feedburner.com/' . $rss_url . '">RSS</a> ';
	} 
	else { ?>
	<a class="rss" href="<?php bloginfo('rss2_url'); ?> "><?php _e('RSS', 'youare'); ?></a>
	<?php } ?>
							
          <?php $fbId = get_option('y_feedburner_email'); //Your Feedburner Username 
	if ( !empty($fbId) ) {?>	

          <a class="email" href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $rss_url; ?>"><?php _e('Email Updates', 'youare'); ?></a>


	<?php } ?>

     
   </div>
		




<?php
    if ((is_category() || is_home() || is_month() || is_year() || is_tag() || $is_home_too)) {
      include (TEMPLATEPATH . '/searchform.php');
    }
  }
  $adbox = get_option('Y_adbox'); 
	$adurl1 = get_option('Y_adurl_1');
  $adlink1 = get_option('Y_adlink_1');
  $adalt1 = get_option('Y_adalt_1');
	$adurl2 = get_option('Y_adurl_2');
  $adlink2 = get_option('Y_adlink_2');
  $adalt2 = get_option('Y_adalt_2');

  if ($adbox == 'true') {
?>
  <div id="adbox" class="clear">
    <a href="<?php if ($adlink1 != '') echo htmlspecialchars($adlink1, UTF-8); else echo "#"; ?>"><img class="alignleft" src="<?php bloginfo('template_url'); ?>/images/sidebar/<?php if ($adurl1 != '') echo $adurl1; else echo "125_ad.gif"; ?>" width="125" height="125" alt="<?php if ($adalt1 != '') echo stripslashes($adalt1); else echo bloginfo('name'); ?>" /></a>
    <a href="<?php if ($adlink2 != '') echo htmlspecialchars($adlink2, UTF-8); else echo "#"; ?>"><img class="alignright" src="<?php bloginfo('template_url'); ?>/images/sidebar/<?php if ($adurl2 != '') echo $adurl2; else echo "125_ad.gif"; ?>" width="125" height="125" alt="<?php if ($adalt2 != '') echo stripslashes($adalt2); else echo bloginfo('name'); ?>" /></a>
  </div><!--end adbox-->
<?php 
  }
  // let's generate info appropriate to the page being displayed
  if (is_home()) {
    // we're on the home page, so let's show a list of all top-level categories
    echo "<h2>".__('Topics', 'youare')."</h2><ul>";
    wp_list_categories('hierarchical=1&sort_column=name&show_count=1&title_li=');
    echo "</ul>";
  } elseif (is_page()) {
    // we're looking at a static page.  Which one?
    if (is_page(2) || is_page('archivos','arxius','archives')) {
      // our about page, archives.
      echo "<h2>".__('Topics', 'youare')."</h2><ul>";
      wp_list_categories('hierarchical=1&sort_column=name&show_count=1&title_li=');
      echo "</ul>";
    } elseif (is_page('Contact')) {
      echo "<!-- <p>Contact page text</p> -->";
    } else {
      // catch-all for other pages
      echo "<?php include (TEMPLATEPATH . '/searchform.php'); ?> ";
    }
  } else {
    // catch-all for everything else (archives, searches, 404s, etc)
    echo "";
  } // That's all, folks!

  if (is_single()) {
    if (!get_option('Y_youare_toggle') || !get_option('Y_twitter_toggle')) {
?>
     
<?php
      if (function_exists('get_youare_latest_updates') && get_option('Y_youare_toggle_updates')) get_youare_latest_updates();
      if (function_exists('get_twitter_latest_updates') && get_option('Y_twitter_toggle_updates')) get_twitter_latest_updates();
    }
?>

    <h2><?php _e('Recent Articles', 'youare'); ?></h2>
		<ul>			
<?php
    $side_posts = get_posts('numberposts=3');
    foreach($side_posts as $post) {
?>
      <li><a href= "<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a> <br /> <?php the_time('F jS, Y') ?></li>
<?php
    }
?>
		</ul>
<?php
  }
  if ((is_archive() || is_category() || is_home() || $is_home_too)) {
?>
    <h2><?php _e('Archives', 'youare'); ?></h2>
<?php
    get_year_archives('monthly');

    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar() ) {
?>
    <div class="widget widget_links">
      <h2 class="widgettitle"><?php _e('Blogroll', 'youare'); ?></h2>
      <ul>
        <?php get_links('-1', '<li>', '</li>', '', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
      </ul>
    </div>
<?php
    }
  }
  if ((is_single() || is_home() || is_page (2) || $is_home_too)) {
    $flickr_off = get_option('Y_flickr_off');
    if ($flickr_off && ($flickr = get_option('Y_flickr'))) {
?>
      <h2>Flickr</h2><div id="flickr_container">
<?php
      $url = 'http://www.flickr.com/photos/'.$flickr;

      $html = file_get_contents($url);

      preg_match_all('/<a[^>]*><img[^>]*src="[^"]*farm\d\.static[^"]*"[^>]*\/><\/a>/', $html, $matches);

      $cont = 1;
      foreach(array_slice($matches[0], 1, 6) as $div) {
        $div = str_replace(array("_m.", 'href="'), array("_s.", 'href="http://www.flickr.com'), $div);
        if ($cont== 3 || $cont==6) {
          $div = str_replace('class="pc_img"', 'class="nomargin"', $div);
        }
        echo $div;
        $cont++;
      }
      echo '</div>';
    }
  }
?>





  </div><!--end sidebar-->

</div><!--end content-background-->
