<?php
/* 
	file: functions.php
	Comment: Handy functions
	Author: Fredrik Fahlstad
*/


/* Get recent comments */
function ff_recent_comments($howmany='5', $before='<li>', $after='</li>')
{
	global $wpdb;

	$sql = 	"SELECT * FROM $wpdb->comments WHERE comment_approved = '1' " .
		"ORDER BY comment_date_gmt DESC LIMIT $howmany";?>

	<div id="commentblock">
	
	<?php if ($comments = $wpdb->get_results($sql)) : ?>
		<?php $default = get_bloginfo('siteurl')."/wp-content/themes/bgone3col/images/gravatar_default.gif";?>
		
		
		<ul id="commentslist">

			<?php foreach ($comments as $comment) : 
				$c = apply_filters('comment_text', $comment->comment_content);?>

				<li>
						<p class="commentauthor"><a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID;?>">
						<?php echo $comment->comment_author; ?></a>
						<?php echo "On \"". get_the_title($comment->comment_post_ID)."\" " . $date; ?>
						<?php ff_edit_comment($comment->comment_post_ID, $comment->comment_ID);?></p> 
						<img class="gravatar" src="<?php gravatar("PG","42", $default,'', $comment->comment_author_email);?>" alt="Gravatar" />
						<div class="commenttext"><?php echo $c;?></div>
				</li>


		  <?php endforeach;  ?>
		</ul>
		
		<?php endif;?>
		</div>
	<?php
}

/* Edit comment link */
function ff_edit_comment($post_id, $comment_id)
{
	if ( ! current_user_can('edit_post', $post_id) )
		return;

	$location = get_settings('siteurl') . "/wp-admin/post.php?action=editcomment&amp;comment=$comment_id";
	echo "<a href='$location'>Edit</a>";
}

/* Encode callback */
function ff_c($stuff)
{
	return "<pre><code{$stuff[1]}>".htmlspecialchars(clean_pre($stuff[2]), ENT_NOQUOTES)."</code></pre>";
}

/* Encode <code>- blocks*/
function ff_encode($c)
{
	return preg_replace_callback('|<code([^>]*)>(.*?)</code>|ims', 'ff_c', $c);
}

/* Substring comments */
function ff_myfragment($s, $max_length) 
{

	return $s;//substr($s, 0, 200) . "...";
}

function CPbreadcrumbs() {
    $CPtheFullUrl = $_SERVER["REQUEST_URI"];
    $CPurlArray=explode("/",$CPtheFullUrl);
    echo "<a href=".get_bloginfo('siteurl').">fahlstad.se</a>";
    while (list($CPj,$CPtext) = each($CPurlArray)) {
        $CPdir='';
        if ($CPj > 2) {
            $CPi=1;
            while ($CPi < $CPj) {
                $CPdir .= '/' . $CPurlArray[$CPi];
                $CPtext = $CPurlArray[$CPi];
                $CPi++;
            }
            if($CPj < count($CPurlArray)-1) echo ' &raquo; <a href="'.$CPdir.'">' . str_replace("-", " ", $CPtext) . '</a>';
        }
    }
    echo wp_title();
}
?>
