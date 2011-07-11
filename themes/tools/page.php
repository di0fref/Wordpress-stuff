<?php get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										
				<h2 class="entry_title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr( sprintf( __( 'Permanent Link to %s' ), the_title_attribute( 'echo=false' ) ) ); ?>"><?php the_title(); ?></a></h2>
				<p class="entry_meta"></p>
				<div class="entry clear">
					<?php the_content(); ?>					
				</div><!--end entry-->
				<div class="entry_footer">						
						<div class="entry_footer_block"><?php comments_popup_link( __( 'Leave a Comment' ), __( '1 Comment' ), __( '% Comments' ), "comment_link has_icon" ); ?></div>
						<div class="entry_footer_block"><?php the_tags('<ul class="tags has_icon"><li>','</li><li>','</li></ul>'); ?></div>
				<?php edit_post_link("edit")?>
				</div><!--end post footer-->
			</div><!--end post-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>