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
<div id="cola" class="sidebar">
<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

  <li>
    <div class="sidebarsection quote">
      <p><strong>jour&#183;nal</strong> <i>n.</i>
        A personal record of occurrences, experiences,
        and reflections kept on a regular basis; a diary.
      </p>
    </div>
  </li>

  <li>
  <div class="sidebarsection">
    <h4>internal links:</h4>
    <ul>
      <li><a href="<?php echo get_settings('siteurl') ?>" title="Blog Home">Blog Home</a></li>
      <?php wp_list_pages('title_li='); ?>
    </ul>
  </div>
  </li>

  <li>
  <div class="sidebarsection">
    <h4>categories:</h4>
    <ul>
      <?php wp_list_categories('title_li='); ?>
    </ul>
  </div>
  </li>

  <li>
    <div class="sidebarsection">
      <h4>search blog:</h4>
      <?php get_search_form(); ?>
    </div>
  </li>

  <li>
    <div class="sidebarsection">
      <h4>calendar:</h4>
      <ul><li>
      <?php get_calendar(); ?>
      </li></ul>
    </div>
  </li>

  <li>
  <div class="sidebarsection">
    <h4>archives:</h4>
    <ul>
      <?php get_archives('monthly',6); ?>
    </ul>
  </div>
  </li>

  <li>
  <div class="sidebarsection">
    <h4>other:</h4>
    <ul>
      <li><a href="<?php bloginfo('rss2_url'); ?>" title="Syndicate this site using RSS"><abbr title="Really Simple Syndication">RSS</abbr> 2.0</a></li>
      <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="The latest comments to all posts in RSS">Comments <abbr title="Really Simple Syndication">RSS</abbr> 2.0</a></li>
      <li><a href="http://feeds.archive.org/validator/check?url=<?php bloginfo('rss2_url'); ?>" title="This feed validates as RSS.">Valid RSS</a></li>
      <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
      <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
    </ul>
  </div>
  </li>

<?php endif; ?>

  <?php if (journalized_show_credit()) { ?>
  <li><cite>Journalized Theme  (version <?php echo journalized_version(); ?>). Copyright &copy; 2002&#8211;<?php echo date('Y'); ?> <a href="http://zed1.com/journalized/themes/">Mike Little</a>.</cite></li>
  <?php } ?>

</ul>
</div> <!-- end col a -->
