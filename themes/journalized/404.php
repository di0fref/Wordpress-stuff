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
<body id="template_404">
<div class="<?php journalized_width_class() ?>">
<?php include('header-block.php'); ?>

<h2>Not Found</h2>
<div class="centreblock">
<p>Sorry, but the page you requested was not found. Please try the "search" box, or visit the <a href="<?php bloginfo('url'); ?>">homepage</a>.</p>
</div> <!-- centreblock -->


<p class="centerP">
  [<?php bloginfo('name'); ?> is proudly powered by <a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform"><strong>WordPress</strong></a>.]
</p>
</div><!-- journalized_width_class() -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>