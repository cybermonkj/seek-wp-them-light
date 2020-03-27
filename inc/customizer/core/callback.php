<?php
/**
 * Customizer callback functions for top_bar.
 *
 * @package Seek
 */

/*select page for slider*/
if ( ! function_exists( 'seek_top_bar_calback' ) ) :

	/**
	 * Check if slider section page/post is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function seek_top_bar_calback( $control ) {

		if ( 1 == $control->manager->get_setting( 'show_top_bar_section' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;


/**
 * Customizer callback functions for header-add.
 *
 * @package Seek
 */

/*select page for slider*/
if ( ! function_exists( 'seek_addvertisement_section_callback' ) ) :

	/**
	 * Check if slider section page/post is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function seek_addvertisement_section_callback( $control ) {

		if ( 1 == $control->manager->get_setting( 'show_addvertisement_section' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

/**
 * Customizer callback functions for page
 *
 * @package Seek
 */

/*select page for slider*/
if ( ! function_exists( 'seek_homepage_section_callback' ) ) :

	/**
	 * Check if slider section page/post is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function seek_homepage_section_callback( $control ) {

		if ('posts' == get_option('show_on_front')) {
			return true;
		} else {
			return false;
		}

	}

endif;

/**
 * Customizer callback functions for post page
 *
 * @package Seek
 */

/*select page for slider*/
if ( ! function_exists( 'seek_blog_section_callback' ) ) :

	/**
	 * Check if slider section page/post is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function seek_blog_section_callback( $control ) {

		if ('posts' != get_option('show_on_front')) {
			return true;
		} else {
			return false;
		}

	}

endif;
