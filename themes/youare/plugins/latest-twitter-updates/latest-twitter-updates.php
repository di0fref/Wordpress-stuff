<?php
/*
Plugin Name: Latest Twitter Updates
Version: 0.1
Description:  Get your latest updates from YouAre. To show off your tweets just put <code>&lt;?php if (function_exists('get_twitter_latest_updates')) get_twitter_latest_updates(); ?&gt;</code> in your template. If you use <a href="http://wptheme.youare.com">YouAre Theme</a>, it is not necessary (No code/template editing required. Just plugin activation and visit YouAre Theme Options).
Author: YouAre Team
Author URI: http://youare.com
Plugin URI: http://wptheme.youare.com/plugins/latest-twitter-updates
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

if (get_option('Y_twitter') && !get_option('twitter_username')) {
  update_option('twitter_username', str_replace('http://twitter.com/', '', get_option('Y_twitter')));
  update_option('twitter_number_updates', '1');
  update_option('twitter_html_template', '<p>%content% %permalink%</p>');
}

// Adding Admin menu
if ( is_admin() ){
  add_action('admin_menu', 'twitter_latest_updates_menu');
  add_action( 'admin_init', 'twitter_latest_updates_register_settings' );

}

function twitter_latest_updates_register_settings() {
  register_setting( 'tw_la_up_option-group', 'twitter_username' );
  register_setting( 'tw_la_up_option-group', 'twitter_number_updates' );
  register_setting( 'tw_la_up_option-group', 'twitter_cache_time' );
  register_setting( 'tw_la_up_option-group', 'twitter_cache_content' );
  register_setting( 'tw_la_up_option-group', 'twitter_html_header' );
  register_setting( 'tw_la_up_option-group', 'twitter_html_tpl_pre' );
  register_setting( 'tw_la_up_option-group', 'twitter_html_template' );
  register_setting( 'tw_la_up_option-group', 'twitter_html_tpl_post' );
}

function twitter_latest_updates_menu() {
  add_options_page('Latest Twitter Updates Options', 'Latest Twitter Updates', 8, __FILE__, 'twitter_latest_updates_options');
}

function twitter_latest_updates_options() {
?>
<div class="wrap">
<h2>Latest Twitter Updates Options</h2>
<form method="post" action="options.php">
<?php settings_fields('tw_la_up_option-group'); ?>
<table class="form-table">
 <tr>
 	<th scope="row" valign="top">Twitter username</th>
 	<td>
 		<input id="twitter_username" name="twitter_username" value="<?php echo get_option('twitter_username'); ?>" />
  	 	<label for="twitter_username">http://twitter.com/<strong><em>username</em></strong></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">Number of updates</th>
 	<td>
 		<input id="twitter_number_updates" name="twitter_number_updates" value="<?php $tw_nu_up = get_option('twitter_number_updates'); echo  $tw_nu_up?  $tw_nu_up: '1'; ?>" />
  	 	<label for="twitter_number_updates">default = 1</label>
 	</td>
 </tr>
</table>
<h3>Advanced options</h3>
<table class="form-table">
 <tr>
 	<th scope="row" valign="top">Cache time</th>
 	<td>
 		<input id="twitter_cache_time" name="twitter_cache_time" value="<?php $tw_nu_up = get_option('twitter_cache_time'); echo  $tw_nu_up?  $tw_nu_up: '60'; ?>" />
  	 	<label for="twitter_cache_time">minutes, default = 60 (1 hour)</label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">Section Title</th>
 	<td>
 		<input id="twitter_html_header" name="twitter_html_header" value="<?php echo get_option('twitter_html_header'); ?>" />
  	 	<label for="twitter_html_header">example: <em>&lt;h2&gt;My Twitter Updates&lt;/h2&gt;</em></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">HTML pre-template</th>
 	<td>
 		<input id="twitter_html_tpl_pre" name="twitter_html_tpl_pre" value="<?php echo get_option('twitter_html_tpl_pre'); ?>" />
  	 	<label for="twitter_html_tpl_pre">example: <em>&lt;ul&gt;</em></label>
 	</td>
 </tr>
 <tr>
 	<th scope="row" valign="top">HTML template</th>
    <td>
      <textarea id="twitter_html_template" name="twitter_html_template"><?php $tw_ht_te = get_option('twitter_html_template'); echo $tw_ht_te?$tw_ht_te:'<p class="twitter">%content% %permalink%</p>'?></textarea>
        <label for="twitter_html_template">example: <em>&lt;li&gt;%content% %permalink%&lt;/li&gt;</em></label>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><u>Usage</u><br /><strong>%content%</strong> = update content<br /><strong>%permalink%</strong> = link to Twitter permalink using publish date</td>
  </tr>
 <tr>
 	<th scope="row" valign="top">HTML post-template</th>
 	<td>
 		<input id="twitter_html_tpl_post" name="twitter_html_tpl_post" value="<?php echo get_option('twitter_html_tpl_post'); ?>" />
  	 	<label for="twitter_html_tpl_post">example: <em>&lt;/ul&gt;</em></label>
 	</td>
 </tr>
 </tr>
</table>
<p>To show off your messages just put <code>&lt;?php if (function_exists('get_twitter_latest_updates')) get_twitter_latest_updates(); ?&gt;</code>  in your template. If you use <a href="http://wptheme.youare.com">YouAre Theme</a>, it is not necessary.</p>
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
</form>
</div>
<?php
}

function twitter_latest_update_pretty_dates($time) {
  if (!is_numeric($time)) $time = strtotime($time);
  $dif = time()-$time;
  if ($dif < 60) {
    return __('a few seconds ago', 'latest-twitter-updates');
  } else if ($dif >= 60 && $dif < 120) {
    return __('1 minute ago', 'latest-twitter-updates');
  } else if ($dif < 3600) {
    return sprintf(__('%d minutes ago', 'latest-twitter-updates'), intval($dif/60));
  } else if ($dif < 86400) {
    $minutes = intval(($dif - intval($dif/3600)*3600) / 60);
    if ($minutes > 0) {
      return sprintf(__('%d hours %d minutes ago', 'latest-twitter-updates'), intval($dif/3600), $minutes);
    } else {
      return sprintf(__('%d hours ago', 'latest-twitter-updates'), intval($dif/3600));
    }
  } else {
    return strftime('%b %e, %Y / %H:%Mh', $time);
  }
}

function get_twitter_latest_updates() {
  $cache_time = get_option('twitter_cache_time');
  if (!$cache_time) $cache_time = 60;
  $cache = get_option('twitter_cache_content');
  if ($cache) {
    $cache = unserialize($cache);
    $lastest_time = time() > $cache->time + $cache_time*60;
  } else {
    $lastest_time = true;
  }
  if (!$cache || $lastest_time) {
    $plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain('latest-twitter-updates', 'wp-content/plugins/' . $plugin_dir, $plugin_dir.'/lang');
    $updates = file_get_contents('http://twitter.com/statuses/user_timeline/'.get_option('twitter_username').'.json');
    if (function_exists('json_decode')) {
      $updates = json_decode($updates);
    } else {
      require(dirname(__FILE__).'/JSON.php');
      $json = new Services_JSON();
      $updates = $json->decode($updates);
    }
    $content = get_option('twitter_html_header').get_option('twitter_html_tpl_pre');
    for ($i=0; $i<get_option('twitter_number_updates') && $i<count($updates); $i++) {
      $updates[$i]->text = preg_replace('/(((http(s?):\/\/)|(www\.))([\-\_\w\%\.\/\#\+\:\@\¿\?\'\+\&\=\%\;]+))/i', '<a href="$1">$1</a>', $updates[$i]->text);
      $updates[$i]->text = preg_replace('/@([\w\d_]*)/', '<a href="http://twitter.com/$1">@$1</a>', $updates[$i]->text);
      $updates[$i]->text = preg_replace('/#([\w\d_]*)/', '<a href="http://twitter.com/search?q=%23$1">#$1</a>', $updates[$i]->text);
      $updates[$i]->text = preg_replace('/<a([^<]*)(<a href=".*">)#(.*)<\/a>">/', '<a$1#$3">', $updates[$i]->text);
      $updates[$i]->text = preg_replace('/<a[^>]*">#(.*)<\/a><\/a>/', '#$1</a>', $updates[$i]->text);
      $content .= str_replace(array('%content%', '%permalink%'), array($updates[$i]->text, '<a href="http://twitter.com/'.get_option('twitter_username').'/status/'.$updates[$i]->id.'">'.twitter_latest_update_pretty_dates($updates[$i]->created_at).'</a>'), get_option('twitter_html_template'));
    }
    $content .= get_option('twitter_html_tpl_post');
    $obj->time = time();
    $obj->content = $content;
    update_option('twitter_cache_content', serialize($obj));
  } else {
    $content = $cache->content;
  }
  echo $content;
}


