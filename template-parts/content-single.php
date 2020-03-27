<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seek
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("twp-article-post"); ?>>
	<header class="entry-header">
		<div class="twp-categories-with-bg twp-categories-with-bg-primary">
		    <?php seek_post_categories(); ?>
		</div>
		<h1 class="entry-title">
			<a href="<?php esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php echo esc_attr(seek_post_format(get_the_ID())); ?>
				<?php the_title(); ?>
			</a>
		</h1>
	    <div class="twp-author-meta">
	        <?php seek_post_author(); ?>
	        <?php seek_post_date(); ?>
	        <?php seek_get_comments_count(get_the_ID()); ?>
	    </div>
	</header><!-- .entry-header -->
	<?php if (has_excerpt()) { ?>
		<div class="single-excerpt">
			<?php the_excerpt() ?>
		</div>
	<?php } ?>
	
	<?php 
	$post_options = get_post_meta( $post->ID, 'seek-meta-checkbox', true );
	if (!empty( $post_options ) ) {
	   seek_post_thumbnail();
	} ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'seek' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seek' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
