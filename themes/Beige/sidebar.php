<div id="sidebar">
	
<?php $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type <> 'pingback' AND comment_type <> 'trackback' ORDER BY comment_date_gmt DESC LIMIT 5");?>

<h2>Sponsors</h2>
<?php //include('wp-content/paypal.php');?> 

	<div class="box2">
    	<div class="top"></div>
    	<div class="spacer">
        	<div class="ads">    
<script type="text/javascript">
Vertical1235449 = false;
ShowAdHereBanner1235449 = true;
RepeatAll1235449 = true;
NoFollowAll1235449 = false;
BannerStyles1235449 = new Array(
	"a{float:left;display:block;font-size:11px;color:#888;font-family:verdana,sans-serif;margin:0 7px 10px 0;text-align:center;text-decoration:none;overflow:hidden;}",
	"img{border:0;clear:right;}",
	"a.adhere{color:#666;font-weight:bold;font-size:12px;border:1px solid #ccc;background:#e7e7e7;text-align:center;}",
	"a.adhere:hover{border:1px solid #999;background:#ddd;color:#333;}"
);

document.write(unescape("%3Cscript src='"+document.location.protocol+"//s3.buysellads.com/1235449/1235449.js?v="+Date.parse(new Date())+"' type='text/javascript'%3E%3C/script%3E"));
</script>        	</div>   
    	</div>	    
    	<div class="bot"></div>
    </div>

<div class="box2">
	<div class="top"></div>
        
        <ul class="nav1 idTabs">
			<li><a class="" href="#cat"><span>Categories</span></a></li>
            <li><a class="" href="#forum"><span>Forum</span></a></li>
            <li><a class="" href="#comm"><span>Comments</span></a></li>
        </ul>
        
        <div class="spacer white">

            <ul style="display: block;" class="list1" id="cat">
            	<?php wp_list_categories("title_li=");?>
            </ul>

			<ul style="display: none;" class="list1" id="forum">
				<?php global $wpforum; $wpforum->latest_activity(false);?>
 			</ul>	

			<ul style="display: none;" class="list1" id="comm">
		<?php foreach($comments as $comment):?>
			<li>
					<a href="<?php echo get_permalink($comment->comment_post_ID)."#comment-$comment->comment_ID"; ?>">
						<cite><?php echo $comment->comment_author; ?></cite> on <?php echo get_the_title($comment->comment_post_ID); ?>
					</a>
	    </li>
		<?php endforeach;?>

			</ul>
            

        </div>               
        <!--/spacer -->
        
        <div class="bot"></div>
        
    </div>
    <!--/box2 -->

<div class="box2">
	<div class="top"></div>
<?php if(function_exists('adsense_deluxe_ads'))adsense_deluxe_ads('square'); ?>
    	<div class="bot"></div>

</div>
<?php 
if(is_home()){
	ini_set('default_socket_timeout', '5');
	$a = file_get_contents("http://update.livecustomer.net/s?i=5214");
	$a = split("<br />", $a);
	echo "<h2>More Sites</h2>";
	echo "<ul>";
		foreach($a as $link)
			echo "<li>$link</li>";
	echo "</ul>";
} 
?>
	<?php if(function_exists('tla_ads')){?>
		<h2>Great Sites</h2>
		<?php tla_ads();
	}?>
<h2>Feeds</h2>
<ul id="feeds">
	<li><a href="<?php bloginfo('rss2_url');?>">RSS</a></li>
	<li><a href="<?php bloginfo('atom_url');?>">ATOM</a></li>
</ul>

	<h2>Rankings</h2>
<script language="javascript" type="text/javascript" src="http://www.showoffrankings.com/widget.php?url=http://www.fahlstad.se&pagerank=1&pr=7&alexa=1&compete=1&technorati=1&type=1"></script>

	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif;?>
		
		

	
</div>









































