<?php
// Template for comments
  function custom_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  global $commentNum;
?>
      
<li id="comment-<?php comment_ID() ?>" >

   <div class="conversation">

	<div class="head">

		<span class="number"><a href="<?php echo get_permalink(); ?>#comment-<?php comment_ID(); ?>" title="Permalink"><?php echo $commentNum+1; ?></a></span>

		<span class="author vcard"> 
                       <?php echo get_avatar( get_comment_author_email(), '40' )?> 
                          
                               <span class="fn n"><?php comment_author_link() ?></span> 
                        
                </span>

		<span class="date_comment bold"><?php comment_date('F jS, Y') ?> <a href="<?php echo get_permalink(); ?>#comment-<?php comment_ID(); ?>" title="Permalink"><?php comment_date('G:i') ?>H</a> <?php edit_comment_link(' (Edit)','<strong>','</strong>'); ?> <?php delete_comment_link(get_comment_ID());?></span>
		
	</div>

		<div class="body">
                    <div <?php comment_class(); ?>><?php if ($comment->comment_approved == '0') : ?>
                          <p class="alert">Your comment is awaiting moderation.</em></p>
                              <?php endif; ?>
  				<?php comment_text() ?>
                    </div>       <?php comment_type((''),('Trackback'),('Pingback')); ?>			
                </div>


		<div class="foot">
		         <span class="reply"><strong><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth']));  ?></strong></span> 
                        
		</div>

	</div>



<?php $commentNum = $commentNum + 1; ?>
<?php } ?>
<?php
// Template for pingbacks/trackbacks
  function list_pings($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
?>
  <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php } ?>