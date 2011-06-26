<div id="comments">	
	<h3>Comments</h3>
	<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p><?php _e('Enter your password to view comments.'); ?></p>
		<?php return; 
	endif; ?>
	<?php if($comments):?>
		
		<?php foreach ($comments as $comment) : ?>
		<?php $comment_class = (1 == $comment->user_id) ? 'comment_admin' : '';?>
			<div class="comment <?php echo $comment_class;?>" id="comment-<?php comment_ID();?>">
				<div class="comment_header">
					<div class="comment_date"><?php comment_date();?></div>
					<div class="comment_title"><h4><?php comment_author_link();?></h4></div>
				</div>
			<div class="comment_text">			
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em>Your comment is awaiting moderation.</em></p>
				<?php endif; ?>	
				<?php comment_text();?>
				<p><small><?php edit_comment_link();?></small></p>
			</div>
		</div>
		<?php endforeach;?> 
		
		<?php else: ?>
			<p class="indent">No comments yet.</p>
		<?php endif; ?>

		<?php if(comments_open()):?>
		<?php if ( get_option('comment_registration') && !$user_ID ) { ?>
				<p class="indent"><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
			<?php } else { ?>

	<div id="stylized" class="myform">
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

    <label>Message:
    	<span class="small">Keep it polite and on topic</span>
    </label>
		<textarea name="comment" id="message" cols="" rows="" tabindex="1"></textarea>
		
    <label>Name:
        <span class="small">Add your name</span>
    </label>
    <input type="text" name="author" id="author" tabindex="2" />
    
    <label>Email:
        <span class="small">Add a valid address</span>
    </label>
    <input type="text" name="email" id="email" tabindex="3" />
     
     <label>Website:
        <span class="small">Your website url</span>
    </label>
    <input type="text" name="url" id="url" tabindex="4" />
 
	<button type="submit" tabindex="5" >Submit</button>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</form>

</div>
 
		<?php } ?>
		<?php else: ?>
			<p class="indent">Comments are closed at this time.</p>
		<?php endif ?>
		
</div>