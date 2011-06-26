<div id="decor"></div>
<div id="sidebar">
	<ul>
		<li><a href="<?php bloginfo('home');?>">Home</a></li>
		<?php wp_list_pages("depth=1&title_li=");?>
	</ul>

<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>	
</div>









































