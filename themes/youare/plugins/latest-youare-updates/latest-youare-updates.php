<?php
/*
Plugin Name: Latest YouAre Updates
Version: 0.1
Description:  Get your latest updates from YouAre. To show off your messages just put <code>&lt;?php if (function_exists('get_youare_latest_updates')) get_youare_latest_updates(); ?&gt;</code> in your template. If you use <a href="http://wptheme.youare.com">YouAre Theme</a>, it is not necessary (No code/template editing required. Just plugin activation and visit YouAre Theme Options).
Author: YouAre Team
Author URI: http://youare.com
Plugin URI: http://wptheme.youare.com/plugins/latest-youare-updates
Text Domain: latest-youare-updates
Domain Path: /lang

Copyright (C) 2009 YouAre.com (use AT youare DOT com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

if (get_option('Y_youare') && !get_option('youare_username')) {
  update_option('youare_username', str_replace('http://youare.com/', '', get_option('Y_youare')));
  update_option('youare_number_updates', '1');
  update_option('youare_html_template', '<p>%content% %permalink%</p>');
}

// Adding Admin menu
if ( is_admin() ){
  add_action('admin_menu', 'youare_latest_updates_menu');
  add_action( 'admin_init', 'youare_latest_updates_register_settings' );

}

function youare_latest_updates_register_settings() {
  register_setting( 'yo_la_up_option-group', 'youare_username' );
  register_setting( 'yo_la_up_option-group', 'youare_number_updates' );
  register_setting( 'yo_la_up_option-group', 'youare_cache_time' );
  register_setting( 'yo_la_up_option-group', 'youare_cache_content' );
  register_setting( 'yo_la_up_option-group', 'youare_html_header' );
  register_setting( 'yo_la_up_option-group', 'youare_html_tpl_pre' );
  register_setting( 'yo_la_up_option-group', 'youare_html_template' );
  register_setting( 'yo_la_up_option-group', 'youare_html_tpl_post' );
}

function youare_latest_updates_menu() {
  add_options_page('Latest YouAre Updates Options', 'Latest YouAre Updates', 8, __FILE__, 'youare_latest_updates_options');
}

function youare_latest_updates_options() {
?>
<div class="wrap">
<h2>Latest YouAre Updates Options</h2>
<form method="post" action="options.php">
<?php settings_fields('yo_la_up_option-group'); ?>
<table class="form-table">
 <tr>
 	<th scope="row" valign="top">YouAre username</th>
 	<td>
 		<input id="youare_username" name="youare_username" value="<?php echo get_option('youare_username'); ?>" />
  	 	<label for="youare_username">http://youare.com/<strong><em>username</em></strong></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">Number of updates</th>
 	<td>
 		<input id="youare_number_updates" name="youare_number_updates" value="<?php $yo_nu_up = get_option('youare_number_updates'); echo  $yo_nu_up?  $yo_nu_up: '1'; ?>" />
  	 	<label for="youare_number_updates">default = 1</label>
 	</td>
 </tr>
</table>
<h3>Advanced options</h3>
<table class="form-table">
 <tr>
 	<th scope="row" valign="top">Cache time</th>
 	<td>
 		<input id="youare_cache_time" name="youare_cache_time" value="<?php $yo_nu_up = get_option('youare_cache_time'); echo  $yo_nu_up?  $yo_nu_up: '60'; ?>" />
  	 	<label for="youare_cache_time">minutes, default = 60 (1 hour)</label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">Section Title</th>
 	<td>
 		<input id="youare_html_header" name="youare_html_header" value="<?php echo get_option('youare_html_header'); ?>" />
  	 	<label for="youare_html_header">example: <em>&lt;h2&gt;My YouAre Updates&lt;/h2&gt;</em></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">HTML pre-template</th>
 	<td>
 		<input id="youare_html_tpl_pre" name="youare_html_tpl_pre" value="<?php echo get_option('youare_html_tpl_pre'); ?>" />
  	 	<label for="youare_html_tpl_pre">example: <em>&lt;ul&gt;</em></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">HTML template</th>
    <td>
      <textarea id="youare_html_template" name="youare_html_template"><?php $yo_ht_te = get_option('youare_html_template'); echo $yo_ht_te?$yo_ht_te:'<p class="youare">%content% %permalink%</p>'?></textarea>
        <label for="youare_html_template">example: <em>&lt;li&gt;%content% %permalink%&lt;/li&gt;</em></label>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><u>Usage</u><br /><strong>%content%</strong> = update content<br /><strong>%permalink%</strong> = link to YouAre permalink using publish date</td>
  </tr>
 <tr>
 	<th scope="row" valign="top">HTML post-template</th>
 	<td>
 		<input id="youare_html_tpl_post" name="youare_html_tpl_post" value="<?php echo get_option('youare_html_tpl_post'); ?>" />
  	 	<label for="youare_html_tpl_post">example: <em>&lt;/ul&gt;</em></label>
 	</td>
 </tr>
 </tr>
</table>
<p>To show off your messages just put <code>&lt;?php if (function_exists('get_youare_latest_updates')) get_youare_latest_updates(); ?&gt;</code> in your template. If you use <a href="http://wptheme.youare.com">YouAre Theme</a>, it is not necessary.</p>
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
</form>
</div>
<?php
}

function youare_latest_update_pretty_dates($time) {
  if (!is_numeric($time)) $time = strtotime($time);
  $dif = time()-$time;
  if ($dif < 60) {
    return __('a few seconds ago', 'latest-youare-updates');
  } else if ($dif >= 60 && $dif < 120) {
    return __('1 minute ago', 'latest-youare-updates');
  } else if ($dif < 3600) {
    return sprintf(__('%d minutes ago', 'latest-youare-updates'), intval($dif/60));
  } else if ($dif < 86400) {
    $minutes = intval(($dif - intval($dif/3600)*3600) / 60);
    if ($minutes > 0) {
      return sprintf(__('%d hours %d minutes ago', 'latest-youare-updates'), intval($dif/3600), $minutes);
    } else {
      return sprintf(__('%d hours ago', 'latest-youare-updates'), intval($dif/3600));
    }
  } else {
    return strftime('%b %e, %Y / %H:%Mh', $time);
  }
}

function get_youare_latest_updates() {
  $cache_time = get_option('youare_cache_time');
  if (!$cache_time) $cache_time = 60;
  $cache = get_option('youare_cache_content');
  if ($cache) {
    $cache = unserialize($cache);
    $latest_time = time() > $cache->time + $cache_time*60;
  } else {
    $latest_time = true;
  }

  if (!$cache || $latest_time) {
    $plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain('latest-youare-updates', 'wp-content/plugins/' . $plugin_dir, $plugin_dir.'/lang');

    $updates = unserialize(file_get_contents('http://youare.com/api/updates/'.get_option('youare_username').'/php'));
    $content = get_option('youare_html_header').get_option('youare_html_tpl_pre');
    for ($i=0; $i<get_option('youare_number_updates') && $i<count($updates['items']); $i++) {
      $content .= str_replace(array('%content%', '%permalink%'), array($updates['items'][$i]['description'], '<a href="'.$updates['items'][$i]['permalink'].'">'.youare_latest_update_pretty_dates($updates['items'][$i]['publish_data']).'</a>'), get_option('youare_html_template'));
    }
    $content .= get_option('youare_html_tpl_post');
    $obj->time = time();
    $obj->content = $content;
  } else {
    $content = $cache->content;
  }
  echo $content;
}

