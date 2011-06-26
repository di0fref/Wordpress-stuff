<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
	<div id="sidebar" class="sidebar">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

			<li class="widget widget_categories">
				<h2><span>Categories</span><small></small></h2>
				
				<ul>
					<?php wp_list_categories('show_count=1&title_li='); ?>
				</ul>
			</li>
			
			<li class="widget widget_archives">
				<h2><span>Archives</span><small></small></h2>
				<ul>
				<?php wp_get_archives('show_post_count=1&type=monthly'); ?>
				</ul>
			</li>
			
			<li class="widget widget_tag_cloud">
				<h2><span>Tag cloud</span><small></small></h2>
				<?php wp_tag_cloud('orderby=count') ?>
			</li>

			<?php endif; ?>
		</ul>
	</div>

