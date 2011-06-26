<? 
$options = get_options();
extract($options);
?>

<div class="wrap"><h2>Better Excerpt Options</h2>

<form method="post" action="options.php">

<?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top"><td width="20%"><h3>Length</h3></td><td valign="middle"><input type="text" name="better_excerpt_length" value="<? echo esc_html($length); ?>" /></td><td><p style="font-size: 80%;">The length of the excerpt <b>in characters</b>; as the final result will be trimmed to the nearest whole word, it may be a little shorter. <br/>As a general rule, assume 5 letters in the average word in English. <br><b>Cannot be left blank. </b></p></td></tr>

<tr valign="top"><td width="20%"><h3>Text/HTML before excerpt</h3></td><td valign="middle"><input type="text" name="better_excerpt_before_text" value='<? echo esc_html($before_text); ?>' /></td><td><p style="font-size: 80%;">Text or HTML code to go before excerpt: e.g. &lt;p&gt; or &lt;div&gt; <br>Can be left blank.</p></td></tr>

<tr valign="top"><td width="20%"><h3>And there's more... (ellipsis)</h3></td><td valign="middle"><input type="text" name="better_excerpt_ellipsis" value="<? echo esc_html($ellipsis); ?>" /></td><td><p style="font-size: 80%;">For ... or >> to indicate that part of the post is missing: if you don't want anything extra added, leave blank. </p></td></tr>

<tr valign="top"><td width="20%"><h3>Text/HTML after excerpt</h3></td><td valign="middle"><input type="text" name="better_excerpt_after_text" value="<? echo esc_html($after_text); ?>" /></td><td><p style="font-size: 80%;">Text or HTML code to go after excerpt+ellipsis: e.g. &lt;/p&gt; or &lt;/div&gt; <br>Can be left blank.</p></td></tr>

<tr valign="top"><td width="20%"><h3>Link to post?</h3></td><td valign="middle">Yes <input type="radio" name="better_excerpt_link_to_post" value="1" <? if ($link_to_post == 1) echo "checked"; ?> />&nbsp;&nbsp;&nbsp;No <input type="radio" name="better_excerpt_link_to_post" value="0" <? if ($link_to_post == 0) echo "checked"; ?> /></td><td><p style="font-size: 80%;">Do you want a link to the post added after the excerpt?</p></td></tr>

<tr valign="top"><td width="20%"><h3>Link Text</h3></td>
<td valign="middle"><input type="text" name="better_excerpt_link_text" value="<? echo esc_html($link_text); ?> " /></td><td>
<p style="font-size: 80%;">If you're adding a link to the end of the excerpt, what should the link text be? e.g. "read more" or "see the rest of this post". </p></td></tr>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="better_excerpt_length, better_excerpt_ellipsis, better_excerpt_before_text, better_excerpt_after_text, better_excerpt_link_to_post, better_excerpt_link_text" />

<tr><td> </td><td><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></td><td> </td></tr>

</table></form></div>