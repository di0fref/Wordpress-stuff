<?php
/*
Copyright 2002-2008 Mike Little

This file is part of Mike Little's Journalized Theme.

Mike Little's Journalized Theme is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

Mike Little's Journalized Theme is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mike Little's Journalized Theme; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ ?>
<?php get_header(); ?>
<body id="template_index">
<div class="<?php journalized_width_class() ?>">
<?php include('header-block.php'); ?>

<?php if (have_posts()) { while (have_posts()) { the_post(); ?>
<?php the_date('','<h2>','</h2>');?>
<div <?php post_class('centreblock') ?>>
  <h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

  <div class="meta"> by <span class="storyauthor"><?php the_author() ?> </span> @ <?php the_time() ?>.<?php edit_post_link(); ?>
    <?php the_tags('Tags: ', ', ', '<br />'); ?>
    Filed under <?php the_category(', ') ?>
  </div> <!-- meta -->
  <div class="entry">
    <?php the_content('Read the rest of this entry...'); ?>
  </div> <!-- entry -->

  <div class="storylinks">
    <div class="feedback">
      <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      <?php comments_popup_link('[Comments (0)]', '[Comments (1)]', '[Comments (%)]'); ?>&nbsp;
      [<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">link</a>]&nbsp;
      [<a href="<?php trackback_url() ?>" title="The URI to TrackBack this entry">TB</a>]
    </div>
  </div> <!-- storylinks -->
</div> <!-- centreblock -->

<?php } /* end while */ ?>

  <div class="navigation">
    <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
    <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
  </div>
<?php
} else { // end if any posts
?>
<h2 class="center">Not Found</h2>
<div class="centreblock"><p>Sorry, no posts matched your criteria.</p></div> <!-- centreblock -->
<?php } // end else no posts
?>

<p class="centerP">
  [<?php bloginfo('name'); ?> is proudly powered by <a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform"><strong>WordPress</strong></a>.]
</p>
</div><!-- journalized_width_class() -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>