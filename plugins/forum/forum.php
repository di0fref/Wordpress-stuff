<?php
/*
	Plugin Name: __WP-Forum__
	Plugin Author: Fredrik Fahlstad
	Plugin URI: http://www.fahlstad.se
	Author URI: http://www.fahlstad.se
	Version: 2.5
*/
#include_once("forum.class.php");
#include_once("thread.class.php");
#include_once("post.class.php");
if ( !defined('WP_CONTENT_DIR')) 	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined('PLUGIN_DIR')) 		define( 'PLUGIN_DIR', ABSPATH . 'wp-content/plugins/forum' );
define('FORUMDIR', dirname(plugin_basename(__FILE__)));

require_once("lib/Smarty.class.php");
require_once("forumDataProvider.php");

$ForumClassName = "forum";

function _log($text){
	echo "<pre>";
	print_r($text);
	echo "</pre>";
}

class forum{

	protected $output, $data_provider;
	
	public function __construct(){
		$this->data_provider = new ForumDataProvider();
	}
	
	public function install(){
		$this->data_provider->installDB();
	}
	
	public function uninstall(){
		
	}
	// Add admin pages
	function add_admin_pages(){
		add_options_page(__('WP-Forum Options', 'forum'), 'WP-Forum', 'manage_options',"forum/forum_admin.php");
	}
	public function display($content){
		/* Wrong page? Just return the content from WP. */
		if(!preg_match('|<!--FORUM-->|', $content))	
			return $content;
			
		$action = $_GET["action"];
		/* Allow numbers only */
		if(isset($_GET["record"]))
			$record = $this->allowNumbersOnly($_GET["record"]);
		
		
		$this->output = "This is a forum";
		
		switch($action){
			case "showforum": 
				$this->output = $this->getForum($record); break;
			case "showthread": 
				$this->output = $this->getThread(); break;
			case "showpost": 
				$this->output = $this->getPost(); break;
			default: 
				$this->output = $this->getIndex(); break;
		}
		return preg_replace("|<!--FORUM-->|", $this->output, $content);
	}	
	
	protected function allowNumbersOnly($parm){
		$regexp = "/^([+-]?((([0-9]+(\.)?)|([0-9]*\.[0-9]+))([eE][+-]?[0-9]+)?))$/";
		if (!preg_match($regexp, $parm)) 
			wp_die("Bad request, please re-enter.");
		return true;
	}
	
	/* Sanitize string for db insert */
	/* TODO: Move somewhere more appropiate */
	protected function sanitize($input) {
    	if (is_array($input)) {
    	    foreach($input as $var=>$val) {
    	        $output[$var] = sanitize($val);
    	    }
    	}
    	else {
    	    if (get_magic_quotes_gpc()) {
    	        $input = stripslashes($input);
    	    }
    	    $input  = cleanInput($input);
    	    $output = mysql_real_escape_string($input);
    	}
    	return $output;
	}
	
	protected function getForum($id){
		$data = $this->data_provider->getForumData($id);
		$smarty = new Smarty();
		$smarty->assign("threads", $data);
		return $smarty->fetch(PLUGIN_DIR."/templates/forums.html");		
		
	}
		
	protected function getThread(){}
		
	protected function getPost(){}
		
	protected function getIndex(){
		$data = $this->data_provider->getIndexData();
		$smarty = new Smarty();
		$smarty->assign("forums", $data);
		return $smarty->fetch(PLUGIN_DIR."/templates/index.html");
	}
	
	public function getCSS(){
		echo "<link rel='stylesheet' href='".WP_CONTENT_URL."/plugins/forum/style.css' type='text/css' media='all' />";
	}
	
}
/* Start the shit */
$forum = new forum();
register_activation_hook(__FILE__ , array(&$forum,'install'));
add_action("the_content", array(&$forum, "display"));
add_action("wp_head", array(&$forum, "getCSS"));
add_action("admin_menu", array(&$forum,"add_admin_pages"));

?>