<?php get_header(); ?>
<div class="bb-tbase">
	<div id="content-main" class="bb-t18 bb-fa"><div class="bbin-c3">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post single" id="post-<?php the_ID(); ?>">
	
			<h1><?php the_title(); ?></h1>

			<p class="postinfo"><em class="date"><?php the_time('F jS, Y') ?></em><br /><?php the_category(', ') ?> <?php edit_post_link('Edit', ' / ', ''); ?></p>
				<?php the_content('<p>Read more &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p class="postmetadata">Tags: ', ', ', '</p>'); ?>

				<p class="postmetadata">
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<a href="<?php trackback_url(); ?>" rel="trackback">Trackback URL</a>.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry.','',''); ?>
				</p>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
</div></div>

<div id="content-sub" class="bb-t12 bb-fc"><div class="bbin-a1">

	<div class="bb-tbase">
		<h4>Other Entries</h4>
		<div class="nav-etries nav-v">
			<ul>
			<?php previous_post_link('<li><span>&laquo;</span> %link</li>') ?>
			<?php next_post_link('<li><span>&raquo;</span> %link</li>') ?>
			</ul>
		</div>
	</div>

	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-default'); ?></div>

	<div class="bb-t13 bb-fa"><div class="bbin-c1">
		<?php dynamic_sidebar('sidebar-postnav'); ?>
	</div></div>

	<div class="bb-t17 bb-fc">
		<?php dynamic_sidebar('sidebar-postrelated'); ?>
		<?php dynamic_sidebar('sidebar-links'); ?><br />
	</div>

	<div class="bb-tbase"><?php dynamic_sidebar('sidebar-bottom'); ?></div>

</div></div>

</div><!--content-->
<?php get_footer(); ?>
