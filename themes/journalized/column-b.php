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
<div id="colb" class="sidebar">
<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

  <li>
    <div class="sidebarsection quote">
      <p><strong>95.</strong> <i>We are waking up and linking to each other.
        We are watching. But we are not waiting.</i><br/>
      &mdash; <cite><a href="http://www.cluetrain.com/" title="The Cluetrain Manifesto">The Cluetrain Manifesto</a></cite>
      </p>
    </div>
  </li>

<?php
if (function_exists('wp_widget_recent_comments')) {
    wp_widget_recent_comments(array('title' => 'recent comments', 'number' => 5,
        'before_widget' => '<li><div class="sidebarsection">',
        'after_widget' => '</div></li>', 
        'before_title' => '<h4>', 
        'after_title' => '</h4>'));
} ?>

<?php
if (function_exists('wp_widget_tag_cloud')) {
    wp_widget_tag_cloud(array('title' => 'tag cloud',
        'before_widget' => '<li><div class="sidebarsection">',
        'after_widget' => '</div></li>', 
        'before_title' => '<h4>', 
        'after_title' => '</h4>'));
} ?>

  <li>
    <ul class="linklist">
      <?php wp_list_bookmarks(); ?>
    </ul>
  </li>

  <li>
  <div class="sidebarsection">
    <h4>admin:</h4>
    <ul>
      <?php wp_register(); ?>
      <li><?php wp_loginout(); ?></li>
    </ul>
  </div>
  </li>

<?php endif; ?>

  <?php if (journalized_show_credit()) { ?>
  <li><cite>Journalized Theme  (version <?php echo journalized_version(); ?>). Copyright &copy; 2002&#8211;<?php echo date('Y'); ?> <a href="http://zed1.com/journalized/themes/">Mike Little</a>.</cite></li>
  <?php } ?>

</ul>
</div> <!-- end right column -->
