<?php
$fpath = ABSPATH."wp-content/fgallery/";
$plugin_path = get_bloginfo('wpurl')."/wp-content/plugins/fgallery/functions";
// Bug fix
require_once(ABSPATH . 'wp-includes/streams.php');
require_once(ABSPATH . 'wp-includes/gettext.php');

// Load language pack
$lang = get_option('fim_lang');
if($lang != '')
	load_textdomain('fgallery', ABSPATH . 'wp-content/plugins/fgallery/languages/'.$lang);
	
function fim_get_the_content()
{

	if(isset($_GET['image'])){
		$_GET['image'] = fim_get_image_id($_GET['image']);
		return fim_get_image();
	}
	else if(isset($_GET['album'])){
		$_GET['album'] = fim_get_cat_id($_GET['album']);
		return fim_get_album();
	}
	else 
		return fim_get_overview();
}
function fim_get_overview()
{
	global $plugin_path;
	
	$galleries = fim_query_cats('public');
	$p_galleries = fim_query_cats('private');
	$th = (20+get_option('fim_th_size'))."px";
	$m = 	(30+get_option('fim_th_size'))."px";
	$fim .= "<div class='fim'>";

	$fim .= fim_build_navigation();
	if($galleries)
	{
    	foreach($galleries as $gallery)
    	{
				$f = substr(fim_get_folder($gallery->id),0 ,-1 );
	
			$image = fim_get_cover($gallery->id);
			$img = rawurlencode($image->image);
			
    		//$image = fim_query_latest($gallery->id);
    		$count = fim_query_numrows($gallery->id);
    		$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($gallery->id);
    		$title = ($image->title!="") ? "$title" : "Image";
    		$description = ($gallery->description == "")?"":__('Description', 'fgallery').": ".$gallery->description;
    		if($count != 0) 
    		{
    		$url = get_url("album/$gallery->id");
    
    			$fim .="
    			<div class='fim-album'>
    				<div class='fim-tn-border-t' style='width:$th; height:$th;float:left'>
    					<div class='fim-thumbnail'>						
							<a href='$url'><img src='$plugin_path/fim_thumb.php?album=$f&image=$img' alt='$title'/></a>
    					</div>
    				</div>
    				<h4 class='fim-title' style='margin-left:$m'>
    					<a href='$url'>$gallery->catname</a>
    				</h4>	
    				<div class='fim-meta' style='margin-left:$m'>
    					".__('This album contains', 'fgallery')." $count ".__('pictures', 'fgallery').".
    				</div>	
    				<div class='fim-album-description' style='margin-left:$m'>
    					$description";
							if($gallery->status == 'private'){
								$fim .= __('Password protected', 'fgallery').".";
							}
							
    				$fim .="</div>
    			</div>";
    			$fim .= "<div class='fim_clear'></div>";
    		}
    	}
 	}
 	if($p_galleries){
		$fim .="<h4>".__('Private galleries', 'fgallery')."</h4><p>";
	
		foreach($p_galleries as $pg){
			$url = get_url("album/$pg->id");
			$fim .=	"<a href='$url'>$pg->catname</a><br/>";
		}
		$fim .= "</p>";
	}
 	else
    	$fim .= "<p>".__('There are currently no albums to show', 'fgallery').".</p>";
	$fim .= "</div>";

	return $fim;
}
function fim_get_album()
{
	if(isset($_POST['fim_pass_submit'])){
		fim_check_password($_POST['pass'], $_GET['album']);
	}
	
	if(fim_get_cat_status($_GET['album']) == 'private'){
		if(!$_SESSION['fim_pass']){
			$fim = fim_login();
			return $fim;
		}
	}
	global $plugin_path;
	$images = fim_query_images($_GET['album']);
	$albumname = fim_get_cat_name_($_GET['album']);
	$fim .= "<div class='fim'>";
	$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($_GET['album']);
	$f = substr(fim_get_folder($_GET['album']),0 ,-1 );
	$lightbox = get_option('fim_use_lightbox');
	$fim .= fim_build_navigation(fim_get_cat_name_($_GET['album']));
	$tw = (20+get_option('fim_th_size'))."px";
	if(get_option('fim_show_caption') == 'true'){
		
		$th = (40+get_option('fim_th_size'))."px";
		
	}
	else{
		$th = $tw;
	}
	// Feeds
	if(get_option('fim_use_rss') == 'true'){
		$fim .= fim_rss_link($_GET['album']);
	}
	$fim .= "<div class='fim-album'>";

	foreach($images as $image)
	{
		$url = get_url("album/$_GET[album]/image/$image->id");
		$title = $image->title;
		$desc = $image->description;
		$img = rawurlencode($image->image);
		$fim .= "
				<div class='fim-tn-border-album' style='width:$tw; height:$th'>
					<div class='fim-thumbnail'>";
					if($lightbox == 'false'){
						$fim .= "<a href='$url'><img src='$plugin_path/fim_thumb.php?album=$f&image=$img' alt='$title' /></a>";
					}else{
						$fim .= "<a href='".$folder.$img."' rel='lightbox[$albumname]' title='$title: $desc'><img src='$plugin_path/fim_thumb.php?album=$f&image=$img' alt='$title' \></a>";
					}
				$fim .= "</div>";
				if(get_option('fim_show_caption') == 'true'){
						$fim .= "<br />$title";
				}
				$fim .= "</div>";
	}
	$fim .= "</div><div class='fim_clear'></div>";
	$fim .= "<p><a href='".get_url("")."'>".__('&laquo; Back to albums', 'fgallery')."</a></p>";
	$fim .= "</div>";
	return $fim;
}
function fim_get_image()
{
	
	global $user_ID, $wpdb, $user_level;
	$go = true;
	
	if(isset($_POST['insert_comment'])){
		if(fim_insert_comment())
			$go = true;
		else
			$go = false;
	}
	
	if($go){
		$image = fim_query_one_image($_GET['image']);
		
		if(isset($_GET['action']) && $_GET['action'] == 'ecard'){
			$fim = fim_ecard($image);
		}
		else{
			get_currentuserinfo();
			$query_string = $_SERVER['QUERY_STRING'];
			$image = fim_query_one_image($_GET['image']);
			$title = ($image->title!="") ? "$title" : "Image";
			$back_link = get_url("album/$image->cat");
			$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($image->cat);

			$fim .= "<div class='fim'>";
			$fim .= fim_build_navigation(fim_get_cat_name_($image->cat), $image->image, $image->cat);
			$fim .= "<div class='fim-photo-date'><p>$image->date</p></div>";
			$fim .= "<div class='fim-photo-desc'>
			<p>$image->description</p>";
			if(get_option('fim_ecard') == 'true'){
				$url = get_url("album/$image->cat/image/$image->id");
				$fim .= "<p><a href='$url&action=ecard'>".__("Send this image as eCard", "fgallery").".</a></p>";
			}
			$fim .= "</div>";
			$fim .= "<div class='fim-photo-block'>
			<div class='fim-photo'>
			<a href='$back_link'><img src='".$folder.$image->image."' alt='$title' /></a>
			</div> 
			</div>";
			$fim .= "<div class='fim_clear'></div>";

			$fim .= "<div class='fim-photo-nav'>
			<div class='fim-nav-buttons'>".fim_get_prev_image_link($image->id, $image->cat, $fimpage)."</div>
			<div class='fim-nav-buttons'><a href='$back_link'>Index</a></div>
			<div class='fim-nav-buttons'>".fim_get_next_image_link($image->id, $image->cat, $fimpage)."</div>
			</div>";
			$fim .= "<div class='fim_clear'></div>";
			$fim .= "</div>";
			$fim .= "<div class='fim_clear'></div>";

			
			$fim .= "<div id='fim-commentblock'>";

			if(get_option('fim_allow_comments') == "true"){
				$comments = fim_get_comments($image->id);		
				$fim .= "<h2>Comments</h2>";

				if($comments){

					foreach ($comments as $comment) {

						$a_link = $comment->author_name;
						if($comment->author_url){
							if(substr($comment->author_url, 0, 7) != "http://"){
								$comment->author_url = "http://".$comment->author_url;
							}
							$a_link = "<a href = '$comment->author_url'>$comment->author_name</a>";
						}
						$fim .= "<div class='fim-comment'>
						<div class='fim-commentname'>
						$a_link <br />on ".
						date("d M, Y @ H:i", strtotime($comment->date))."
						</div>

						<div class='fim-gravatar'>".fim_get_gravatar($comment->author_email)."</div>
						<div class='fim-commenttext'>".nl2br($comment->author_comment)."</div>
						<div class='fim-dec'></div>
						</div>";
					} 
				}
				else{
					$fim .= "No comments yet.";
				}

				$site = get_option('wpurl');
				$fim .= "<h2>Leave a comment</h2>";
				$fim .= "<div id='fim-commentsform'> 
				<form action='$PHP_SELF' method='post'>

				<p> 
				<label for='author'>Name:</label><br /> <input type='text' name='author' id='author' value='' tabindex='1' /> 
				</p>

				<p> 
				<label for='email'>Email:</label><br /> <input type='text' name='email' id='email' value='' tabindex='2' />
				</p>

				<p> 
				<label for='url'>Website:</label><br /> <input type='text' name='url' id='url' value='' tabindex='3' /> 
				</p>

				<p> 
				<label for='comment'>Comment:</label><br />
				<textarea name='comment' id='comment' cols='50' rows='10' tabindex='4'></textarea> 
				</p> 

				<p> 
				<input name='insert_comment' type='submit' id='submit' tabindex='5' value='Submit Comment' /> 
				<input type='hidden' name='image_id' value='$image->id' />
				</p> 
				</form> 
				</div>";
			}
			else{
				$fim .= "<p>Comments are closed</p>";
			}
			$fim .= "</div>";
		}
	}
	return $fim;
}
// RSS link
function fim_rss_link($gallery)
{
	$path_ = get_bloginfo('wpurl')."/wp-content/plugins/fgallery/fim_rss.php?album=$gallery";
	return "<a href='$path_'>".__("Album RSS feed", "fgallery")."</a>";
}
// Insert image comment
function fim_insert_comment()
{
	
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	
	$name = $_POST['author'];
	$url = $_POST['url'];
	$date = date("Y-m-d H:i:s");
	$comment = $_POST['comment'];
	$email = $_POST['email'];
	$image_id = $_POST['image_id'];
	$ip = $SERVER['REMOTE_ADDR'];
	
	if(!$name){
		_e("You must provide a name.");
		return false;
	}
	if(!$comment){
		_e("You must provide a comment.");
		return false;
	}
	
	$sql = "INSERT INTO $table_comments 
				(image_id, date, author_comment, author_name, author_email, author_url, author_ip) 
				VALUES('$image_id', '$date', '$comment', '$name', '$email', '$url', '$ip')";
	
	$wpdb->query($sql);
	fim_mail(fim_get_latest_comment_id());
	return true;
	
}
function fim_get_one_comment($id)
{
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	
	return $wpdb->get_row("SELECT * FROM $table_comments WHERE id = $id");
}
// Comment gravatar
function fim_get_gravatar($email)
{
	
	$md5sum = md5($email);
	return "<img src='http://www.gravatar.com/avatar.php?gravatar_id=$md5sum&size=48' />";
}
// Get comments for an image
function fim_get_comments($image_id)
{
	
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	return $wpdb->get_results("SELECT * FROM $table_comments WHERE image_id = $image_id ORDER BY date DESC");
}
// Get prev image link
function fim_get_next_image_link($curr_id, $curr_cat, $fimpage)
{
	global $wpdb, $table_prefix;
	$table_image = $table_prefix."fim_images";
	
	$order = get_option('fim_image_order');
	$type = get_option('fim_image_order_type');
	
	$sql = "SELECT id FROM $table_image WHERE id > '$curr_id' AND cat = '$curr_cat' ORDER BY $order $type LIMIT 0,1";
	$link = $wpdb->get_row($sql);
	if($link)
		//return "<a href='$fimpage?image=$link->id'>".__('Next &raquo;', 'fgallery')."</a>";
		return "<a href='".get_url("album/$curr_cat/image/$link->id")."'>".__('Next &raquo;', 'fgallery')."</a>";
	else
		return __('Next &raquo;' , 'fgallery');
	
}
// Get next image link
function fim_get_prev_image_link($curr_id, $curr_cat, $fimpage)
{
	global $wpdb, $table_prefix;
	$table_image = $table_prefix."fim_images";
	$order = get_option('fim_image_order');
	$type = get_option('fim_image_order_type');
	$sql = "SELECT id FROM $table_image WHERE id < '$curr_id' AND cat = '$curr_cat' ORDER BY $order $type LIMIT 0,1";
	$link = $wpdb->get_row($sql);
	if($link)
		//return "<a href='$fimpage?image=$link->id'>".__('&laquo; Prev', 'fgallery')."</a>";
		return "<a href='".get_url("album/$curr_cat/image/$link->id")."'>".__('&laquo; Prev', 'fgallery')."</a>";

	else
		return __('&laquo; Prev', 'fgallery');
}
// Get latest image
function fim_query_latest($catid)
{
	global $table_prefix, $wpdb;
	$table_image = $table_prefix . "fim_images";
	return $wpdb->get_row("SELECT image FROM $table_image WHERE cat = '$catid' ORDER BY date DESC LIMIT 0,1");
}
function fim_get_latest_comment_id()
{
	global $table_prefix, $wpdb;
	$table_comments = $table_prefix . "fim_comments";
	return $wpdb->get_var("SELECT id FROM $table_comments ORDER BY id DESC LIMIT 1");
}
// Get album cover
function fim_get_cover($catid)
{
	global $table_prefix, $wpdb;
	$table_cat = $table_prefix . "fim_cat";
	$table_image = $table_prefix . "fim_images";

	$myid = $wpdb->get_row("SELECT cover FROM $table_cat WHERE id='$catid'");
	if(!$myid->cover)
		return fim_query_latest($catid);
	else
		return $wpdb->get_row("SELECT image,id FROM $table_image WHERE id='$myid->cover'");
}
// Get category name from id
function fim_get_cat_name_($id)
{
	global $table_prefix, $wpdb;
	$table_cat = $table_prefix . "fim_cat";
	$name = $wpdb->get_row("SELECT catname FROM $table_cat WHERE id = '$id'");
	return $name->catname;
}
// Get categoty name from image id
function fim_get_cat_name_from_imageid($image_id)
{
	global $table_prefix, $wpdb;
	$table_cat = $table_prefix . "fim_cat";
	$table_image = $table_prefix . "fim_images";
	$id = $wpdb->get_var("SELECT cat FROM $table_image WHERE id = $image_id");
	$name = $wpdb->get_row("SELECT catname FROM $table_cat WHERE id = $id");
	return $name->catname;
}
// Get cat id from image id
function fim_get_cat_id_from_imageid($image_id)
{
	global $table_prefix, $wpdb;
	$table_cat = $table_prefix . "fim_cat";
	$table_image = $table_prefix . "fim_images";
	$id = $wpdb->get_row("SELECT cat FROM $table_image WHERE id = $image_id");
	$name = $wpdb->get_row("SELECT id FROM $table_cat WHERE id = $id->cat");
	return $name->id;
}
// Get category path
function fim_get_cat_folder($id)
{
	global $table_prefix, $wpdb;
	$table_cat = $table_prefix . "fim_cat";
	$name = $wpdb->get_row("SELECT folder FROM $table_cat WHERE id = '$id'");
	return $name->folder;
}
// Get image name from id
function fim_get_image_name($id)
{
	global $table_prefix, $wpdb;
	$table = $table_prefix . "fim_images";
	$name = $wpdb->get_row("SELECT image FROM $table WHERE id = '$id'");
	return $name->image;
}
// Get image id from name
function fim_get_image_id($name)
{
	global $table_prefix, $wpdb;
	$table = $table_prefix . "fim_images";
	$name = $wpdb->get_row("SELECT id FROM $table WHERE image = '$name'");
	return $name->id;
}
// Get cat id from folder
function fim_get_cat_id($folder)
{
	global $table_prefix, $wpdb;
	$table = $table_prefix . "fim_cat";
	$name = $wpdb->get_row("SELECT id FROM $table WHERE folder = '$folder'");
	return $name->id;
}
// Get one image
function fim_query_one_image($imgid = "", $catd = "")
{
	global $wpdb, $table_prefix;
	$table_image = $table_prefix."fim_images";
	return $wpdb->get_row("SELECT * FROM $table_image WHERE id = '$imgid'");
}
// get all folders
function fim_get_all_folders()
{
	global $wpdb, $table_prefix;
	$table = $table_prefix."fim_cat";
	return $wpdb->get_results("SELECT folder FROM $table");
}
// Get folder
function fim_get_folder($id)
{
	global $wpdb, $table_prefix;
	$table = $table_prefix."fim_cat";
	$name= $wpdb->get_row("SELECT folder FROM $table WHERE id = '$id'");
	return $name->folder."/";
}
// Get all images within a certain gallery
function fim_query_images($catid)
{
	global $wpdb, $table_prefix;
	$table_image = $table_prefix."fim_images";
	$order_by = get_option('fim_image_order');
	$order_type = get_option('fim_image_order_type');
	
	return $wpdb->get_results("SELECT * FROM $table_image WHERE cat = '$catid' AND status <> 'exclude' ORDER BY '$order_by' $order_type");
}
// Get all galleries
function fim_query_cats($status = 'public')
{	
	global $wpdb, $table_prefix;
	$table_cat = $table_prefix."fim_cat";
	$order_by = get_option('fim_album_order');
	$order_type = get_option('fim_album_order_type');
	
	return $wpdb->get_results("SELECT * FROM $table_cat WHERE status = '$status' ORDER BY '$order_by' $order_type");
}
// Get gallery
function fim_get_gallery($id)
{	
	global $wpdb, $table_prefix;
	$table_cat = $table_prefix."fim_cat";
	return $wpdb->get_row("SELECT * FROM $table_cat WHERE id='$id'");
}
// Get number of rows
function fim_query_numrows($catid)
{
	global $wpdb, $table_prefix;
	$table_image = $table_prefix."fim_images";
	$count =  $wpdb->get_row("SELECT COUNT(*) as c FROM $table_image WHERE cat = '$catid'");
	return $count->c;
}
// Make navigation
function fim_build_navigation($album = "", $image = "", $cat = "")
{
	$baseurl = get_url("");
	$albumurl = get_url("album/$cat");
	$t = fim_query_one_image(fim_get_image_id($image));
	$imagetitle = ($t->title == "")?$image:$t->title;
	$string = "<h4 class='fim-nav'><a href='$baseurl'>".__('Current Albums', 'fgallery')."</a>";
	if($album && $image)
		$string .= " &raquo; <a href ='$albumurl'>$album</a>";
	else
		$string .= " &raquo; $album";
	if($image)
		$string .= " &raquo; $imagetitle";
	
	$string .= "</h4>";
	return $string;
	
}
// Random images from database
function fim_get_random($num, $size)
{
	global $wpdb, $table_prefix, $plugin_path;
	$table_image = $table_prefix."fim_images";
	$table_cat = $table_prefix."fim_cat";

	$sql = "SELECT * FROM $table_image 		
						INNER JOIN $table_cat ON $table_image.cat = $table_cat.id 
						WHERE $table_cat.status = 'public' AND $table_image.status = 'include' ORDER BY RAND() LIMIT $num";

	//$sql = "SELECT image, id, cat FROM $table_image ORDER BY RAND() LIMIT $num";
	$images = $wpdb->get_results($sql);
	/*echo "<pre>";
	print_r($images);
	echo "</pre>";*/
	
	foreach($images as $image)
	{
		$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($image->cat);
		$url = get_url("album/$image->cat/image/$image->id");
		$f = substr(fim_get_folder($image->cat),0 ,-1 );
		echo "<div class='fim_random'>";
		echo "<div class='fim-tn-border-sidebar'>";
		echo "<div class='fim-thumbnail'>";
		if(get_option('fim_use_lightbox') == 'true'){
			echo "<a href='".$folder.$image->image."' rel='lightbox' title='$title: $desc'><img src='$plugin_path/fim_thumb.php?album=$f&image=$image->image&w=$size' alt='$title' \></a>";
			
		}
		else{
			echo "<a href='$url'><img src='$plugin_path/fim_thumb.php?album=$f&image=$image->image&w=$size' alt='$title' width='$size'/></a>";
		}
		echo "</div></div></div>";
	}
	echo "<div class='fim_clear'></div>";
	
	
}
// Get latest images regarless of album
function fim_get_latest($num, $size)
{
	global $wpdb, $table_prefix, $plugin_path;
	$table_image = $table_prefix."fim_images";
	$table_cat = $table_prefix."fim_cat";

	//$sql = "SELECT image, cat, id FROM  $table_image ORDER BY date DESC LIMIT $num";
	
	$sql = "SELECT * FROM $table_image 		
						INNER JOIN $table_cat ON $table_image.cat = $table_cat.id 
						WHERE $table_cat.status = 'public' AND $table_image.status = 'include' ORDER BY $table_image.date LIMIT $num";
						
	$images = $wpdb->get_results($sql);
	if($images){
		foreach($images as $image)
		{
			$url = get_url("album/$image->cat/image/$image->id");
			$f = substr(fim_get_folder($image->cat),0 ,-1 );
				$folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($image->cat);
				
			echo "<div class='fim_random'>
				<div class='fim-tn-border-sidebar'>
					<div class='fim-thumbnail'>";
					if(get_option('fim_use_lightbox') == 'true'){
						echo "<a href='".$folder.$image->image."' rel='lightbox' title='$title: $desc'>
						<img src='$plugin_path/fim_thumb.php?album=$f&image=$image->image&w=$size' alt='$title' width='$size'\></a>";

					}
					else{
						echo "<a href='$url'><img src='$plugin_path/fim_thumb.php?album=$f&image=$image->image&w=$size' alt='$title' width='$size'/></a>";
					}					
					echo "</div>
				</div>
			</div>";
		}
	}
	echo "<div class='fim_clear'></div>";

}
// Builds the urls used in fGallery
function get_url($parms)
{
  $urltype = get_option('fim_use_fancy_url');
	if ($parms != '')
	{
		$element = explode('/', $parms);
		for ($x = 1; $x < count($element); $x ++) {
			$element[$x] = urlencode($element[$x]);
		}
		$element[1] = fim_get_cat_folder($element[1]);
		$element[3] = fim_get_image_name($element[3]);

		if ($urltype == 'false')
		{
			$parms = '?'.$element[0].'='.$element[1].'&'.$element[2].'='.$element[3];
			$parms = str_replace('&=', '', $parms);
			return htmlspecialchars(get_bloginfo('wpurl')."/wp-content/plugins/fgallery/fim_photos.php".$parms);
		}
		else
		{
			$parms = implode('/', $element);	
			return htmlspecialchars(get_bloginfo('url')."/".get_option('fim_baseurl')."/$parms");
		}
	}
	else
    {
        if ($urltype == 'false')
           return htmlspecialchars(get_bloginfo('wpurl')."/wp-content/plugins/fgallery/fim_photos.php");
        else
            return htmlspecialchars(get_bloginfo('wpurl')."/".get_option('fim_baseurl'));

    }
}
// Based on wp_notify_author
function fim_mail($comment_id)
{
	global $wpdb;
    
	$comment = fim_get_one_comment($comment_id);
	$image    = fim_query_one_image($comment->image_id);

	if (!get_option('fim_user_email')) return false; // If there's no email to send the comment to

	$blogname = get_settings('blogname');
		
		$notify_message  = sprintf( __('New comment on your image #%1$s "%2$s"'), $image->id, $image->image ) . "\r\n";
		$notify_message .= sprintf( __('Author : %1$s'), $comment->author_name) . "\r\n";
		$notify_message .= sprintf( __('E-mail : %s'), $comment->author_email ) . "\r\n";
		$notify_message .= sprintf( __('Website : %s'), $comment->author_url ) . "\r\n\r\n";
		
		$notify_message .= __('Comment: ') . "\r\n" . $comment->author_comment . "\r\n\r\n";
		$subject = sprintf( __('[%1$s] Comment: "%2$s"'), $blogname, $image->image );
	
	//echo $notify_message; exit;
	$from = "From: WordPress Blog: $blogname";

	$message_headers = "MIME-Version: 1.0\n"
		. "$from\n"
		. "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";

	@wp_mail(get_option('fim_user_email'), $subject, $notify_message, $message_headers);
   
	return true;
}
function fim_ecard($image)
{
	
	$img_folder = ABSPATH."/wp-content/fgallery/".fim_get_folder($image->cat);
	$url_folder = get_bloginfo('wpurl')."/wp-content/fgallery/".fim_get_folder($image->cat);
	$out = "<h3>".__('Send image as eCard', "fgallery").".</h3>";
	
	if(isset($_POST['send_ecard'])){
		
		$url = get_url("album/$_GET[album]/image/$image->id");
		if(!class_exists('phpMailer'))
			include('phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();

		$mail->From = $_POST['from_email'];
		$mail->FromName = $_POST['name'];
		$mail->IsHTML(true);
		$mail->AddEmbeddedImage($img_folder.$image->image, "main", $img_folder.$image->image);
		$mail->Subject = $_POST['name']." ".__('have sent you an eCard', 'fgallery');
		$mail->AddAddress($_POST['to_email']);	
		
		$mail->Body = "
			<h2>An eCard from $_POST[name]</h2>
			<p>$_POST[message]</p>
				<img src='cid:main'>";
						
		if(!$mail->Send()){
			$out .= "<p>".__('The eCard could not be delivered to','fgallery')." ".$_POST['to_email']."</p>";
		}
		else{
			$out .= "<p>".__('eCard successfully sent to', 'fgallery')." ".$_POST['to_email']."</p>";
		}
		$out .= "<p><a href='$url'>".__('Back to the galleries', 'fgallery').".</a></p>";
		
		 
	}
	else{
	
		$out .= "
		<form action='' method='post'>
			<p>
				<label for from_email>".__('From email', 'fgallery').":</label><br />
				<input type='text' name='from_email' />
			</p>
			<p>
				<label for to_email>".__('To email', 'fgallery').":</label><br />
				<input type='text' name='to_email' />
			</p>
			<p>
				<label for name>".__('Your name', 'fgallery').":</label><br />
				<input type='text' name='name' />
			</p>
			<p>
				<label for message>".__('Message', 'fgallery').":</label><br />
				<textarea name='message' cols='40' rows='8'></textarea>
			</p>
			<p>
				<input type='submit' value='Send eCard' name='send_ecard'/>
		</form>";
	
		$out .= "<h4>$image->title</h4><img src='".$url_folder.$image->image."' alt='$title' />";
	}
	return $out;
	
	
	
	
	
	
	
	
}
function fim_get_cat_status($cat)
{
	global $wpdb, $table_prefix, $plugin_path;
	$table_cat = $table_prefix."fim_cat";
	return $wpdb->get_var("select status from $table_cat WHERE id = $cat");
}
function fim_get_cat_pass($cat)
{
	global $wpdb, $table_prefix, $plugin_path;
	$table_cat = $table_prefix."fim_cat";
	return $wpdb->get_var("select password from $table_cat WHERE id = $cat");
}
function fim_login()
{
	$out .= "<h3>".__('This album is password protected', 'fgallery').".</h3>";
	$out .= "<p><form method='post' action = ''>
		<input type='password' name='pass' />
		<input type='submit' name='fim_pass_submit' value='".__('Login', 'fgallery')."'/>
	</form></p>";
	return $out;
}
function fim_check_password($pass, $cat)
{
	global $wpdb, $table_prefix;
	$table_cat = $table_prefix."fim_cat";
	$dbpass = $wpdb->get_var("SELECT password FROM $table_cat WHERE id = $cat");
	if($pass == $dbpass){
		$_SESSION['fim_pass'] = $dbpass;
	}
	else
		die("Wrong Password");
}
function escape($string){
	return $string; //apply_filters('comment_text', $string);
}
















