<?php
$dir = ABSPATH."wp-content/fgallery/";
if(!is_dir ( $dir ))
{
	@mkdir ($dir) or die ("<div  class='error fade' id='message'><p><strong>".	
	__('Unable to create directory', 'fgallery')." ".$dir."!</strong></p><p>".__('You can create it your self or do a chmod 755 wp-content and try again','fgallery').".</p></div>");
}
require_once("class.imageMod.php");
require_once("fim_functions.php");
$plugin_path = get_bloginfo('wpurl')."/wp-content/plugins/fgallery/functions";

if(isset($_POST['upload']))
	fim_upload();
else if(isset($_POST['uploaded']))
	fim_uploaded();
else if(isset($_POST['zip_upload']))
	fim_zip_upload();
else if(isset($_POST['folder_upload']))
	fim_folder_upload();
/*else if(isset($_POST['movie_upload']))
	fim_movie_upload();*/
else
	fim_main();
	
function fim_folder_upload(){
	global $fpath,$plugin_path;
	$dir = $_POST['folder'];
	$path = $fpath.$dir."/";
	if(!is_dir($path))
		die ("<div class='error fade' id='message'><p><strong>".__("No such folder", "fgallery")." ".$path.".</strong></p></div>");
	
	if($dir == "")
		die ("<div class='error fade' id='message'><p><strong>".__("No such folder", "fgallery")." ".$path.".</strong></p></div>");
	$dh = opendir($path) or die ("<div class='error fade' id='message'><p><strong>".__("No such folder", "fgallery")." ".$path.".</strong></p></div>");
	$date = gmdate('Y-m-d H:i:s', time());
	global $wpdb, $table_prefix, $fpath;
	$table = $table_prefix."fim_images";
	$table_cat = $table_prefix."fim_cat";
	$linkpath = get_bloginfo('wpurl')."/wp-content/fgallery/$dir/";

	$thw = get_option('fim_th_size');
	$imw = get_option('fim_image_size');
	$types = array("gif","png","jpg", "JPG", "PNG", "GIF", "jpeg", "JPEG");
	$files = array();

	$re = get_option('fim_resize');	
	
	while (($file = readdir($dh)) !== false) 
	{
		$ext = substr(strrchr($file, "."), 1);
		//echo $ext."<br>";
		if(in_array($ext, $types))					
			array_push($files, $file);
	}
	sort($files);
	closedir($dh);
		$sql = "INSERT INTO $table_cat (catname, date, folder) VALUES('$dir', '$date', '$dir')";
	$wpdb->query($sql);
	$c = $wpdb->get_row("SELECT id FROM $table_cat WHERE catname = '$dir'");
	$gallery = $c->id;
//print_r($files);exit;
	$i = 0;
	?><div class="wrap">
	<form method="post" action=""><?php
	$f = fim_get_folder($gallery);
if($files){
	foreach($files as $file)
	{
		if($re == 'true')
		{
			// Resize image
			$normal = new imageMod($path,$file, 'normal', $imw, $imw, 100);
			$normal->resize();
		}
		// Create thumbnail
		//$thumb = new imageMod($path, $file, 'thumb', $thw, $thw, 50);
		//$thumb->resize();
		
		$insertSQL = "INSERT INTO $table (date, cat, image) VALUES('$date', '$gallery', '$file')";
		$res = $wpdb->query($insertSQL);
		if(!$res){
			echo "<div class='error fade' id='message'><p><strong>".
			__('Unable to add image to database', 'fgallery').".</strong></p><p>($imagename)</p></div>";
		}
			?>
			<table cellpadding="3" cellspacing="3" style="border:solid 1px #ccc">
				<tr>
				<td rowspan="2" valign="top"><img src='<?php echo "$plugin_path/fim_thumb.php?album=$f&image=$file";?>' alt='$title'/></td>
					<td valign="top"><div align="right"><strong><?php _e('Title', 'fgallery')?>:</strong></div></td>
					<td><input type="text" name="title_<?php echo $i;?>" /></td>
				</tr>
				<tr>
					<td valign="top"><div align="right"><strong><?php _e('Description', 'fgallery')?>:</strong></div></td>
					<td> <textarea rows="5" name="desc_<?php echo $i;?>"></textarea></td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $file;?>" name="imagename_<?php echo $i;?>" />
			<p>&nbsp;</p>
			<?php
			++$i;
	}
	?>
	<div class="submit">
		<input type="hidden" value="<?php echo $i+1;?>" name="num" />
		<input type="submit" name="uploaded" value="<?php _e('Add images', 'fgallery')?> &raquo;" />
	</div>
	</form></div><?php
}
else{
	echo "<div class='error fade' id='message'><p><strong>".
	__('No images in folder', 'fgallery').". ($path)</strong></p></div>";
}
}
function fim_zip_upload(){
	
	global $fpath, $plugin_path, $wpdb, $table_prefix;
	$table = $table_prefix."fim_images";
	
	$zipname = $_FILES['zipfile']["name"];
	$gallery = $_POST['gallery'];	
	$folder = fim_get_folder($gallery);
	$extract_dir = $fpath.$folder."tmp";
	$image_dir = $fpath.$folder;
	$files = array();
	$date = gmdate('Y-m-d H:i:s', time());
	$types = array("gif","png","jpg", "JPG", "PNG", "GIF", "jpeg", "JPEG");
	
	if($_FILES['zipfile']['type'] != 'application/zip')
	{
		die ("<div class='error fade' id='message'><p><strong>".
		__('Wrong file type, zip files supported only', 'fgallery').".</strong></p></div>");
		fim_main();
	}
	else if($gallery == "null")
	{
		echo "<div class='error fade' id='message'><p><strong>".__('No album selected', 'fgallery').".</strong></p></div>";
		fim_main();
	}
	mkdir($extract_dir);
	
	if(!move_uploaded_file($_FILES['zipfile']["tmp_name"], $extract_dir."/".$zipname)){
		echo __("Sorry, unable to upload file", "fgallery");
	}
	 chdir($extract_dir);
	
	// Extract files to tmp dir
	 $r = shell_exec("unzip $zipname");
	
	// open tmp dir
	$dir = opendir($extract_dir);

	// Remove zip file
	unlink($extract_dir."/".$zipname);
	
	// Get the images
  	while (($file = readdir($dir)) !== false) {
		$ext = substr(strrchr($file, "."), 1);
		if(in_array($ext, $types)){
			array_push($files, $file);
			// Copy the images to the album folder
			copy($extract_dir."/".$file, $image_dir.$file);
		}
	}
	
	sort($files);
	
	// Remove temp files
	rewinddir($dir);
	
	while (($file = readdir($dir)) !== false) {
		if($file != ".." and $file != ".")
			unlink($extract_dir."/".$file);
	}
	closedir($dir);
	// Remove tmp dir
	rmdir($extract_dir);
	
	$resize = get_option('fim_resize');
	$imw = get_option('fim_image_size');
	
	
	$folder = fim_get_folder($catid);
 	
	$f = fim_get_folder($gallery);
	
	if($files){
	
	echo "<div class='wrap'>
				<form method='post' action=''>";
	// Deal wíth the images
	foreach($files as $file){
		
		// Resize images?
		if($resize == 'true'){
			$normal = new imageMod($image_dir, $file, 'normal', $imw, $imw, 100);
			$normal->resize();
		}

		$sql = "INSERT INTO $table (date, cat, image) VALUES('$date','$gallery','$file')";
		$res = $wpdb->query($sql);
		
		if(!$res){
			echo "<div class='error fade' id='message'><p><strong>".
			__('Unable to add image to database', 'fgallery').".</strong></p><p>($file)</p></div>";
		}
			?>
			<table cellpadding="3" cellspacing="3" style="border:solid 1px #ccc">
				<tr>
				<!--	<td rowspan="2" valign="top"><img src="<?php echo "$linkpath"."thumb_$filename";?>" /></td> -->
					<td rowspan="2" valign="top"><img src='<?php echo "$plugin_path/fim_thumb.php?album=$f&image=$file' alt=''";?>/></td>
					
					<td valign="top"><div align="right"><strong><?php _e('Title', 'fgallery')?>:</strong></div></td>
					<td><input type="text" name="title_<?php echo $i;?>" /></td>
				</tr>
				<tr>
					<td valign="top"><div align="right"><strong><?php _e('Description', 'fgallery')?>:</strong></div></td>
					<td> <textarea rows="5" name="desc_<?php echo $i;?>"></textarea></td>
				</tr>
			</table>				
			<p>&nbsp;</p>
			
			<input type="hidden" value="<?php echo $filename;?>" name="imagename_<?php echo $i;?>" />
			<?php ++$i; 
		}
	
		?>
		<div class="submit">			
			<input type="hidden" value="<?php echo $i;?>" name="num" />
			<input type="submit" name="uploaded" value="<?php _e('Add images', 'fgallery')?> &raquo;" />
		</div> <?php
		echo "</form></div>";
	}
	else
		echo "<div class='error fade' id='message'><p><strong>".
		__('No images in zip file', 'fgallery')."<p><strong></div>";
}
function fim_upload(){
	
	global $wpdb, $table_prefix, $fpath, $plugin_path;
	$table = $table_prefix."fim_images";

	//$picture_folder = "../wp-content/fgallery_images/";
	//$thumb_folder = "../wp-content/fgallery_thumbs/";
	$thw = get_option('fim_th_size');
	$imw = get_option('fim_image_size');
	$gallery = $_POST['gallery'];	
	$folder = fim_get_folder($gallery);
	$image_folder = $fpath.$folder;
	$linkpath = get_bloginfo('wpurl')."/wp-content/fgallery/$folder/";

	$date = gmdate('Y-m-d H:i:s', time());
	$i = 0;				
	if($gallery == "null"){
		die ("<div class='error fade' id='message'><p><strong>".__('No album selected', 'fgallery').".</strong></p></div>");
	}	
	if($_FILES['file_0']['error'] != 0){
		die ("<div class='error fade' id='message'><p><strong>".__('No album selected', 'fgallery').".</strong></p></div>");
	}

	?>	
	<div class="wrap">	
	<h2><?php _e("Uploaded images", "fgallery");?></h2>		
	<form method="post" action="">
	<?php
	$f = fim_get_folder($gallery);

	foreach ($_FILES as $file){
		if($file["error"] == 0)
		{
			$ext = strtolower(end(explode('.',  $file["name"])));
			$do = true;
			if(is_file($image_folder.$file["name"])) {
				echo "<div class='error fade' id='message'><p><strong>".
				__('Image', 'fgallery').
				" $file[name] ".__('already exists in')." ".fim_get_cat_name_($gallery).".</strong></p></div>";
				$do = false;
			}
			if($do)
			{
				if($ext != "jpg" && $ext != "gif" && $ext != "png"  && $ext != "jpeg"){
					echo "<div class='error fade' id='message'><p><strong>".
					__('Unsupported image format. jpg, gif and png only', 'fgallery').". </strong></p><p>($imagename)</p></div>";
				}
				if(!is_uploaded_file($file["tmp_name"])){
					echo "<div class='error fade' id='message'><p><strong>".__('Unable to upload file', 'fgallery').".</strong></p></	div>";
					break;
				}
				if(!move_uploaded_file($file["tmp_name"], $image_folder.$file["name"])){
					echo "<div class='error fade' id='message'><p><strong>".__('Unable to upload file', 'fgallery').".</strong></p></div>";
					break;
				}
	
			//$imgname = str_replace(".", "", array_sum(explode(" ",microtime())));
			//rename($picture_folder.$file["name"], "$image_folder$imgname.$ext");
	
				$insertSQL = "INSERT INTO $table (date, cat, image) VALUES('$date', '$gallery', '$file[name]')";
				$res = $wpdb->query($insertSQL);
				if(!$res){
					echo "<div class='error fade' id='message'><p><strong>".__('Unable to add image to database', 'fgallery').".</strong></p><p>($imagename)</p></div>";
					break;
				}
				if(get_option('fim_resize')=='true'){
					// Resize image
					$normal = new imageMod($image_folder,$file["name"], 'normal', $imw, $imw, 100);
					$normal->resize();
				}
				// Create thumbnail
				//$thumb = new imageMod($image_folder, $file["name"], 'thumb', $thw, $thw, 50);
				//$thumb->resize();
				?>
				<table cellpadding="3" cellspacing="3" style="border:solid 1px #ccc">
					<tr>
					<!--
						<td rowspan="2" valign="top"><img src="<?php echo $linkpath."thumb_".$file["name"];?>" /></td>
					-->
					
						<td rowspan="2" valign="top">
							<img src='<?php echo "$plugin_path/fim_thumb.php?album=$f&image=$file[name]";?>' alt='$title'/>
						</td>
						
						<td valign="top"><div align="right"><strong><?php _e('Title', 'fgallery')?>:</strong></div></td>
						<td><input type="text" name="title_<?php echo $i;?>" /></td>
					</tr>
					<tr>
						<td valign="top"><div align="right"><strong><?php _e('Description', 'fgallery')?>:</strong></div></td>
						<td> <textarea rows="5" name="desc_<?php echo $i;?>"></textarea></td>
					</tr>
				</table>
				<input type="hidden" value="<?php echo $file["name"];?>" name="imagename_<?php echo $i;?>" />
				<p>&nbsp;</p>
				<?php
				++$i;
			}
		}
	}
	?>
	<div class="submit">
		<input type="hidden" value="<?php echo $i+1;?>" name="num" />
		<input type="submit" name="uploaded" value="<?php _e('Add images', 'fgallery')?> &raquo;" />
	</div>
	</form></div><?php
}	
function fim_uploaded(){
	global $table_prefix, $wpdb;
	$table_image = $table_prefix . "fim_images";
	for($i = 0; $i < $_POST['num']; ++$i){
	
	$t = "title_".$i;
	$d = "desc_".$i;
	$im = "imagename_".$i;
	
		$title =  		escape($_POST["title_".$i]);
		$description =  escape($_POST["desc_".$i]);
		$image =  		$_POST["imagename_".$i];
				
		$editSQL = "UPDATE $table_image SET title = '$title', description = '$description' WHERE image = '$image'";	
		$res = $wpdb->query($editSQL);
	}			
	echo "<div class='updated fade' id='message'><p>".__('Images added successfully', 'fgallery').".</p></div>";

	fim_main();
}
function fim_main(){
	global $table_prefix, $wpdb;
	$table_name_cat = $table_prefix . "fim_cat";
	$sql_cat = "SELECT * FROM $table_name_cat";
	$cats = $wpdb->get_results($sql_cat); ?>
	
	<div class="wrap">
		<h2><?php _e('Upload images', 'fgallery');?></h2>
		<p><strong><?php _e('Max upload size', 'fgallery');?>: <?php echo ini_get('upload_max_filesize');?></strong></p>
		<h3><?php _e('Direct image upload', 'fgallery');?></h3>
		<form enctype="multipart/form-data"  method = "post" action="">
		<table>
			<tr>
				<td>
				  <div align="right"><strong><?php _e('Album', 'fgallery');?>:</strong></div>
				</td>
				<td><select name="gallery">
						<option selected value="null"><?php _e('Choose album', 'fgallery');?></option>
					<?php foreach($cats as $cat){
							echo "<option value='$cat->id'>$cat->catname</option>";
						}?>
						</select>
				</td>
			</tr>
			<tr>
				<td>
				  <div align="right"><strong><?php _e('Image', 'fgallery');?>:</strong></div>
				</td>
				<td><input id="elem" type="file" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="upload"value="<?php _e('Upload images', 'fgallery');?>" /></td>
			</tr>
		</table>
		</form>

	</div>
	<div class="updated fade" id="files" style="display:none">
		<h3><?php _e('Added images', 'fgallery');?></h3>
		<div id="files_list"></div>
		<script language="javascript" type="text/javascript">
			var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 5 );
			multi_selector.addElement( document.getElementById( 'elem' ) );
		</script>
	</div>
	
	
	<div class="wrap">
		<h3><?php _e('Add by existing folder', 'fgallery');?></h3>
		<?php global $fpath;?>
		<form action="" method="post" >
			<table>
				<tr>
					<td><?php echo $fpath?></td>
					<td><input type="text" name="folder" /></td>
				    <td><?php _e('No spaces in folder name', 'fgallery')?>. </td>
				</tr>
				<tr>
					<td><input type="submit" name="folder_upload"value="<?php _e('Add images', 'fgallery');?>" /></td>
					<td>&nbsp;</td>
				    <td>&nbsp;</td>
				</tr>
			</table>
		</form>
	</div>
	
	
	
	
	<div class="wrap">		
	<?php $have_zip = false;
		if(!ini_get('safe_mode'))
				$have_zip = true;
		?>

	<h3><?php _e('Upload by zip file', 'fgallery'); if(!$have_zip) echo " ".__('(Disabled)', 'fgallery');?></h3>
		<form enctype="multipart/form-data"  method = "post"  action="">
		<table>
			<tr>
				<td>
				  <div align="right"><strong><?php _e('Album', 'fgallery');?>:</strong></div>
				</td>
				<td><select name="gallery" id="gallery" <?php if(!$have_zip) echo "disabled='disabled'";?>>
						<option selected value="null"><?php _e('Choose album', 'fgallery');?></option>
					<?php foreach($cats as $cat){
							echo "<option value='$cat->id'>$cat->catname</option>";
						}?>
						</select>
				</td>
			</tr>
			<tr>
				<td>
				  <div align="right"><strong><?php _e('Zip-file', 'fgallery');?>:</strong></div>
				</td>
				<td><input name="zipfile" type="file"  <?php if(!$have_zip) echo "disabled='disabled'";?>/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="zip_upload" <?php if(!$have_zip) echo "disabled='disabled'";?>value="<?php _e('Upload zip', 'fgallery');?>"/></td>
			</tr>
		</table>
		</form>
		<?php if(!$have_zip)
		{
			echo "<p>".__("This module uses the functions that's not available in PHP safe_mode", "fgallery").".</p>";
		}
		?>

	</div>
<?php 
} ?>
