<?php
if ( function_exists('register_sidebars') )
	register_sidebars(2, array(
		"before_title" => "<h2><span>",
		"after_title"  => "</span><small></small></h2>"
	));
?>