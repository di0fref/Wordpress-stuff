<div id="more">
	<div class="col"><h2>Categories</h2><ul><?php wp_list_categories("title_li=&feed=Subscribe&show_count=1");?></ul></div>
	<div class="col center"><h2>Recent Articles</h2><?php recent_posts();?></div>
	<div class="col"><h2>Resent Comments</h2><?php recent_comments();?></div>
</div>