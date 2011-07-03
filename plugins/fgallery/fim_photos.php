<?php
	// Most general template, change accordingly.
?>
<?php define('FIM', true); ?>

<?php include("../../../wp-blog-header.php"); ?>
<?php require_once("functions/fim_functions.php"); ?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">

		<div class="entry">
			<?php echo fim_get_the_content(); ?>
		</div>	
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
