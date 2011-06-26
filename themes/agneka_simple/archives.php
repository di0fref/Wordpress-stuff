<?php
/*
Template Name: Archive Index
*/
?>
<?php get_header(); ?>
<div class="bb-tbase">

<div id="content-main" class="bb-t17 bb-fa">

<h1>Archive</h1>

<div class="bb-tbase">

	<div class="bb-t15 bb-fa widget"><div class="bbin-c1">
		<h5>By Month:</h5>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div></div>

	<div class="bb-t15 bb-fc widget"><div class="bbin-a1">
		<h5>By Subject:</h5>

		<ul>
			 <?php wp_list_categories('orderby=name&title_li='); // &exclude=10 ?>
		</ul>	
	</div></div>

</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">
	<?php dynamic_sidebar('sidebar-default'); ?>
	<?php dynamic_sidebar('sidebar-postrelated'); ?>

	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>
