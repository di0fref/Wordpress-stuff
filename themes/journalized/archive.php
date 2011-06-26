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
<body id="template_archive">
<div class="<?php journalized_width_class() ?>">
<?php include('header-block.php'); ?>

<?php if (have_posts()) { ?>

<?php $post = $posts[0]; /* Hack. Set $post so that the_date() works. */ ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="pagetitle">Archive for the '<?php echo single_cat_title(); ?>' Category</h2>

<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
<h2 class="pagetitle">Posts tagged '<?php single_tag_title(); ?>'</h2>

<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>

<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2 class="pagetitle">Author Archive</h2>

<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="pagetitle">Blog Archives</h2>

<?php } ?>

<?php while (have_posts()) { the_post(); ?>
<div <?php post_class("centreblock") ?>>
  <h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
  <div class="meta"> by <span class="storyauthor"><?php the_author() ?> </span> @ <?php the_time('l, F jS, Y') ?>.
    <?php the_tags('Tags: ', ', ', '<br />'); ?>
    Filed under <?php the_category(', ') ?>
  </div> <!-- meta -->
  <div class="entry">
    <?php the_excerpt(); ?>
  </div> <!-- entry -->

  <div class="storylinks">
    <div class="feedback">
      <?php comments_popup_link('[Comments (0)]', '[Comments (1)]', '[Comments (%)]'); ?>&nbsp;
    </div>
  </div> <!-- storylinks -->

</div> <!-- centreblock -->

<?php } // end foreach
?>
<div class="navigation">
<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>
<?php
} else { // end if any posts
?>
<div class="centreblock">
<?php
if (is_category()) // If this is a category archive
    printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
else if (is_date()) // If this is a date archive
    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
else if (is_author()) // If this is a category archive
    if (function_exists('get_userdatabylogin')) {
        printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", get_userdatabylogin(get_query_var('author_name'))->display_name);
    } else {
        echo("<h2>Sorry, but there aren't any posts by that author.</h2>");
    }
else
    echo("<h2 class='center'>No posts found.</h2>");
?>
</div> <!-- centreblock -->
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