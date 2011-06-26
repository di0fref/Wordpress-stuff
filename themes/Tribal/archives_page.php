<?php 
/*
Template Name: Archive page
Description:  Used for the archives
*/
?>
<?php get_header();?>


  
	<?php the_post(); ?>
	<div class="entry">
	
    	<h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
			<?php edit_post_link(__('&#183; Edit'));?>
			<?php the_content(__('Read more &raquo;'));?>

</div> <!-- content -->
		
<?php get_footer(); ?>
<?php get_footer();?>