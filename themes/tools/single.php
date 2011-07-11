<?php get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										
				<h2 class="entry_title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr( sprintf( __( 'Permanent Link to %s' ), the_title_attribute( 'echo=false' ) ) ); ?>"><?php the_title(); ?></a></h2>
				<p class="entry_meta"><?php the_time(__( 'Y/m/d')); ?></p>
				<div class="entry clear">
					<?php the_content(); ?>					
				</div><!--end entry-->
				<div class="entry_footer">						
					<?php edit_post_link("edit")?>
				</div><!--end post footer-->
			</div><!--end post-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="comments">
			<?php comments_template('', true);?>
		</div>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>