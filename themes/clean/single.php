<?php get_header();?>
	<div id="main-column">
	<?php if(have_posts()): while(have_posts()):the_post();?>
		<div class="post" id="<?php the_ID();?>">
			<h3><a href='<?php the_permalink();?>'><?php the_title();?></a></h3>
				<div class="entry">
					<?php the_content();?>
				</div>

			

			<ul class="meta">
				<li class="clear">
					<div class="title">Posted</div>
					<div class="text"><?php the_date();?> <?php edit_post_link();?></div>
				</li>

				<li class="clear">
					<div class="title">Responses</div>
					<div class="text"><a href="<?php comments_link();?>"><?php comments_number();?> &raquo; </a></div>
				</li>
				
				<li class="clear sharethis">
					<div class="title">Categories</div>
					<div class="text"><?php the_category(",");?></div>
				</li>
			</ul>
		</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>
</div>
<?php get_sidebar();?>
<?php get_footer();?>
		










