<div id="search">
	<form method="get" id="searchform" action="<?php bloginfo('url');?>">
		<input type="text" value="Enter search keyword" onclick="this.value='';" name="s" id="s" />
		<input name="" type="image" value="Go" class="btn" src="<?php bloginfo('template_url');?>/images/search.png" />
	</form>
	<p>Subscribe: <a href="<?php bloginfo('rss2_url');?>">Posts</a> / <a href="<?php bloginfo('comments_rss2_url');?>">Comments</a></p>
</div>
