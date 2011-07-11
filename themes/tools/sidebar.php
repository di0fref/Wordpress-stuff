<div id="sidebar">
	
	<ul>
		<li><a class="rss" href="<?php bloginfo('rss2_url'); ?>">RSS feed</a></li>
	</ul>
	<ul>
		<li><?php get_search_form();?></li>
	</ul>
	<ul>
		<li>
			<h2> Connect elsewhere</h2>
			<ul>
				<li><a href="">Facebook</a></li>
				<li><a href="">Linkedin</a></li>
				<li><a href="">Twitter</a></li>
			</ul>
		</li>
	</ul>
	<ul>
		
	<?php dynamic_sidebar("Sidebar"); ?>

	</ul>
		<?php getLiveCustomerLinks();?>
</div><!--end sidebar-->