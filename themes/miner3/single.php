<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post(); ++$loop;?>

	<div class="entry" id="post-<?php the_ID();?>">
		<div class="date">
			<?php the_date();?>
		</div>

		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<div class="body">
			<?php the_content();?>
			<p class="meta"></p>
		</div>
	</div>
	
	<?php endwhile;?>
<?php endif;?>
</div> <!-- entries -->
<?php comments_template();?>
</div> <!-- content -->
<?php get_sidebar();?>
<?php get_footer();?>




