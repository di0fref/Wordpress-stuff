<?php get_header();?>


<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry_page">
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<?php edit_post_link("Edit");?>
		<div class="entrytext">
			<?php the_content();?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_footer();?>
