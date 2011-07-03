<?php
//require_once("class.imageMod.php");

/*Lets add some default options if they don't exist*/
add_option('fim_th_size', '96');
add_option('fim_image_size', '400');
add_option('fim_page', 'none');
add_option('fim_resize', 'true');
add_option('fim_num_th', '0');
add_option('fim_lang'. '');
add_option('fim_use_fancy_url', 'false');
add_option('fim_baseurl', 'photos');
add_option('fim_use_lightbox', 'false');
add_option('fim_allow_comments', 'true');
add_option('fim_use_rss', 'true');
add_option('fim_user_email', '0');
add_option('fim_image_order', 'date');
add_option('fim_album_order', 'date');
add_option('fim_update_check', date("Y-m-d H:i:s", time()));
add_option('fim_ecard', 'true');

add_option('fim_dynamic_thumbnails', 'false');

add_option('fim_show_caption', 'true');

add_option('fim_image_order_type', 'desc');
add_option('fim_album_order_type', 'desc');

require_once("fim_functions.php");
function fim_rewrite_rule()
{
    // Complete url
    $url = get_bloginfo('wpurl');
    $urlparts = parse_url($url);
	$base = get_option('fim_baseurl');
	$rewrite = "# BEGIN FGALLERY\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteRule ^$base/?([^/]*)?/?([^/]*)?/?([^/]*)?/?([^/]*)?/?$   $urlparts[path]/wp-content/plugins/fgallery/fim_photos.php?$1=$2&$3=$4 [QSA,L]\n</IfModule>\n# END FGALLERY\n";
	
	return $rewrite;
}
if(isset($_POST['rewrite']))
{
	$url = $_POST['baseurl'];
	$url = strtolower($url);
	$url = str_replace(" ", "_", $url); 
	update_option('fim_baseurl', $url);
	$file = $_SERVER['SERVER_ROOT']."/.htaccess";

	if(is_writable($file))
	{
		$content = file_get_contents ($file);
		$content = preg_replace("/(# BEGIN FGALLERY)(\n+.*)*(# END FGALLERY)\n/", "", $content);
				
		$content = fim_rewrite_rule().$content;
		$f = fopen($file, "w");
		fwrite($f, $content);
		fclose($f);
		//echo "<pre>$content</pre>";
		echo "<div class='updated fade' id='message'><p>".__('Mod ReWrite rules successfully updated', 'fgallery').".</p></div>";

	}
	else
	{	
		?><div class="wrap">
		<h2><?php _e("Add ReWrite rules", 'fgallery');?></h2>
		<?php _e(".htaccess is not writable so you have to add add the following manually", 'fgallery');
		echo "<p>".__('This should be at the TOP of your .htacces file before the WordPress rules', 'fgallery').".</p>";?>
		<textarea cols="100" rows="5" wrap="off"><?php echo fim_rewrite_rule(); ?></textarea></div><?php
	}

}
if(isset($_POST['option_update']))
{
	if($_POST['fim_resize'] == "true")
		update_option('fim_resize', 'true');
	else
		update_option('fim_resize', 'false');
	
		if($_POST['fim_use_rss'] == "true")
			update_option('fim_use_rss', 'true');
		else
			update_option('fim_use_rss', 'false');
	
	if($_POST['fim_use_fancy_url'] == "true")
		update_option('fim_use_fancy_url', 'true');
	else
		update_option('fim_use_fancy_url', 'false');
		
	if($_POST['fim_use_lightbox'] == "true")
		update_option('fim_use_lightbox', 'true');	
	else
		update_option('fim_use_lightbox', 'false');
		
	if($_POST['fim_allow_comments'] == "true")
		update_option('fim_allow_comments', 'true');	
	else
		update_option('fim_allow_comments', 'false');
	
		if($_POST['fim_show_caption'] == "true")
			update_option('fim_show_caption', 'true');	
		else
			update_option('fim_show_caption', 'false');
	
			if($_POST['fim_dynamic_thumbnails'] == "true")
				update_option('fim_dynamic_thumbnails', 'true');	
			else
				update_option('fim_dynamic_thumbnails', 'false');
				
				if($_POST['fim_ecard'] == "true")
					update_option('fim_ecard', 'true');	
				else
					update_option('fim_ecard', 'false');
					
	update_option('fim_image_order', $_POST['fim_image_order']);
	update_option('fim_image_order_type', $_POST['fim_image_order_type']);
	
	
	update_option('fim_album_order', $_POST['fim_album_order']);
	update_option('fim_album_order_type', $_POST['fim_album_order_type']);
	
	update_option('fim_th_size', $_POST['fim_th_size']);
	update_option('fim_image_size', $_POST['fim_image_size']);
	update_option('fim_page', $_POST['fim_page']);
	update_option('fim_lang', $_POST['fim_lang']);
	update_option('fim_num_th', $_POST['fim_num_th']);
	update_option('fim_user_email', $_POST['fim_user_email']);

	echo "<div class='updated fade' id='message'><p>".__('Options updated', 'fgallery').".</p></div>";
}
/*
if(isset($_POST['resize_all']))
{
	$dirs = fim_get_all_folders();
	$path = "../wp-content/fgallery/";
	$files = array();
	if($_POST['fim_resize'] == "true")
		update_option('fim_resize', 'true');
	else
		update_option('fim_resize', 'false');
	
	if($_POST['fim_use_fancy_url'] == "true")
		update_option('fim_use_fancy_url', 'true');
	else
		update_option('fim_use_fancy_url', 'false');

	update_option('fim_th_size', $_POST['fim_th_size']);
	update_option('fim_image_size', $_POST['fim_image_size']);
	update_option('fim_page', $_POST['fim_page']);
	update_option('fim_lang', $_POST['fim_lang']);
	update_option('fim_num_th', $_POST['fim_num_th']);
	$thw = get_option('fim_th_size');
	foreach($dirs as $dir)
	{
		if (is_dir($path.$dir->folder)) 
		{
			if ($dh = opendir($path.$dir->folder)) 
			{
				while (($file = readdir($dh)) !== false) 
				{
					if($file != "." && $file != ".." && (substr($file, 0, 6) == "thumb_"))
					array_push($files, $file);
				}
				closedir($dh);
			}
		}
		foreach($files as $f)
		{
			//$resize = new imageMod($path.$dir->folder."/",$f, 'normal', $thw, $thw, 50);
			//$resize->resize();
			echo $path.$dir->folder."/".$f."<br>";
		}
	}
	echo "<div class='updated fade' id='message'><p>".__('Options updated', 'fgallery')."</p></div>";

}
*/
?>

<?php
	$dir = "../wp-content/plugins/fgallery/languages/";
	$ext = ".mo";
	$files = array();
// Open a known directory, and proceed to read its contents
	if (is_dir($dir))
	{
		if ($dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				$ext = ereg_replace("^.+\\.([^.]+)$", "\\1", $file);
				if($ext == "mo")					
				array_push($files, $file);
			}
			closedir($dh);
		}
}
?>
<script type="text/javascript">
function check()
{
	box = eval("document.fim_option_form.fim_use_lightbox"); 
	if(box.checked == true){
		document.fim_option_form.fim_allow_comments.checked = false;
	}
}
</script>

<div class='wrap'>
  <h2><?php _e('fGallery options', 'fgallery');?></h2>
	  <form method="post" name='fim_option_form' action="">
		<h3><?php _e('Album options', 'fgallery');?></h3>
		<table cellpadding="5" cellspacing="0">
		  	<tr>
		    <td align="right" ><strong><?php _e('Use nice urls', 'fgallery');?>:</strong></td>
		  	<td><input type="checkbox" name="fim_use_fancy_url" value="true" <?php echo get_option('fim_use_fancy_url') == 'true'?"checked=yes":"";?>/><?php _e("I.e permalinks", "fgallery");?>.</td>
	      </tr>
	      
	
				<tr>
		    <td align="right" ><strong><?php _e('Use Lightbox', 'fgallery');?>:</strong></td>
		  	<td><input type="checkbox" name="fim_use_lightbox" value="true" 
		<?php echo get_option('fim_use_lightbox') == 'true'?"checked=yes":"";?> onClick="javascript:check()"/> 
		<?php _e("Javascript image decoration", "fgallery");?>.</td>
	      </tr>
	
				<tr>
		    <td align="right" ><strong><?php _e('Allow Comments', 'fgallery');?>:</strong></td>
		  		<td>
							<input type="checkbox" name="fim_allow_comments"  value='true'
							<?php if(get_option('fim_allow_comments') == 'true') echo " checked='yes'";?> onClick="javascript:check()"/>
							 (<?php _e("Disabled if using Lightbox", "fgallery");?>)
					</td>
	      </tr>
			

			<tr>
			<td align="right" ><strong><?php _e('Comment notification email', 'fgallery'); ?>:</strong></td>
			<td><input type="text" name="fim_user_email" size="25" value="<?php echo get_option('fim_user_email'); ?>" /> 
			 <?php _e("Where to send notification on new comment", "fgallery");?>.</td>
		  </tr>

			
			
			
				<tr>
		    	<td align="right" ><strong><?php _e('Display album RSS feed link', 'fgallery');?>:</strong></td>
			    <td><input type="checkbox" name="fim_use_rss" value="true" <?php echo get_option('fim_use_rss') == 'true'?"checked=yes":"";?>/> <?php _e("Displays RSS feed link on album page", "fgallery");?>.</td>
				</tr>
			
					<tr>
			    	<td align="right" ><strong><?php _e('Show thumbnail caption', 'fgallery');?>:</strong></td>
				    <td><input type="checkbox" name="fim_show_caption" value="true" <?php echo get_option('fim_show_caption') == 'true'?"checked=yes":"";?>/> <?php _e("Displays captions on album page", "fgallery");?>.</td>
					</tr>
			
					<tr>
			    	<td align="right" ><strong><?php _e('Allow images to be sent as eCard', 'fgallery');?>:</strong></td>
				    <td><input type="checkbox" name="fim_ecard" value="true" <?php echo get_option('fim_ecard') == 'true'?"checked=yes":"";?>/> <?php _e("Users can send images as eCard emails", "fgallery");?>.</td>
					</tr>
			
				<tr>
		    <td align="right" ><strong><?php _e('Resize images','fgallery'); ?>:</strong></td>
		    <td><input type="checkbox" name="fim_resize" value="true" <?php echo get_option('fim_resize') == 'true'?"checked=yes":"";?>/> <?php _e("Resize uploaded images or not", "fgallery");?>.</td>
	      </tr>
		  <tr>
			<td align="right" ><strong><?php _e('Thumbnail size', 'fgallery'); ?>:</strong></td>
			<td><input type="text" name="fim_th_size" size="5" value="<?php echo get_option('fim_th_size'); ?>" /> 
			  px </td>
		  </tr>
		
			<tr>
	    <td align="right" ><strong><?php _e('Use dynamic thumbnails','fgallery'); ?>:</strong></td>
	    <td><input type="checkbox" name="fim_dynamic_thumbnails" value="true" <?php echo get_option('fim_dynamic_thumbnails') == 'true'?"checked=yes":"";?>/> <?php _e("Thumbnails are generated on the fly", "fgallery");?>.</td>
      </tr>
		
		  <tr>
			<td align="right" ><strong><?php _e('Image size', 'fgallery'); ?>:</strong></td>
			<td><input name="fim_image_size" type="text" size="5" value="<?php echo get_option('fim_image_size'); ?>" /> 
			  px </td>
			<tr>
			<td align="right" ><strong><?php _e('Sort images by', 'fgallery'); ?>:</strong></td>
				<td>
				<?php $order = get_option('fim_image_order');?>
					<select name="fim_image_order">
						<option value="title" <?php if($order == "title") echo "selected"; ?>><?php _e('Title', "fgallery");?></option>
						<option value="description" <?php if($order == "description") echo "selected"; ?>><?php _e('Decription', "fgallery");?></option>
						<option value="image" <?php if($order == "image") echo "selected"; ?>><?php _e('Image name', "fgallery");?></option>
						<option value="date" <?php if($order == "date") echo "selected"; ?>><?php _e('Date', "fgallery");?></option>
					</select>
					
					<?php $order_type = get_option('fim_image_order_type');?>
					<select name="fim_image_order_type">
						<option value="desc"  <?php if($order_type == "desc") echo "selected"; ?>><?php _e("Descending", "fgallery");?></option>
						<option value="asc"  <?php if($order_type == "asc") echo "selected"; ?>><?php _e("Acending", "fgallery");?></option>
					</select>
					
				</td>
		  </tr>
			<tr>
			<td align="right" ><strong><?php _e('Sort album by', 'fgallery'); ?>:</strong></td>
				<td>
				<?php $order = get_option('fim_album_order');?>
					<select name="fim_album_order">
						<option value="catname" <?php if($order == "catname") echo "selected"; ?>><?php _e('Name', "fgallery");?></option>
						<option value="description" <?php if($order == "description") echo "selected"; ?>><?php _e('Decription', "fgallery");?></option>
						<option value="date" <?php if($order == "date") echo "selected"; ?>><?php _e('Date', "fgallery");?></option>
					</select>
					
					<?php $order_type = get_option('fim_album_order_type');?>
					<select name="fim_album_order_type">
						<option value="desc"  <?php if($order_type == "desc") echo "selected"; ?>><?php _e("Descending", "fgallery");?></option>
						<option value="asc"  <?php if($order_type == "asc") echo "selected"; ?>><?php _e("Acending", "fgallery");?></option>
					</select>
				</td>
		  </tr>
		</table>
		<h3> <?php _e('Language options', 'fgallery');?></h3>
		
		<?php
			$lang = get_option('fim_lang');
			
			echo "<p>".__('Choose language file', 'fgallery')."</p>";
		?>

		<select name="fim_lang">
			<?php
				foreach($files as $f)
				{
					if($lang == $f)
						echo "<option selected value='$f'>$f</option>";
					else
						echo "<option value='$f'>$f</option>";
				}
				if($lang == "")
						echo "<option selected value=''>Default (English)</option>";
				else
						echo "<option value=''>Default (English)</option>";
					
			?>
		</select>		
		<?php
			if(get_option('fim_use_fancy_url') == "true"){
				$rule = fim_rewrite_rule();
				echo "<h3>".__('Rewrite rules', 'fgallery')."</h3>";
					?>
					<table cellpadding="3" cellspacing="0">
					<tr>
						<td align="right"><strong><?php _e('Base url','fgallery');?>:</strong></td>
						<td><input type="text" name="baseurl" size="32" value="<?php echo get_option('fim_baseurl')?>"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="rewrite"value="<?php _e('Update Mod ReWrite','fgallery');?>" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<?php echo __('The link to the fgallery page is', 'fgallery');?>
						<a href="<?php echo get_bloginfo('wpurl')."/".get_option('fim_baseurl')?>"><?php echo get_bloginfo('wpurl')."/".get_option('fim_baseurl');?></a>
						</td>
					</tr>
					</table>
		<?php
					
			}
?>

		<div class="submit">
		  <input type="submit" name="option_update" value="<?php _e('Update options', 'fgallery')?> &raquo;" /><!--<input type="submit" name="resize_all" value="<?php _e('Resize all thumbnails', 'fgallery')?> &raquo;" />-->
		</div>
	  </form>
	  
</div>
