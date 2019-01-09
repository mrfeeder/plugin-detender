<?php
    function vacancy_add_meta_box() {
        //this will add the metabox for the vacancy post type
        $screens = array( 'vacancy' );

        foreach ( $screens as $screen ) {

            add_meta_box(
                'vacancy_sectionid',
                __( 'Expired date', 'vacancy' ),
                'vacancy_meta_box_callback',
                $screen
            );
        }
    }
    add_action( 'add_meta_boxes', 'vacancy_add_meta_box' );

    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function vacancy_meta_box_callback( $post ) {
        wp_nonce_field( 'vacancy_save_meta_box_data', 'vacancy_meta_box_nonce' );
        $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
        echo '<label for="vacancy_new_field">';
        _e( 'Expired date', 'vacancy' );
        echo '</label> ';
        echo '<input type="text" id="vacancy_new_field" name="vacancy_new_field" value="' . esc_attr( $value ) . '" size="25" />';
    }

    function vacancy_save_meta_box_data( $post_id ) {

        if ( ! isset( $_POST['vacancy_meta_box_nonce'] ) ) { return; }
        if ( ! wp_verify_nonce( $_POST['vacancy_meta_box_nonce'], 'vacancy_save_meta_box_data' ) ) { return; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
        }

        if ( ! isset( $_POST['vacancy_new_field'] ) ) { return; }
        $my_data = sanitize_text_field( $_POST['vacancy_new_field'] );
        update_post_meta( $post_id, '_my_meta_value_key', $my_data );
    }
    add_action( 'save_post', 'vacancy_save_meta_box_data' );
?>