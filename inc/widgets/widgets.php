<?php
/**
 * Theme widgets.
 *
 * @package Seek
 */

if (!function_exists('seek_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function seek_load_widgets()
    {

        // Recent Post widget.
        register_widget('Seek_sidebar_widget');

        // Author widget.
        register_widget('Seek_Author_Post_widget');

        // Social widget.
        register_widget('Seek_Social_widget');

        //tab widget.
        register_widget('Seek_Tabbed_Widget');

        // Featured News widget.
        register_widget('Seek_Homepage_Featured_News_Post');

        // News carousel widget.
        register_widget('Seek_Homepage_Carousel_News_Post');


    }
endif;
add_action('widgets_init', 'seek_load_widgets');


/*Recent Post widget*/
if (!class_exists('Seek_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Seek_sidebar_widget extends Seek_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'seek_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'seek'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'seek'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'seek'),
                ),
                'enable_counter' => array(
                    'label' => __('Enable Counter:', 'seek'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'seek'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('seek-popular-sidebar-layout', __('Seek :- Recent Post', 'seek'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php global $post; 
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget-section">                
                <ul class="twp-list-post-list">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                        <li class="twp-list-post twp-d-flex">
                            <div class="twp-image-section twp-image-hover">
                                <?php if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                    $url = $thumb['0'];
                                    } else {
                                        $url = '';
                                }
                                ?>
                                <a  href="<?php the_permalink(); ?>" class="data-bg" data-background="<?php echo esc_url($url); ?>">
                                    <?php if (true === $params['enable_counter']) { ?>
                                        <?php } ?>
                                </a>
                                <span class="twp-unit"> <?php echo $count; ?></span>
                            </div>
                            <div class="twp-desc">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="twp-author-meta">
                                    <?php seek_post_date(); ?>
                                </div>
                            </div>
                        </li>
                    <?php 
                        $count++;
                        endforeach;
                    ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Author widget*/
if (!class_exists('Seek_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Seek_Author_Post_widget extends Seek_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'seek_author_widget',
                'description' => __('Displays authors details in post.', 'seek'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'seek'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'seek'),
                    'type'  => 'image',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'seek'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'seek'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => __('Linkedin URL:', 'seek'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => __('Instagram URL:', 'seek'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('seek-author-layout', __('Seek :- Author Widget', 'seek'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="twp-author-info">
               
                    <?php if ( ! empty( $params['image_url'] ) ) { ?>
                        <div class="twp-image-section  bg-image twp-overlay-image-hover">
                            <img src="<?php echo esc_url( $params['image_url'] ); ?>">
                        </div>
                    <?php } ?>

                <div class="twp-description">
                    <?php if ( ! empty( $params['author-name'] ) ) { ?>
                        <h3 class="twp-inner-title"><?php echo esc_html($params['author-name'] );?></h3>
                    <?php } ?>
                    <?php if ( ! empty( $params['description'] ) ) { ?>
                        <div class="twp-author-bio"><p><?php echo wp_kses_post( $params['description']); ?></p></div>
                    <?php } ?>
                </div>
                <div class="twp-social twp-widget-social-icons-rounded">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <span ><a href="<?php echo esc_url($params['url-fb']); ?>"><i class="fa fa-facebook"></i></a></span></span>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <span ><a href="<?php echo esc_url($params['url-tw']); ?>"><i class=" fa fa-twitter"></i></a></span>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-lt'] ) ) { ?>
                        <span><a href="<?php echo esc_url($params['url-lt']); ?>"><i class=" fa fa-linkedin"></i></a></span>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-ig'] ) ) { ?>
                        <span><a href="<?php echo esc_url($params['url-ig']); ?>"><i class=" fa fa-instagram"></i></a></span>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Social widget*/
if (!class_exists('Seek_Social_widget')) :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Seek_Social_widget extends Seek_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'seek_social_widget',
                'description' => __('Displays Social share.', 'seek'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('seek-social-layout', __('Seek :- Social Widget', 'seek'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <div class="twp-social-widget">
                <div class="social-widget-menu">
                <?php
                    wp_nav_menu(
                        array('theme_location' => 'social-nav',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'menu_id' => 'social-menu',
                            'fallback_cb' => false,
                            'menu_class' => 'twp-social-icons  twp-social-widget'
                        )); ?>
                </div>
                <?php if ( ! has_nav_menu( 'social-nav' ) ) : ?>
                    <p>
                        <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'seek' ); ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Seek_Tabbed_Widget')):

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Seek_Tabbed_Widget extends Seek_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {

            $opts = array(
                'classname'   => 'seek_widget_tabbed',
                'description' => __('Tabbed widget.', 'seek'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label'          => __('Popular', 'seek'),
                    'type'           => 'heading',
                ),
                'popular_number' => array(
                    'label'         => __('No. of Posts:', 'seek'),
                    'type'          => 'number',
                    'css'           => 'max-width:60px;',
                    'default'       => 5,
                    'min'           => 1,
                    'max'           => 6,
                ),
                'enable_discription' => array(
                    'label'             => __('Enable Description:', 'seek'),
                    'type'              => 'checkbox',
                    'default'           => false,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size Featured Post:', 'seek'),
                    'type' => 'select',
                    'default' => 'medium',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'seek' ),
                        'medium' => esc_html__( 'Medium', 'seek' ),
                        'large' => esc_html__( 'Large', 'seek' ),
                        'full' => esc_html__( 'Full', 'seek' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label'         => __('Excerpt Length:', 'seek'),
                    'description'   => __('Number of words', 'seek'),
                    'default'       => 10,
                    'css'           => 'max-width:60px;',
                    'min'           => 0,
                    'max'           => 200,
                ),
                'recent_heading' => array(
                    'label'         => __('Recent', 'seek'),
                    'type'          => 'heading',
                ),
                'recent_number' => array(
                    'label'        => __('No. of Posts:', 'seek'),
                    'type'         => 'number',
                    'css'          => 'max-width:60px;',
                    'default'      => 5,
                    'min'          => 1,
                    'max'          => 6,
                ),
                'comments_heading' => array(
                    'label'           => __('Comments', 'seek'),
                    'type'            => 'heading',
                ),
                'comments_number' => array(
                    'label'          => __('No. of Comments:', 'seek'),
                    'type'           => 'number',
                    'css'            => 'max-width:60px;',
                    'default'        => 5,
                    'min'            => 1,
                    'max'            => 6,
                ),
            );

            parent::__construct('seek-tabbed', __('Seek :- Tab Widgets', 'seek'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance) {

            $params = $this->get_params($instance);
            $tab_id = 'tabbed-'.$this->number;

            echo $args['before_widget'];
            ?>
            <div class="twp-tabbed-section">

                <div class="section-head">
                    <ul class="twp-tab" role="tablist">
                        <li role="presentation" class="tabbed-popular active">
                            <span class="fire-icon tab-icon"> 
                                <i class="fa fa-fire"></i>
                            </span>
                            <?php esc_html_e('Popular', 'seek');?>
                        </li>
                        <li class="tabbed-recent">
                            <span class="flash-icon tab-icon">
                                <i class="fa fa-bolt"></i>
                            </span>
                            <?php esc_html_e('Recent', 'seek');?>
                        </li>
                        <li class="tabbed-comments">
                            <span class="comment-icon tab-icon">
                                <i class="fa fa-comments"></i>
                            </span>
                            <?php esc_html_e('Comments', 'seek');?>
                        </li>
                    </ul>
                </div>
                <div class="twp-tab-content">
                    <div id="tabbed-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params);?>
                    </div>
                    <div id="tabbed-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params);?>
                    </div>
                    <div id="tabbed-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params);?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params) {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows'  => true,
                        'orderby'        => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows'  => true,
                    );
                    break;

                default:
                    break;
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)):?>
                <?php global $post;
                ?>
                <div class="twp-full-post-list">
                    <?php foreach ($all_posts as $key => $post):?>
                        <?php setup_postdata($post);?>
                            <?php if (has_post_thumbnail($post->ID)){?>
                                <?php
                                $select_image_size = esc_attr($params['select_image_size']);
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $select_image_size);?>
                            <?php  } ?>
                            <div class="twp-full-post twp-full-post-md data-bg twp-overlay-image-hover" data-background="<?php echo esc_url($image[0]);?>">
                                <span class="twp-post-format-absolute">
                                    <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                </span>
                                <div class="twp-wrapper twp-overlay twp-w-100">
                                    <div class="twp-categories-with-bg twp-categories-with-bg-primary">
                                        <?php seek_post_categories(); ?>
                                    </div>
                                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                    <div class=" twp-author-meta">
                                        <?php seek_post_date(); ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (true === $params['enable_discription']) {?>
                                <?php if (absint($params['excerpt_length']) > 0):?>
                                    <div class="twp-post-description">
                                        <?php
                                        //$excerpt = seek_words_count(absint($params['excerpt_length']), get_the_content());
                                        $excerpt = get_the_excerpt();
                                        echo wp_kses_post(wpautop($excerpt));
                                        ?>
                                    </div>
                                <?php endif;?>
                            <?php }?>
                    <?php endforeach;?>
                </div><!-- full post list -->

                <?php wp_reset_postdata();?>

            <?php endif;?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params) {

            $comment_args = array(
                'number'      => $params['comments_number'],
                'status'      => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)):?>
                <ul class="twp-list-post-list">
                    <?php foreach ($comments as $key => $comment):?>
                        <li class="twp-list-post twp-d-flex">
                            <figure class="twp-image-section twp-image-hover">
                                <?php $comment_author_url = get_comment_author_url($comment);?>
                                <?php if (!empty($comment_author_url)):?>
                                    <a class="data-bg d-block" href="<?php echo esc_url($comment_author_url);?>"><?php echo get_avatar($comment, 65);
                                        ?></a>
                                <?php  else :?>
                                    <?php echo get_avatar($comment, 65);?>
                                <?php endif;?>
                            </figure>
                            <div class="twp-desc">
                                <?php echo get_comment_author_link($comment);?>
                                &nbsp;
                                <?php echo esc_html_x('on', 'Tabbed Widget', 'seek');
                                ?>&nbsp;
                                    <h5>
                                        <a href="<?php echo esc_url(get_comment_link($comment));?>">
                                        <?php echo get_the_title($comment->comment_post_ID);?>
                                    </a>
                                    </h5>
                               
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul><!-- .comments-list -->
            <?php endif;?>
            <?php
        }

    }
endif;


// Featured News widget.
if (!class_exists('Seek_Homepage_Featured_News_Post')) :

    /**
     * Featured News widget Class.
     *
     * @since 1.0.0
     */
    class Seek_Homepage_Featured_News_Post extends Seek_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'seek_featured_post_widget',
                'description' => __('Displays post form selected category with 3 large grid and remianing on list format.', 'seek'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'seek'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'seek'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'seek'),
                    'type' => 'number',
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('seek-featured-post-layout', __('Seek :- Featured Grid Post', 'seek'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            if (absint($params['post_category']) > 0) {
                $cat_link =esc_url(get_category_link( $params['post_category'] ));
            } else {
                $cat_link ='';
            }


            $all_posts = get_posts($qargs);
            ?>
            <?php global $post; 
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>

            <div class="twp-featured-post-section">
                <div class="container">
                    <div class="twp-features-post-list">
                        <?php
                            if (!empty($params['title'])) {
                                echo $args['before_title']  .$params['title'] .$args['after_title'];
                            }
                        ?>
                        <div class="twp-row">
                            <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                                <?php if ($count <= 1) { ?>
                                    <div class="twp-col-4">
                                        <div class="twp-feature-post twp-box-shadow-sm">
                                            <div class="twp-image-section twp-image-lg twp-image-hover">
                                                <?php if (has_post_thumbnail()) {
                                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
                                                    $url = $thumb['0'];
                                                    } else {
                                                        $url = '';
                                                }
                                                ?>
                                                <a class="data-bg d-block twp-overlay-image-hover" href="<?php the_permalink(); ?>" data-background="<?php echo esc_url($url); ?>">
                                                </a>
                                                <span class="twp-post-format-absolute">
                                                    <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                                </span>
                                            </div>
                                            <div class="twp-desc">
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
                                                        $args_bes = array('layout'=>'layout-2','status' => 'enable');
                                                        do_action('booster_extension_social_icons',$args_bes);
                                                    } ?>

                                                </div>
                                                <div class="twp-caption">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </div><!--/twp-feature-post-->
                                    </div><!--/col-->
                                <?php } ?>
                                <?php if ($count == 1) {
                                    echo "<div class='twp-col-4'><div class='twp-full-post-list'>";
                                } ?>
                                <?php if (($count > 1 && $count <= 3 )) { ?>
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = '';
                                    }
                                    ?>
                                    <div class="twp-full-post twp-full-post-md data-bg twp-overlay-image-hover" data-background="<?php echo esc_url($url); ?>">
                                        <a href="<?php the_permalink(); ?>"></a>
                                        <span class="twp-post-format-absolute">
                                            <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                        </span>
                                        <div class="twp-wrapper twp-overlay twp-w-100">
                                            <div class="twp-categories-with-bg twp-categories-with-bg-primary">
                                                <?php seek_post_categories(); ?>
                                            </div>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <div class="twp-social-share-section">
                                                <div class="twp-author-meta m-0">
                                                    <?php seek_post_date(); ?>
                                                </div>
                                                <?php if( class_exists( 'Booster_Extension_Class') ){
                                                    $args_be = array('layout'=>'layout-2','status' => 'enable');
                                                    do_action('booster_extension_social_icons',$args_be);
                                                } ?>

                                            </div>
                                        </div>
                                    </div><!--/twp-feature-post-->
                                <?php } ?>

                                <?php if ($count == 3) {
                                    echo "</div></div>";
                                    echo "<div class='twp-col-4'>";
                                    echo "<ul class='twp-list-post-list twp-row'>";
                                } ?>
                                <?php if ($count >= 4) { ?>
                                    <li class="twp-list-post twp-d-flex">
                                        <?php if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                            $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                        }
                                        ?>
                                        <div class="twp-image-section twp-image-hover">
                                            <a href="<?php the_permalink(); ?>" class="data-bg"  data-background="<?php echo esc_url($url); ?>"></a>
                                        </div>
                                        <div class="twp-desc">
                                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            <div class="twp-author-meta">
                                                <?php seek_post_date(); ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if( $key == ( count( $all_posts ) - 1 ) ){
                                    echo '</ul>';
                                    echo '</div>';
                                }?>
                            <?php $count++; endforeach; ?>
                        </div>
                    </div>
                </div><!--/twp-container-->
            </div><!--/twp-featured-post-section-->

    <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

// News carousel widget.
if (!class_exists('Seek_Homepage_Carousel_News_Post')) :

    /**
     * carousel News widget Class.
     *
     * @since 1.0.0
     */
    class Seek_Homepage_Carousel_News_Post extends Seek_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'seek_carousel_post_widget',
                'description' => __('Displays post form selected category as carousel slider.', 'seek'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'seek'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'seek'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'seek'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'seek'),
                    'type' => 'number',
                    'default' => 9,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
            );

            parent::__construct('seek-carousel-post-layout', __('Seek :- Carousel Post', 'seek'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            if (absint($params['post_category']) > 0) {
                $cat_link =esc_url(get_category_link( $params['post_category'] ));
            } else {
                $cat_link ='';
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php global $post; 
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>
                <?php $rtl_class_c = 'false';
                if(is_rtl()){ 
                    $rtl_class_c = 'true';
                }?>
            <div class="twp-featured-post-slider-section">
                <div class="container-fluid">
                    <?php
                        if (!empty($params['title'])) {
                            echo $args['before_title'] .'<a href="'.$cat_link.'"><span class="twp-tag-line twp-tag-line-white">' .$params['title'] .'<span></a>' .$args['after_title'];
                        }
                    ?>
                    <div class="twp-featured-post-slider" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <div class="twp-feature-post">
                                <div class="twp-image-section twp-image-sm twp-image-hover">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = '';
                                    }
                                    ?>
                                    <a class="data-bg twp-overlay-image-hover" href="<?php the_permalink(); ?>" data-background="<?php echo esc_url($url); ?>">
                                    </a>
                                    <span class="twp-post-format-absolute-center">
                                        <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                    </span>
                                </div>
                                <div class="twp-desc">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="twp-social-share-section">
                                        <div class="twp-author-meta m-0">
                                            <?php seek_post_date(); ?>
                                        </div>
                                        <?php if( class_exists( 'Booster_Extension_Class') ){
                                            $args_be_c = array('layout'=>'layout-2','status' => 'enable');
                                            do_action('booster_extension_social_icons',$args_be_c);
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

    <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
