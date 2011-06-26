			<div id="sidebar2" class="sidebar">
				<ul>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>
					<li class="widget widget_links">
						<h2><span>our sponsors</span> <small></small></h2>
						
						<ul>
							<?php foreach( get_bookmarks("show_images=1") as $link ): ?>
							<li><a href="<?=$link->link_url?>"><img src="<?=$link->link_image?>" alt="<?=$link->link_name?>" /></a></li>
							<?php endforeach; ?>
						</ul>
					</li>
					
					<li class="widget widget_recent_comments<?php if ( function_exists('get_recent_comments')) { ?>_advanced<?php } ?>">
						<?php wp_widget_recent_comments(array('number' => 5, 'before_title' => '<h2><span>', 'after_title' => '</span> <small></small></h2>')) ?>
					</li>
					
					<?php if ( function_exists('get_flickrRSS')) { ?>
					<li class="widget widget_flickrRSS">
						<h2><span>flickr photo stream</span> <small></small></h2>
						
						<ul>
							<?php get_flickrRSS(); ?>
						</ul>
					</li>
					<? } ?>
					
					<?php endif; ?>
				</ul>
			</div>