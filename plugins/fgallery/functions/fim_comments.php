<?php
require_once("fim_functions.php");

if(isset($_POST['fim_edit_comment']))
	fim_edit_comment();
else if(isset($_POST['fim_delete_comment']))
	fim_delete_comment();
else if(isset($_POST['fim_do_edit_comment']))
		fim_do_edit_comment();
else
	fim_manage_comments();


function fim_manage_comments(){
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	$sql = "SELECT * FROM $table_comments ORDER BY date DESC";
	$res = $wpdb->get_results($sql);?>
	
	<div class='wrap'>
	<?php
	if(isset($_POST['fim_do_edit_comment'])){
		echo "<div class='updated fade' id='message'><p>".__('Comment edited', 'fgallery').".</p></div>";
		
	}
	if(isset($_POST['fim_delete_comment'])){
		echo "<div class='updated fade' id='message'><p>".__('Comment deleted', 'fgallery').".</p></div>";
		
	}
		
	  ?><h2><?php _e('Manage comments', 'fgallery');?></h2>
	
	
		<table width="100%" cellpadding="5" cellspacing="3">
		<tr>
			<th><?php _e("Author", "fgallery");?></th>
			<th><?php _e("Author Email", "fgallery");?></th>
			<th><?php _e("Author Web site", "fgallery");?></th>
			<th><?php _e("Comment", "fgallery");?></th>
			<th><?php _e("Image", "fgallery");?></th>
			<th></th>
			<th></th>
		</tr>
<?php
	foreach((array)$res as $r){ 
		$class = ('alternate' == $class) ? '' : 'alternate';
		$image = fim_get_image_name($r->image_id);
		$cat = fim_get_cat_name_from_imageid($r->image_id);
		$cat_id = fim_get_cat_id_from_imageid($r->image_id);
		$lnk = get_url("album/$cat_id/image/$r->image_id");
		
			?>
			<tr class='<?php echo $class; ?>'>
				<td><?php echo $r->author_name; ?></td>
				<td><?php echo $r->author_email; ?></td>
				<td><?php echo $r->author_url; ?></td>
				<td><?php echo $r->author_comment; ?></td>
				<td><?php echo "<a href='$lnk'>$cat/$image";?></a></td>
				<td>
					<form action="" method="post">
						<input name="fim_edit_comment" type="hidden" value="<?php echo $r->id;?>">
						<input type="submit" value="<?php _e('Edit', 'fgallery');?>">
					</form>
				</td>
				<td>
					<form action="" method="post">
						<input name="fim_delete_comment" type="hidden" value="<?php echo $r->id;?>">
						<input type="submit" value="<?php _e('Delete', 'fgallery');?>" onClick="return go('comment');">
					</form>
				</td>
				
				
			</tr>

	<?php } ?>
	
	</table>
	</div>
<?php
}

function fim_delete_comment(){
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	
	$wpdb->query("DELETE FROM $table_comments WHERE id = $_POST[fim_delete_comment]");
	fim_manage_comments();
}

function fim_edit_comment(){
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	
	$sql = "SELECT * FROM $table_comments WHERE id = $_POST[fim_edit_comment]";
	$comment = $wpdb->get_row($sql);?>
	<div class="wrap">
	
	<h2><?php _e('Manage comments', 'fgallery');?></h2>
  
	<h3><?php _e("Edit comment", "fgallery"); ?></h3>
	
	<form method="post" action="">
	
	<table cellpadding="3" cellspacing="0">
	
		<tr>
			<td align="right" ><strong><?php _e("Author name", "fgallery"); ?>:</td>
			<td><input type="text" name="fim_do_edit_comment_name" value="<?php echo $comment->author_name ;?>" /></td>
		</tr>
		<tr>
			<td align="right" ><strong><?php _e("Author email", "fgallery"); ?>:</td>
			<td><input type="text" name="fim_do_edit_comment_email" value="<?php echo $comment->author_email ;?>" /></td>
		</tr>
		<tr>
			<td align="right" ><strong><?php _e("Author Web site", "fgallery"); ?>:</td>
			<td><input type="text" name="fim_do_edit_comment_url" value="<?php echo $comment->author_url ;?>" /></td>
		</tr>
		<tr>
			<td align="right" valign="top"><strong><?php _e("Author comment", "fgallery"); ?>:</td>
			<td><textarea name="fim_do_edit_comment_comment" cols="29" rows="5"><?php echo $comment->author_comment ;?></textarea></td>
		</tr>
		<tr>
			<td></td><td><input type="submit" value="<?php _e("Update", "fgallery");?>"></td>
	</table>
	<input type="hidden" name="fim_do_edit_comment" value="<?php echo $comment->id ;?>" />
	</form>
	</div>
	<?php
		
}

function fim_do_edit_comment(){
	global $wpdb, $table_prefix;
	$table_comments = $table_prefix."fim_comments";
	
	$sql = sprintf("UPDATE $table_comments SET author_name = '%s', author_email = '%s', author_url = '%s',	author_comment = '%s' WHERE id = %s",
				$_POST['fim_do_edit_comment_name'],
				$_POST['fim_do_edit_comment_email'],
				$_POST['fim_do_edit_comment_url'],
				$_POST['fim_do_edit_comment_comment'],
				$_POST['fim_do_edit_comment']
	);
	$wpdb->query($sql);
	fim_manage_comments();
}


?>