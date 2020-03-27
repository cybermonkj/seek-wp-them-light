<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Seek
 */

?>

<article  id="post-<?php the_ID(); ?>" <?php post_class("twp-article-post"); ?>>
	<header class="entry-header">
		<div class="twp-categories-with-bg twp-categories-with-bg-primary">
		    <?php seek_post_categories(); ?>
		</div>
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	    <div class="twp-author-meta">
	        <?php seek_post_author(); ?>
	        <?php seek_post_date(); ?>
	        <?php seek_get_comments_count(get_the_ID()); ?>
	    </div>
	</header><!-- .entry-header -->

	<?php seek_post_thumbnail(); ?>

	<div class="entry-content">
		<?php 
		the_excerpt();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seek' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<div class="twp-social-share-section">
		<?php 
		if( class_exists( 'Booster_Extension_Class')){
			do_action('booster_extension_like_dislike','allenable');
		} ?>
		<?php if( class_exists( 'Booster_Extension_Class') ){
			$args = array('layout'=>'layout-2','status' => 'enable');
			do_action('booster_extension_social_icons',$args);
		} ?>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
