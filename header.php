<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	}
	?>
<?php if (seek_get_option('enable_preloader') == 1) { ?>
	<div class="twp-preloader" id="preloader">
		<div class="twp-clock" id="status">
					<div class="twp-clock-arrow"></div>
		</div>
	</div>
<?php } ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seek' ); ?></a>
	<header id="masthead" class="site-header">
		<?php if (seek_get_option('show_addvertisement_section') == 1) { ?>
			<div class="twp-ad-section">
				<div class="container">
					<div class="twp-ad">
						<a class="d-block data-bg" href="<?php echo esc_url(seek_get_option('top_section_advertisement_url')); ?>"  data-background="<?php echo esc_url(seek_get_option('top_section_advertisement')); ?>">
						</a>
					</div><!--/twp-ad-->
				</div>		
			</div>	
		<?php } ?>
		<?php if (seek_get_option('show_top_bar_section') == 1) { ?>
			<div class="twp-topbar clearfix">
				<div class="twp-topbar-content-left twp-float-left clearfix">
					<?php if (seek_get_option('show_top_date_section') == 1) { ?>
						<div class="twp-current-date twp-float-left">
							<?php 
								$time = current_time('timestamp');
								echo date_i18n('l, M j, Y',$time); 
							?>
						</div>
					<?php } ?>
					<?php if (seek_get_option('show_top_breaking_news_section') == 1) { ?>
						<?php $seek_top_breaking_news_title = seek_get_option('breaking_news_title');
						?>
						<?php if (!empty($seek_top_breaking_news_title)) { ?>
							<div class="twp-title twp-title-with-arrow twp-title-primary twp-float-left">
								<?php echo esc_html($seek_top_breaking_news_title);?>
							</div>
						<?php } ?>
						<?php $rtl_class_c = 'false';
						if(is_rtl()){ 
						    $rtl_class_c = 'true';
						}?>
						<div class="twp-breaking-news-section">
							<?php
								$seek_breaking_categories = absint(seek_get_option('select_category_for_breaking_news_section'));
								$breaking_args = array(
									'post_type' => 'post',
									'posts_per_page' =>  12,
									'ignore_sticky_posts' => 1,
									'orderby' => 'date',
									'cat' => absint($seek_breaking_categories),
								);
							$twp_breaking_nav_posts = new WP_Query($breaking_args);
							if($twp_breaking_nav_posts->have_posts()):?>
								<div class="twp-ticket-pin-slider clearfix"  data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
									<?php while ($twp_breaking_nav_posts->have_posts()):$twp_breaking_nav_posts->the_post();?>
									<div class="twp-ticket-pin">
										<div class="twp-image-section">
											<?php if(has_post_thumbnail()){
												$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
												$url = $thumb['0'];
											}
											else{
												$url = '';
											}
											?>
											<a href="<?php the_permalink(); ?>" class="data-bg d-block" data-background="<?php echo esc_url($url); ?>"></a>
										</div>
										<div class="twp-articles-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
									</div><!--/twp-ticket-pin-->
									<?php endwhile;wp_reset_postdata();?>
								</div><!--/twp-ticket-pin-slider-->
							<?php endif; ?>
						</div><!--/twp-breaking-news-section-->
					<?php } ?>
				</div><!--/twp-topbar-content-left-->
				<?php if (seek_get_option('show_top_social_section') == 1) { ?>
					<?php if (has_nav_menu('social-nav')) { ?>
						<div class="twp-topbar-content-right twp-float-right">
							<?php
								wp_nav_menu(
									array('theme_location' => 'social-nav',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'menu_id' => 'social-menu',
										'fallback_cb' => false,
										'menu_class' => 'twp-social-icons'
									));
								?>
						</div><!--/twp-topbar-content-right-->
					<?php } ?>		
				<?php } ?>
			</div><!--/twp-topbar-->
		<?php } ?>
		<?php $image_header_class = '';
		if (has_header_image()) {
			$image_header_class = 'twp-overlay twp-overlay-bg-black';
		} ?>
		<div class="twp-site-branding data-bg <?php echo esc_attr($image_header_class); ?>" data-background="<?php echo esc_url(get_header_image()); ?>">
			<div class="container">
				<div class="twp-wrapper">
					<div class="twp-logo">
						<div class="twp-image-wrapper"><?php the_custom_logo(); ?></div>
							<?php if ( is_front_page() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif; ?>
						<?php
							$seek_description = get_bloginfo( 'description', 'display' );
							if ( $seek_description || is_customize_preview() ) :
						?>
							<p class="site-description"><?php echo $seek_description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
			
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="twp-navigation">
			<div class="twp-nav-menu-section">
				<div class="container">
					<div class="twp-row twp-wrapper">
						<div class="twp-menu-section desktop twp-d-flex">
							<?php wp_nav_menu(array(
								'theme_location' => 'primary-nav',
								'menu_id' => 'primary-menu',
								'container' => 'div',
								'container_class' => 'twp-nav-menu',
								'menu_class' => 'twp-nav-menu'
							)); ?>
							<div class="twp-menu-icon-section">
								<div class="twp-menu-icon twp-menu-icon-white" id="twp-menu-icon">
									<span></span>
								</div>
							</div>
						</div>
						<div class="twp-site-features">
							<?php if (seek_get_option('show_theme_mode_switcher') == 1) { ?>
								<!-- dark and light -->
								<div class="theme-mode header-theme-mode"></div>
							<?php } ?>
							<?php if (seek_get_option('show_trending_on_nav') == 1) { ?>
								<div class="twp-trending" id="nav-latest-news">
									<i class="fa fa-flash"></i>
								</div>
							<?php } ?>
							<?php if (seek_get_option('show_search_icon_on_nav') == 1) { ?>
								<div class="twp-search" id="search">
									<i class="fa fa-search"></i>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php if (seek_get_option('show_progress_bar_below_nav') == 1) { ?>
					<div class="twp-progress-bar" id="progressbar">
					</div>
				<?php } ?>
			</div>
			<div class="twp-search-field-section" id="search-field">
				<div class="container">
					<div class="twp-search-field-wrapper">
						<div class="twp-search-field">
							<?php get_search_form(); ?>
						</div>
						<div class="twp-close-icon-section">
							<span class="twp-close-icon" id="search-close">
								<span></span>
								<span></span>
							</span>
						</div>
					</div>

				</div>
			</div>
			<!-- trending news section -->
			<?php if (seek_get_option('show_trending_on_nav') == 1) { ?>
				<div class="twp-article-list" id="nav-latest-news-field">
					<div class="container">
						<?php
							$seek_trending_category = esc_attr(seek_get_option('select_category_for_trending_section'));
							$args = array(
								'post_type' => 'post',
								'posts_per_page' =>  12,
								'ignore_sticky_posts' => 1,
								'orderby' => 'date',
								'cat' => absint($seek_trending_category),
							);
							$twp_trending_nav_posts = new WP_Query($args);
							if($twp_trending_nav_posts->have_posts()):?>
								<header class="twp-article-header">
									<h3>
										<?php echo esc_html(seek_get_option('trending_section_title'));?>
									</h3>
									<div class="twp-close-icon-section">
										<span class="twp-close-icon" id="latest-news-close">
											<span></span>
											<span></span>
										</span>
									</div>
								</header>
								<div class="twp-row">
									<?php $counter = 1; ?>
									<?php while ($twp_trending_nav_posts->have_posts()):$twp_trending_nav_posts->the_post();?>
									<!-- loop starts here -->
									<div class="twp-col-4 twp-article-border">
										<div class="twp-article">
											<div class="twp-units">
												<?php echo $counter; ?>
											</div>
											<div class="twp-description">
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<div class="twp-author-meta">
													<?php seek_post_date(); ?>
												</div>
											</div>

										</div>
									</div>
									<?php $counter++; ?>
									<?php endwhile;wp_reset_postdata();?>
								</div>
							<?php endif; ?>
					</div>
				</div><!--/latest-news-section-->
			<?php } ?>
				
			<!-- main banner content -->
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div class="twp-mobile-menu">
		<div class="twp-mobile-close-icon">
			<span class="twp-close-icon twp-close-icon-sm twp-close-icon-white twp-rotate-90" id="twp-mobile-close">
				<span></span>
				<span></span>
			</span>
		</div>
	</div>
	<div class="twp-body-overlay" id="overlay"></div>
	<!-- breadcrums -->
	<?php do_action( 'seek_action_get_breadcrumb' ); ?>


	<?php if (!is_front_page() || !is_home() ) { ?>
		<div id="content" class="site-content">
	<?php } ?>
