<div id="sidebar"> 
	<ul id="nav"> 
		<?php wp_list_pages("depth=1&title_li=");?> 
	</ul>
	
	<?php 
	if (function_exists('dynamic_sidebar')){ ?>
		<div id="widgets">
			<ul>
				<?php dynamic_sidebar();?>
			</ul>
		</div>
	<?php } ?>	
	</ul>
</div>
