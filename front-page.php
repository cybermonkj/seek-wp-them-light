<?php

get_header();?>
<?php if ( is_paged()) { ?>
        <div id="content" class="site-content">
<?php } else {
            do_action( 'seek_action_main_banner' );
            do_action( 'seek_action_grid_post' );
            do_action( 'seek_action_category_list_post' ); 
            do_action( 'seek_action_editor_featured_section' );
            ?>
            <?php if (is_active_sidebar('fullwidth-homepage-sidebar')) { ?>
                <div class="twp-home-widget-section">
                    <?php dynamic_sidebar('fullwidth-homepage-sidebar'); ?>
                </div>
            <?php }?>
        <div id="content" class="site-content">
<?php } ?>

        <?php if ('posts' == get_option('show_on_front')) { ?>
            <?php if (1 == seek_get_option('show_latest_post_content_on_homepage')) { ?>
            <div class="twp-home-page-latest-post">
                <div class="container clearfix">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="twp-archive-post-list twp-row">
                                <?php
                                if ( have_posts() ) :

                                    if ( is_home() && ! is_front_page() ) :
                                        ?>
                                        <header>
                                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                        </header>
                                        <?php
                                    endif;
                                    while ( have_posts() ) :
                                        the_post();
                                        get_template_part( 'template-parts/content', get_post_type() );

                                    endwhile;
                                    
                                    do_action('seek_action_posts_navigation');

                                else :

                                    get_template_part( 'template-parts/content', 'none' );

                                endif;
                                ?>
                            </div>
                        </main>
                    </div>
                    <?php get_sidebar();?>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <?php if (1 == seek_get_option('show_selected_page_content_on_homepage')) { ?>
                <div class="twp-home-static-page" id="content-container">
                    <div class="container clearfix">
                        <div id="primary" class="content-area">
                            <?php
                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content', 'page');

                            endwhile;
                            ?>
                        </div>
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php } ?>
                
    <?php } ?>

<?php get_footer();