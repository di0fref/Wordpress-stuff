<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( function_exists("post_password_required") && post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	} else if ( !function_exists("post_password_required") && !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

	<div id="comments">
		<div class="meta">
			<p class="rss"><?php comments_rss_link("subscribe to comments RSS") ?></p>
			
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
			<p><?php comments_number('There are <strong>no</strong> comments for this post', 'There is <strong>one</strong> comment for this post', 'There are <strong>%</strong> comments for this post' );?></p>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
			<p>Comments are closed</p>
	<?php endif; ?>
		</div>
		
<?php if ( have_comments() ) : ?>
	<?php if ( function_exists('wp_list_comments') ) { ?>
		<ol class="commentlist">
			<?php wp_list_comments('avatar_size=50'); ?>
		</ol>
		
		<ul class="nav">
			<li class="prev"><?php previous_comments_link() ?></li>
			<li class="next"><?php next_comments_link() ?></li>
		</ul>
	<?php } else { include TEMPLATEPATH . '/legacy.comments.php'; } ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php if ( function_exists("comment_form_title")) comment_form_title( 'Please, feel free to post your own comment', 'Leave a Reply to %s' ); else echo "Please, feel free to post your own comment"; ?></h3>

<?php if ( function_exists("cancel_comment_reply_link")) { ?>
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
<?php } ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p class="not_registered">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p class="logged_as">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<div class="row">
	<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
	<label for="author">Name <?php if ($req) echo "*"; ?></label>
</div>

<div class="row">
	<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
	<label for="email">Email <?php if ($req) echo "*"; ?></label>
</div>

<div class="row">
	<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
	<label for="url">Website</label>
</div>

<?php endif; ?>

<div class="row">
	<label for="comment">Message</label>
	<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
</div>

<div class="submit">
	<button type="submit" id="submit" tabindex="5">Post comment</button>
	
	<?php if ($req) echo "<p class=\"req\">* these are required fields</p>"; ?>
<?php if ( function_exists("comment_id_fields")) comment_id_fields(); else { ?><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /><?php } ?>
</div>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>