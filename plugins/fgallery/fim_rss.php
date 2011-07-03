<?  
include("functions/feedcreator.class.php"); 
include("../../../wp-blog-header.php"); 
require_once("functions/fim_functions.php"); 
global $wpdb, $table_prefix;
$cats = $table_prefix."fim_cat";
$imgs = $table_prefix."fim_images";

$cat = $wpdb->get_row("SELECT * FROM $cats WHERE id = $_GET[album]");
$images = $wpdb->get_results("SELECT * FROM $imgs WHERE cat = $_GET[album]");

$rss = new UniversalFeedCreator(); 
$rss->useCached(); 
$rss->title = get_bloginfo('name')." Image Gallery"; 
$rss->description = "Image Gallery feed from ".get_bloginfo('name'); 
$rss->link = get_bloginfo('siteurl')."/wp-content/plugins/fgallery/fim_rss.php?album=$_GET[album]"; 
$rss->syndicationURL = get_bloginfo('siteurl')."/wp-content/plugins/fgallery/fim_rss.php?album=$_GET[album]"; 


foreach ($images as $data) { 
    $item = new FeedItem(); 
		if(!$data->title)
			$item->title = "$cat->catname - $data->image"; 
		else
    	$item->title =  "$cat->catname - $data->title"; 
    $item->link = $url = get_url("album/$_GET[album]/image/$data->id");
    $item->description = "<img src='".get_bloginfo('siteurl')."/wp-content/fgallery/$cat->folder/thumb_$data->image' /><br>$data->description"; 
    $item->date = $data->date; 
    $item->author = get_bloginfo("admin_email"); 
     
    $rss->addItem($item); 
} 

echo $rss->saveFeed("RSS2.0", "fim_feed.xml"); 
?>