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

<?php $default = get_bloginfo('template_url')."/images/gravatar_default.gif";?>


<div id="commentblock">

<!--------------------------------------------------------------------->
<?php if ($comments) : ?>
	 <p><?php comments_rss_link('Comment RSS feed'); ?></p>

  <h2 id="comments"><?php comments_number(__('No Comment'), __('1 Comment so far'), __('% Comments so far')); ?></h2>
<ol id="commentlist">

<?php foreach ($comments as $comment) : ?>
<?php if($comment->comment_type != 'pingback' && $comment->comment_type != 'trackback'):?>

	<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">

	<!-- Gravatar -->
	<?php if (function_exists('gravatar')) : ?>
	<div class="comment-gravatar">
		<a href="http://www.gravatar.com/" title="<?php _e('Gravatar'); ?>">
			<img src="<?php gravatar("PG", 42, $default, 'false', $comment->comment_author_email); ?>" class="gravatar" alt="&nbsp;" />
		</a>
	</div>
	<?php else :?>
		<div class="comment-gravatar">
			<a href="http://www.gravatar.com/" title="<?php _e('Gravatar'); ?>">
				<img src="<?php echo get_bloginfo('template_url')."/images/gravatar_default.gif"; ?>" class="gravatar" alt="&nbsp;" />
			</a>
		</div>
	<?php endif; ?>
	<h3 class="comment-title"><?php comment_author_link() ?></h3>
	
	<p class="comment-meta">
		<?php comment_date('F j, Y') ?> 
		at <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a>
		<?php edit_comment_link(__("Edit"), ' &#183; ', ''); ?>
	</p>
	
	<div class="comment-text"><?php comment_text() ?></div>
	</li>

	<?php 
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>
  <?php endif; ?>

<?php endforeach; /* end for each comment */ ?>

</ol>
<!--------------------------------------------------------------------->



  



  <?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post-> comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->
  <h2 id="comments"> No comments yet. Be the first. </h2>
  <?php else : // comments are closed ?>
  <!-- If comments are closed. -->
<?php if(!is_page()){ ?>
  <p class="nocomments">Comments are closed.</p>
<?php } ?>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post-> comment_status) : ?>
  
<div style="clear:both; height:1%;"></div>

  <h2 id="respond">Leave a reply</h2>

<p id="polite">Keep it polite and on topic. Your email address will not be published.</p>
	
  <div id="commentsform">
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p> Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"> Logout &raquo; </a> </p>
      <?php else : ?>
      

	<p>
        <label for="author"> <?php _e('Name');?>:</label><br />
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>"  tabindex="1" />
	</p>




	<p>
		<label for="email"> <?php _e('Email');?>:</label><br />
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
	</p>
    



	<p>
		<label for="url"><?php _e('Website');?>:</label><br />
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>"  tabindex="3" />
	</p>
     


 <?php endif; ?>
    
      <p>
		<label for="comment"><?php _e('Comment');?>:</label><br />

        <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
      </p>
      <p>
        <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
      </p>
      <?php do_action('comment_form', $post->ID); ?>
    </form>
  </div>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>
