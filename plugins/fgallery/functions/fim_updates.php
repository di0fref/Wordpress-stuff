<?php
if(isset($_POST['fim_update_submit'])){
	$result = fim_url_get("http://www.fahlstad.se/ff_version_check.php?plugin=$_POST[plugin]&version=$_POST[version]");
	update_option('fim_update_check', date("Y-m-d H:i:s"), time());
		echo $result;
}
	$last_check = get_option('fim_update_check');
	
	$date_then = getdate(strtotime($last_check));
	$date_now = getdate(strtotime(date("Y-m-d H:i:s", time())));
	$diff = intval($date_now['yday'] - $date_then['yday']);
	$next_update = 7 - $diff;

	$version =  trim(fim_get_version());
	?>
	
	<div class="wrap">
		<h2><?php _e("Check for updates", "fgallery")?></h2>
		<p><?php _e("Last checked", "fgallery");?>: <b><?php echo $last_check;?></b></p>
		<?php
		if($diff < 1){
			echo "<p>".__('Due to server load checking for update is only available once a day. Your version is', 'fgallery')."<b> $version</b>.</p>
						<p>".__('But if you don´t want to wait you can always check out the', 'fgallery')."<a href='http://www.fahlstad.se'> ".__('plugin page', 'fgallery')."</a></p>";
		}
		else{
			?>
			<form action="" method="post">
			<input type="submit" name="fim_update_submit" value="<?php _e("Click here to check for fGallery updates", "fgallery")?>"</a>
			<input type="hidden" name="version" value="<?php echo $version;?>" />	
			<input type="hidden" name="plugin" value="fgallery" />	
			</div> <?php
		} 
	?>
	</div>


<?php
function fim_url_get($url) {
	$return_value = '';
	$elements = parse_url($url);
	if ($fp = @fsockopen($elements['host'],80)) {
		fputs($fp, sprintf("GET %s HTTP/1.0\r\n" . "Host: %s\r\n\r\n", $elements['path'] . (isset ($elements['query']) ? '?'. $elements['query'] : ''), $elements['host']));
		while (!feof($fp)) $line .= fgets($fp, 4096);
		fclose($fp);				
		$line       = urldecode(trim(strtr($line,"\n\r\t\0","    ")));
		$work_array = explode("  ",$line);
		
		$return_value = $work_array[count($work_array)-1];
	} 
return $return_value;
}

function fim_get_version() {	
		$plugin_data = implode('', file("../wp-content/plugins/fgallery/fgallery-plugin.php"));
		if (preg_match("|Version:(.*)|i", $plugin_data, $version)) {
				$version = $version[1];
		} 
	return $version;
}?>