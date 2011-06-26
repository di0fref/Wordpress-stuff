<?php get_header(); ?>
      <h1 class="title"><?php the_title(); ?></h1>
      <p><span><?php
$prev_post = get_previous_post();
if($prev_post) {
  $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
  echo "\t" . '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class="previous">'.__('&laquo; Prev', 'youare').'</a>' . "\n";
}

$next_post = get_next_post();
if($next_post) {
  $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
  echo "\t" . '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class="next">'.__('Next &raquo;', 'youare').'</a>' . "\n";
}
?></span> <?php edit_post_link(__('Edit This', 'youare'),'<strong>','</strong>'); ?> <strong><?php the_time('F jS, Y') ?></strong>, <a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link"><?php the_time('G:i') ?>H</a> &middot; <?php _e('Topics', 'youare'); ?>: <?php the_category(', ') ?> &middot; <a href="#" onclick="javascript:print();" rel="nofollow" class="print" title="<?php _e('Print', 'youare'); ?>"><?php _e('Print', 'youare'); ?></a> </p>
    </div> <!--end grid_24-->
  </div> <!--end container_24-->
</div> <!--end splash-->  
<div class="container_24 content-background">
	<div id="content" class="grid_16 suffix_1">   
    <div class="single">
<?php 
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      the_content(__('read more...', 'youare'));
      wp_link_pages();
?>
      <p class="tag"><?php the_tags(__('Tags', 'youare').': <em>', ', ', '</em>'); ?></p>
      <div class="post-footer bold">
        <?php include (TEMPLATEPATH . '/share.php'); ?>
      </div>
<?php 
    } /* rewind or continue if all posts have been fetched */
    comments_template('', true);
  } else {
  }
?>
    </div> <!--end single-->
	</div> <!--end grid_16-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>