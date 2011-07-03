<?php
class ForumDataProvider{
	protected $db;
	protected $forum_table, $thread_table, $posts_table;
	
	public function __construct(){
		global $wpdb, $table_prefix;
		$this->db = $wpdb;
		$this->forum_table 	= $table_prefix . "wp_forums";
		$this->thread_table = $table_prefix . "wp_threads";
		$this->post_table 	= $table_prefix . "wp_posts";
	}
	public function getForumData($id){
		$sql = "select * from $this->thread_table where forum_id = '$id'";
		$results = $this->db->get_results($sql, ARRAY_A);
		echo "<pre>";
		print_r($sql);
		echo "</pre>";
		return $results;
	}
	
	public function getIndexData(){
		
		$sql = "SELECT name, description, count(*) as threads
		FROM $this->forum_table
		LEFT JOIN $this->thread_table ON $this->thread_table.forum_id = $this->forum_table.id
		LEFT JOIN $this->post_table ON $this->post_table.thread_id = $this->thread_table.id";
		
		$sql = "SELECT wp_wp_forums.id, name, wp_wp_posts.id as post_id, DATE_FORMAT(wp_wp_posts.date, '%a %b %d %H:%i') as date, description, count(wp_wp_threads.id) as threads, count(wp_wp_posts.id) as posts FROM wp_wp_forums LEFT JOIN wp_wp_threads ON wp_wp_threads.forum_id = wp_wp_forums.id LEFT JOIN wp_wp_posts ON wp_wp_posts.thread_id = wp_wp_threads.id 
		GROUP BY wp_wp_forums.id";
		
		$results = $this->db->get_results($sql, ARRAY_A);

		return $results;
	}
	
	public function installDB(){
		
		$forum_table_sql = "
		CREATE TABLE IF NOT EXISTS $this->forum_table (
		  id int(11) NOT NULL auto_increment,
		  `name` varchar(255) NOT NULL default '',
		  description varchar(255) NOT NULL default '',
		  views int(11) NOT NULL default '0',
		  PRIMARY KEY  (id)
		);";
		$threads_table_sql = "
		CREATE TABLE IF NOT EXISTS $this->thread_table (
		  id int(11) NOT NULL auto_increment,
		  forum_id int(11) NOT NULL default '0',
		  views int(11) NOT NULL default '0',
		  `subject` varchar(255) NOT NULL default '',
		  `date` datetime NOT NULL default '0000-00-00 00:00:00',
		  `status` varchar(20) NOT NULL default 'open',
		  starter int(11) NOT NULL,
		  PRIMARY KEY  (id)
		);";
		$posts_table_sql = "
			CREATE TABLE IF NOT EXISTS $this->post_table (
			  id int(11) NOT NULL auto_increment,
			  `text` longtext,
			  thread_id int(11) NOT NULL default '0',
			  `date` datetime NOT NULL default '0000-00-00 00:00:00',
			  author_id int(11) NOT NULL default '0',
			  `subject` varchar(255) NOT NULL default '',
			  views int(11) NOT NULL default '0',
			  PRIMARY KEY  (id)
			);";
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');

		dbDelta($posts_table_sql);
		dbDelta($forum_table_sql);
		dbDelta($threads_table_sql);
		
		/*$sql = "insert into wp_wp_forums (name, description) VALUES ('This is a forum', 'Description')";
		$sql2 = "insert into wp_wp_forums (name, description) VALUES ('This is another forum', 'Testing if it works')";
		
		$this->db->query($sql);
		$this->db->query($sql2);*/
	}
}

?>