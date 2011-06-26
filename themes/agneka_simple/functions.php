<?php

function widget_observer_init() {
	if ( !function_exists('register_sidebar_widget') ) return;

	function widget_observer($args) {
		extract($args);
		$options = get_option('widget_observer');
		$wtitle = $options['title'];
		$wshow = $options['show'];
		
		echo $before_widget;
			wp_list_bookmarks("category_before=&category_after=&categorize=0&title_li=$wtitle&title_before=<h4>&title_after=</h4>&show_images=0&show_description=1&limit=$wshow");
			echo '<p><a href="' . get_bloginfo('url') . '/links">' . __('View All Links') . '</a> »</p>';
		echo $after_widget;
	}

	function widget_observer_control() {
	 
		// Get options
		$options = get_option('widget_observer');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('title'=>'Observer', 'show'=>'3');
		
			if ( $_POST['observer-submit'] ) {
				// Remember to sanitize and format use input appropriately.
				$options['title'] = strip_tags(stripslashes($_POST['observer-title']));
				$options['show'] = strip_tags(stripslashes($_POST['observer-show']));
				update_option('widget_observer', $options);
			}
		
			// Get options for form fields to show
			$title = htmlspecialchars($options['title'], ENT_QUOTES);
			$show = htmlspecialchars($options['show'], ENT_QUOTES);

			// The form fields
			echo '<p style="text-align:right;">
					<label for="observer-title">' . __('Title:') . ' 
					<input style="width: 200px;" id="observer-title" name="observer-title" type="text" value="'.$title.'" />
					</label></p>';
			echo '<p style="text-align:right;">
					<label for="observer-show">' . __('Show:') . ' 
					<input style="width: 200px;" id="observer-show" name="observer-show" type="text" value="'.$show.'" />
					</label></p>';
			echo '<input type="hidden" id="observer-submit" name="observer-submit" value="1" />';
			
	}

register_sidebar_widget(array('Observer', 'widgets'), 'widget_observer');
register_widget_control(array('Observer', 'widgets'), 'widget_observer_control', 300, 200);

}

add_action('widgets_init', 'widget_observer_init');




if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
    	'name'=>'sidebar-page',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'name'=>'sidebar-default',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'name'=>'sidebar-postnav',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'name'=>'sidebar-postrelated',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'name'=>'sidebar-links',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'name'=>'sidebar-bottom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}

?>
