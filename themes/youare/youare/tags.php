<?php
/*
Template Name: Tags
*/
get_header();
?>


      <h1 class="title"><?php _e('Tags Archive', 'youare'); ?></h1>
      <p><?php _e('Tag Cloud', 'youare'); ?></p>
    </div> <!--end grid_24-->
  </div> <!--end container_24-->
</div> <!--end splash-->  
<div class="container_24 content-background">
	<div id="content" class="grid_16 suffix_1"> 
<?php
  include (TEMPLATEPATH . '/searchform.php');
  if ( function_exists('wp_tag_cloud') ) {
?>
    <div id="tagcloud">
      <?php wp_tag_cloud('smallest=8&largest=22&number=30&orderby=name'); ?>
    </div>
<?php 
  }
?>
  </div><!--end grid_16-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>