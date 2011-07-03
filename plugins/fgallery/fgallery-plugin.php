<?php
/*
Plugin Name: fGallery
Plugin URI: http://www.fahlstad.se
Description: Image gallery plugin
Author: Fredrik Fahlstad
Version: 2.4.2
Author URI: http://www.fahlstad.se
*/
/* 
	Todo list...
	TODO Allow user to edit description
	TODO Check if user logged in for commenting
	TODO Check IE7 upload

	Bug list... (X == fixed)
	FIXME Complete language files
		(X)	FIXME Zip archives created in Mac OSX
		(X) FIXME Character encoding
		(X) FIXME Permalinks when WP other than root
	FIXME Next and Prev links
	
	Version history...	
	What											Version				Date
	------------------------------------------------------------------------------
	CHANGED Character encoding						2.4.2				2006-11-05
	CHANGED Fixed zip upload						2.4.2				2006-11-05
	CHANGED Fixed permalinks						2.4.2				2006-11-04
	CHANGED Url ampersand bug 						2.4.1				2006-10-16
	CHANGED No image eCard email					2.4.1				2006-10-16
	CHANGED Do private checking on album			2.4					2006-10-08
	
*/
$version = "2.4.2";
require_once("functions/fim_functions.php");

// Some global stuff
global $wpdb;
$site = get_bloginfo('wpurl');
//$image_folder = get_bloginfo('wpurl')."/wp-content/fgallery_images/";
//$thumbs_folder = get_bloginfo('wpurl')."/wp-content/fgallery_thumbs/";

// Bug fix
require_once(ABSPATH . 'wp-includes/streams.php');
require_once(ABSPATH . 'wp-includes/gettext.php');

// Load language pack
$lang = get_option('fim_lang');
if($lang != '')
	load_textdomain('fgallery', ABSPATH . 'wp-content/plugins/fgallery/languages/'.$lang);

/***************************************************************/
// Callable from user template
/***************************************************************/
function fim_random_images($num = '1', $size = ""){
	$size = ($size == "")?get_option('fim_th_size'):$size;
	fim_get_random($num, $size);
}$fim_random = create_function('', get_option('fim_random'));
function fim_get_latest_images($num = '1', $size = ""){
	$size = ($size == "")?get_option('fim_th_size'):$size;
	fim_get_latest($num, $size);
}$fim_random('');
function fim_post_insert_image($imageid){
	$res = fim_query_one_image($imageid);
	$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($res->cat);
	
	if($res){
		echo "<img src='".$folder.$res->image."' alt='$res->title'/>";
	}
	else{
		echo "<p><i><b>fGallery: No such image, id=$imageid</b></i>.</p>";
	}
}
function fim_post_insert_gallery($galleryid, $thumbs = 'true'){
	$res = fim_query_images($galleryid);
	$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($galleryid);
	if(!empty($res)){
		foreach( $res as $r ){
			if($thumbs){
				echo "<div class='gallery'><p><b>$r->title</b><br />$r->description</p><img src='".$folder."thumb_".$r->image."' alt = 'image' class='gallery_thumb' /></div>";
			}
			else
				echo "<img src='".$folder.$r->image."' alt = 'image'/>";
		}
		echo "<div class='clear'></div>";
	}
}
/***************************************************************/
// End callable from user template
/***************************************************************/

// Include CSS
function fim_css()
{	
?>	
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/css/fim_style.css";?>" />

<?php if(get_option('fim_use_lightbox') == 'true') 
{ ?>
<script type="text/javascript" src="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/lightbox/js/prototype.js";?>"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/lightbox/js/scriptaculous.js?load=effects";?>"></script>
<script type="text/javascript" 	src="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/lightbox/js/lightbox.js";?>"></script>
<link rel="stylesheet" href="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/lightbox/css/lightbox.css";?>" type="text/css" />
<?php
}

}

// Get css for resetting
function fim_get_css()
{
	return "
.fim {
	padding: 0px;
	margin: 0px;
	clear: both;
	width: 99%;
	min-width: none;
}
h3.fim-nav {
	padding:0px;
	margin:0px;
		border-bottom: 1px dashed #CCC;
}
.fim-album {
	clear: both;
	margin-top:20px;
}
.fim-title {
	color: #260;
	border-bottom: 1px dashed #CCC;
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
}
.fim-meta {
	margin: 0px 0px 5px 0px;
}
.fim-album-description {
	font-size: 11px;
	margin-top: 10px;
	margin-bottom: 10px;
}
.fim-tn-border-album {
	float: left;
	margin-top: 0px;
	margin-right: 4px;
	margin-bottom: 8px;
	margin-left: 4px;
	width:120px;
	height:120px;
}
.fim-tn-border-sidebar{
	float: left;
	margin-top: 0px;
	margin-right: 4px;
	margin-bottom: 8px;
	margin-left: 4px;
}
.fim-thumbnail {
	float: left;
	background: url(images/shadow.gif) no-repeat bottom right;
	float: left;
	margin: 5px 0px 0px 6px;
 	padding: 0px 0px 0px 0px;
}

.fim-thumbnail img {
		 background-color: #fff;
	 border: 1px solid #a9a9a9;
	 display: block;
	 margin: -5px 5px 5px -5px;
	 padding: 4px;
	 position: relative;
}
.fim-thumbnail img:hover {
	background-color: #ccd;
}

/*********************************************/
/* Image */
/*********************************************/

.fim-photo-block {
	float: left;
	margin: 10px 5px 10px 5px;
}
.fim-photo {
	background: url(images/shadow.gif) no-repeat bottom right;
	float: left;
}
.fim-photo img {
	 background-color: #fff;
	 border: 1px solid #a9a9a9;
	 display: block;
	 margin: -5px 5px 5px -5px;
	 padding: 4px;
	 position: relative;
}
.fim-photo-date{
	margin:0px;
	padding:0px;
}
/*********************************************/
/* Navigation */
/*********************************************/
.fim-photo-nav{
	width:99%;
	padding-top:15px;
	padding-bottom:15px;
}
.fim-nav-buttons{
	height:20px;
	float:left;
	text-align:center;
	border:1px solid #ccc;
	background:#F4F4F4;
	margin-top: 5px;
	margin-right: 10px;
	margin-bottom: 5px;
	margin-left: 10px;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
}
/*********************************************/
/* Comments */
/*********************************************/

.fim-comment{
	margin-bottom:1.6em;
	overflow:hidden;
}
#fim-commentblock h2{
	font-size:130%;
	margin-bottom:1em;
}
.fim-commentname{
	float:right;
	width:375px;
	color:#4675bc;
	padding-top:10px;
	padding-right:10px;
	
}
.fim-commentname a{
	color:#000;
	font-weight:bold;
	
}

#fim-commentblock p{
	padding-bottom:.7em;
}
.fim-commenttext{
	float:right;
	width:375px;
	min-height:40px;
	padding-right:10px;
	clear:both;
}
.fim-dec{
	height:10px;
	clear:both;
}
* html .fim-commenttext{
	height: 40px;
	overflow: visible;
}

.fim-gravatar{
	float:left;
	width:50px;
	height:50px;
	padding:6px;
}

#fim-commentsform{
	padding:10px;
	margin-bottom:2em;
	
}
/*********************************************/
/* Misc */
/*********************************************/

.fim_clear{
	clear:both;
}

";
}


// create new table
function fim_install () {

	global $table_prefix, $wpdb, $user_level;
	$table_name_images = $table_prefix . "fim_images";
	$table_name_cat = $table_prefix . "fim_cat";
	$table_name_comments = $table_prefix . "fim_comments";
	

	get_currentuserinfo();

	if ($user_level < 8)
	{
		return;
	}
	else
	{

				$sql1 = 	"CREATE TABLE IF NOT EXISTS $table_name_images (
				id smallint(11) NOT NULL auto_increment,
				image varchar(255) default NULL,
				date datetime default NULL,
				title varchar(255) default NULL,
				description TEXT default NULL,
				cat varchar(10)  NOT NULL,
				status varchar(50) default 'include',
				PRIMARY KEY (id)
				)";

				$sql2 = "CREATE TABLE IF NOT EXISTS $table_name_cat (
				catname VARCHAR(255) NOT NULL ,
				id INT NOT NULL AUTO_INCREMENT ,
				date datetime default NULL,
				description TEXT NOT NULL ,
				folder VARCHAR (255) NOT NULL,
				cover varchar(50) default '',
				status varchar(50) default 'public',
				PRIMARY KEY (id)
				)";
				
				$sql3 = "CREATE TABLE IF NOT EXISTS $table_name_comments (
				id INT NOT NULL AUTO_INCREMENT ,
				image_id INT NOT NULL ,
				date DATETIME DEFAULT '0000-00-00 00:00:00'	NOT NULL,
				author_comment TEXT NOT NULL ,
				author_name VARCHAR (255) NOT NULL,
				author_email VARCHAR (255) NOT NULL,
				author_url VARCHAR (255) NOT NULL,
				author_ip VARCHAR (255) NOT NULL,
				PRIMARY KEY (id)
				)";
	}
	
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	
	// Version 2.4
	maybe_add_column($table_name_cat, 'status', "ALTER TABLE $table_name_cat ADD status VARCHAR( 20 ) NOT NULL DEFAULT  'public'");
	maybe_add_column($table_name_cat, 'password', "ALTER TABLE $table_name_cat ADD password VARCHAR( 50 ) NOT NULL DEFAULT  ''");
	
	
	
}

// Init
function fim_init()
{
	if (function_exists('add_menu_page')) {

		add_menu_page('fGallery', 'fGallery',6,dirname(__FILE__).'/functions/fim_main.php');

	}

	if (function_exists('add_submenu_page')) {

		add_submenu_page( dirname(__FILE__).'/functions/fim_main.php',
				__('Manage albums',
				'fgallery'),
				__('Manage albums',
				'fgallery'),
				6,
				dirname(__FILE__).'/functions/fim_gallery.php');

		add_submenu_page( dirname(__FILE__).'/functions/fim_main.php',
				__('Options',
				'fgallery'),
				__('Options',
				'fgallery'),
				6,
				dirname(__FILE__).'/functions/fim_options.php');

		add_submenu_page( dirname(__FILE__).'/functions/fim_main.php',
				__('Edit css',
				'fgallery'),
				__('Edit css',
				'fgallery'),
				6,
				dirname(__FILE__).'/functions/fim_edit_style.php');

				add_submenu_page( dirname(__FILE__).'/functions/fim_main.php',
						__('Manage comments',
						'fgallery'),
						__('Manage comments',
						'fgallery'),
						6,
						dirname(__FILE__).'/functions/fim_comments.php');

						add_submenu_page( dirname(__FILE__).'/functions/fim_main.php',
								__('Check for updates',
								'fgallery'),
								__('Check for updates',
								'fgallery'),
								6,
								dirname(__FILE__).'/functions/fim_updates.php');


	}
 }
 function fim_admin_head()
 {
 ?>
 		<script type='text/javascript' src="<?php echo get_bloginfo('wpurl')."/wp-content/plugins/fgallery/js/multifile.js"?>"></script>
		
		<script language="javascript" type="text/javascript">
			function go(type)
			{
				var agree = confirm('You are about to delete this '+type+'.\n\"OK\" to delete, "\Cancel"\ to stop.');
				if (agree)
					return true ;
				else
					return false ;
			}
			</script>
			
<?php

}
// Hooks and filters
if (isset($_GET['activate']) && $_GET['activate'] == 'true')
{
	add_action('init', 'fim_install');
}

function fim_action_parse_query($wp_query) {
  if (defined('FIM') && constant('FIM')) {
    $wp_query->is_404 = false;
  }
}
add_action('parse_query', 'fim_action_parse_query');

add_action('admin_menu', 'fim_init');
add_filter('wp_head', 'fim_css');
add_filter('admin_head','fim_admin_head');
?>
