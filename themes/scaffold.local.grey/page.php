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
			<div class="panel_foot"></div>
		</div>
		<div class="side_meta"> 
			<ul class="info"> 
				<li class="authored has_icon icon_posted"><p>posted <?php the_time('F jS, Y') ?></p> </li> 
				<li class="has_icon icon_permalink"><a href="<?php the_permalink();?>">Permalink</a></li> 
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
