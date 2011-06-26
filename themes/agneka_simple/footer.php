<div id="footer"><div class="bb-tbase">
	<div class="bb-t17 bb-fa"><div class="credits">
		<div class="bb-t11 bb-fa footer-links">
			<p><strong>Subscribe</strong> to <a href="<?php bloginfo('rss2_url'); ?>">RSS feed</a>.</p>
		</div>
		<div class="bb-t18 bb-fc footer-info">
			<p><a href="http://wordpress.org/">WordPress</a> power &amp; <a href="http://konstruktors.com/WordPressTheme/AgnekaSimple" title="Agneka Simple WordPress Theme">Agneka Simple</a> looks.</p>
			
			<?php 
			global $user_ID;
			get_currentuserinfo();

			if ($user_ID !== '') : ?>
				<p><br /><a href="<?php bloginfo('url'); ?>/wp-admin">Dashboard</a> »</p>
			<?php endif; ?>
		</div>
	</div></div>
	
	<div class="bb-t11 bb-fc"><div class="bbin-a1">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div></div>
</div></div>

</div><!--content-->

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
<?php wp_footer(); ?>
</body>
</html>
