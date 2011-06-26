<?php get_header(); ?>
      <h1 class="title"><?php _e('404: Page Not Found', 'youare'); ?></h1>
      <p><?php _e('It might have been moved or deleted, or perhaps you mistyped it. We suggest searching the site:', 'youare'); ?></p>
    </div> <!--end grid_24-->
  </div> <!--end container_24-->
</div> <!--end splash-->  
<div class="container_24 content-background">
	<div id="content" class="grid_16 suffix_1"> 
    <div class="single">
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    </div>
	</div><!--end grid_16-->
  <?php get_sidebar(); ?>
<?php get_footer(); ?>