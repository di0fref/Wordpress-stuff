<?php
/*
	Template name: Page Wide
*/
?>
<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post();?>
	<div class="post">
		<?php edit_post_link();?>
		<div class="post_header">
			<div class="post_title_wide"><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3></div>

		</div>
		<div class="post_text_wide"><?php the_content();?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>
</div>

<?php get_sidebar();?>
<?php get_footer();?>