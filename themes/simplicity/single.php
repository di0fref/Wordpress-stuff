<?php get_header();?>

<?php if(have_posts()):while(have_posts()):the_post(); ++$loop;?>

	<div id="single-post"><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<div class="asideBlock date">
			<?php the_date();?><br />
		</div>
			<?php the_content();?>
	</div>

<?php endwhile;?>
</dl>
<?php endif;?>

	<?php ajax_comments(); ?>
</div> <!-- End content -->
<?php get_sidebar();?>
<?php get_footer();?>

