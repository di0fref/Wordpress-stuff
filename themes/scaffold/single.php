<?php get_header(); ?>
<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="single_wrapper"> 
		<div class="post narrow text">
				<div class="panel_head"></div> 
			<div class="panel_content base_format"> 
				<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2> 
				<?php the_content();?>
			</div>
			<div class="meta_foot"><?php edit_post_link(); ?></div>
				
				<div id="disqus">
					<?php comments_template();?>
					<div id="disqus_thread"></div>
					<noscript><p>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=mitchellh">comments powered by Disqus.</a></p></noscript>
					<p><a href="http://disqus.com" class="dsq-brlink">Blog comments powered by <span class="logo-disqus">Disqus</span></a></p>
				</div>
				
			
			<div class="panel_foot"></div>
		</div>
		<div class="side_meta"> 
			<ul class="info"> 
				<li class="authored icon_posted has_icon"><p>posted <?php the_time('F jS, Y') ?></p></li> 
				<li class="has_icon icon_permalink"><a href="<?php the_permalink();?>">Permalink</a> / <?php the_shortlink("Short Link");?></li> 
			</ul>
			<?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>			
		</div> 
	</div>
<?php endwhile;?>
<?php endif;?>
										
		</div> 
	</div> 
</div>	
<?php get_sidebar();?>
<?php get_footer();?>
