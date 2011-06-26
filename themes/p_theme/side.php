<div id="side">
	
	<h2>Feeds</h2>
	<ul>
		<li class="feed"><a href="<?php bloginfo('rss2_url');?>">RSS Articles complete</a></li>
		<li class="feed"><a href="http://www.fahlstad.se/wp-rss2.php?cat=15">RSS Sidenotes only</a></li>
		<li class="feed"><a href="<?php bloginfo('comments_rss2_url');?>">RSS Comments complete</a></li>
	</ul>
		<?php include(TEMPLATEPATH ."/searchform.php")?>
		<?php include('wp-content/ads.php');?>
		<?php include( 'paypal.php' );?>
		
		<?php adsense_deluxe_ads('sidebar'); ?>
			<h2>Latest forum activity</h2>

	<?php forum_latest_activity(5)?>
		
		<h2>Meta</h2>
		<ul>
				<li class="register"><?php wp_register('',''); ?></li>
				<li class="loginout"><?php wp_loginout(); ?></li>
				<li class="wp"><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				<?php wp_meta(); ?>
		</ul>	
</div>