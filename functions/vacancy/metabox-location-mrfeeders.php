<?php
    function vacancy_add_meta_box_location() {
        //this will add the metabox for the vacancy post type
        $screens = array( 'vacancy' );

        foreach ( $screens as $screen ) {
            add_meta_box(
                'location_id',
                __( 'Location', 'vacancy' ),
                'vacancy_meta_box_location_callback',
                $screen
            );
        }
    }
    add_action( 'add_meta_boxes', 'vacancy_add_meta_box_location' );

    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function vacancy_meta_box_location_callback( $post ) {
        wp_nonce_field( 'vacancy_save_meta_box_location_data', 'vacancy_location_meta_box_nonce' );
        $value = get_post_meta( get_the_ID('vacancy'), '_my_meta_value_location_key', true );
        echo '<label for="vacancy_new_field_location">';
        _e( 'Location', 'vacancy' );
        echo '</label> ';
        echo '<input type="text" id="vacancy_new_field_location" name="vacancy_new_field_location" value="';
            if (!isset( $value ) || $value == "") {
                echo "Ha Noi";
            }else{
                echo(esc_attr( $value ));
            }
        echo '" size="25" />';
    }

    function vacancy_save_meta_box_location_data( $post_id ) {

        if ( ! isset( $_POST['vacancy_location_meta_box_nonce'] ) ) { return; }
        if ( ! wp_verify_nonce( $_POST['vacancy_location_meta_box_nonce'], 'vacancy_save_meta_box_location_data' ) ) { return; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
        }

        if ( ! isset( $_POST['vacancy_new_field_location'] ) ) { return; }
        $my_data = sanitize_text_field( $_POST['vacancy_new_field_location'] );
        update_post_meta( $post_id, '_my_meta_value_location_key', $my_data );
    }
    add_action( 'save_post', 'vacancy_save_meta_box_location_data' );
?>
