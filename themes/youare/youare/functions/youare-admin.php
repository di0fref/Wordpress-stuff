<?php

if (get_option('youare_username') && !get_option('Y_youare')) update_option('Y_youare', 'http://youare.com/'.get_option('youare_username'));
if (get_option('twitter_username') && !get_option('Y_twitter')) update_option('Y_twitter', 'http://twitter.com/'.get_option('twitter_username'));

$themename = "YouAre";
$shortname = "Y";
$theme_current_version = "0.1";
$theme_url = "http://wptheme.youare.com/";



// Stylesheet Auto Detect
$alt_stylesheet_path = TEMPLATEPATH;

$alt_stylesheets     = array();

if(is_dir($alt_stylesheet_path))
{
    if($alt_stylesheet_dir = opendir($alt_stylesheet_path))
    {
        while(($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false)
        {
            if(stristr($alt_stylesheet_file, '.css') !== false && $alt_stylesheet_file != 'style.css')
            {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

asort($alt_stylesheets);
array_unshift($alt_stylesheets, 'Select a stylesheet:');

$options = array (



			
	//COLOR THEME
			
	   array(	"name" => "Alternate Styles",
	   "type" => "subhead"),
	      
	      
	      array(	"name" => "Alternate Theme Stylesheet",
			"desc" => __("<a href=\"http://www.flickr.com/photos/youarecom/tags/wpschemes\">Preview</a>. Place additional theme stylesheets in the <code>themes/youare/</code> subdirectory to have them automatically detected.", 'youare'),
		    "id" => $shortname."_alt_stylesheet",
		    "std" => "Select a stylesheet:",
		    "type" => "select",
		    "options" => $alt_stylesheets),

 //HEADER NAVIGATION EXCLUDE PAGES
              array(	"name" => "Header Navigation",
	      "type" => "subhead"),
              array(  "name" => "Exclude pages",
              "id" => $shortname."_pages_to_exclude",
              "desc" => "Page IDs you don't want displayed in your header navigation. Use a comma-delimited list, eg. 1, 7, 1386",
              "std" => "",
              "type" => "text"),

  	                 array(	"name" => "Page Ids",
  			"type" => "cats_ids"),

				array(	"name" => "Hide all pages",
					    "id" => $shortname."_hide_pages",
					    "desc" => "Check this box to hide all pages in header navigation.",
					    "std" => "false",
					    "type" => "checkbox"),
           


            //AUTHOR BOX
               array(	"name" => "Author Box Sidebar",
		"type" => "subhead"),
						
				array(	"name" => "About you (A brief description)",
						"id" => $shortname."_about",
						"desc" => "2 lines recommended. XHTML allowed. eg: I am founder of &lt;a href=\"http://domain.com\"&gt;Company Name&lt;/a&gt;, a creative web design agency based in London.",
						"type" => "textarea",
						"options" => array("rows" => "2",
						"cols" => "80") ),


                   
    //PHOTO ABOUT PAGE (Sidebar)
               array( "name" => "Your photo in the default 'About Page' (Sidebar) = Page ID: 2 ",
              "type" => "subhead"),
        

	      array(  "name" => "Photo URL",
              "id" => $shortname."_photo_url_about",
              "desc" => "eg: http://domain.com/photo.jpg. Image will be resized to 244x244 pixels. <br />Tip: Place your image in the <code>/wp-content/themes/youare/images/sidebar</code> subdirectory and paste the URL Photo <br /> Tip: <a href=\"http://wptheme.youare.com/demo/2009/08/22/how-to-customize-your-about-page/\">How to customize your 'About Page'</a> ",
              "std" => "",
              "type" => "text",
              "style" => "width: 425px"), 



   //SOCIAL PROFILES. FOLLOW LINKS
								
		array(	"name" => "Online identity",
		"type" => "subhead"),
                         array(	"name" => "YouAre URL (<a href=\"http://youare.com\">Have an account?</a>)",
				"id" => $shortname."_youare",
				"desc" => "eg: http://youare.com/jlantunez",
				"type" => "text",
	                        "style" => "width: 300px",
	                        "row_style" => "background-color: #f1f1f1;"),
										
				array( "name" => "YouAre link in author box",
				    "id" => $shortname."_youare_toggle_link",
				    "desc" => "Activate YouAre link.",
				    "std" => "",
				    "type" => "checkbox"),

                                 array(	"name" => "Twitter URL (<a href=\"http://twitter.com/signup\">Have an account?</a>)",
						"id" => $shortname."_twitter",
						"desc" => "eg: http://twitter.com/eventoblog",
						"type" => "text",
			                        "style" => "width: 300px",
			                        "row_style" => "background-color: #f1f1f1;"),
										
				array( "name" => "Twitter link in author box",
				    "id" => $shortname."_twitter_toggle_link",
				    "desc" => "Activate Twitter link.",
				    "std" => "",
				    "type" => "checkbox"),


//REAL-TIME SERVICES LATEST UPDATES
								
		array(	"name" => "Real-time services",
		"type" => "subhead"),
                        
										
				array( "name" => "Latest YouAre Updates",
				    "id" => $shortname."_youare_toggle_updates",
				    "desc" => "Show my latest updates. You should activate 'Latest YouAre Updates plugin' before.",
				    "std" => "",
				    "type" => "checkbox"),

                   
										
				array( "name" => "Latest Twitter Updates",
				    "id" => $shortname."_twitter_toggle_updates",
					  "desc" => "Show my latest updates. You should activate 'Latest Twitter Updates plugin' before.",
				    "std" => "",
				    "type" => "checkbox"),


     
        //FEEDBURNER	
	array(	"name" => "RSS / Feedburner Options",
			"type" => "subhead"),
					
	array ( "name" => "Feedburner Username (<a href=\"http://feedburner.google.com\">Have an account?</a>)",
			"id" => $shortname."_feedburner_username",
			"std" => "",
			"type" => "text"),

	array ( "name" => "FeedCount Image"		,
			"desc" => __("Paste the dynamic graphic that always displays your feed's current circulation", 'youare'),
			"id" => $shortname."_feedburner_counter",
			"std" => "",
		        "type" => "textarea",
			"options" => array("rows" => "3",
			"cols" => "80") ),


	array ( "name" => "Allow readers to receive email updates"		,
			"desc" => __("Activate Email Subscription.", 'youare'),
			"id" => $shortname."_feedburner_email",
			"std" => "",
		        "type" => "checkbox"),

        
						
	//FLICKR SIDEBAR

            array(  "name" => "Flickr (Your latest photos in Sidebar)",
		"type" => "subhead"),
                 array(	"name" => "Flickr Username",
		"id" => $shortname."_flickr",
		"desc" => "http://flickr.com/photos/<strong>username</strong>",
		"type" => "text",
	        "style" => "width: 300px"),
										
	 			array(	"name" => "Activate Flickr",
				    "id" => $shortname."_flickr_off",
						"desc" => "Activate Flickr.",
				    "std" => "",
				    "type" => "checkbox"),


 //SIDEBAR ADS 125X125
           array(	"name" => "Sidebar Ads",
              "type" => "subhead"),
        
   			array(	"name" => "Ads (125x125px)",
				    "id" => $shortname."_adbox",
				    "desc" => "Enable the sidebar ads.",
				    "std" => "",
				    "type" => "checkbox"),

	     array(  "name" => "Ad 1 Image",
            "id" => $shortname."_adurl_1",
            "desc" => " eg: ad1.gif. Place your image in the <code>/wp-content/themes/youare/images/sidebar</code> subdirectory",
            "std" => "",
            "type" => "text"), 

	      array(  "name" => "Ad 1 URL",
              "id" => $shortname."_adlink_1",
              "desc" => "Please include http://",
              "std" => "",
            "type" => "text",
            "row_style" => "background-color: #f1f1f1;"), 
        
        array(  "name" => "Ad 1 alt",
              "id" => $shortname."_adalt_1",
              "desc" => "Alt tag for the first ad",
              "std" => "",
              "type" => "text"),

   			array(  "name" => "Ad 2 Image",
            "id" => $shortname."_adurl_2",
            "desc" => "eg: ad2.gif. Place your image in the <code>/wp-content/themes/youare/images/sidebar</code> subdirectory",
            "std" => "",
            "type" => "text"), 

              
        array(  "name" => "Ad 2 URL",
              "id" => $shortname."_adlink_2",
              "desc" => "Please include http://",
              "std" => "",
            "type" => "text",
            "row_style" => "background-color: #f1f1f1;"), 
        
        array(  "name" => "Ad 2 alt",
              "id" => $shortname."_adalt_2",
              "desc" => "Alt tag for the second ad",
              "std" => "",
              "type" => "text"),


			
    //FOOTER PROMOTE YOUR COMPANY
       array(	"name" => "Footer Promo",
		"type" => "subhead"),
            
        array(	"name" => "Promote your company",
					    "id" => $shortname."_promo_footer",
					     "desc" => "I want to promote my company services in Footer.",
					    "std" => "false",
					    "type" => "checkbox"),

       array(	"name" => "Company tag line or Featured work",
						"id" => $shortname."_footer_tagline",
						"desc" => "",
						"type" => "text",
			                        "style" => "width: 677px",
			                        "row_style" => "background-color: #f1f1f1;"),
            
        array(	"name" => "Company services",
						"id" => $shortname."_footer_content",
						"desc" => "XHTML required to look gorgeous, eg: &lt;p&gt;Company services in one line&lt;/p&gt; <a href=\"http://wptheme.youare.com/demo/2009/08/19/how-to-customize-footer/\">How to customize footer</a>",
						"std" => "",
						"type" => "textarea",
						"options" => array("rows" => "3",
						"cols" => "80") ),



	//FOOTER CREDITS AND STATS CODE
	array(	"name" => "Footer Credits / Stats Code",
	"type" => "subhead"),
	array(	"name" => "Copyright (Your name)",
	"id" => $shortname."_copyright_name",
	"std" => "Your Name Here",
	"type" => "text"),			
				
				array(	"name" => "Stats code",
						"id" => $shortname."_stats_code",
						"desc" => "Paste your Google Analytics (or other) tracking code here",
						"std" => "",
						"type" => "textarea",
						"options" => array("rows" => "4",
										   "cols" => "80") ),
		  );

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=youare-admin.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=youare-admin.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "$themename Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

//add_theme_page($themename . 'Header Options', 'Header Options', 'edit_themes', basename(__FILE__), 'headimage_admin');

function headimage_admin(){
	
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2 class="updatehook">YouAre Options</h2>

<table class="widefat" style="margin: 20px 0 0;">
	<thead>

		<tr>
			<th scope="col" style="width: 50%; font: 1.6em Baskerville, palatino, georgia, times, serif;">About YouAre Theme</th>
			<th scope="col" style="font: 1.6em Baskerville, palatino, georgia, times, serif;">Support</th>
		</tr>
	</thead>
	<tbody>
		<tr style="background: #f1f1f1; color: #222">
			<td>YouAre Theme works in WordPress 2.8+ and is released under GPL License. Plugins required and recommended are in the zip files that you downloaded. Upload and activate plugins, before activating the theme itself. <br /><br />

This theme is designed and developed by <a href="http://youare.com">YouAre</a> and was inspired on several themes like <a href="http://themes.jestro.com/titan/">Titan</a> and <a href="http://curtishenson.com/checkmate-20-a-free-premium-wordpress-theme/">Checkmate</a>. 
			</td>
			<td>

			 We will not provide any support via e-mail. If you have questions about using or extending this theme, the best resources are: <a href="http://wptheme.youare.com/demo">YouAre Theme Blog</a>, <a href="http://getsatisfaction.com/youare/products/youare_wordpress_theme">YouAre Theme Forum</a>, and <a href="http://wordpress.org/support/">WordPress Forums</a>.<br /><br />

                        We love feedback. Feel free to give us your suggestions: <a href="mailto:use@youare.com?subject=YouAre Theme FeedBack">use@youare.com</a>.

			</td>

		</tr>
	</tbody>
</table>

	<form method="post">

<form method="post">


<?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'subhead':
		?>
			</table>

			<hr style="border: 1px dotted #dfdfdf; margin: 20px 0">

			<table class="widefat">
			
			<thead>
				<tr>
					<th scope="col" style="width:20%" class="column-title"><?php echo $value['name']; ?></th>
					<th scope="col"></th>
				</tr>
			</thead>
			
		<?php
		break;

		case 'text':
		?>
		<tr valign="top" style="<?php echo $value['row_style']; ?>"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <input style="<?php echo $value['style']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
			    <?php echo $value['desc']; ?>
		    </td>
		</tr>
		<?php
		break;
		
		case 'select':
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                <?php foreach ($value['options'] as $option) { ?>
	                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
				<?php echo $value['desc']; ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case 'textarea':
		$ta_options = $value['options'];
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
			    <?php echo $value['desc']; ?>
				<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
				if( get_settings($value['id']) != "") {
						echo stripslashes(get_settings($value['id']));
					}else{
						echo $value['std'];
				}?></textarea>
	        </td>
	    </tr>
		<?php
		break;

		case "radio":
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $value['name']; ?>:</th>
	        <td>
	            <?php foreach ($value['options'] as $key=>$option) { 
				$radio_setting = get_settings($value['id']);
				if($radio_setting != ''){
		    		if ($key == get_settings($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
	            <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
	            <?php } ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case "checkbox":
		?>
			<tr valign="top"> 
		        <th scope="row"><?php echo $value['name']; ?>:</th>
		        <td>
		           <?php
						if(get_settings($value['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					?>
		            <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

			    <?php echo $value['desc']; ?>
		        </td>
		    </tr>
			<?php
		break;
		
		case "cats_ids":
		?>
			<tr valign="top"> 
		        <th scope="row"><?php echo $value['name']; ?>:</th>
		        <td>
				<p>	<?php
				$pages = get_pages('depth=1&orderby=ID&hide_empty=0');
				//print_r($pages);
				echo '<strong>Page IDs and Names</strong> (<em>Archives Page</em> you can\'t exclude). <a href="http://wptheme.youare.com/wp-content/themes/youare/images/screenshot_archives_page.png">How to make an archives page</a>.<br />'; 
					foreach($pages as $page) { 
					    echo $page->ID . ' = ' . $page->post_name . '<br />'; 
					} 
					?>
				</p>
		        </td>
		    </tr>
			<?php
		break;

		default:

		break;
	}
}
?>

</table>

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<?php
}

function option_wrapper_header($values){
	?>
	<tr valign="top"> 
	    <th scope="row"><?php echo $values['name']; ?>:</th>
	    <td>
	<?php
}
function option_wrapper_footer($values){
	?>
		<br />
		<?php echo $values['desc']; ?>
	    </td>
	</tr>
	<?php 
}
function option_wrapper_footer_nobreak($values){
	?>
		<?php echo $values['desc']; ?>
	    </td>
	</tr>
	<?php 
}
add_action('admin_menu', 'mytheme_add_admin'); 
?>