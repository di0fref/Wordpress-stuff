<?php
function getRandomPost(){
	get_posts('orderby=rand&numberposts=1'); 
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

function getSearchForm(){
	$form = '
		<form action="" method="get" id="search"> 
			<fieldset> 
				<input type="text" name="s" id="search_field" value="" /> 
				<input type="submit" id="search_button" value="Search" /> 
			</fieldset> 
		</form>';
		echo $form;
}

?>