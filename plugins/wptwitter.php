<?php
/*
Plugin Name: Twitter widget
Description: Sidebar widget to display your Twitter timeline. The widget allows you to choose to display your twitter username in front of your updates. You can also choose whether to display the time before or after the twitter post. You can also show or hide tweets starting with @username
Author: Sarah Isaacson
Version: 2.0 stable
Plugin URI: http://www.velvet.id.au/twitter-wordpress-sidebar-widget/
Author URI: http://velvet.id.au
License:  Creative Commons Attribution-Noncommercial-Share Alike 2.5
Warranties: None
Last Modified: 21st June 2010 (Western Australian Time +8 UTC)
*/
/* Credits and thanks: I learned lots from the Automattic Inc del.icio.us widget plugin. Thanks guys */
/* And obviously, the good folks at Obvious Corp need to be thanked for creating Twitter */ 
/**
  Version 2 - released 21st June 2010

  Although the plugin has been at this point of readiness for months now, I held off releasing it in the hope that I might be able to add a couple of nice little extra features (like automatic url linking and so on), but I haven't had the time. It's been a long time since I've worked on it, so I'm going to release this version today finally, and endeavour to do a new release at some point in the near future.

  Thank you to Chris Clark of http://releasecandidateone.com/ for his contribution of the regular expressions and his ever-lasting patience with me and my questions.
**/
/*
This work is licensed under the Creative Commons Attribution-Noncommercial-Share Alike 2.5 License. To view a copy of this license, 
visit http://creativecommons.org/licenses/by-nc-sa/2.5/ or send a letter to Creative Commons, 543 Howard Street, 5th Floor, San 
Francisco, California, 94105, USA.

There's probably a lot of mistakes and errors and I have no idea how this is for accessibility. My coding skills aren't strong and everything that is in this plugin has been learned mostly through trial and error. I apologise if this breaks stuff for you, but I welcome suggestions for improvements. Personally I'm astounded that this works at all on even my weblog. I hope that it works for you. I will try to fix things if I can, but I really am not a strong coder, so you may have to wait until someone who knows more than I do can fix it. 
Cheers and beers,
Sarah
*/

// Add the twitter widget to plugin loading
function widget_twitterer_init() {

        // Check for the sidebar widget functions
                if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return;

                // This is the widget's configuration form - will save the options too.
                        function widget_twitterer_control() {
                $options = $newoptions = get_option('widget_twitterer');
                    if ( $_POST['twitterer-submit'] ) {
                          $newoptions['title'] = strip_tags(stripslashes($_POST['twitterer-title']));
                          $newoptions['tuser'] = strip_tags(stripslashes($_POST['twitterer-tuser']));
                          $newoptions['count'] = (int) $_POST['twitterer-count'];
                          $newoptions['ttimetext'] = strip_tags(stripslashes($_POST['twitterer-ttimetext']));
                          $newoptions['taftertimetext'] = strip_tags(stripslashes($_POST['twitterer-taftertimetext']));
                          $newoptions['tshowname'] = isset($_POST['twitterer-showname']);
                          $newoptions['ttimefirst'] = isset($_POST['twitterer-timefirst']);
                          $newoptions['tshowreplies'] = isset($_POST['twitterer-showreplies']);
                // title is the widget title to apear in the sidebar, tuser is the twitter user's screen name, count is the number of entries to display and tuserid is the numeric twitter user ID
                      }
                      if ( $options != $newoptions ) {
                            $options = $newoptions;
                            update_option('widget_twitterer', $options);
                      }
                       
                 // This is so your plugin will work if you don't set any options
                 // I suggest you change them unless you find my twitters regarding this plugin particularly interesting.
                      if ( $newoptions['tuser'] == null ) {
                      $options['tuser'] = 'wptwitter';
                      update_option('widget_twitterer', $options);
                      }
                      if ( $newoptions['count'] == null ) {
                      $options['count'] = ((int) '1');
                      $options['title'] = 'WP Twitter Widget News';
                      $options['ttimetext'] = 'This happened';
                      update_option('widget_twitterer', $options);
                      }

                // For the show name option
                      $tshowname = $options['tshowname'] ? 'checked="checked"' : '';

                // For the time showing option 
                      $ttimefirst = $options['ttimefirst'] ? 'checked="checked"' : '';

               // For the repies showing option
                      $tshowreplies = $options['tshowreplies'] ? 'checked="checked"' : '';

              ?>
<?php // I've kept the styling from the del.icio.us plugin to keep things consistent in the widget options user interface
?>
<div style="text-align:right">
     <label for="twitterer-title" style="line-height:32px;display:block;"><?php _e('Widget title:', 'widgets'); ?> <input type="text" id="twitterer-title" name="twitterer-title" value="<?php echo wp_specialchars($options['title'], true); ?>" /></label>    
     <label for="twitterer-tuser" style="line-height:32px;display:block;"><?php _e('Twitter username:', 'widgets'); ?> <input type="text" id="twitterer-tuser" name="twitterer-tuser" value="<?php echo wp_specialchars($options['tuser'], true); ?>" /></label>
     <label for="twitterer-count" style="line-height:32px;display:block;"><?php _e('Number of updates:', 'widgets'); ?> <input type="text" id="twitterer-count" name="twitterer-count" value="<?php echo $options['count']; ?>" /></label>
     <label for="twitterer-ttimetext" style="line-height:32px;display:block;"><?php _e('Text before time:', 'widgets'); ?> <input type="text" id="twitterer-ttimetext" name="twitterer-ttimetext" value="<?php echo wp_specialchars($options['ttimetext'], true); ?>" /></label>    
     <label for="twitterer-taftertimetext" style="line-height:32px;display:block;"><?php _e('Text after time:', 'widgets'); ?> <input type="text" id="twitterer-taftertimetext" name="twitterer-taftertimetext" value="<?php echo wp_specialchars($options['taftertimetext'], true); ?>" /></label>    
     <label for="twitterer-showname" style="line-height:32px;display:block;"> <input class="checkbox" type="checkbox" id="twitterer-showname" name="twitterer-showname" <?php echo $tshowname; ?> /> <?php _e('Show Twitter Name', 'widgets'); ?> </label>
     <label for="twitterer-timefirst" style="line-height:32px;display:block;"><input class="checkbox" type="checkbox" id="twitterer-timefirst" name="twitterer-timefirst" <?php echo $ttimefirst; ?> /> <?php _e('Show Time First', 'widgets'); ?> </label>
     <label for="twitterer-showreplies" style="line-height:32px;display:block;"><input class="checkbox" type="checkbox" id="twitterer-showreplies" name="twitterer-showreplies" <?php echo $tshowreplies; ?> /> <?php _e('Show Replies', 'widgets'); ?> </label>
     <input type="hidden" name="twitterer-submit" id="twitterer-submit" value="1" />
     </div>

<?php
         }
          // This shows the widget on the sidebar
         function widget_twitterer($args) {
                 extract($args);
                
                 $defaults = array('count' => 5, 'title' => 'Latest Twitters', 'tuser' => 'wptwitter');
                 $options = (array) get_option('widget_twitterer');
                 foreach ( $defaults as $key => $value )
                         if ( !isset($options[$key]) )
                         $options[$key] = $defaults[$key];
?>
<?php   //set variables refer to later
                         $twitter_url = 'http://twitter.com/';
                         $my_twitter_feed_url = $twitter_url . 'statuses/user_timeline/' . ($options['tuser']);
                         $my_twitter_feed_url.= '.json?callback=twitterCallback2&amp;count=' . ((int) $options['count']) . '&amp;named_obj';

                         $my_twitter = $twitter_url . $options['tuser'] . '/';
                         $setcount =  ($options['count']); 

        // This is to take care of extra spaces if the time text happens to be blank
                      if ( $options['ttimetext'] == null ) {
                      $timetext = (' ');
                      }
                      else if ( $options['ttimetext'] == ('(') ) {
                      $timetext = ( ' ' . '(');
                      }  
                      else {  $timetext = ' ' . $options['ttimetext'] . ' '; }

        // This is to add an extra space before the after time text
                      if ( $options['taftertimetext'] == null ) {
                      $aftertimetext = (' ');
                      }
                      else if ( $options['taftertimetext'] == (')') ) {
                      $aftertimetext =  $options['taftertimetext'] . ' '; 
                      }
                     else {  $aftertimetext = ' ' . $options['taftertimetext'] . ' '; }

         // options for showing username - time first - suppress replies
         $sn = $options['tshowname'] ? '1' : '0';

         $stf = $options['ttimefirst'] ? '1' : '0';

         $sr = $options['tshowreplies'] ? '1' : '0';

         // check if before time text (timetext) is blank
         //  var btt;

         if ($options['ttimetext'] == null) { $btt = 1; }
         else { $btt = 0; }

 ?>

 <!-- start good stuff --> 
<?php // The next two bits are using functions of the Automattic sidebar widget plugin
?>
<?php echo $before_widget;  ?>
<?php echo $before_title . "<a href='" . $my_twitter . "' title='My Twitter page at Twitter.com'>{$options['title']}</a>" . $after_title; ?>

<?php // fetches the now customised twitter feed url 
?>

<script type="text/javascript" src="<?php echo $my_twitter_feed_url; ?>"></script>

<div id="twitter-box" style="overflow: hidden; /* to hide the overflow of long urls */"> </div>
 <script type="text/javascript"><!--
   
  function relative_created_at(time_value) {  // thanks to Lionel of rarsh.com for pointing out that Twitter changed their code, and this is the fix which will work in IE
     var created_at_time = Date.parse(time_value.replace(" +0000",""));
     var relative_time = ( arguments.length > 1 ) ? arguments[1] : new Date();
     var wordy_time = parseInt(( relative_time.getTime() - created_at_time ) / 1000) + (relative_time.getTimezoneOffset()*60);
     var returnString;

       if ( wordy_time < 59 ) {
         returnString = 'less than a minute ago';
         } 
       else if ( wordy_time < 119 ) {       // changed because otherwise you get 30 seconds of 1 minutes ago  
         returnString = 'about a minute ago';
         } 
       else if ( wordy_time < 3000 ) {         // < 50 minutes ago
         returnString = ( parseInt( wordy_time / 60 )).toString() + ' minutes ago';
         } 
       else if ( wordy_time < 5340 ) {         // < 89 minutes ago
         returnString = 'about an hour ago';
         } 
       else if ( wordy_time < 9000 ) {          // < 150 minutes ago
         returnString = 'a couple of hours ago';  
         }
       else if ( wordy_time < 82800 ) {         // < 23 hours ago
         returnString = 'about ' + ( parseInt( wordy_time / 3600 )).toString() + ' hours ago';
         } 
       else if ( wordy_time < 129600 ) {       //  < 36 hours
         returnString = 'a day ago';
         }
       else if ( wordy_time < 172800 ) {       // < 48 hours
         returnString = 'almost 2 days ago';
         }
       else {
         returnString = ( parseInt(wordy_time / 86400)).toString() + ' days ago';
         }
     if (<?php echo $stf; ?> && <?php echo $btt // ( $options['ttimetext'] == null ) ;  ?>  ) {
         function capitaliseFirst(str) {
            firstChar = str.substring(0,1);
            remainChar = str.substring(1);

            // change case 
            firstChar = firstChar.toUpperCase(); 
            remainChar = remainChar.toLowerCase();

            return firstChar + remainChar;
         }

        returnString = capitaliseFirst(returnString);
         } 
 
         return returnString;
   }

// You can thank Chris Clark for the next bit. I do :o)

function autolink(s) {   
   var hlink = /(ht|f)tp:\/\/([^ \,\;\:\!\)\(\"\'\<\>\f\n\r\t\v])+/g;
   return (s.replace (hlink, function ($0,$1,$2) { 
         s = $0.substring(0,$0.length); 
   
        // remove trailing dots brackets etc, if any  
        while (s.length>0 && s.charAt(s.length-1)=='.' || s.charAt(s.length-1)==')' || s.charAt(s.length-1)==']'  || s.charAt(s.length-1)=='"' || s.charAt(s.length-1)=='}' || s.charAt(s.length-1)==',' ) 
  
         s=s.substring(0,s.length-1);
         // add hlink
         return " " + s.link(s);   
    }  
    ) 
    );
}

var tweets = '<ul id="twitter-list">';
var maxTweets = <?php echo $setcount ; ?>;
for(var i = 0; i < maxTweets && i < Twitter.posts.length; i++) {
    var post = Twitter.posts[i];
      if (<?php echo $sr ; ?> == 0 &&  post.text.substr(0, 1) == '@') { 
           maxTweets++;
           continue;
        }
    var showTwitterName = <?php echo $sn; ?>;
    var showTimeFirst = <?php echo $stf; ?>;
    var timeText = '<?php echo $timetext // , ' ' ; ?>';
    timeText +=  '<a href="' + 
                  '<?php echo $my_twitter ?>' + 'statuses/' + post.id  + '" title="Permalink to this twitter (id ' + post.id + ') at twitter.com">' +
		   relative_created_at(post.created_at) + '</a>';

     timeText +=  '<?php echo $aftertimetext . ' ' ; ?>' ;
     var postText = autolink(post.text); 
   
     tweets += '<li>';
     if (showTimeFirst) tweets += timeText;
     if(showTwitterName) tweets += post.user.name + ' ';
     tweets += postText;
     if(!showTimeFirst) tweets += timeText;
     tweets += '</li>';
}
     tweets += '</ul>';

document.getElementById('twitter-box').innerHTML = tweets;


-->
</script>


<!-- end experiment good stuff -->
<?php echo $after_widget; ?>
<?php
        }

        // Tell the sidebar about the Twitter widget and its control
        register_sidebar_widget(array('Twitters', 'widgets'), 'widget_twitterer');
        register_widget_control(array('Twitters', 'widgets'), 'widget_twitterer_control');

}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('widgets_init', 'widget_twitterer_init');

?>