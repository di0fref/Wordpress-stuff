	<div id="sidebar">

			<?php if (function_exists('wp_theme_switcher')) { ?>
					<h2><?php _e('Themes'); ?></h2>
							<?php wp_theme_switcher(); ?>
			<?php }?>
					
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
				<?php endif;?>

	</div>
<?php


?>