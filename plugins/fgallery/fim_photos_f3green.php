<?php
/*
Template name: fGallery f3Green template
Author: Fredrik Fahlstad
*/
?>
<?php define('FIM', true); ?>

<?php include("../../../wp-blog-header.php"); ?>
<?php require_once("functions/fim_functions.php"); ?>

<!-- Main template, change below, do not edit above. -->

<!-- Get the WordPress header template -->
<?php get_header(); ?>

<?php include(TEMPLATEPATH."/l_sidebar.php");?>


<!-- Main content box -->
<div id="content" class="narrowcolumn">

		<!-- Entry box -->
		<div class="entry">
		
			<!-- fGallery -->
			<?php echo fim_get_the_content(); ?>
			<!-- End fGallery -->
		
		</div>
		
</div>
<!-- Get the WordPress sidebar template-->
<?php include(TEMPLATEPATH."/r_sidebar.php");?>

<!-- Get the WordPress footer template-->
<?php get_footer(); ?>

<!-- End change -->