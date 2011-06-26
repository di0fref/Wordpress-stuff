<?php
/*
	Template name: Page Wide
*/
?>
<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post();?>
	<div class="post">
			
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<p class="meta"><?php the_date();?> Posted to: <?php the_category(", ");?> <?php edit_post_link();?></p>

		<div class="post_text_wide"><?php the_content();?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>
</div>

<?php get_sidebar();?>
<?php get_footer();?>