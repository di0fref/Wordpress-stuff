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
					<div class="entry_footer_block"><a href="<?php the_permalink(); ?>" class="more_link has_icon">Continue reading</a></div>
					<div class="entry_footer_block right"><?php comments_popup_link( __( '0' ), __( '1' ), __( '%' ), "comment_link has_icon" ); ?></div>
				</div><!--end post footer-->
			</div><!--end post-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php endif; ?>
	<div class="navigation clear">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries' ) ); ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;' ) ); ?></div>
	</div> 
</div><!--end content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>