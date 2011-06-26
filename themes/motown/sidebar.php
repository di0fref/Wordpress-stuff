<div id="sidebar">

	<div id="header">
		
	</div>
	
	<div class="sbox searchbox">
		<?php include(TEMPLATEPATH."/searchform.php");?>	
	</div>
	
	<div class="sbox">
		<div id="nav">
			<ul>
				<?php wp_list_pages("depth=1&title_li=");?>
			</ul>
		</div>
	</div>
	<div class="sbox rssbox">
		<h2>Subscribe</h2>
		<a href="<?php bloginfo('rss2_url'); ?>">Posts</a> //
		<a href="<?php bloginfo('rss2_url'); ?>">Comments</a> //
		<a href="<?php bloginfo('rss2_url'); ?>">Forums</a>
	</div>


<div class="sbox">
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
	</div>
	<div class="sbox">
		<img src="<?php bloginfo("template_directory");?>/images/me.png" class="alignright imground">	
		<p>My name is Fredrik Fahlstad. I'm a computer engineer and this is my blog.<br /><a href="./about">More about me &raquo;</a></p>
	</div>
</div>