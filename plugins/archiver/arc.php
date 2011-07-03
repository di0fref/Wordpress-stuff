<?php
include( '../../../wp-blog-header.php' );
$year = $_GET['year'];
$what = $_GET['what'];
switch($what){
	case 'blog': query_posts("year=$year&cat=-15&showposts=-1"); break;
	case 'side': query_posts("year=$year&cat=15&showposts=-1"); break;
}
$first = true;
echo "<div class='clear'></div>";
while (have_posts()) : the_post();
	
	$newdate = get_the_time('F');
	if($first)
		echo "</ul>";
	if($newdate != $olddate){
		echo "</ul>";
		the_date('F',"<h4 class='arc'>", '</h4>');
		echo "<ul class='farc'>";
	}?>
	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	
	<?php 
	$olddate = $newdate; 
	$first = false;
endwhile; 
?>
