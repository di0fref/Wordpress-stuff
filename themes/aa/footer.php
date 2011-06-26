<!--<div id="morenavwrapper">-->

<div id="morenav">

<?php $posts = get_posts('numberposts=10&orderby=post_date&order=DESC');?>
<?php $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type <> 'pingback' AND comment_type <> 'trackback' ORDER BY comment_date_gmt DESC LIMIT 4");?>
<?php $default = get_bloginfo('template_url')."/images/gravatar_default.gif";?>

	<div class="column">
		<h2>Recent <span>entries</span></h2>
		<ul class="recent">
		<?php foreach($posts as $post): setup_postdata($post);?>
			<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	
	<div class="column">
		<h2>Random <span>destinations</span></h2>
		<ul class="recent"><?php get_linksbyname('Links', '<li>','</li>', '', false, 'rand',	false, false, 10,	true); ?></ul>
	</div>
	
	<div class="column">
		<h2>Categories</h2>
			<ul class="recent">
			<?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'); ?>
			</ul>		
	</div>
	<div class="clear"></div>
	
	<div class="column">
		<h2>Need <span>more?</span></h2>
		<ul class="recent">
			<li><a href="/archives">Archives</a></li>
			<li><a href="/links">Linked list</a></li>
			<li><a href="/feeds">Feeds</a></li>
		</ul>
	</div>
	
	<div class="column">
		<?php include("paypal.php") ?>
	</div>
	
	
	
<!--</div>-->
</div>
	<div id="footer">
		<p>With inspiration from the <a href="http://www.nikhedonia.com/notebook/entry/6-brand-new-templates-for-expression-engine/">fresh theme</a> for <a href="http://www.pmachine.com/">Expression Engine</a>, by <a href="http://www.bartelme.at">Bartelme designs</a>. <br />Proudly powered by <a href="http://www.wordpress.org" title="Wordpress CMS">WordPress</a>. <?php wp_loginout(); ?></p>
		<?php do_action('wp_footer'); ?>
	
	</div>

</div>
</body>


</html>




    



    

