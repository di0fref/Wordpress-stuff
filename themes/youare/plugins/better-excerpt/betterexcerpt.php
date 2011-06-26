<?php

/*
Plugin Name: Better Excerpt
Version: 0.2 
Description: Gives you full control over the WordPress excerpt: change the length, the ellipsis [...] and surrounding markup; can automatically add a link to the full post. Has admin page; no code/theme editing required.
Author: Sue Bailey
Author URI: http://blogmum.com
Plugin URI: http://blogmum.com/2009/08/plugin-better-excerpt/

    Copyright (C) 2009  Sue Bailey

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

global $wp_version;

$exit_msg = 'This plugin requires WordPress 2.8 or higher. Please upgrade!';
if (version_compare($wp_version, "2.8", "<")) {
	exit($exit_msg);
}

//add options if they don't already exist
  add_option("better_excerpt_length", '250', '', 'yes'); 
  add_option("better_excerpt_ellipsis", '...', '', 'yes'); 
  add_option("better_excerpt_before_text", '<p>', '', 'yes'); 
  add_option("better_excerpt_after_text", '</p>', '', 'yes'); 
  add_option("better_excerpt_link_to_post", '1', '', 'yes'); 
  add_option("better_excerpt_keep_line_breaks", '0', '', 'yes'); 
  add_option("better_excerpt_link_text", 'Read more', '', 'yes'); 


//add the admin page
add_action('admin_menu', 'better_excerpt_menu');

function better_excerpt_menu() {
  add_options_page('Better Excerpt Options', 'Better Excerpt', 8, 'blog_mum_better_excerpt', 'better_excerpt_options');
}

function better_excerpt_options() {
  include("optionsform.php");
}


function get_options(){
 $options = array();
 $options['length'] = get_option(better_excerpt_length);
 $options['ellipsis'] = get_option(better_excerpt_ellipsis);
 $options['before_text'] = get_option(better_excerpt_before_text);
 $options['after_text'] = get_option(better_excerpt_after_text);
 $options['link_to_post'] = get_option(better_excerpt_link_to_post);
 $options['link_text'] = get_option(better_excerpt_link_text);

return $options;
}



function better_excerpt($length, $ellipsis, $before_text, $after_text, $link_to_post, $link_text) {
$permalink = get_permalink($post->ID);
$text = get_the_content();
$text = preg_replace(" (\[.*?\])",'',$text);
 if ($keep_line_breaks == 0) {
$text = strip_tags($text);
 }
 else {
$text = strip_tags($text, '<p><br>');
 }
$text = substr($text, 0, $length);
$text = substr($text, 0, strripos($text, " "));
$text = trim(preg_replace( '/\s+/', ' ', $text));  
$text = stripslashes($before_text).$text.$ellipsis;
if ($link_to_post == 1) {
  $text = $text.' <a href="'.$permalink.'">'.$link_text.'</a>';
}
$text .=stripslashes($after_text);
return $text;
} //end of function better_excerpt

function get_better_excerpt() {
$options = get_options();
extract($options);
return better_excerpt($length, $ellipsis, $before_text, $after_text, $link_to_post, $link_text);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'get_better_excerpt');

?>