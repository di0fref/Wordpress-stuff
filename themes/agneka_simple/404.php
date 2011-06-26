<?php get_header(); ?>
<div class="bb-tbase">

<div id="content-main" class="bb-t18 bb-fa">
	<h1>Error 404 - Not Found</h1>

	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>

<div id="content-sub" class="bb-t11 bb-fc"><div class="bbin-a1">
	<?php get_sidebar(); ?>
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>

	<div class="bb-t13 bb-fa"><div class="bbin-c1">
		<?php dynamic_sidebar('sidebar-postnav'); ?>
	</div></div>
	<div class="bb-t17 bb-fc">
		<?php dynamic_sidebar('sidebar-postrelated'); ?>
		<?php dynamic_sidebar('sidebar-links'); ?><br />
	</div>		
	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>