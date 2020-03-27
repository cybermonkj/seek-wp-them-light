<?php
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content','single' );
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
			$next_post = get_next_post();
			if (!empty( $next_post )): ?>
				<div class="twp-single-next-post">
					<div class="twp-next-post">
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<?php echo esc_html__('Next Post','seek'); ?><i class="fa fa-chevron-right"></i>
						</a>
					</div>

					<?php
						$post_categories = get_the_category($next_post);
						if ($post_categories) {
							$output = '<div class="twp-categories-with-bg twp-categories-with-bg-primary "><ul class="cat-links">';
							foreach ($post_categories as $post_category) {
								$output .= '<li>
										<a href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'seek'), $post_category->name)) . '"> 
											' . esc_html($post_category->name) . '
										</a>
									</li>';
							}
							$output .= '</ul></div>';
							echo $output;
			
						}
					?>
					
					<h2><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo esc_attr( $next_post->post_title ); ?></a></h2>

					<div class="twp-author-meta"><span class="twp-post-date"><i class="fa fa-clock-o"></i><?php echo get_the_date('D M j , Y', $next_post->ID  ); ?></span></div>
						
					<div class="twp-caption"><?php echo wp_kses_post( get_the_excerpt( $next_post->ID ) ); ?></div>
					<?php 
					if (!empty(get_the_post_thumbnail( $next_post->ID , 'large' ))) { ?>
						<div class="twp-image-section"><?php echo wp_kses_post(get_the_post_thumbnail( $next_post->ID , 'large' )); ?></div>
					<?php } ?>
				</div>
			<?php endif; ?>
			<?php do_action('seek_action_related_post'); ?>
			
		<?php endwhile; 
		?>

		</main>
	</div>

<?php
get_sidebar();
get_footer();
