<?php
/*
Copyright 2002-2008 Mike Little

This file is part of Mike Little's Journalized Theme.

Mike Little's Journalized Theme is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

Mike Little's Journalized Theme is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mike Little's Journalized Theme; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?><?php

define(JOURNALIZED_THEME_OPTIONS, 'journalized-theme-options');
if ( function_exists('register_sidebars') )
    register_sidebars(2, array('name' => 'Sidebar %d',
        'before_widget' => '<li><div class="sidebarsection">', // Removes lone <li>
        'after_widget' => '</div></li>', // Removes lone </li>
        'before_title' => '<h4>', // Replaces <h2>
        'after_title' => '</h4>', // Replaces </h2>
    ));


add_action('wp_head', 'journalized_head');
add_action( 'admin_head', 'journalized_admin_head' );

// theme admin stuff
add_action('admin_menu', 'journalized_add_theme_page');


function journalized_admin_head() {
    if ( $_GET['page'] == basename(__FILE__) ) {
?>
<style type="text/css">/* <![CDATA[ */
/* journalized_admin_head */
input { margin-left: 2em; }
fieldset { border: 1px solid #ddd;  -moz-border-radius: 5px; padding: 5px;}
legend { font-weight: bold; margin-left: 1em; }
.image-radio p { margin-bottom: 10px; }
#headimage label.fixer { width: 35%; display:inline-block; }
#headimage input { width: 40%; }
#headimage input#header_height { width: 4em; }
/* ]]> */</style>
<?php
  } // end if our page
} // end journalized_admin_head


function journalized_add_theme_page() {

    $theme_journalized_options = get_journalized_theme_options();

    //if this is our page
    if ( $_GET['page'] == basename(__FILE__) ) {
        // do processing

        if ('save' == $_REQUEST['action']) {
            // do save processing
            // populate the array
            if (isset($_REQUEST['skin'])) {
                $theme_journalized_options['skin'] = $_REQUEST['skin'];
            }

            if (isset($_REQUEST['layout'])) {
                $theme_journalized_options['layout'] = $_REQUEST['layout'];
            }

            if (isset($_REQUEST['altlayout'])) {
                $theme_journalized_options['altlayout'] = $_REQUEST['altlayout'];
            }

            if (isset($_REQUEST['headimg_name'])) {
                $theme_journalized_options['headimg_name'] = $_REQUEST['headimg_name'];
            } else {
                $theme_journalized_options['headimg_name'] = '';
            }

            if (isset($_REQUEST['header_height'])) {
                $theme_journalized_options['header_height'] = $_REQUEST['header_height'];
            } else {
                $theme_journalized_options['header_height'] = '';
            }

            if (isset($_REQUEST['headimg_wide'])) {
                $theme_journalized_options['headimg_wide'] = $_REQUEST['headimg_wide'];
            } else {
                $theme_journalized_options['headimg_wide'] = 'N';
            }

            if (isset($_REQUEST['headimg_bg'])) {
                $theme_journalized_options['headimg_bg'] = $_REQUEST['headimg_bg'];
            } else {
                $theme_journalized_options['headimg_bg'] = '';
            }

            if (isset($_REQUEST['h1_off'])) {
                $theme_journalized_options['h1_off'] = $_REQUEST['h1_off'];
            } else {
                $theme_journalized_options['h1_off'] = 'N';
            }

            if (isset($_REQUEST['credit_off'])) {
                $theme_journalized_options['credit_off'] = $_REQUEST['credit_off'];
            } else {
                $theme_journalized_options['credit_off'] = 'N';
            }

            update_option(JOURNALIZED_THEME_OPTIONS, serialize($theme_journalized_options));
            // all done
            header("Location: themes.php?page=functions.php&saved=true");
            die;
        } // end if save
    } // end if our page

    if (function_exists('add_theme_page')) {
        add_theme_page('Journalized Options', 'Journalized Options', 'edit_themes', basename(__FILE__), 'journalized_theme_page');
    }

} // end journalized_add_theme_page

function journalized_theme_page() {
    $imagedir = dirname(get_stylesheet_directory_uri()) . '/' . basename(dirname(__FILE__));
    $skindir = $imagedir . '/skins';

    $theme_journalized_options = get_journalized_theme_options();

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Options saved.</strong></p></div>';

    $journalized_skins = get_journalized_skins();

    foreach ($journalized_skins as $i => $skin) {
        $skin_name = $skin['name'];
        if ($theme_journalized_options['skin'] == $skin_name) {
            $journalized_skins[$i]['checked'] = 'checked="checked"';
        } else {
            $journalized_skins[$i]['checked'] = '';
        }
    }

    if ($theme_journalized_options['layout'] == 'ACB')
        $ACBchecked = 'checked="checked"';
    if ($theme_journalized_options['layout'] == 'CB')
        $CBchecked = 'checked="checked"';
    if ($theme_journalized_options['layout'] == 'AC')
        $ACchecked = 'checked="checked"';
    if ($theme_journalized_options['layout'] == 'C')
        $Cchecked = 'checked="checked"';

    if ($theme_journalized_options['altlayout'] == 'ACB')
        $altACBchecked = 'checked="checked"';
    if ($theme_journalized_options['altlayout'] == 'CB')
        $altCBchecked = 'checked="checked"';
    if ($theme_journalized_options['altlayout'] == 'AC')
        $altACchecked = 'checked="checked"';
    if ($theme_journalized_options['altlayout'] == 'C')
        $altCchecked = 'checked="checked"';

    if ($theme_journalized_options['headimg_wide'] == 'Y')
        $headimg_wide_checked = 'checked="checked"';
    else
        $headimg_narrow_checked = 'checked="checked"';

    if ($theme_journalized_options['headimg_bg'] == 'Y')
        $headimg_bg_checked = 'checked="checked"';

    if ($theme_journalized_options['h1_off'] == 'Y')
        $h1_off_checked = 'checked="checked"';

    if ($theme_journalized_options['credit_off'] == 'Y')
        $credit_off_checked = 'checked="checked"';

?>
<div class='wrap'>
<h2><?php echo wp_specialchars('Journalized Theme Options' ); ?></h2>
    <div id="form">
        <form method="post" action ="">
            <input type="hidden" name="action" id="action" value="save" />

            <fieldset id="skincolour"><legend>Select a Skin</legend>
                <div>
<?php

foreach ($journalized_skins as $skin) {
    $skin_name = $skin['name'];
    $skin_thumb = $skin['thumb'];
    $skin_checked = $skin['checked'];
?>
                    <div class="image-radio" style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="skin" id="skin<?php echo $skin_name ?>" value="<?php echo $skin_name ?>" <?php echo $skin_checked ?> style="vertical-align:top" />
                        <label for="skin<?php echo $skin_name ?>"><img src="<?php echo $skindir; ?>/<?php echo $skin_thumb ?>" alt="thumbnail of <?php echo $skin_name ?> skin" />
                        <br /><?php echo $skin_name ?></label></p>
                    </div>
<?php } ?>
                </div>
            </fieldset>

            <fieldset id="arclayout"><legend>Main Layout</legend>
                <div class="image-radio" >
                    <p>This is the layout used for your main blog page, and whenever there is more than one post listed.</p>
                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="layout" id="layoutACB" value="ACB" <?php echo $ACBchecked; ?> style="vertical-align:top" />
                        <label for="layoutACB">
                        <img src="<?php echo $imagedir; ?>/layout-ACB.png" alt="" />
                        <br />Both columns</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="layout" id="layoutAC" value="AC" <?php echo $ACchecked; ?> style="vertical-align:top" />
                        <label for="layoutAC"><img src="<?php echo $imagedir; ?>/layout-AC.png" alt="" />
                        <br />Left column</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="layout" id="layoutCB" value="CB" <?php echo $CBchecked; ?> style="vertical-align:top" />
                        <label for="layoutCB"><img src="<?php echo $imagedir; ?>/layout-CB.png" alt="" />
                        <br />Right column</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="layout" id="layoutC" value="C" <?php echo $Cchecked; ?> style="vertical-align:top" />
                        <label for="layoutC"><img src="<?php echo $imagedir; ?>/layout-C.png" alt="" />
                        <br />Neither column</label></p>
                    </div>

                </div>
            </fieldset>

            <fieldset id="altlayoutf"><legend>Single and Page Layout</legend>
                <div class="image-radio" >
                    <p>This is the layout used for an individual post or a 'static' page.</p>
                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="altlayout" id="altlayoutACB" value="ACB" <?php echo $altACBchecked; ?> style="vertical-align:top" />
                        <label for="altlayoutACB">
                        <img src="<?php echo $imagedir; ?>/layout-ACB.png" alt="" />
                        <br />Both columns</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="altlayout" id="altlayoutAC" value="AC" <?php echo $altACchecked; ?> style="vertical-align:top" />
                        <label for="altlayoutAC"><img src="<?php echo $imagedir; ?>/layout-AC.png" alt="" />
                        <br />Left column</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="altlayout" id="altlayoutCB" value="CB" <?php echo $altCBchecked; ?> style="vertical-align:top" />
                        <label for="altlayoutCB"><img src="<?php echo $imagedir; ?>/layout-CB.png" alt="" />
                        <br />Right column</label></p>
                    </div>

                    <div style="float:left">
                        <p style="text-align:center">
                        <input type="radio" name="altlayout" id="altlayoutC" value="C" <?php echo $altCchecked; ?> style="vertical-align:top" />
                        <label for="altlayoutC"><img src="<?php echo $imagedir; ?>/layout-C.png" alt="" />
                        <br />Neither column</label></p>
                    </div>

                </div>
            </fieldset>

            <fieldset id="headimage"><legend>Header Settings</legend>
              <p>How wide do you want the header to be? 
                <input type="radio" name="headimg_wide" id="headimg_wide" value="Y" <?php echo $headimg_wide_checked; ?> />
                       <label for="headimg_wide">Full width of browser?</label>
                <input type="radio" name="headimg_wide" id="headimg_narrow" value="N" <?php echo $headimg_narrow_checked; ?> />
                       <label for="headimg_narrow">Just in the Centre?</label>
              </p>

              <p>
                <label for="header_height" class="fixer">How high should the header be (in pixels):</label>
                <input name="header_height" id="header_height" value="<?php echo $theme_journalized_options['header_height']; ?>" />px
              </p>

              <p>
                <label for="headimg_name" class="fixer">Header Image (leave blank for none):</label>
                <input name="headimg_name" id="headimg_name" value="<?php echo $theme_journalized_options['headimg_name']; ?>" /><br />
                <small style="font-size: 80%">This should be set to the filename of the image (if the images is in the skins folder) or the full path</small>
              </p>

              <p>
                <input type="checkbox" name="headimg_bg" id="headimg_bg" value="Y" <?php echo $headimg_bg_checked; ?> />
                       <label for="headimg_bg">Add the image in the background of header box? (Recommended)</label>
              </p>

              <p>
                <input name="h1_off" id="h1_off" type="checkbox" value="Y" <?php echo $h1_off_checked; ?>" />
                <label for="h1_off">Turn off the blog title and description?</label>
              </p>

            </fieldset>

            <fieldset id="credit"><legend>Theme Credit</legend>
              <p>
                <input name="credit_off" id="credit_off" type="checkbox" value="Y" <?php echo $credit_off_checked; ?>" />
                <label for="credit_off">Turn off the theme credit at the bottom of the sidebar?</label>
              </p>

            </fieldset>

            <p><input type="submit" name="defaultsubmit" value="Save Settings" /></p>
        </form>
    </div>
</div>
<?php
} // end journalized_theme_page


// this is our data array stored as 'theme-journalized-options' in options

function get_journalized_theme_options() {
    // default array
    $theme_journalized_options  = array(
        'skin' => 'blue',
        'layout' => 'ACB',
        'altlayout' => 'ACB',
        );
    $tmp = get_settings(JOURNALIZED_THEME_OPTIONS);
    if (isset($tmp)) {
        $tmp = unserialize($tmp);
        if (is_array($tmp)) {
            $theme_journalized_options = $tmp;
        }
    }

    // do we have an pre-defined options file for thie selected theme?
    $optionsfile = get_theme_root(). '/' . basename(dirname(__FILE__))
                   . '/skins/' . $theme_journalized_options['skin'] . '-options.php';
    if (file_exists($optionsfile)) {
        include($optionsfile);
    }
    return $theme_journalized_options;
}

function journalized_version() {
    return "2.7";
}

function journalized_head() {
    echo '<meta name="theme" content="Journalized Theme (version ' . journalized_version() . '). Copyright 2002-' . date('Y'). ' Mike Little. http://zed1.com/journalized/themes/" />' . "\n";
}

function journalized_skin() {
    $theme_journalized_options = get_journalized_theme_options();

    if ($theme_journalized_options['skin'] != '')
        return bloginfo('stylesheet_directory') . '/skins/'
            . $theme_journalized_options['skin'] . '-skin.css';
    return bloginfo('stylesheet_directory') . '/skins/blue-skin.css';
}

function journalized_layout_sheet() {
    $theme_journalized_options = get_journalized_theme_options();
    return bloginfo('stylesheet_directory') . '/layout.css';
}

function journalized_col_a_on() {
    $theme_journalized_options = get_journalized_theme_options();
    if ((! is_single()) && (! is_page()))
        $layout = $theme_journalized_options['layout'];
     else
        $layout = $theme_journalized_options['altlayout'];

    if ($layout == 'ACB' || $layout == 'AC')
        return TRUE;

    return FALSE;
}

function journalized_col_b_on() {
    $theme_journalized_options = get_journalized_theme_options();
    if ((! is_single()) && (! is_page()))
        $layout = $theme_journalized_options['layout'];
     else
        $layout = $theme_journalized_options['altlayout'];

    if ($layout == 'ACB' || $layout == 'CB')
        return TRUE;

    return FALSE;
}

function journalized_show_header_h1() {
    $theme_journalized_options = get_journalized_theme_options();
    return ($theme_journalized_options['h1_off'] != 'Y');
}

function journalized_show_credit() {
    $theme_journalized_options = get_journalized_theme_options();
    global $credit_checked;
    $ret = ($theme_journalized_options['credit_off'] != 'Y') && (!$credit_checked);
    $credit_checked = true;
    return $ret;
}

function journalized_header_image() {
    $theme_journalized_options = get_journalized_theme_options();
    $image = $theme_journalized_options['headimg_name'];
    if ($image == '')
        return '';
    if ((substr($image,0,1) == '/') || (substr($image,0,5) == 'http:')) // absolute path
        return $image;
    return get_stylesheet_directory_uri() . '/skins/'
        . $theme_journalized_options['headimg_name'];
}

function journalized_header_height($bg = 'n') {
    $theme_journalized_options = get_journalized_theme_options();
    $n = (int)$theme_journalized_options['header_height'];
    if ($n == 0)
        return '135';
    if (($bg == 'y'))
        return $n - 20;
    else
        return $n + 30;
}

function journalized_header_image_wide() {
    $theme_journalized_options = get_journalized_theme_options();
    return $theme_journalized_options['headimg_wide'];
}

function journalized_header_image_background() {
    $theme_journalized_options = get_journalized_theme_options();
    return $theme_journalized_options['headimg_bg'];
}

function journalized_header_image_layout() {
    $theme_journalized_options = get_journalized_theme_options();

    $style = '';
    //if full width header, adjust margins
    if ($theme_journalized_options['headimg_wide'] == 'Y') {
        $style .= '#headerblock { margin-right: 0px; margin-left: 0px; }'. "\n";
        if ($theme_journalized_options['headimg_bg'] == 'Y')
            $style .= '#cola, #colb { top: ' . journalized_header_height('n') . 'px; }'. "\n";
        else
            $style .= '#cola, #colb { top: ' . journalized_header_height('n') . 'px; }'. "\n";
    }

    if (journalized_header_image() != '')
    {
        if ($theme_journalized_options['headimg_bg'] == 'Y')
            $style .= '#headerblock { background-image:url(' . journalized_header_image() . '); height: ' . journalized_header_height('y') . 'px; }' . "\n";
        else
            $style .= '#headerblock { padding: 0; }' . "\n"
                . 'h1 { margin: 0; }' . "\n";
    }

    if (!empty($style)) {
        $ret = '<style type="text/css" media="screen"><!--' . "\n"
        . $style
        . '--></style>';
    }
    return $ret;
}

function journalized_header_html()
{
    $theme_journalized_options = get_journalized_theme_options();

    // are we returning an image? (linked in an h1)
    // is the image in the 
    // or are we returning the title (linked in an h1) and description?
    $image = journalized_header_image();
    if (!empty($image) && !journalized_header_image_background()) {
        $ret = '<h1 id="header"><a href="' . get_option('home') .'">'
               . '<img src="' . journalized_header_image() . '" alt="" />';
        if (journalized_show_header_h1()) {
            $ret .= ' ' . get_bloginfo('name');
        }
        $ret .= '</a></h1>';
        if (journalized_show_header_h1()) {
            $ret .= '<p class="description"><strong>' . get_bloginfo('description') . '</strong></p>';
        }
    } else if (journalized_show_header_h1()) {
        $ret = '<h1 id="header"><a href="' . get_option('home') .'">'
               . get_bloginfo('name')
               . '</a></h1>';
        $ret .= '<p class="description"><strong>' . get_bloginfo('description') . '</strong></p>';
    }

    return $ret;
}

function journalized_width_class($echo=true) {
    $theme_journalized_options = get_journalized_theme_options();

    if ((! is_single()) && (! is_page()))
        $layout = $theme_journalized_options['layout'];
     else
        $layout = $theme_journalized_options['altlayout'];

    if ($layout == 'ACB')
        $ret = 'journalized-centre-normal';
    else if ($layout == 'CB')
        $ret = 'journalized-centre-left';
    else if ($layout == 'C')
        $ret = 'journalized-centre-full';
    else if ($layout == 'AC')
        $ret = 'journalized-centre-right';

    if (!$echo)
        return $ret;
    echo $ret;
}


function get_journalized_skins() {
    $imageurl = dirname(get_stylesheet_directory_uri()) . '/' . basename(dirname(__FILE__));
    $skinurl = $imageurl . '/skins';

    $theme_root = get_theme_root();
    $skin_loc = $theme_root . '/' . basename(dirname(__FILE__)) . '/skins';

    // get files in the skins directory
    $skins_dir = @dir($skin_loc);
    if ($skins_dir) {
        while(($skin_file = $skins_dir->read()) !== false) {
            if (preg_match('|(.+)-skin\.css$|', $skin_file, $parts)) {
                $skinname = $parts[1];
                $filename = $parts[0];
                if ($journalized_skins[$skinname] == null) {
                    $journalized_skins[$skinname]['name'] = $skinname;
                }
                $journalized_skins[$skinname]['css'] = $filename;
            } // end if css
            else if (preg_match('#(.+)-thumb\.(png|gif|jpg)$#', $skin_file, $parts)) {
                $skinname = $parts[1];
                $filename = $parts[0];
                if ($journalized_skins[$skinname] == null) {
                    $journalized_skins[$skinname]['name'] = $skinname;
                }
                $journalized_skins[$skinname]['thumb'] = $filename;
            } // end if css
        }
    } // end if skins_dir

    usort($journalized_skins, _compare_skins);
    return $journalized_skins;
}

function _compare_skins($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return strcasecmp($a['name'], $b['name']);
}


// Support slightly older versions
if (!function_exists('post_class')) {
    function post_class( $class = '', $post_id = null ) {
                	// Separates classes with a single space, collates classes for post DIV
        echo 'class="' . join( ' ', array($class, 'post', 'post-'.$post_id ) ) . '"';
    }
}

add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
    if(!function_exists('wp_list_comments'))
        $file = TEMPLATEPATH . '/old-comments.php';
	return $file;
}

?>