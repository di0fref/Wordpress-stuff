<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>

<?php if ($comments) : ?>
	<h2><?php comments_number('No Responses', 'One Response', '% Responses' );?></h2>

	<ol class="bb-tbase comments">
	
	<?php foreach ($comments as $comment) : ?>
		<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
			<div class="bb-t10 bb-fc"><div class="credits">
				<cite><?php comment_author_link() ?></cite> 
				<em class="date"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F j, Y') ?> at <?php comment_time() ?></a></em>
				<?php edit_comment_link('edit','',''); ?>
			</div></div>
			<div class="bb-t20 bb-fa"><div class="commentcontent"><span>
				<?php if ($comment->comment_approved == '0') : ?><p><em>Your comment is awaiting moderation.</em></p><?php endif; ?>
				<?php comment_text() ?>
			</span></div></div>
		</li>
		
		<?php
			/* Changes every other comment to a different class */
			$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
		?>
	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h2>Leave a Reply</h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<p class="note"><strong>Formatting:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></p>
<div class="bb-t19 bb-fa">
<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="1"></textarea></p>
</div>

<?php if ( $user_ID ) : ?>

<div class="bb-t10 bb-fc">
<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>
</div>

<?php else : ?>

<div class="bb-t11 bb-fc"><div class="bbin-a1 credits">
<p><label for="author">Name <?php if ($req) echo "(required)"; ?></label></p>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="2" />

<p><label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="3" /></p>

<p><label for="url">Website</label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="4" /></p>
</div></div>

<?php endif; ?>

<p class="bb-tbase"><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head