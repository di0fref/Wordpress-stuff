<?php
define ('FUNCTIONS', TEMPLATEPATH . '/functions');
define ('COPY', FUNCTIONS . '/youare.php');
require_once (FUNCTIONS . '/comments.php');
require_once (FUNCTIONS . '/youare-admin.php');

// Meta description and keywords
function csv_tags() {
  $list = get_the_tags();
  if ($list) {
    foreach($list as $tag) {
      $csv_tags[] = $tag->name;
    }
  }
  foreach((get_the_category()) as $tag) {
		$csv_tags[] = $tag->cat_name;
	}
	echo '<meta name="keywords" content="'.implode(',',$csv_tags).'" />';
}


// Widgets Sidebar
if ( function_exists('register_sidebar_widget') )
    register_sidebar(array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

function set_canonical() {
  if ( is_single() or is_page() ) {
    global $wp_query;
    echo '<link rel="canonical" href="'.get_permalink($wp_query->post->ID).'"/>';
  }
}
add_action('wp_head', 'set_canonical');

// Comments hack: Permalinks: edit, delete or mark certain comments as spam without visiting your WordPress dashboard (http://www.smashingmagazine.com/2009/07/23/10-wordpress-comments-hacks/)

function delete_comment_link($id) {  
if (current_user_can('edit_post')) {  
echo '| <a title="Delete comment" href="'.admin_url("comment.php?action=cdc&c=$id").'">delete</a> ';  
echo '| <a title="Mark comment as spam" href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">mark as spam</a>';  
}  
}


// Comment hack: this code automatically rejects any request for comment posting coming from a browser (or, more commonly, a bot) that has no referrer in the request

function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == рс) {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!') );
    }
}

add_action('check_comment_flood', 'check_referrer');

// Numerical Page Navigation: (Lester Chan - http://lesterchan.net/wordpress/readme/wp-pagenavi.html)
### Function: Page Navigation Options
function pagenavi_init() {
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','wp-pagenavi');
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = __('&laquo; First','wp-pagenavi');
	$pagenavi_options['last_text'] = __('Last &raquo;','wp-pagenavi');
	$pagenavi_options['next_text'] = __('&raquo;','wp-pagenavi');
	$pagenavi_options['prev_text'] = __('&laquo;','wp-pagenavi');
	$pagenavi_options['dotright_text'] = __('...','wp-pagenavi');
	$pagenavi_options['dotleft_text'] = __('...','wp-pagenavi');
	$pagenavi_options['style'] = 1;
	$pagenavi_options['num_pages'] = 5;
	$pagenavi_options['always_show'] = 0;
	return $pagenavi_options;
}

### Function: Page Navigation: Boxed Style Paging
function wp_pagenavi($before = '', $after = '') {
	global $wpdb, $wp_query; 
	$pagenavi_options = array();
	$pagenavi_options = pagenavi_init();

	if (!is_single()) {
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		
		/*
		$numposts = 0;
		if(strpos(get_query_var('tag'), " ")) {
		    preg_match('#^(.*)\sLIMIT#siU', $request, $matches);
		    $fromwhere = $matches[1];			
		    $results = $wpdb->get_results($fromwhere);
		    $numposts = count($results);
		} else {
			preg_match('#FROM\s*+(.+?)\s+(GROUP BY|ORDER BY)#si', $request, $matches);
			$fromwhere = $matches[1];
			$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		}
		$max_page = ceil($numposts/$posts_per_page);
		*/
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = intval($pagenavi_options['num_pages']);
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
			echo $before.'<div class="wp-pagenavi">'."\n";
			switch(intval($pagenavi_options['style'])) {
				case 1:
				
					if(!empty($pages_text)) {
						echo '<span class="pages">&#8201;'.$pages_text.'&#8201;</span>';
					}					
					if ($start_page >= 2 && $pages_to_show < $max_page) {
						$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
						echo '<a href="'.clean_url(get_pagenum_link()).'" title="'.$first_page_text.'">&#8201;'.$first_page_text.'&#8201;</a>';
						if(!empty($pagenavi_options['dotleft_text'])) {
							echo '<span class="extend">&#8201;'.$pagenavi_options['dotleft_text'].'&#8201;</span>';
						}
					}
					previous_posts_link($pagenavi_options['prev_text']);
					for($i = $start_page; $i  <= $end_page; $i++) {						
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							echo '<span class="current">&#8201;'.$current_page_text.'&#8201;</span>';
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							echo '<a href="'.clean_url(get_pagenum_link($i)).'" title="'.$page_text.'">&#8201;'.$page_text.'&#8201;</a>';
						}
					}
					next_posts_link($pagenavi_options['next_text'], $max_page);
					if ($end_page < $max_page) {
						if(!empty($pagenavi_options['dotright_text'])) {
							echo '<span class="extend">&#8201;'.$pagenavi_options['dotright_text'].'&#8201;</span>';
						}
						$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
						echo '<a href="'.clean_url(get_pagenum_link($max_page)).'" title="'.$last_page_text.'">&#8201;'.$last_page_text.'&#8201;</a>';
					}
					break;
				case 2;
					echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
					echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
					for($i = 1; $i  <= $max_page; $i++) {
						$page_num = $i;
						if($page_num == 1) {
							$page_num = 0;
						}
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							echo '<option value="'.clean_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							echo '<option value="'.clean_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
						}
					}
					echo "</select>\n";
					echo "</form>\n";
					break;
			}
			echo '</div>'.$after."\n";
		}
	}
}



// Monthly archive grouped by year (Oriol Morell - http://oriolmorell.cat)

function get_year_archives($type='monthly', $show_post_count = false) {
        global $month, $wpdb;

        // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
        $archive_date_format_over_ride = 0;

        $now = current_time('mysql');

	$arcresults = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts WHERE post_date < '
$now' AND post_date != '0000-00-00 00:00:00' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC" . $limit);
                if ( $arcresults ) {
                        $afterafter = $after;
			$act_year=0;
			$output="";
                        foreach ( $arcresults as $arcresult ) {
				if ($act_year!=$arcresult->year) {
					if (strlen($output)) {
						$output.="</ul></li>";
					} 
					$act_year=$arcresult->year;
					$output.="<li>".$act_year.": <ul class='months'>";
				}
                                $url = get_month_link($arcresult->year, $arcresult->month);
                                if ( $show_post_count ) {
                                        $text = sprintf('%s', substr($month[zeroise($arcresult->month,2)],0,3));
                                        $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                                } else {
                                        $text = sprintf('%s', substr($month[zeroise($arcresult->month,2)],0,3));
                                }
                                $output.="<li>".get_archives_link($url, $text, $format, $before, $after)."</li>";
                        }
			echo "<ul class='year_arch'>".$output."</ul></li></ul>";
	        }
}


// Gravatar Favicon (Patrick Chia - http://patrick.bloggles.info/plugins/)

if ( !function_exists( 'get_favicon' ) ) :
function get_favicon( $id_or_email, $size = '96', $default = '', $alt = false){
	$avatar = get_avatar($id_or_email, $size, $default, $alt);

	$openPos = strpos($avatar, 'src=\'');
	$closePos = strpos(substr($avatar, ($openPos+5)), '\'');
	$newAvatar = substr($avatar, ($openPos+5), ($closePos-($openPos+5)) );
	
	return $newAvatar;
}
endif;

function blog_favicon() {
	$apple_icon = get_favicon( get_bloginfo('admin_email'), 60 );
	$favicon_icon = get_favicon( get_bloginfo('admin_email'), 18 );

	if ( get_option('show_avatars') ) {
		echo "<link rel=\"apple-touch-icon\" href=\"$apple_icon\" />\n";
		echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"$favicon_icon\" />\n";
	}
}

function admin_logo() {
	$admin_logo = get_favicon( get_bloginfo('admin_email'), 31 );

	if ( get_option('show_avatars') ) {
	?>
	<style type="text/css">
		#header-logo{background: transparent url( <?php echo $admin_logo; ?> ) no-repeat scroll center center;
		-moz-border-radius: 5px;
		-webkit-border-bottom-left-radius: 5px;	-webkit-border-bottom-right-radius: 5px; -webkit-border-top-left-radius: 5px; -webkit-border-top-right-radius: 5px;
		-khtml-border-bottom-left-radius: 5px;-khtml-border-bottom-right-radius: 5px;-khtml-border-top-left-radius: 5px;-khtml-border-top-right-radius: 5px;
		border-bottom-left-radius: 5px;	border-bottom-right-radius: 5px;border-bottom-top-radius: 5px;border-bottom-top-radius: 5px;}
		</style>
	<?php
	}
}

function add_feed_logo() {
	$feed_logo = get_favicon( get_bloginfo('admin_email'), 48 );
	echo "
   <image>
    <title>". get_bloginfo('name')."</title>
    <url>". $feed_logo ."</url>
    <link>". get_bloginfo('siteurl') ."</link>
   </image>\n";
}

add_action( 'wp_head', "blog_favicon" );
add_action( 'admin_head', 'blog_favicon' );
add_action( 'login_head', 'blog_favicon' );
add_action( 'admin_head', 'admin_logo' );
add_action('rss_head', add_feed_logo );
add_action('rss2_head', add_feed_logo );
?>
<?php if ( !function_exists('y_addgravatar') ) {
	function y_addgravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory').'/images/youare_gravatar.png';
                //default avatar
		$avatar_defaults[$myavatar] = 'YouAre.com';

		return $avatar_defaults;
	}

	add_filter( 'avatar_defaults', 'y_addgravatar' );
}

 ?>
<?php remove_action('wp_head', 'wp_generator'); ?>
<?php remove_action('wp_head', 'rsd_link'); ?>
<?php remove_action('wp_head', 'wlwmanifest_link'); ?>