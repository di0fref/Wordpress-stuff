<?php get_header();?>

<?php the_post();?>
	<div class="post">
		<div class="post_header">
			<div class="post_date"><p><?php the_date();?></p><?php the_category();?><br /><?php edit_post_link();?></div>
			<div class="post_title"><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3></div>

		</div>
		<div class="post_text"><?php the_content();?>
		</div>
	</div>
<?php comments_template();?>
</div>

<?php get_sidebar();?>
<?php get_footer();?> 