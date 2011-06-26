<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>	        
      <h1 class="bigpage title"><?php _e('Archives', 'youare'); ?></h1>
<?php 
$numposts = (int) $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'"); 
$numcomms = (int) $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'"); 
$numcats = wp_count_terms('category'); 
$numtags = wp_count_terms('post_tag'); 
?> 
      <p><?php echo sprintf(__('There are currently %s posts, contained within %s categories, using <a href="/tags">%s tags.</a>', 'youare'), $numposts, $numcats, $numtags); ?></p>
    </div> <!--end grid_24-->
  </div> <!--end container_24-->
</div> <!--end splash-->  
<div class="container_24 content-background">
	<div id="content" class="grid_16 suffix_1">   
    <div class="single">
      <?php include (TEMPLATEPATH . '/searchform.php'); ?>




      <?php smart_archives(); ?>
    </div>
	</div><!--end content grid_16-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>