<?php
if (!function_exists('seek_grid_block_args')) :
    /**
     * Banner grid Details
     *
     * @since Seek 1.0.0
     *
     * @return array $qargs grid details.
     */
    function seek_grid_block_args()
    {
        $seek_grid_block_number = absint(seek_get_option('number_of_home_grid'));
        $seek_grid_block_category = esc_attr(seek_get_option('select_category_for_grid'));
        $qargs = array(
            'posts_per_page' => esc_attr($seek_grid_block_number),
            'post_type' => 'post',
            'cat' => $seek_grid_block_category,
        );
        return $qargs;
        ?>
        <?php
    }
endif;


if (!function_exists('seek_grid_block')) :
    /**
     * Banner grid
     *
     * @since Seek 1.0.0
     *
     */
    function seek_grid_block()
    {
        $seek_grid_block_title_text = esc_html(seek_get_option('heading_text_on_grid'));

        if (1 != seek_get_option('show_grid_section')) {
            return null;
        }
        $seek_grid_block_args = seek_grid_block_args();
        $seek_grid_block_query = new WP_Query($seek_grid_block_args); ?>
        <div class="twp-latest-post-section twp-overlay data-bg" data-background="<?php echo esc_url(seek_get_option('grid_section_background_image')); ?>">
            <div class="container">
                <?php if (!empty($seek_grid_block_title_text)) { ?>
                        <h2 class="twp-title-with-dashed">
                            <?php echo esc_html($seek_grid_block_title_text); ?>
                        </h2>
                <?php } ?>
                <div class="twp-latest-post-list twp-row">
                    <?php
                    if ($seek_grid_block_query->have_posts()) :
                        while ($seek_grid_block_query->have_posts()) : $seek_grid_block_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                $url = $thumb['0'];
                            }
                            ?>
                                <div class="twp-editorial-post twp-latest-post">
                                    <div class="twp-image-section twp-image-hover">
                                        <?php if (has_post_thumbnail()) { ?>
                                        <a href="<?php the_permalink(); ?>" class="data-bg" data-background="<?php echo esc_url($url); ?>"></a>
                                        <?php  } else { ?>
                                            <div class="data-bg"></div>
                                        <?php } ?>
                                        <span class="twp-post-format-absolute">
                                            <?php echo esc_attr(seek_post_format(get_the_ID())); ?>
                                        </span>
                                    </div>
                                    <div class="twp-desc">
                                        <h4>
                                            <a  href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
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
                                </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
endif;
add_action('seek_action_grid_post', 'seek_grid_block', 10);