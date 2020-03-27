<?php
if (!function_exists('seek_main_banner')) :
    /**
     * Main Banner Section
     *
     * @since seek 1.0.0
     *
     * 
     * 
     */
    function seek_main_banner()
    {
        if (1 != seek_get_option('show_main_banner_section')) {
            return null;
        }
        ?>
            <div class="twp-banner-section twp-bg-light-gray">

                <div class="container">
                    <div class="twp-row">
                        <?php 
                        $seek_select_category_for_banner_section = esc_attr(seek_get_option('select_category_for_slider_section'));
                        $seek_number_of_home_banner_section = absint(seek_get_option('number_of_home_slider'));
                        $seek_main_banner_banner_args = array(
                            'post_type' => 'post',
                            'cat' => absint($seek_select_category_for_banner_section),
                            'ignore_sticky_posts' => true,
                            'posts_per_page' => absint( $seek_number_of_home_banner_section ),
                            'posts_per_page' => 4,
                            'offset' => 2,
                        ); 

                        $seek_main_banner_banner_args_2 = array(
                            'post_type' => 'post',
                            'cat' => absint($seek_select_category_for_banner_section),
                            'ignore_sticky_posts' => true,
                            'posts_per_page' => 2,
                        ); ?>
                        <div class="twp-col-12 twp-col-lg-6">
                            <div class="twp-row">
                                <div class="twp-col-half">
                                    <?php 
                                    $seek_select_category_for_recent_section = esc_attr(seek_get_option('select_category_for_recent_post'));
                                    $seek_number_of_home_recent_section = absint(seek_get_option('number_of_home_recent_post'));
                                    $seek_main_banner_recent_args = array(
                                        'post_type' => 'post',
                                        'cat' => absint($seek_select_category_for_recent_section),
                                        'ignore_sticky_posts' => true,
                                        'posts_per_page' => absint( $seek_number_of_home_recent_section ),
                                    ); ?>
                                    <div class="twp-banner-post-section">
                                        <h2><span class="twp-tag-line twp-tag-line-white"><?php echo esc_html(seek_get_option('seek_recent_post_section_title')); ?></span></h2>
                                        <ul class="twp-list-post-lists">
                                        <?php 
                                        $seek_main_banner_recent_post_query = new WP_Query($seek_main_banner_recent_args);
                                        if ($seek_main_banner_recent_post_query->have_posts()) :
                                            while ($seek_main_banner_recent_post_query->have_posts()) : $seek_main_banner_recent_post_query->the_post();
                                                if(has_post_thumbnail()){
                                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                                    $url = $thumb['0'];
                                                }
                                                else{
                                                    $url = '';
                                                }
                                                ?>
                                                    <li class="twp-list-post twp-d-flex">
                                                        <div class="twp-image-section twp-image-hover">
                                                            <a href="<?php the_permalink(); ?>" class="data-bg" data-background="<?php echo esc_url($url); ?>"></a>
                                                        </div>
                                                        <div class="twp-desc">
                                                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                            <div class="twp-author-meta">
                                                                <?php seek_post_date(); ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                            <?php 
                                        endwhile;
                                        endif; 
                                        wp_reset_postdata(); 
                                        ?>
                                    </div>
                                </div><!--/col-half-->
                                <div class="twp-col-half">
                                    <div class="twp-full-post-list">
                                        <?php 
                                        $seek_main_banner_banner_post_query_args_2 = new WP_Query($seek_main_banner_banner_args_2);
                                        if ($seek_main_banner_banner_post_query_args_2->have_posts()) :
                                        while ($seek_main_banner_banner_post_query_args_2->have_posts()) : $seek_main_banner_banner_post_query_args_2->the_post();
                                            if(has_post_thumbnail()){
                                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                                $url = $thumb['0'];
                                            }
                                            else{
                                                $url = '';
                                            }
                                            ?>
                                        <div class="twp-full-post twp-full-post-sm data-bg twp-overlay-image-hover" data-background="<?php echo esc_url($url); ?>">
                                            <a href="<?php the_permalink(); ?>"></a>
                                            <div class="twp-wrapper twp-overlay twp-w-100">
                                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <div class="twp-social-share-section">
                                                    <div class="twp-author-meta m-0">
                                                        <?php seek_post_date(); ?>
                                                    </div>
                                                    <?php if( class_exists( 'Booster_Extension_Class') ){
                                                        $args = array('layout'=>'layout-2','status' => 'enable');
                                                        do_action('booster_extension_social_icons',$args);
                                                    } ?>
                                                </div>
                                            </div>

                                            <span class="twp-post-format-absolute">
                                                <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                            </span>
                                            
                                        </div>
                                        <?php endwhile;
                                        endif; 
                                        wp_reset_postdata(); ?>
                                    </div><!--/twp-full-post-list-->
                                </div><!--/col-half-->
                            </div>
                        </div>
                        <div class="twp-col-12 twp-col-lg-6">
                            <?php $rtl_class_c = 'false';
                            if(is_rtl()){ 
                                $rtl_class_c = 'true';
                            }?>
                            <div class="twp-banner-slider"  data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                                <?php 
                                $seek_main_banner_banner_post_query = new WP_Query($seek_main_banner_banner_args);
                                if ($seek_main_banner_banner_post_query->have_posts()) :
                                while ($seek_main_banner_banner_post_query->have_posts()) : $seek_main_banner_banner_post_query->the_post();
                                    if(has_post_thumbnail()){
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                                        $url = $thumb['0'];
                                    }
                                    else{
                                        $url = '';
                                    }
                                    ?>
                                    <div class="twp-banner-slider-wrapper">
                                        <div class="twp-full-post twp-full-post-lg data-bg twp-overlay-image-hover" data-background="<?php echo esc_url($url); ?>">
                                            <a href="<?php the_permalink(); ?>"></a>
                                            <div class="twp-wrapper twp-overlay twp-w-100">
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
                                                    <?php 
                                                    if( class_exists( 'Booster_Extension_Class')){
                                                        do_action('booster_extension_like_dislike','allenable');
                                                    } ?>
                                                    <?php if( class_exists( 'Booster_Extension_Class') ){
                                                        $args = array('layout'=>'layout-2','status' => 'enable');
                                                        do_action('booster_extension_social_icons',$args);
                                                    } ?>
                                                </div>
                                            </div>
                                            <span class="twp-post-format-absolute">
                                                <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endwhile;
                                endif; 
                                wp_reset_postdata(); ?>
                            </div>
                        </div>

                    </div>                   
                </div>
            </div>

        <?php
    }   
endif;
add_action('seek_action_main_banner', 'seek_main_banner', 10);
