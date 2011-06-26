<?php
<?php get_header(); ?>
<div class="bb-tbase">
<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3">

<h1>Observing the Web</h1>
<ul class="flat">
<?php wp_list_bookmarks("category_before=&category_before=&categorize=0&title_li=&title_before=&title_after=&show_images=0&show_description=1"); ?>
</ul>

</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">
		<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>
		<div class="bb-t13 bb-fa"><div class="bbin-c1">
			<?php dynamic_sidebar('sidebar-postnav'); ?>
		</div></div>

		<div class="bb-t16 bb-fc">
			<?php dynamic_sidebar('sidebar-postrelated'); ?>
		</div>

		<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>
</div></div>

</div><!--content-->
<?php get_footer(); ?>