<?php

if ( ! function_exists( 'seek_setup' ) ) :
	function seek_setup() {
		load_theme_textdomain( 'seek', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'primary-nav' => esc_html__( 'Primary Menu', 'seek' ),
			'social-nav' => esc_html__( 'Social Menu', 'seek' ),
			'footer-nav' => esc_html__( 'Footer Menu', 'seek' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'seek_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'post-formats', array(
		    'image',
		    'video',
		    'quote',
		    'gallery',
		    'audio',
			'document',
		) );

		
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'seek_setup' );

function seek_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seek_content_width', 640 );
}
add_action( 'after_setup_theme', 'seek_content_width', 0 );

if (!function_exists('seek_fonts_url')) :

function seek_fonts_url()
    {
        $fonts_url = '';
        $fonts     = array();

        $seek_primary_font = 'Raleway:400,400i,600,600i,700';

        $seek_fonts = array();
        $seek_fonts[]=$seek_primary_font;

          $seek_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

          $i  = 0;
          for ($i=0; $i < count( $seek_fonts ); $i++) { 

            if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'seek' ), $seek_fonts[$i] ) ) {
            $fonts[] = $seek_fonts[$i];
          }

          }

        if ( $fonts ) {
          $fonts_url = add_query_arg( array(
            'family' => urldecode( implode( '|', $fonts ) ),
          ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

function seek_scripts() {
	$fonts_url = seek_fonts_url();
	if (!empty($fonts_url)) {
	    wp_enqueue_style('seek-google-fonts', $fonts_url, array(), null);
	}
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/libraries/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/assets/libraries/slick/css/slick.css');
	wp_enqueue_style('magnific', get_template_directory_uri().'/assets/libraries/magnific/css/magnific-popup.css');

	wp_enqueue_script( 'seek-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-magnific', get_template_directory_uri() . '/assets/libraries/magnific/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('seek-color-switcher', get_template_directory_uri() . '/assets/libraries/color-switcher/color-switcher.js', array('jquery'), '', true);
	wp_enqueue_script( 'seek-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'seek-script', get_template_directory_uri() . '/assets/twp/js/main.js', array(), '', true );

	wp_enqueue_style( 'seek-style', get_stylesheet_uri() );
	wp_add_inline_style( 'seek-style', seek_trigger_custom_css_action() );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seek_scripts' );

function seek_admin_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
	    wp_enqueue_media();
		wp_enqueue_script( 'seek-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array( 'jquery' ), '1.0.0', true );
	}
	wp_enqueue_style( 'seek-custom-admin-style', get_template_directory_uri() . '/assets/twp/css/wp-admin.css', array(), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'seek_admin_scripts' );

require get_template_directory().'/assets/libraries/TGM-Plugin/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/hooks/single-meta.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/widgets/widget-init.php';
require get_template_directory() . '/inc/hooks/banner-with-slider.php';
require get_template_directory() . '/inc/hooks/featured-category.php';
require get_template_directory() . '/inc/hooks/editor-featured.php';
require get_template_directory() . '/inc/hooks/news-blog-grid.php';


if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_filter( 'walker_nav_menu_start_el', 'seek_add_description', 10, 2 );
function seek_add_description( $item_output, $item ) {
    $description = $item->post_content;
    if (('' !== $description) && (' ' !== $description) ) {
        return preg_replace( '/(<a.*)</', '$1' . '<span class="menu-description">' . $description . '</span><', $item_output) ;
    }
    else {
        return $item_output;
    };
}

add_filter('wp_nav_menu_items', 'seek_add_admin_link', 1, 2);
function seek_add_admin_link($items, $args){
    if( $args->theme_location == 'primary-nav' ){
        $item = '<li class="brand-home"><a title="Home" href="'. esc_url( home_url() ) .'">' . "<span class='fa fa-home'></span>" . '</a></li>';
        $items = $item . $items;
    }
    return $items;
}

