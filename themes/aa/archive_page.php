<?php 
/*
Template Name: Archive page
Description:  Used the archives
*/
?>
<?php get_header();?>

<div id="content_arc">
  
	<?php the_post(); ?>
	<div class="entry">
    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
			<?php edit_post_link(__('&#183; Edit'));?>
		<?php the_content(__('Read more &raquo;'));?>
   </div>

</div>
<?php get_footer(); ?>