<?php
/**
 * carousel section
 *
 * @package Seek
 */

$default = seek_get_default_theme_options();

// Top Header Add Section.
$wp_customize->add_section( 'top_header_add_section_settings',
	array(
		'title'      => __( 'Top Header Add Section', 'seek' ),
		'priority'   => 90,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_addvertisement_section.
$wp_customize->add_setting( 'show_addvertisement_section',
	array(
		'default'           => $default['show_addvertisement_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_addvertisement_section',
	array(
		'label'    => __( 'Enable Header Advertisement', 'seek' ),
		'section'  => 'top_header_add_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting top_section_advertisement.
$wp_customize->add_setting('top_section_advertisement',
	array(
		'default'           => $default['top_section_advertisement'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize, 'top_section_advertisement',
		array(
			'label'       => esc_html__('Top Section Advertisement', 'seek'),
			'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'seek'), 728, 90),
			'section'     => 'top_header_add_section_settings',
			'priority'    => 120,
			'active_callback' => 'seek_addvertisement_section_callback',
		)
	)
);

/*top_section_advertisement_url*/
$wp_customize->add_setting('top_section_advertisement_url',
	array(
		'default'           => $default['top_section_advertisement_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control('top_section_advertisement_url',
	array(
		'label'    => esc_html__('URL Link', 'seek'),
		'section'  => 'top_header_add_section_settings',
		'type'     => 'text',
		'priority' => 130,
		'active_callback' => 'seek_addvertisement_section_callback',
	)
);

// Top bar Main Section.
$wp_customize->add_section( 'top_bar_section_settings',
	array(
		'title'      => __( 'Top Bar Section', 'seek' ),
		'priority'   => 90,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_top_bar_section.
$wp_customize->add_setting( 'show_top_bar_section',
	array(
		'default'           => $default['show_top_bar_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_bar_section',
	array(
		'label'    => __( 'Enable Top Bar', 'seek' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Setting - show_top_date_section.
$wp_customize->add_setting( 'show_top_date_section',
	array(
		'default'           => $default['show_top_date_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_date_section',
	array(
		'label'    => __( 'Enable Date on Top Bar', 'seek' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'seek_top_bar_calback',
	)
);

// Setting - show_top_breaking_news_section.
$wp_customize->add_setting( 'show_top_breaking_news_section',
	array(
		'default'           => $default['show_top_breaking_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_breaking_news_section',
	array(
		'label'    => __( 'Enable Breaking News on Top Bar', 'seek' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'seek_top_bar_calback',
	)
);

$wp_customize->add_setting( 'breaking_news_title',
	array(
		'default'           => $default['breaking_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'breaking_news_title',
	array(
		'label'    => __( 'Breaking Section Title', 'seek' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'text',
		'priority' => 100,
		'active_callback' => 'seek_top_bar_calback',
	)
);

// Setting - drop down category for breaking section.
$wp_customize->add_setting( 'select_category_for_breaking_news_section',
	array(
		'default'           => $default['select_category_for_breaking_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_breaking_news_section',
	array(
        'label'           => __( 'Category for Breaking News Section', 'seek' ),
        'description'     => __( 'Select category to be shown as breaking news onn top bar if set empty will get recent post', 'seek' ),
        'section'         => 'top_bar_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,
    ) ) );


// Setting - show_top_social_section.
$wp_customize->add_setting( 'show_top_social_section',
	array(
		'default'           => $default['show_top_social_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_social_section',
	array(
		'label'    => __( 'Enable Social Menu on Top Bar', 'seek' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'seek_top_bar_calback',
	)
);


// Main Header Section.
$wp_customize->add_section( 'main_header_section_settings',
	array(
		'title'      => __( 'Header Section', 'seek' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_theme_mode_switcher.
$wp_customize->add_setting( 'show_theme_mode_switcher',
	array(
		'default'           => $default['show_theme_mode_switcher'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_theme_mode_switcher',
	array(
		'label'    => __( 'Enable Theme (Dark/Light)Mode Switcher', 'seek' ),
		'section'  => 'main_header_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - show_trending_on_nav.
$wp_customize->add_setting('show_trending_on_nav',
	array(
		'default'           => $default['show_trending_on_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_trending_on_nav',
	array(
		'label'       => esc_html__('Enable Trending Now On Menu', 'seek'),
		'section'     => 'main_header_section_settings',
		'type'        => 'checkbox',
		'priority'    => 140,
	)
);

$wp_customize->add_setting( 'trending_section_title',
	array(
		'default'           => $default['trending_section_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'trending_section_title',
	array(
		'label'    => __( 'Trending Section Title', 'seek' ),
		'section'  => 'main_header_section_settings',
		'type'     => 'text',
		'priority' => 150,
	)
);


// Setting - drop down category for carousel.
$wp_customize->add_setting( 'select_category_for_trending_section',
	array(
		'default'           => $default['select_category_for_trending_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_trending_section',
	array(
        'label'           => __( 'Category for Trending Section', 'seek' ),
        'description'     => __( 'Select category to be shown on trending section on click', 'seek' ),
        'section'         => 'main_header_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 150,

    ) ) );

// Setting - show_search_icon_on_nav.
$wp_customize->add_setting('show_search_icon_on_nav',
	array(
		'default'           => $default['show_search_icon_on_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_search_icon_on_nav',
	array(
		'label'       => esc_html__('Enable Search Icon On Menu', 'seek'),
		'section'     => 'main_header_section_settings',
		'type'        => 'checkbox',
		'priority'    => 150,
	)
);
// Setting - show_progress_bar_below_nav.
$wp_customize->add_setting( 'show_progress_bar_below_nav',
	array(
		'default'           => $default['show_progress_bar_below_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_progress_bar_below_nav',
	array(
		'label'    => __( 'Enable Progress Bar Below Nav', 'seek' ),
		'section'  => 'main_header_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

// Grid Main Section.
$wp_customize->add_section( 'grid_section_settings',
	array(
		'title'      => __( 'Blog/News Grid Section', 'seek' ),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_grid_section.
$wp_customize->add_setting( 'show_grid_section',
	array(
		'default'           => $default['show_grid_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_grid_section',
	array(
		'label'    => __( 'Enable Grid', 'seek' ),
		'section'  => 'grid_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
// Setting grid_section_background_image.
$wp_customize->add_setting('grid_section_background_image',
	array(
		'default'           => $default['grid_section_background_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize, 'grid_section_background_image',
		array(
			'label'       => esc_html__('Grid Section Background Image', 'seek'),
			'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'seek'), 1920, 1080),
			'section'     => 'grid_section_settings',
			'priority'    => 100,
		)
	)
);
$wp_customize->add_setting( 'heading_text_on_grid',
	array(
		'default'           => $default['heading_text_on_grid'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'heading_text_on_grid',
	array(
		'label'    => __( 'Section Title Text', 'seek' ),
		'section'  => 'grid_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

/*No of Grid*/
$wp_customize->add_setting( 'number_of_home_grid',
	array(
		'default'           => $default['number_of_home_grid'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_grid',
	array(
		'label'    => __( 'Select no of grid', 'seek' ),
		'section'  => 'grid_section_settings',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),

		'type'     => 'number',
		'priority' => 105,
	)
);


// Setting - drop down category for grid.
$wp_customize->add_setting( 'select_category_for_grid',
	array(
		'default'           => $default['select_category_for_grid'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_grid',
	array(
        'label'           => __( 'Category for Grid Section', 'seek' ),
        'description'     => __( 'Select category to be shown on Grid bellow slider ', 'seek' ),
        'section'         => 'grid_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,

    ) ) );



// Featured Blog Main Section.
$wp_customize->add_section( 'featured_category_section_settings',
	array(
		'title'      => __( 'Blog/News Featured Category Section', 'seek' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_featured_category_section.
$wp_customize->add_setting( 'show_featured_category_section',
	array(
		'default'           => $default['show_featured_category_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_featured_category_section',
	array(
		'label'    => __( 'Enable Featured Category', 'seek' ),
		'section'  => 'featured_category_section_settings',
		'type'     => 'checkbox',
		'priority' => 110,
	)
);


// Setting - drop down category for featured_blog.
for ( $i=1; $i <=  3 ; $i++ ) {
	$wp_customize->add_setting( 'select_category_for_featured_category_'. $i,
		array(
			'default'           => $default['select_category_for_featured_category'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured_category_'. $i,
		array(
	        'label'           => __( 'Category for Featured Category -', 'seek' ). $i,
	        'section'         => 'featured_category_section_settings',
	        'type'            => 'dropdown-taxonomies',
	        'taxonomy'        => 'category',
			'priority'    	  => 130,

	    ) ) );
}


$wp_customize->add_setting( 'number_of_post_featured_category',
	array(
		'default'           => $default['number_of_post_featured_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_post_featured_category',
	array(
		'label'    => __( 'Number of Post on Single Category column', 'seek' ),
		'section'  => 'featured_category_section_settings',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),

		'type'     => 'number',
		'priority' => 130,
	)
);




// Featured editorial  Section.
$wp_customize->add_section( 'featured_editorial_section_settings',
	array(
		'title'      => __( 'Editorial Choice/Featured News Section', 'seek' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_editorial_featured_news_section.
$wp_customize->add_setting( 'show_editorial_featured_news_section',
	array(
		'default'           => $default['show_editorial_featured_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_editorial_featured_news_section',
	array(
		'label'    => __( 'Enable Editorial/Featured Section', 'seek' ),
		'section'  => 'featured_editorial_section_settings',
		'type'     => 'checkbox',
		'priority' => 110,
	)
);


// Setting - show_editorial_choice_section.
$wp_customize->add_setting( 'show_editorial_choice_section',
	array(
		'default'           => $default['show_editorial_choice_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_editorial_choice_section',
	array(
		'label'    => __( 'Enable Editorial Choice Section', 'seek' ),
		'section'  => 'featured_editorial_section_settings',
		'type'     => 'checkbox',
		'priority' => 110,
	)
);

$wp_customize->add_setting('editorial_choice_section_title',
	array(
		'default'           => $default['editorial_choice_section_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('editorial_choice_section_title',
	array(
		'label'       => esc_html__('Editorial Choice Section Title', 'seek'),
		'section'     => 'featured_editorial_section_settings',
		'type'        => 'text',
		'priority'    => 110,
	)
);

$wp_customize->add_setting( 'select_category_for_editorial_choice',
	array(
		'default'           => $default['select_category_for_editorial_choice'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_editorial_choice',
	array(
        'label'           => __( 'Category for Editorial Choice', 'seek' ),
        'description'     => __( 'Select category to be shown on Editorial Choice section bellow slider ', 'seek' ),
        'section'         => 'featured_editorial_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 120,

    ) ) );

$wp_customize->add_setting( 'select_category_for_featured_Section',
	array(
		'default'           => $default['select_category_for_featured_Section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured_Section',
	array(
        'label'           => __( 'Category for Featured Post Section', 'seek' ),
        'description'     => __( 'Select category to be shown on side of Editorial Choice section bellow slider ', 'seek' ),
        'section'         => 'featured_editorial_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 120,

    ) ) );