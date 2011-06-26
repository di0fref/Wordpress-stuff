<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
        if (!empty($post->post_password))
		{
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password)
			{
				?>
				<p class="nocomments">
  				<?php _e("This post is password protected. Enter the password to view comments."); ?>
				<p>
				<?php
 				return;
            }
        }

?>

<?php $default = get_bloginfo('template_url')."/images/gravatar_default.png";?>


<div id="commentblock">

<?php if ($comments) : ?>
	 <p id="comment_rss"><?php comments_rss_link('Comment RSS feed'); ?></p>

  <h4 id="comments"><?php comments_number(__('No Comment'), __('1 Comment <span>so far</span>'), __('% Comments <span>so far</span>')); ?></h4>



<div id="commentlist">

<?php foreach ($comments as $comment) : ?>
<?php if($comment->comment_type != 'pingback' && $comment->comment_type != 'trackback'):?>
<?php $oddcomment =  ('alt' == $oddcomment)? $oddcomment = '': $oddcomment = 'alt'; ?>

	<div class="<?php echo $oddcomment; ?> comm" id="comment-<?php comment_ID() ?>">
		<div class="comment-meta">
			<div class="time">
				<div class="month"><?php comment_date('M')?></div>
				<div class="day"><?php comment_date('d')?></div>
				<div class="year"><?php comment_date('Y')?></div>
				<div class="clock"><?php comment_date('h:i')?></div>
			</div>
			
		</div>
		<div class="comment-text">
			<?php if(function_exists('gravatar')):?>
				<img src="<?php gravatar("PG", 32, $default, 'false', $comment->comment_author_email); ?>" class="gravatar" alt="&nbsp;" />
			<?php endif ?>
			<h3 class="comment-title"><?php comment_author_link() ?><?php edit_comment_link(__("Edit"), ' &#183; ', ''); ?></h3>
			
			<?php if ($comment->comment_approved == '0') : ?>
				<p><em>Your comment is awaiting moderation.</em></p>
			<?php endif; ?>	
			<?php comment_text() ?>
		</div>
	</div>

  <?php endif; ?>

<?php endforeach; ?>

</div>



	<?php else : // this is displayed if there are no comments so far ?>
  	<?php if ('open' == $post-> comment_status) : ?>
  		<h4 id="comments"> No comments yet. <span>Be the first.</span> </h4>
  	<?php else : // comments are closed ?>
			<?php if(!is_page()){ ?>
  			<p class="nocomments">Comments are closed.</p>
			<?php } ?>
  	<?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post-> comment_status) : ?>  
		<div style="clear:both; height:1%;"></div>
			<h4 id="respond">Leave a <span>reply</span></h4>
			<p id="polite">Keep it polite and on topic. Your email address will not be published.</p>
			
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>



		<div id="commentsform">
    		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      			<?php if ( $user_ID ) : ?>
      				<p> Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php 						echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"> Logout &raquo; </a> </p      		<?php else : ?>
				<p><label for="author"> <?php _e('Name');?>:</label><br />
				<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>"  tabindex="1" /></p>

					<p><label for="email"> <?php _e('Email');?>:</label><br />
        			<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /></p>
    
					<p><label for="url"><?php _e('Website');?>:</label><br />
        			<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>"  tabindex="3" /></p>
     
 				<?php endif; ?>
    
      	<p><label for="comment"><?php _e('Comment');?>:</label><br />
        <textarea name="comment" id="comment" cols="40" rows="8" tabindex="4"></textarea></p>

      <p>
        <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
      </p>

      <?php do_action('comment_form', $post->ID); ?>
    </form>
  </div>
  
  
  
  <?php endif; ?>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>