<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>

			<div id="post_data">
				<div class="post_data">
					<h2>Article written</h2>
					<ul>
						<li class="date">on <strong><?php the_time('d.m.Y') ?></strong></li>
						<li class="time">at <strong><?php the_time('h:i A') ?></strong></li>
						<li class="author">by <strong><?php the_author_link(); ?></strong></li>
					</ul>
				</div>
				<?php if (get_the_tags()): ?>
				<div class="post_tags">
					<h2>Article tags</h2>
					<?php the_tags( '<ul><li>', '</li><li>', '</li></ul>'); ?>
				</div>
				<?php endif; ?>
			</div>
			
			<div id="content">
				<h2 class="links"><span>category: <?php the_category(', ') ?></span><small></small></h2>
				
				<div class="post" id="post-<?php the_ID(); ?>">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span><?php the_title(); ?></span> <small><?php comments_number('0','1','%'); ?></small></a></h3>
					
					<div class="social">
						<h2>share this</h2>
						<ul>
							<li class="digg"><a href="http://digg.com/submit?url=<?php the_permalink() ?>&title=<?php the_title() ?>">Digg.com</a></li>
							<li class="mixx"><a href="http://www.mixx.com/submit?page_url=<?php the_permalink() ?>">Mixx.com</a></li>
							<li class="technorati"><a href="http://technorati.com/ping/?url=<?php the_permalink() ?>">Technorati</a></li>
							<li class="delicious"><a href="http://delicious.com/save?url=<?php the_permalink() ?>&title=<?php the_title() ?>">del.icio.us</a></li>
							<li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>">Facebook.com</a></li>
							<li class="stumbleupon"><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&title=<?php the_title() ?>">StumbleUpon</a></li>
							<li class="reddit"><a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>">reddit.com</a></li>
						</ul>
					</div>
					
					<?php if ( $img = get_post_meta($post->ID, "image", true) ) { ?>
					<div class="headline">
						<a href="<?php the_permalink() ?>">
							<img src="<?=$img?>" alt="" />
							<span><?php the_date("M<b\i\g>j</b\i\g>") ?></span>
						</a>
					</div>
					<? } else { ?>
					<div class="date">
						<span><?php the_date("M<b\i\g>j</b\i\g>") ?></span>
					</div>
					<? } ?>
					
					<div class="text">
						<?php the_content('continue reading &raquo;'); ?>
					</div>
				</div>
				
				<?php comments_template(); ?>
			</div>

<?php endwhile; ?>

<?php include ('sidebar2.php'); ?>

<?php get_footer(); ?>