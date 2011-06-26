
<?php get_header();?>
	<div id="content_index">

<?php query_posts("showposts=1");?>
<?php if (have_posts()): while(have_posts()): the_post(); ?>
	<div class="entry">
		<div class="entrytext_index">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<div class="meta">
				<p class="date"><?php the_date();?> 
				<a href="<?php comments_link();?>"><?php comments_number(__('No Comment'), __('1 Comment'), __('% Comments')); ?></a></p>
				<?php edit_post_link(" Edit");?>
			</div>
			<div class="text"><?php the_content("Continue &raquo;");?></div>
		</div>
		<div id="rss">
			<ul class="latest">
				<li class="feed"><a href="<?php bloginfo('rss2_url');?>">Articles <span>RSS 2.0</span></a></li>
				<li class="feed"><a href="<?php bloginfo('comments_rss2_url');?>">Comments <span>RSS 2.0</span></a></li>
			</ul>		
		</div>
	</div>
<?php endwhile;?>
<?php endif;?>
</div> <!-- content -->
<div class="clear"></div>
<?php include(TEMPLATEPATH."/more.php");?>
<?php get_footer();?>




