
<?php
	function admin_page(){
	global $wpdb, $table_prefix;
	//$wpdb->show_errors();
		$admin_tabs = array(	"options" 		=> __("General Options", "wpforum"),
									"structure" 	=> __("Categories and forums", "wpforum"),
									"skins"			=> __("Skins", "wpforum"),
									"moderators"	=> __("Moderators", "wpforum"),
									"usergroups"	=> __("User Groups", "wpforum"),
									"about"			=> __("About", "wpforum")
									);
									
	if (isset($_REQUEST['wpforum_action']) && !empty($admin_tabs[$_REQUEST['wpforum_action']]))
		$cur_tab = $_REQUEST['wpforum_action'];
	else
		$cur_tab = "options";
		
		echo "<ul id='wpf-menu'>";
		$url = ADMIN_BASE_URL."/wpf-admin.php&amp;wpforum_action=";
		foreach ($admin_tabs as $tab => $name) {
			if ($cur_tab == $tab)
				echo "<li class='current'><a href=\"" . $url . $tab . "\">$name</a></li>";
			else
				echo "<li><a href=\"" . $url . $tab . "\">$name</a></li>";
		}

		echo "</ul>";
		
		/*switch($cur_tab){
			case "options": 	$this->options(); break;
			case "structure": 	$this->structure(); break;
			case "usergroups": 	$this->usergroups(); break;
			case "skins": 		$this->skins(); break;
			case "moderators":	$this->moderators(); break;
			case "about": 		$this->about(); break;
		}*/
		
	}
	admin_page();
/*************** wpf-add-forum.php *********************/
	//echo "<h2>".__("Add forum to", "wpforum")." \"".stripslashes($wpforum->get_groupname($_GET['groupid']))."\"</h2>";

	echo "<form name='add_forum_form' id='add_forum_form' method='post' action='".ADMIN_BASE_URL."structure'>";
	echo "<table class='form-table'>
			<tr>
				<th>".__("Name:", "wpforum")."</th>
				<td><input type='text' value='' name='add_forum_name' /></td>
			</tr>
			<tr>
				<th>".__("Description:", "wpforum")."</th>
				<td><textarea name='add_forum_description' ".ADMIN_ROW_COL."></textarea></td>
			</tr>
			<tr>";/*
				<th>".__("Add forum to:", "wpforum")."</th>
					<td>
						<select name='add_forum_group_id'>
							<option selected='selected' value='add_forum_null'>".__("Select group", "wpforum")."</option>";
							foreach($groups as $group){
								echo "<option value='$group->id'>$group->name</option>";
							}
						echo "</select>
					</td>
			</tr>*/
			echo "<tr>
				<th></th>
				<td><input type='submit' value='".__("Save forum", "wpforum")."' name='add_forum_submit' /></td>
			</tr>
			<input type='hidden' name='add_forum_group_id' value='{$_GET['groupid']}' />";
	
	echo "</form></table>";
/**********************************************************/



?>