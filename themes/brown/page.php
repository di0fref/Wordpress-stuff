<?php get_header();?>
<div id="content">

<?php if (have_posts()): while(have_posts()): the_post();?>
	<div class="entry_page">
		<div class="meta">
			<p class="date"><?php edit_post_link("Edit");?></p>
		</div>
		<div class="entrytext">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<div class="text"><?php the_content();?></div>
			<?php edit_post_link(" Edit");?>
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
<?php comments_template();?>

</div>
<?php get_sidebar();?>

<?php get_footer();?>
