<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Seek
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function seek_body_classes( $classes ) {
    global $post;
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	    $global_layout = seek_get_option( 'global_layout' );
        // Adds a class of no-sidebar when there is no sidebar present.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        if ( $post && is_singular() ) {
            $post_options = get_post_meta( $post->ID, 'seek-meta-select-layout', true );

            if (empty( $post_options ) ) {
                $global_layout = esc_attr( seek_get_option('global_layout') );
            } else{
                $global_layout = esc_attr($post_options);
            }
        }

        if ($global_layout == 'left-sidebar') {
            $classes[]= 'left-sidebar';
        }
        elseif ($global_layout == 'no-sidebar') {
            $classes[]= 'no-sidebar';
        }
        else{
            $classes[]= 'right-sidebar';

        }

	return $classes;
}
add_filter( 'body_class', 'seek_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function seek_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'seek_pingback_header' );



if ( ! function_exists( 'seek_archive_title' ) ) :
    function seek_archive_title( $title ) {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }
endif;
add_filter( 'get_the_archive_title', 'seek_archive_title' );

/* Display Breadcrumbs */
if (!function_exists('seek_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function seek_get_breadcrumb()
    {
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }
        $breadcrumb_type = seek_get_option( 'breadcrumb_type' );
        if ( 'disabled' === $breadcrumb_type ) {
            return;
        }

        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/assets/libraries/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        ); ?>


        <div class="twp-breadcrumbs">
            <div class="container">
                <?php breadcrumb_trail($breadcrumb_args); ?>
            </div>
        </div>


    <?php }

endif;
add_action('seek_action_get_breadcrumb', 'seek_get_breadcrumb');


if( ! function_exists( 'seek_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  seek 1.0.0
     *
     * @param null
     * @return int
     */
    function seek_excerpt_length( $length ){
        if ( is_admin() ) {
                return $length;
        }
        $excerpt_length = seek_get_option('excerpt_length_global');
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
        return absint( $excerpt_length );

    }

endif;
add_filter( 'excerpt_length', 'seek_excerpt_length', 999 );


if ( ! function_exists( 'seek_custom_posts_navigation' ) ) :
    /**
     * Posts navigation.
     *
     * @since 1.0.0
     */
    function seek_custom_posts_navigation() {

        $pagination_type = seek_get_option( 'pagination_type' );

        switch ( $pagination_type ) {

            case 'default':
                echo '<div class="twp-pagination">';
                    the_posts_navigation();
                echo '</div>';
            break;

            case 'numeric':
                echo '<div class="twp-pagination-numeric">';
                    the_posts_pagination(array(
                            'mid_size' => 4,
                            'prev_text' => __('Previous', 'seek'),
                            'next_text' => __('Next', 'seek'),
                        ));
                echo '</div>';
            break;

            default:
            break;
        }

    }
endif;

add_action( 'seek_action_posts_navigation', 'seek_custom_posts_navigation' );

if (!function_exists('seek_single_related_post')) :
    /**
     * Main Banner Section
     *
     * @since seek 1.0.0
     *
     */
    function seek_single_related_post()
    {
        if (1 != seek_get_option('enable_related_post_on_single_page')) {
            return;
        }
        ?>
        <div class="twp-related-post-section">
            <div class="container">
                    <?php
                    global $post;
                    $categories = get_the_category(get_the_ID());
                    $related_section_title = esc_html(seek_get_option('single_related_post_title'));
                    $number_of_related_posts = absint(seek_get_option('number_of_single_related_post'));

                    if ($categories) {
                        $cat_ids = array();
                        foreach ($categories as $category) $cat_ids[] = $category->term_id;
                        $seek_related_post_args = array(
                            'posts_per_page' => absint($number_of_related_posts),
                            'category__in' => $cat_ids,
                            'post__not_in' => array(get_the_ID()),
                            'order' => 'ASC',
                            'orderby' => 'rand'
                        ); 
                        $seek_related_post_post_query = new WP_Query($seek_related_post_args);
                        ?>
                        <?php if (!empty($seek_related_post_post_query)) { ?>
                            <h2 class="twp-title twp-title-with-dashed"><?php echo esc_html($related_section_title); ?></h2>
                        <?php } ?>
                        <ul class="twp-related-post-list">
                            <?php 
                            if ($seek_related_post_post_query->have_posts()) :
                                while ($seek_related_post_post_query->have_posts()) : $seek_related_post_post_query->the_post();
                                        if(has_post_thumbnail()){
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                            $url = $thumb['0'];
                                        }
                                        else{
                                            $url = '';
                                        }?>
                                        <li class="twp-related-post twp-d-flex">
                                            <div class="twp-image-section twp-image-hover">
                                                <a href="<?php the_permalink(); ?>" class="data-bg" data-background="<?php echo esc_url($url); ?>"></a>
                                            </div>
                                            <div class="twp-desc twp-bg-light-gray">
                                                <div class="twp-categories-with-bg twp-categories-with-bg-primary">
                                                    <?php seek_post_categories(); ?>
                                                </div>
                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                
                                                <div class="twp-social-share-section">
                                                    <div class="twp-author-meta m-0">
                                                        <?php seek_post_author(); ?>
                                                        <?php seek_post_date(); ?>
                                                        <?php seek_get_comments_count(get_the_ID()); ?>
                                                    </div>
                                                    
                                                    <?php if( class_exists( 'Booster_Extension_Class') ){
                                                        $args = array('layout'=>'layout-2','status' => 'enable');
                                                        do_action('booster_extension_social_icons',$args);
                                                    } ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile;
                            endif; 
                            wp_reset_postdata(); 
                            ?>
                        </ul>
                    <?php } ?> 
            </div><!--/container-->
        </div><!--/twp-news-main-section-->
        <?php
}  
endif;
add_action('seek_action_related_post', 'seek_single_related_post', 10);


if( ! function_exists( 'seek_recommended_plugins' ) ) :

  /**
   * Recommended plugins
   *
   */
  function seek_recommended_plugins(){
      $seek_plugins = array(
        array(
            'name'     => __('Booster Extension', 'seek'),
            'slug'     => 'booster-extension',
            'required' => false,
        ),
        array(
          'name'     => __('Mailchimp for WordPress', 'seek'),
          'slug'     => 'mailchimp-for-wp',
          'required' => false,
        ),
      );
      $seek_plugins_config = array(
          'dismissable' => true,
      );
      
      tgmpa( $seek_plugins, $seek_plugins_config );
  }
endif;
add_action( 'tgmpa_register', 'seek_recommended_plugins' );


/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package seek
 */

if (!function_exists('seek_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
function seek_trigger_custom_css_action()
{
    $seek_site_title_identity_color = seek_get_option('site_title_identity_color');
    ?>
        <style type="text/css">
        <?php
        if (!empty($seek_site_title_identity_color) ){
            ?>
            .twp-site-branding .twp-logo,
            .twp-site-branding.twp-overlay .twp-logo,
            .twp-site-branding .twp-logo a,
            .twp-site-branding .twp-logo a:visited
            .twp-site-branding.twp-overlay .twp-logo a,
            .twp-site-branding.twp-overlay .twp-logo a:visited{
                color: <?php echo esc_html($seek_site_title_identity_color); ?>;
            }
        <?php  } ?>
        </style>
<?php }
endif;

