<?php
require_once("fim_functions.php");
// Some global variables
global $table_prefix, $wpdb, $fpath;
$table_name_cat = $table_prefix . "fim_cat";
$table_name_image = $table_prefix . "fim_images";
$table_comments = $table_prefix."fim_comments";

$plugin_path = get_bloginfo('wpurl')."/wp-content/plugins/fgallery/functions";

// Edit gallery
if(isset($_POST['edit_cat']))
{
	$data = fim_get_gallery($_POST['edit_cat']);
	$cat = $_POST['edit_cat'];
	?>
	<div class="wrap">
 		<h2><?php _e('Manage albums', 'fgallery');?></h2>
		<h3><?php _e('Edit','fgallery')?> <?php _e('album','fgallery')?></h3>
		<form method="post" action="">
		<table>
			<tr>
				<td align="right"><strong><?php _e('Name','fgallery')?>:</strong></td>
				<td><input name="edit_catname" type="text" size="32"  value="<?php echo $data->catname;?>"/>
				</td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong><?php _e('Description','fgallery')?>:</strong></td>
				<td>
				  <textarea name="edit_catdesc" cols="29" rows="5"><?php echo $data->description;?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right" ><strong><?php _e('Password', 'fgallery');?>:</strong></td>
				<td><input name="pass" type="text" id="pass" size="32" value="<?php echo $data->password;?>"/></td>
			</tr>
			<tr>
			<td align="right" valign="top"><strong><?php _e('Status','fgallery')?>:</strong></td>
				<td>
				<?php $status = $data->status;?>
				<select name="fim_cat_status">
					<option value="public" <?php if($status == "public") echo "selected"; ?>><?php _e('Public', "fgallery");?></option>
					<option value="private" <?php if($status == "private") echo "selected"; ?>><?php _e('Private', "fgallery");?></option>		
				</select>
				</td>

		</table>
	<div class="submit">
	<input name="edit_catid" type="hidden" value="<?php echo $cat; ?>" />

      <input type="submit" name="do_edit_cat" value="<?php _e('Update options', 'fgallery');?> &raquo;" />
    </div>
		</form>

	<?php
}
if(isset($_POST['do_edit_cat']))
{
	global $wpdb, $table_prefix;
	$table = $table_prefix."fim_cat";
	$name = escape($_POST['edit_catname']);
	$desc = escape($_POST['edit_catdesc']);
	$catid = $_POST['edit_catid'];
	$pass = $_POST['pass'];
	$status = $_POST['fim_cat_status'];
	
	if($status == 'private' && $pass == ''){
		die ("<div  class='error fade' id='message'><p><strong>".
	__('You must provide a password if you want this album to be private', 'fgallery')."</strong></p></div>");	
	}
	
	$sql = "UPDATE $table SET catname='$name', password = '$pass', description='$desc', status='$status' WHERE id='$catid'";
	$res = $wpdb->query($sql);
	echo "<div class='updated fade' id='message'><p><strong>".__('Options updated', 'fgallery').".</strong></p></div>";

}
// Edit the image
if(isset($_POST['edit_image']))
{
	$title = escape($_POST['name']);
	$description = escape($_POST['description']);
	$edit_image_id = $_POST['edit_image_id'];
	$status = $_POST['status'];
	$gallery = $_POST['gallery'];
	if($_POST['status'] == "true")
		$status = "exclude";
	else
		$status = "include";
	
	if($_POST['cover'] == "true")
	{
		$sql = "UPDATE $table_name_cat SET cover = '$edit_image_id' WHERE id='$gallery'";
		$wpdb->query($sql);
	}
	else
	{		
		$sql = "UPDATE $table_name_cat SET cover = '' WHERE id='$gallery'";
		$wpdb->query($sql);
	}
	
	$editSQL = "UPDATE $table_name_image SET title = '$title', description = '$description', status = '$status' WHERE id = '$edit_image_id'";
	$res = $wpdb->query($editSQL);
	if($res === "false")
		echo "<div class='error fade' id='message'><p><strong>".__('Could not update image', 'fgallery').".</strong></p></div>";
	else
		echo "<div class='updated fade' id='message'><p><strong>".__('Image successfully updated', 'fgallery').".</strong></p></div>";
		
	
}
// Confirm detetion of images in the gallery
if(isset($_POST['del_cat']))
{
?>
	<div class="wrap">
		<h2><?php _e('Confirm deletion','fgallery')?></h2>
		<form action="" method="post">
		<table cellpadding="3" cellspacing="0">
			<tr>
				<td colspan="2"><strong><?php _e('Would you like to delete the images as well','fgallery')?>?</strong></td>
			</tr>
			<tr>
				<td align="center"><input type="submit" name="del_images_no" value="<?php _e('No','fgallery')?>" /></td>
				<td align="center"><input type="submit" name="del_images_yes" value="<?php _e('Yes','fgallery')?>" /></td>
			</tr>
		</table>
		<input type="hidden" name="del_catid" value="<?php echo $_POST['del_cat']?>" />
		</form>
	</div>
<?php
}
// Delete a gallery
if(isset($_POST['del_catid']))
{
	$del_catid = $_POST['del_catid'];
	$folder = fim_get_folder($_POST['del_catid']);
	// Get all the images in the gallery
	$imagesSQL = "SELECT image, id FROM $table_name_image WHERE cat = '$del_catid'";
	// Remove all images in the database
	$deleteSQL_images = "DELETE FROM $table_name_image WHERE cat = '$del_catid'";
	// Remove galley in the database
	$deleteSQL_cat = "DELETE FROM $table_name_cat WHERE id = '$del_catid'";
	
	$images = $wpdb->get_results($imagesSQL);
	$res_images = $wpdb->query($deleteSQL_images);
	$res_cat = $wpdb->query($deleteSQL_cat);
	
	if(!$res_cat)
		echo "<div class='error fade' id='message'><p><strong>".__('Could not delete album', 'fgallery').".</strong></p></div>";
	
		
			foreach((array)$images as $image)
			{
				$deleteSQL_comments = "DELETE FROM $table_comments WHERE image_id = $image->id";
				$wpdb->query($deleteSQL_comments);
				if(isset($_POST['del_images_yes']))
				{
					// Delete image
					@unlink("../wp-content/fgallery/".$folder."$image->image");
					// Delete thumbnail
					@unlink("../wp-content/fgallery/".$folder."thumb_$image->image");		
				}
			}
			if(isset($_POST['del_images_yes']))
			{
				@rmdir($fpath.$folder);	
			}
	echo "<div class='updated fade' id='message'><p><strong>".__('Album deleted successfully', 'fgallery').".</strong></p></div>";

}
// Delete an image
if(isset($_POST['del_imageid']))
{
	$table_prefix."fim_comments";
	$del_imageid = $_POST['del_imageid'];
	$del_imagename = $_POST['del_imagename'];
	$folder = fim_get_folder($_POST['catid']);
	// Remove image in the database
	$deleteSQL_image = "DELETE FROM $table_name_image WHERE id = '$del_imageid'";
	$res_delimage = $wpdb->query($deleteSQL_image);
	// Remove comments
	$deleteSQL_comments = "DELETE FROM $table_comments WHERE image_id = '$del_imageid'";
	$wpdb->query($deleteSQL_comments);
	if(!$res_delimage)
		echo "<div class='error fade' id='message'><p><strong>".__('Could not delete image', 'fgallery').".</strong></p></div>";
	else
	{
			// Delete image
			@unlink("../wp-content/fgallery/".$folder."$del_imagename");
			//echo "../wp-content/fgallery/".$folder."$del_imagename";
			// Delete thumbnail
			@unlink("../wp-content/fgallery/".$folder."thumb_$del_imagename");		
		}
}

// Add a new gallery
if(isset($_POST['new_gallery']))
{		
	$new = $_POST['name'];

	if($new != "")
	{
		/* Folder name bug fixed */
		$dirname = sanitize_title_with_dashes($new);
		/* End bug fix */

		$dir = ABSPATH."wp-content/fgallery/$dirname";

		//echo "<pre>$dirname</pre>";

		if (!is_dir($dir))
		{
			@mkdir ($dir) or die ("<div  class='error fade' id='message'><p><strong>".
			__('Unable to create directory ', 'fgallery').$dir.'!</strong></p></div>');
		}
		else
		{
			die ("<div  class='error fade' id='message'><p><strong>".
			__('Directory', 'fgallery').' '.$dirname.' '.__('exists', 'fgallery').'!</strong></p></div>');	
		}

		$new = escape($new);
		$description = escape($_POST['description']);
		$date = gmdate('Y-m-d H:i:s', time());
		$status = $_POST['fim_cat_status'];
		$pass = $_POST['pass'];
		if(!$pass && $status == 'private'){
			die ("<div  class='error fade' id='message'><p><strong>".
			__('You must provide a password if you want this album to be private', 'fgallery')."</strong></p></div>");	
		}
		
		$sql = "INSERT INTO $table_name_cat (catname, description, date, folder, status, password) VALUES('$new', '$description', '$date', '$dirname', '$status', '$pass')";
		$res = $wpdb->query($sql);
		if($res)
		echo "<div class='updated fade' id='message'><p><strong>".__('Album created successfully', 'fgallery').".</strong></p></div>";
		else
		echo "<div class='error fade' id='message'><p><strong>".__('Unable to create album', 'fgallery').".</strong></p></div>";	
	}
	else
		echo "<div class='error fade' id='message'><p><strong>".__('Can not create an album with no name', 'fgallery').".</strong></p></div>";	
	}
	if(!isset($_POST['catid']) && !isset($_POST['edit_id']) && !isset($_POST['edit_cat']) && !isset($_POST['del_cat']))
	{ 
		$sql_cat = "SELECT * FROM $table_name_cat";
		$cats = $wpdb->get_results($sql_cat);
		?>
		<div class='wrap'>
		<h2><?php _e('Manage albums', 'fgallery');?></h2>
		<h3><?php _e('Create new album', 'fgallery');?> </h3>
		<form method="post" enctype="multipart/form-data" action="">
	
		<table cellpadding="3" cellspacing="0">
		<tr>
			<td align="right" ><strong><?php _e('Name', 'fgallery');?>:</strong></td>
			<td><input type="text" name="name" id="name" size="32" /></td>
		</tr>
		<tr>
			<td align="right" ><strong><?php _e('Description', 'fgallery');?>:</strong></td>
			<td><input name="description" type="text" id="description" size="32" /></td>
		</tr>
		
		<tr>
			<td align="right" ><strong><?php _e('Password', 'fgallery');?>:</strong></td>
			<td><input name="pass" type="text" id="pass" size="32" /></td>
		</tr>
		<tr>
			<td align="right" ><strong><?php _e('Status', 'fgallery');?>:</strong></td>
			<td>
				<select name="fim_cat_status">
					<option value="public"><?php _e('Public', 'fgallery');?></option>
					<option value="private"><?php _e('Private', 'fgallery');?></option>
				</select>
			</td>
		</tr>
		</table>
		
		
		<div class="submit">
		<input type="submit" name="new_gallery" value="<?php _e('Create', 'fgallery')?> &raquo;" />
		</div>
		</form>
		</div> <?php
}
  	
// Edit an image
if(isset($_POST['edit_id']))
{
	$catid = $_POST['catid'];
	$edit_id = $_POST['edit_id'];
	$sql_image = "SELECT * FROM $table_name_image WHERE id = '$edit_id'";
	$sql_cat = "SELECT * FROM $table_name_cat";
	$cats = $wpdb->get_results($sql_cat);
	$image = $wpdb->get_row($sql_image);
	$cover = $wpdb->get_row("SELECT cover FROM $table_name_cat WHERE id='$catid'");
	$f = substr(fim_get_folder($catid),0 ,-1 );

?>
<div class='wrap'>

  <h2><?php _e('Manage albums', 'fgallery');?></h2>
  <h3><?php _e('Edit image', 'fgallery');?></h3>
  <form method="post" action="">
   	<?php $folder = fim_get_folder($catid);
		$img = rawurlencode($image->image);
?>

    <table cellpadding="3" cellspacing="0">
      <tr>
        <td align="right" ><strong><?php _e('Title', 'fgallery');?>:</strong></td>
        <td><input type="text" name="name" id="name" size="32" value="<?php echo $image->title; ?>" /></td>
        
				<td rowspan="3">
						<img src='<?php echo "$plugin_path/fim_thumb.php?album=$f&amp;image=$img' alt='$title'";?>/>
						
				</td>
      

				</tr>
      <tr>
        <td align="right" valign="top" ><strong><?php _e('Description', 'fgallery');?>:</strong></td>
        <td><textarea name="description" cols="29" rows="5" id="description"><?php echo $image->description;?></textarea></td>
      </tr>
      
      <tr>
        <td align="right" valign="top" ><strong><?php _e('Exclude', 'fgallery');?>:</strong></td>
        <td>
		<?php 
			if($image->status == "include")
				$checked = "";
			else
				$checked = "checked='CHECKED'";
						?>
          <input name="status" type="checkbox" <?php echo $checked; ?> value="true" /></td>
        <td>&nbsp;</td>
		</tr>
		<tr>
			<td><strong><?php _e('Use as album cover', 'fgallery');?>:</strong></td>
			<?php 
			if($cover->cover != $image->id)
				$checked = "";
			else
				$checked = "checked='CHECKED'";
			?>
			<td><input name="cover" type="checkbox" <?php echo $checked; ?> value="true" /></td>
      </tr>
    </table>
    <div class="submit">
	<input name="edit_image_id" type="hidden" value="<?php echo $image->id; ?>" />
	<input name="catid" type="hidden" value="<?php echo $catid; ?>" />
	<input name="gallery" type="hidden" value="<?php echo $catid; ?>" />

      <input type="submit" name="edit_image" value="<?php _e('Update image', 'fgallery');?> &raquo;" />
    </div>
  </form>
</div>

<?php
}
?>

<?php 
// Show categories
if(!isset($_POST['catid']) && !isset($_POST['edit_cat']) && !isset($_POST['del_cat']))
{ 
	$sql_cat = "SELECT * FROM $table_name_cat ORDER BY date DESC";
	$cats = $wpdb->get_results($sql_cat);
?>
	<div class=wrap>
	<h3><?php _e('Albums', 'fgallery');?></h3>
	<?php if($cats) 
	{ ?>
		<table width="100%" cellpadding="3" cellspacing="3">
		<tr>
			<th><?php _e('ID', 'fgallery');?></th>
			<th><?php _e('Creation date', 'fgallery');?></th>
			<th><?php _e('Name', 'fgallery');?></th>
			<th><?php _e('Description', 'fgallery');?></th>
			<th><?php _e('Status', 'fgallery');?></th>
			<th><?php _e('Password', 'fgallery');?></th>
			<th>&nbsp;</th>
		</tr>
		<?php
		foreach($cats as $cat)
		{ 
			$class = ('alternate' == $class) ? '' : 'alternate';?>
			<tr class='<?php echo $class; ?>'>
				<th><?php echo $cat->id; ?></th>
				<td><?php echo str_replace(" ", "<br />", $cat->date); ?></td>
				<td><?php echo $cat->catname; ?></td>
				<td><?php echo $cat->description; ?></td>
				<td><?php echo $cat->status; ?></td>
				<td><?php echo $cat->password; ?></td>
				
				
				<td>
					<form action="" method="post">
						<input name="edit_cat" type="hidden" value="<?php echo $cat->id;?>" />
						<input type="submit" value="<?php _e('Edit', 'fgallery');?>" />
					</form>
				</td>
				<td>
					<form action="" method="post">
						<input name="catid" type="hidden" value="<?php echo $cat->id;?>" />
						<input type="submit" value="<?php _e('Manage images', 'fgallery');?>" />
					</form>
				</td>
				<td>
					<form action="" method="post">
						<input name="del_cat" type="hidden" value="<?php echo $cat->id;?>" />
						<input type="submit" value="<?php _e('Delete', 'fgallery');?>" onClick="return go('album');" />
					</form>
				</td>
			</tr> <?php
		} ?>
		</table> <?php
	}
	else
		echo "<p>".__('There are no albums in the database', 'fgallery').".</p>"; ?>
	</div> <?php
} 

// Show images in the category
if(isset($_POST['catid']) && !isset($_POST['edit_id']))
{
	$catid = $_POST['catid'];

	$sql_images = "SELECT * FROM $table_name_image WHERE cat = '$catid' ORDER BY date DESC";
	$images = $wpdb->get_results($sql_images);
	?>
<div class="wrap">
<h2><?php _e('Manage albums', 'fgallery');?></h2>
  <h3><?php echo __('Images in the', 'fgallery')." \"";?><?php echo fim_get_cat_name($catid); ?><?php echo "\" ".__('album', 'fgallery');?></h3>
  
  <?php 	
 	$folder = fim_get_folder($catid);
	if($images) 
  	{ 
		$cover = fim_get_cover($catid);
?>
		<table width="100%" cellpadding="3" cellspacing="3">
		<tr>
			<th><?php _e('Id', 'fgallery');?></th>
			<th><?php _e('Thumbnail', 'fgallery');?></th>
			<th><?php _e('Date added', 'fgallery');?></th>
			<th><?php _e('Image name', 'fgallery');?></th>
			<th><?php _e('Album cover', 'fgallery');?></th>
			<th><?php _e('Title', 'fgallery');?></th>
			<th><?php _e('Description', 'fgallery');?></th>
			<th><?php _e('Status', 'fgallery');?></th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($images as $image) 
		{ 
			$f = substr(fim_get_folder($image->cat),0 ,-1 );
			$img = rawurlencode($image->image);
			
			
			$class = ('alternate' == $class) ? '' : 'alternate';?>
			<tr class='<?php echo $class; ?>'>
				<th><?php echo $image->id; ?></th>
				<td><img src='<?php echo "$plugin_path/fim_thumb.php?album=$f&amp;image=$img' alt='$title'";?>/></td>
				<td><?php echo str_replace(" ", "<br />", $image->date); ?></td>
				<td><?php echo $image->image; ?></td>
				<td><?php if ($cover->id == $image->id) echo "X"; ?></td>
				<td><?php echo $image->title; ?></td>
				<td><?php echo $image->description; ?></td>
				<td><?php echo $image->status; ?></td>
				<td>
					<form action=""  method="post">
						<input type="submit" value="<?php _e('Edit', 'fgallery');?>" />
						<input name="edit_id" type="hidden" value="<?php echo $image->id; ?>" />
						<input name="catid" type="hidden" value="<?php echo $catid; ?>" />

					</form>
				</td>
				<td>
					<form action="" method="post">
						<input type="submit" value="<?php _e('Delete', 'fgallery');?>" onClick="return go('image');" />
						<input name="del_imageid" type="hidden" value="<?php echo $image->id; ?>" />
						<input name="catid" type="hidden" value="<?php echo $catid; ?>" />
						<input name="del_imagename" type="hidden" value="<?php echo $image->image; ?>" />

					</form>
				</td>
			</tr> <?php
		} 
?>
</table><?php
	}
else
	echo "<p>".__('There are no images in this album', 'fgallery').".</p>"; ?>
</div> <?php
} 

// Get category name from id
function fim_get_cat_name($id)
{
	global $table_prefix, $wpdb;
	$table_name_cat = $table_prefix . "fim_cat";

	$sql = "SELECT * FROM $table_name_cat WHERE id = '$id'";
	$res = $wpdb->get_row($sql);
	return $res->catname;
}




