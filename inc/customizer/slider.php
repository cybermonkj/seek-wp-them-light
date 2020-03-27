<?php
/**
 * slider section
 *
 * @package Seek
 */

$default = seek_get_default_theme_options();
// Slider Main Section.
$wp_customize->add_section( 'main_banner_section_settings',
	array(
		'title'      => __( 'Main Banner Section', 'seek' ),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_main_banner_section.
$wp_customize->add_setting( 'show_main_banner_section',
	array(
		'default'           => $default['show_main_banner_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_main_banner_section',
	array(
		'label'    => __( 'Enable Main Banner', 'seek' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'seek_recent_post_section_title',
	array(
		'default'           => $default['seek_recent_post_section_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'seek_recent_post_section_title',
	array(
		'label'    => __( 'Recent Post Section Title Text', 'seek' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_recent_post',
	array(
		'default'           => $default['select_category_for_recent_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_recent_post',
	array(
        'label'           => __( 'Category for Recent Post', 'seek' ),
        'description'     => __( 'Select category to be shown on recent post left of main slider block', 'seek' ),
        'section'         => 'main_banner_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,

    ) ) );


/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_recent_post',
	array(
		'default'           => $default['number_of_home_recent_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_recent_post',
	array(
		'label'    => __( 'Select Number of Post on Recent Post', 'seek' ),
        'description'     => __( 'Post will be shown on left of slider along with one featured post (Max 6)', 'seek' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'input_attrs'     => array( 'min' => 1, 'max' => 6, 'style' => 'width: 150px;' ),
		'priority' => 100,
	)
);

// Setting - drop down category for exclusive section.
$wp_customize->add_setting( 'select_category_for_slider_section',
	array(
		'default'           => $default['select_category_for_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Seek_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider_section',
	array(
        'label'           => __( 'Category for Slider Section', 'seek' ),
        'description'     => __( 'Select category to be shown on slider section on your banner as well as the recent two featured post ', 'seek' ),
        'section'         => 'main_banner_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,
    ) ) );


/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_slider',
	array(
		'default'           => $default['number_of_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'seek_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_slider',
	array(
		'label'    => __( 'Select Number of Post on Slider', 'seek' ),
        'description'     => __( 'Recent 2 Post will be shown on list and remining as on slider', 'seek' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),
		'priority' => 100,
	)
);