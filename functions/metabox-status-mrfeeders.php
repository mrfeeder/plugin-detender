<?php
    function vacancy_add_meta_box_status() {
        //this will add the metabox for the vacancy post type
        $screens = array( 'vacancy' );

        foreach ( $screens as $screen ) {
            add_meta_box(
                'status_id',
                __( 'Status', 'vacancy' ),
                'vacancy_meta_box_status_callback',
                $screen
            );
        }
    }
    add_action( 'add_meta_boxes', 'vacancy_add_meta_box_status' );

    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function vacancy_meta_box_status_callback( $post ) {
        wp_nonce_field( 'vacancy_save_meta_box_status_data', 'vacancy_status_meta_box_nonce' );
        $value_saved = get_post_meta( $post->ID, '_my_meta_value_status_key', true );
        $values_status = array(
            'open' => 'Open',
            'expired' => 'Expired',
        );
        echo '<label for="vacancy_new_field_status">';
        _e( 'Status', 'vacancy' );
        echo '</label> ';
        echo '</label> ';
        echo '<select id="vacancy_new_field_status" name="vacancy_new_field_status">';
        foreach ($values_status as $key => $value) {
            $selected = $key == $value_saved ? 'selected="selected"' : '';
            echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
        }
        echo '</select>';
    }

    function vacancy_save_meta_box_status_data( $post_id ) {

        if ( ! isset( $_POST['vacancy_status_meta_box_nonce'] ) ) { return; }
        if ( ! wp_verify_nonce( $_POST['vacancy_status_meta_box_nonce'], 'vacancy_save_meta_box_status_data' ) ) { return; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
        }

        if ( ! isset( $_POST['vacancy_new_field_status'] ) ) { return; }
        $my_data = sanitize_text_field( $_POST['vacancy_new_field_status'] );
        update_post_meta( $post_id, '_my_meta_value_status_key', $my_data );
    }
    add_action( 'save_post', 'vacancy_save_meta_box_status_data' );
?>
