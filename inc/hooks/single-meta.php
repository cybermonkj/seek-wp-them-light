<?php
/**
 * Implement theme metabox.
 *
 * @package Seek
 */
if (!function_exists('seek_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function seek_add_theme_meta_box()
    {

        $screens = array('post', 'page');

        foreach ($screens as $screen) {
            add_meta_box(
                'seek-theme-settings',
                esc_html__('Single Page/Post Layout Settings', 'seek'),
                'seek_render_theme_settings_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action('add_meta_boxes', 'seek_add_theme_meta_box');


if ( ! function_exists( 'seek_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 */
	function seek_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;
		$seek_post_meta_value = get_post_meta($post_id);

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'seek_meta_box_nonce' );
		// Fetch Options list.
		$page_layout = get_post_meta($post_id,'seek-meta-select-layout',true);
	?>
	<div id="seek-settings-metabox-container" class="seek-settings-metabox-container">
		<div id="seek-settings-metabox-tab-layout">
			<h4><?php echo __( 'Layout Settings', 'seek' ); ?></h4>
			<div class="seek-row-content">
				 <!-- Checkbox Field-->
				     <p>
				     <div class="seek-row-content">
				         <label for="seek-meta-checkbox">
				             <input type="checkbox" name="seek-meta-checkbox" id="seek-meta-checkbox" value="yes" <?php if ( isset ( $seek_post_meta_value['seek-meta-checkbox'] ) ) checked( $seek_post_meta_value['seek-meta-checkbox'][0], 'yes' ); ?> />
				             <?php _e( 'Check To Enable Featured Image On Single Page', 'seek' )?>
				         </label>
				     </div>
				     </p>
			     <!-- Select Field-->
			        <p>
			            <label for="seek-meta-select-layout" class="seek-row-title">
			                <?php _e( 'Single Page/Post Layout', 'seek' )?>
			            </label>
			            <select name="seek-meta-select-layout" id="seek-meta-select-layout">
				            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
				            	<?php _e( 'Content - Primary Sidebar', 'seek' )?>
				            </option>
				            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
				            	<?php _e( 'Primary Sidebar - Content', 'seek' )?>
				            </option>
				            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
				            	<?php _e( 'No Sidebar', 'seek' )?>
				            </option>
			            </select>
			        </p>
			</div><!-- .seek-row-content -->
		</div><!-- #seek-settings-metabox-tab-layout -->
	</div><!-- #seek-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'seek_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function seek_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['seek_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['seek_meta_box_nonce'], basename( __FILE__ ) ) ) {
			  return; }

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return; }
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$seek_meta_checkbox =  isset( $_POST[ 'seek-meta-checkbox' ] ) ? esc_attr($_POST[ 'seek-meta-checkbox' ]) : '';
		update_post_meta($post_id, 'seek-meta-checkbox', sanitize_text_field($seek_meta_checkbox));

		$seek_meta_select_layout =  isset( $_POST[ 'seek-meta-select-layout' ] ) ? esc_attr($_POST[ 'seek-meta-select-layout' ]) : '';
		if(!empty($seek_meta_select_layout)){
			update_post_meta($post_id, 'seek-meta-select-layout', sanitize_text_field($seek_meta_select_layout));
		}
	}

endif;

add_action( 'save_post', 'seek_save_theme_settings_meta', 10, 3 );