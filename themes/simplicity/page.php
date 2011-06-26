<?php get_header();?>

	
	<dl class="entryList">

<?php if(have_posts()):while(have_posts()):the_post(); ++$loop;?>

	<dt><a href="<?php the_permalink();?>"><?php the_title();?></a></dt>
	<dd>
		<div class="asideBlock date">
			<?php the_date();?><br />
      <?php comments_popup_link(); ?><br />
			<?php edit_post_link();?>
		</div>
			<div class="bodytext"><?php the_content('',FALSE,""); ?></div>
	</dd>

<?php endwhile;?>
</dl>
<?php endif;?>
	<p class="indent pageing"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>
</div> <!-- End content -->
<?php get_sidebar();?>
<?php get_footer();?>

<?php
