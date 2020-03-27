<?php
/**
 * Default theme options.
 *
 * @package Seek
 */

if ( ! function_exists( 'seek_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function seek_get_default_theme_options() {

		$defaults = array();

		//header top bar
		$defaults['site_title_identity_color']		= '#000';
		$defaults['show_selected_page_content_on_homepage']		= 1;
		$defaults['show_latest_post_content_on_homepage']		= 1;

		$defaults['show_top_bar_section']				        = 1;
		$defaults['show_top_breaking_news_section']				= 1;
		$defaults['breaking_news_title']				        = esc_html__( 'Breaking News', 'seek' );
		$defaults['select_category_for_breaking_news_section']	= '';
		$defaults['show_top_social_section']				    = 1;
		$defaults['show_top_date_section']				    	= 1;
		
		//header top bar
		$defaults['show_addvertisement_section']				= 0;
		$defaults['top_section_advertisement']					= '';
		$defaults['top_section_advertisement_url']				= '#';
		$defaults['show_trending_on_nav']						= 1;
		$defaults['trending_section_title']				        = esc_html__( 'Trending Now', 'seek' );
		$defaults['select_category_for_trending_section']		= '';
		$defaults['show_search_icon_on_nav']					= 1;
		$defaults['show_progress_bar_below_nav']				= 1;
		$defaults['show_theme_mode_switcher']					= 1;

		// Slider options.
		$defaults['show_main_banner_section']				    = 1;
		$defaults['select_category_for_slider_section']			= '';
		$defaults['number_of_home_slider']						= 8;
		$defaults['seek_recent_post_section_title']					= esc_html__( 'Recent Stories', 'seek' );
		$defaults['select_category_for_recent_post']			= '';
		$defaults['number_of_home_recent_post']					= 5;

		// grid section options.
		$defaults['show_grid_section']						= 0;
		$defaults['grid_section_background_image']			= '';
		$defaults['number_of_home_grid']					= 12;
		$defaults['heading_text_on_grid']					= esc_html__( 'Trending This Week', 'seek' );
		$defaults['select_category_for_grid']				= 0;

		// Single post options.
		$defaults['enable_except_on_single_post'] 	= 1;
		$defaults['enable_authro_detail_single_page'] 	= 1;
		$defaults['enable_related_post_on_single_page'] 	= 1;
        $defaults['single_related_post_title']                   = esc_html__('You May Like', 'seek');
		$defaults['number_of_single_related_post'] = 6;


		// featured_blog section
		$defaults['show_featured_category_section']			= 0;
		$defaults['select_category_for_featured_category']	= 0;
		$defaults['number_of_post_featured_category']		= 5;


		// Editorial Featured News section
		$defaults['show_editorial_featured_news_section']	= 0;
		$defaults['show_editorial_choice_section']			= 1;
        $defaults['editorial_choice_section_title']         = esc_html__('Editorial Choice', 'seek');
		$defaults['select_category_for_editorial_choice']	= '';
		$defaults['select_category_for_featured_Section']	= '';


		//Layout options.
		$defaults['site_date_layout_option']		= 'in-time-span';
		$defaults['homepage_layout_option']			= 'full-width';
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 50;
		$defaults['pagination_type']				= 'numeric';
		
		$defaults['enable_mailchimp_suscription']   = 1;
		$defaults['mailchimp_suscription_title']	= esc_html__( 'Subscribe US Now', 'seek' );
		$defaults['mailchimp_suscription_shortcode']   = '';

		$defaults['enable_copyright_credit']     	= 1;
		$defaults['copyright_text']					= '';
		$defaults['number_of_footer_widget']		= 4;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader']				= 1;

		// Pass through filter.
		$defaults = apply_filters( 'seek_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
