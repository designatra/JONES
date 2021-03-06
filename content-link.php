<?php
/**
 * @package Chunk
 */
?>

<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="entry-meta">
		<div class="date"><a href="<?php the_permalink(); ?>"><?php chunk_date(); ?></a></div>
		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<div class="comments"><?php comments_popup_link( __( 'Leave a comment', 'chunk' ), __( '1 Comment', 'chunk' ), __( '% Comments', 'chunk' ) ); ?></div>
		<?php endif; ?>
		<span class="cat-links"><?php the_category( ', ' ); ?></span>
		<span class="entry-format"><a href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'chunk' ), get_post_format_string( get_post_format() ) ) ); ?>"><?php echo get_post_format_string( get_post_format() ); ?></a></span>
		<?php edit_post_link( __( 'Edit', 'chunk' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<div class="main">
		<?php
			// Let's find the first url in the post content
			$link_url = chunk_url_grabber();

			// Let's make the title a link if there's a link in this link post
			if ( ! empty( $link_url ) ) :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( $link_url ) ), '</a></h2>' );
			else :
				the_title( '<h2 class="entry-title">', '</h2>' );
			endif; 
		
			// Sometimes links need descriptions and sometimes they don't ...
	
			// Let's compare the length of the first url with the length of the post content.
			// If they're one and the same we don't really need to show the post content BECAUSE ...
			// that's just a url and we're already using that url as a href for the title link above BUT ...
			// if they're NOT the same I think we should show that content.
			if ( strlen( $link_url ) != strlen( get_the_content() ) ) :

				// Let's make any bare URL a clickable link, too.
				add_filter( 'the_content', 'make_clickable' );
		?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'chunk' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'chunk' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div>
		<?php endif; ?>
		<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'chunk' ) . '', ', ', '</span>' ); ?>
	</div>
</div>

<?php comments_template(); ?>