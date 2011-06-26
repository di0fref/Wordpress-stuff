<div id="morenav">

<?php $posts = get_posts('numberposts=10&orderby=post_date&order=DESC');?>
<?php $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type <> 'pingback' AND comment_type <> 'trackback' ORDER BY comment_date_gmt DESC LIMIT 4");?>
<?php $default = get_bloginfo('template_url')."/images/gravatar_default.gif";?>

	<div class="column">
		<h2>Recent entries</h2>
		<ul class="recent">
		<?php foreach($posts as $post): setup_postdata($post);?>
			<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	
	<div class="column">
		<h2>Random destinations</h2>
		<ul class="recent"><?php get_linksbyname('Links', '<li>','</li>', '', false, 'rand',	false, false, 10,	true); ?></ul>
	</div>
	
	<div class="column">
		<h2>Latest comments</h2>
		<ul class="latestcomments">
		<?php foreach($comments as $comment):?>
			<li>
					<a href="<?php echo get_permalink($comment->comment_post_ID)."#comment-$comment->comment_ID"; ?>">
						<?php //if(function_exists('gravatar')):?>
							<!--<img class="gravatar" src="<?php //gravatar("PG","24", $default,'false', $comment->comment_author_email);?>" alt="Gravatar" />-->
						<?php //else:?>
							<img class="gravatar" src="<?php echo $default;?>" alt="Gravatar" width=24 height=24/>
						<?php //endif;?>
						<cite><?php echo $comment->comment_author; ?></cite> on <?php echo get_the_title($comment->comment_post_ID); ?>
					</a>
	    </li>
		<?php endforeach;?>
		</ul>
		
	</div>
	<div class="clear"></div>
	
	<div class="column">
		<h2>Need more?</h2>
		<ul class="recent">
			<li><a href="/archives">Archives</a></li>
			<li><a href="/links">Linked list</a></li>
			<li><a href="/feeds">Feeds</a></li>
		</ul>
	</div>
	
	<div class="column">
		<?php include("paypal.php") ?>
	</div>
	
	
	
</div>

	<div id="footer">
		<p>With inspiration from the <a href="http://www.nikhedonia.com/notebook/entry/6-brand-new-templates-for-expression-engine/">fresh theme</a> for <a href="http://www.pmachine.com/">Expression Engine</a>, by <a href="http://www.bartelme.at">Bartelme designs</a>. <br />Proudly powered by <a href="http://www.wordpress.org" title="Wordpress CMS">WordPress</a>. <?php wp_loginout(); ?></p>
		<?php do_action('wp_footer'); ?>
	
	</div>
</div>
</body>


</html>




    



    

