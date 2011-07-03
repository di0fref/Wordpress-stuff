<div id="footer"> 
	<p><a href="http://scaffold.tumblr.com">Scaffold theme</a> by <a href="http://sneak.co.nz">Mike Harding</a>. Adapted to Wordpress by <a href="http://www.fahlstad.se">Fredrik Fahlstad</a>.</p>
	<ul class="footer_links"> 
		<li class="has_icon icon_rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS feed</a></li>
		<li class="has_icon icon_tumblr">Powered by <a href="http://www.wordpress.org/">Wordpress</a></li> 
		<li><?php wp_register(); ?></li>
	</ul> 
	<?php wp_meta(); ?>
	</div> 
</div>

</body> 
</html>
<?php wp_footer();?>
