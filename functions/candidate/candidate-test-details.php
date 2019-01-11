<?php
    function candidate_add_meta_box() {
        //this will add the metabox for the vacancy post type
        $screens = array( 'candidate' );

        foreach ( $screens as $screen ) {

            add_meta_box(
                'candidate_sectionid',
                __( 'Test Details Of Candidate', 'candidate' ),
                'candidate_meta_box_callback',
                $screen
            );
        }
    }
    add_action( 'add_meta_boxes', 'candidate_add_meta_box' );

    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function candidate_meta_box_callback( $post ) {
        wp_nonce_field( 'candidate_save_meta_box_data', 'candidate_meta_box_nonce' );
        $value = get_post_meta( $post->ID, 'repoofcandidate', true );
        $noteinstruction = get_post_meta( $post->ID, 'noteinstruction', true );
        $taskname = get_post_meta( $post->ID, 'taskname', true );
        $taskurl = get_post_meta( $post->ID, 'taskurl', true );
        $hoursspent = get_post_meta( $post->ID, 'hoursspent', true );
        echo '<label for="candidate_new_field">';
        _e( 'Repo Of Candidate', 'candidate' );
        echo '</label> ';
        echo '<input type="text" id="candidate_new_field" name="candidate_new_field" value="' . esc_attr( $value ) . '" size="25" />';

        echo '<label for="candidate_noteinstruction">';
        _e( 'Note Intructions of Candidate', 'candidate' );
        echo '</label> ';
        echo '<textarea type="text" id="candidate_noteinstruction" name="candidate_noteinstruction">' . esc_attr( $noteinstruction ) . '</textarea>';

        echo '<label for="candidate_taskname">';
        _e( 'Task Name', 'candidate' );
        echo '</label> ';
        echo '<input type="text" id="candidate_taskname" name="candidate_taskname" value="' . esc_attr( $taskname ) . '" size="25" />';

        echo '<label for="candidate_taskurl">';
        _e( 'Task Url', 'candidate' );
        echo '</label> ';
        echo '<input type="text" id="candidate_taskurl" name="candidate_taskurl" value="' . esc_attr( $taskurl ) . '" size="25" />';

        echo '<label for="candidate_hoursspent">';
        _e( 'Hours spent', 'candidate' );
        echo '</label> ';
        echo '<input type="number" id="candidate_hoursspent" name="candidate_hoursspent" value="' . esc_attr( $hoursspent ) . '" size="25" />';
    }

    function candidate_save_meta_box_data( $post_id ) {

        if ( ! isset( $_POST['candidate_meta_box_nonce'] ) ) { return; }
        if ( ! wp_verify_nonce( $_POST['candidate_meta_box_nonce'], 'candidate_save_meta_box_data' ) ) { return; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
        }

        if ( ! isset( $_POST['candidate_new_field'] ) ) { return; }
        $my_data = sanitize_text_field( $_POST['candidate_new_field'] );
        update_post_meta( $post_id, 'repoofcandidate', $my_data );

        if ( ! isset( $_POST['candidate_noteinstruction'] ) ) { return; }
        $my_noteinstruction = sanitize_text_field( $_POST['candidate_noteinstruction'] );
        update_post_meta( $post_id, 'noteinstruction', $my_noteinstruction );

        if ( ! isset( $_POST['candidate_taskname'] ) ) { return; }
        $my_candidate_taskname = sanitize_text_field( $_POST['candidate_taskname'] );
        update_post_meta( $post_id, 'taskname', $my_candidate_taskname );

        if ( ! isset( $_POST['candidate_taskurl'] ) ) { return; }
        $my_candidate_taskurl = sanitize_text_field( $_POST['candidate_taskurl'] );
        update_post_meta( $post_id, 'taskurl', $my_candidate_taskurl );

        if ( ! isset( $_POST['candidate_hoursspent'] ) ) { return; }
        $my_candidate_hoursspent = sanitize_text_field( $_POST['candidate_hoursspent'] );
        update_post_meta( $post_id, 'hoursspent', $my_candidate_hoursspent );
    }
    add_action( 'save_post', 'candidate_save_meta_box_data' );
?>
