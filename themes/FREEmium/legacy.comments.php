<ol class="commentlist">
	<?php foreach ($comments as $comment) : ?>
	<li class="comment<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID() ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 50 ); ?>
				<?php printf(__('<cite>%s</cite>', 'kubrick'), get_comment_author_link()); ?>
			</div>
			
			<div class="comment-meta commentmetadata"><a href="#comment-<?php comment_ID() ?>"><?php printf(__('%1$s at %2$s', 'kubrick'), get_comment_date(__('F jS, Y', 'kubrick')), get_comment_time()); ?></a></div>
			
			<?php if ($comment->comment_approved == '0') { ?><p><strong>Your comment is awaiting moderation.</strong></p><?php } ?>
			<?php comment_text() ?>
		</div>
	</li>
	
	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? ' even' : '';
		
		endforeach;
	?>
</ol>