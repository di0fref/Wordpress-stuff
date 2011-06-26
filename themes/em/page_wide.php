<?php
/*
	Template name: Page Wide
*/
?>
<?php get_header();?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php edit_post_link();?>
			<?php the_content();?>
		<?php endwhile;?>
	<?php endif; ?> 
</div><!-- .cmain -->
<?php get_sidebar();?>

</div><!-- .cc -->

<?php get_footer();?>