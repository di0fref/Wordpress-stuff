<div class="sidebar-default">
<?php
	
	if ( function_exists('dynamic_sidebar') || dynamic_sidebar() ) { 
	/* 
		This is the Default sidebar for all pages 
	*/
	?>
			<?php if ( is_404() || is_category() || is_day() || is_month() ||
							is_year() || is_search() || is_paged() ) { ?>
			
				<?php /* If this is a 404 page */ if (is_404()) { ?>
					<?php /* If this is a category archive */ } elseif (is_category()) { ?>
					<p>Currently browsing the archives for the <strong><?php single_cat_title(''); ?></strong> category.</p>

					<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
					<p>Currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
					for the day <?php the_time('l, F jS, Y'); ?>.</p>

					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
					for <strong><?php the_time('F, Y'); ?></strong>.</p>

					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<p>Currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
					for the year <?php the_time('Y'); ?>.</p>

					<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
					<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> archives
					for <strong>'<?php the_search_query(); ?>'</strong>.</p>

					<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<p>Currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>
				<?php } ?>
			<?php } ?>
				

				<?php 
				
				if (intval($post->post_parent)) {
					while(intval($post->post_parent))
						$post = get_post($post->post_parent);
				}
				
				if ($post->post_parent) { 
					$children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0");
				} else { 
					$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0"); 
				}
			
				if ($children) { ?>
				<div id="nav-sub" class="widget">
					<ul><?php echo $children; ?></ul>
				</div>
				<?php } ?>
	
	<?php } ?>

</div>
