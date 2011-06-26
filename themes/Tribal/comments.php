<div id="commentblock">
<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<h4 id="comments"><?php comments_number(__('No Responses'), __('1 Respons'), __('% Responses')); ?> to "<?php the_title();?>"

<?php if ( comments_open() ) : ?>
	<a href="#postcomment" title="<?php _e("Leave a comment"); ?>">&raquo;</a>
<?php endif; ?>
</h4>
	<p id="comment-rss-track">
	 <span id="comment-rss"><?php comments_rss_link('Comment RSS feed'); ?></span>
	 <span id="comment-trackback"><a href="<?php trackback_url(); ?>">Trackback URL</a></span>
	</p>
<?php if ( $comments ) : ?>
<div id="commentlist">


<?php foreach ($comments as $comment) : ?>
<?php $alt =  ('odd' == $alt)? $alt = 'even': $alt = 'odd'; ?>


	<div class="<?php echo $alt; ?> comm" id="comment-<?php comment_ID() ?>">
				<div class="comment-text">
				<?php echo get_avatar( $comment, 32 ); ?>

			<h3 class="comment-title">By: <?php comment_author_link() ?>, <?php comment_date(); if(function_exists('iptocountry')) echo " ".iptocountry($comment->comment_ID); ?><?php edit_comment_link(__("Edit"), ' &#183; ', ''); ?></h3>
			
			<?php if ($comment->comment_approved == '0') : ?>
				<p><em>Your comment is awaiting moderation.</em></p>
			<?php endif; ?>	
			<?php comment_text() ?>
		</div>
	</div>




<?php endforeach; ?>

</div>

<?php else : // If there are no comments yet ?>
	<p><?php //_e('No comments yet.'); ?></p>
<?php endif; ?>



<?php if ( comments_open() ) : ?>
<h2 id="respond">Leave a <span>reply</span></h2>
			<p id="polite">Keep it polite and on topic.</p>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else : ?>




<div id="formadd">

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>

<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>

<?php else : ?>

		<p><input type="text" name="author" id="author" value="" size="22" tabindex="1" />
		<label for="author"><small><strong>Name</strong> </small></label></p>
		<p><input type="text" name="email" id="email" value="" size="22" tabindex="2" />
		<label for="email"><small><strong>Mail</strong> (will not be published) </small></label></p>
		<p><input type="text" name="url" id="url" value="" size="22" tabindex="3" />
		<label for="url"><small><strong>Website</strong></small></label></p>
<?php endif;?>			
		<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>

		
	<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
		<p>
			<input name="submit" type="submit" id="submit" tabindex="5" value="Submit" />
			<input type="hidden" name="comment_post_ID" value="267" />
		</p>
</form>

</div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
<?php endif; ?>
</div>
