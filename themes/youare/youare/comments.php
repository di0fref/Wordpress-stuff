<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="alert"><?php _e('This post is password protected. Enter the password to view comments.', 'youare'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<div id="comments">
<?php if ( have_comments() ) : ?>
  <div class="comment-number">
     <h3 class="line-middle"><span><?php comments_number(__('No Comments Yet', 'youare'), __('1 Comment', 'youare'), __('% Comments', 'youare') );?> &rarr;
    <a id="leavecomment" href="#respond" title="<?php _e("Leave One", 'youare'); ?>"> <?php _e('Leave a Reply', 'youare'); ?></a></span></h3> <?php if ('open' == $post-> ping_status) { ?><p><a href="<?php trackback_url() ?>" title="Trackback URL">Trackback URL</a></p><?php } ?>
   </div><!--end comment-number-->
  <ol class="commentlist">
	
        <?php wp_list_comments('type=comment&callback=custom_comment'); ?>    
    
  </ol>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
  <?php if ( ! empty($comments_by_type['pings']) ) : ?>
    <h3 class="pinghead"><?php _e('Trackbacks &amp; Pingbacks', 'youare'); ?></h3>
    <ol class="pinglist">
      <?php wp_list_comments('type=pings&callback=list_pings'); ?>
    </ol>
  <?php endif; ?>
 <?php else : // this is displayed if there are no comments so far ?>
  
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="note"><?php _e('Comments are closed for this entry.', 'youare'); ?></p>
	<?php endif; ?>
<?php endif; ?>
</div><!--end comments-->

<?php if ('open' == $post->comment_status) : ?>
  
  <div id="respond">
     <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
     
         <h4 id="postcomment"><?php comment_form_title( __('Leave a Reply', 'youare'), __('Leave a Reply to %s', 'youare') ); ?></h4>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
      <p><?php echo sprintf(__('You must be <a href="%s/wp-login.php?redirect_to=%s">logged in</a> to post a comment.', 'youare'), get_option('siteurl'), urlencode(get_permalink())); ?></p>
      </div><!--end respond-->
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
        <p><?php echo sprintf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>. <a href="%s" title="Log out of this account">Log out &raquo;</a>', 'youare'), get_option('siteurl'), $user_identity, wp_logout_url(get_permalink())); ?></p>
      <?php else : ?>
        <fieldset>
					<label for="author" class="comment-field"><?php _e('Name', 'youare'); ?> <?php if ($req) _e('(required)', 'youare'); ?>:</label>
					<input class="text-input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>"  tabindex="1" />
				</fieldset>
        <fieldset>
					<label for="email" class="comment-field"><?php _e('Email', 'youare'); ?> <?php if ($req) _e('(required)', 'youare'); ?>:</label>
					<input class="text-input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /> <small><?php _e('Your email address will <strong>not</strong> be published. Your photo in comments, use <a href="http.//gravatar.com">Gravatar</a>', 'youare'); ?></small>
				</fieldset>
        <fieldset>
					<label for="url" class="comment-field"><?php _e('Website (optional)', 'youare'); ?>: </label>
					<input class="text-input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /> <small><?php _e('Please include http://', 'youare'); ?></small>
				</fieldset>
      <?php endif; ?>
      <fieldset>
				<label for="comment" class="comment-field"><?php _e('Comment', 'youare'); ?></label>
				<textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea> <small style="float: right"><?php _e('Note: XHTML is allowed.', 'youare'); ?></small>
			</fieldset>
      
      <?php do_action('comment_form', $post->ID); ?>
      <fieldset>
				<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'youare'); ?>" />
        <?php comment_id_fields(); ?>
				<!--input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /-->
			</fieldset>
			
		
      <p class="comments-rss"><?php comments_rss_link(__('Subscribe to this comment feed via RSS', 'youare')); ?></p>
      			
    </form><!--end commentform-->
  </div><!--end respond-->

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>