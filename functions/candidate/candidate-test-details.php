<?php
    function candidate_fields() {
        $candidates_fields = array (
            array (
                'key' => 'field_5c22fd113e5b8',
                'label' => 'Name Candidate',
                'name' => 'candidate_name',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Candidate Name',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c22fd3d3e5b9',
                'label' => 'Location Candidate',
                'name' => 'location',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Location',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c22fd6d3e5ba',
                'label' => 'Experience Candidate',
                'name' => 'experience',
                'type' => 'number',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Experience',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_5c22fd823e5bb',
                'label' => 'Desired Salary Of Candidate',
                'name' => 'desired_salary',
                'type' => 'number',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Desired Salary',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_5c23ad823e5bb',
                'label' => 'Applied Position Of Candidate',
                'name' => 'applied_position',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Applied Position',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c22fdbc3e5bc',
                'label' => 'Stage',
                'name' => 'stage',
                'type' => 'select',
                'choices' => array (
                    'Screening' => 'Screening',
                    'Phone Interview' => 'Phone Interview',
                    'In-office Interview' => 'In-office Interview',
                    'Make an offer' => 'Make an offer',
                ),
                'default_value' => 'Screening',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_5c22fdcb3e5bd',
                'label' => 'Phone of Candidate',
                'name' => 'tel',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Tel',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c22fde53e5be',
                'label' => 'Email Candidate',
                'name' => 'email',
                'type' => 'email',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Email',
                'prepend' => '',
                'append' => '',
            ),
            array (
                'key' => 'field_5c22fdf43e5bf',
                'label' => 'Facebook link Candidate',
                'name' => 'social_link',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Social Link',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c24sqf43e5bf',
                'label' => 'Linkendin link Candidate',
                'name' => 'social_link_linkendin',
                'type' => 'text',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Social Link Linkendin',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5c22fe1a3e5c0',
                'label' => 'CV pdf',
                'name' => 'cv',
                'type' => 'file',
                'required' => 0,
                'save_format' => 'object',
                'library' => 'all',
            ),
            array (
                'key' => 'field_5c22fe513e5c1',
                'label' => 'total Rating Candidate',
                'name' => 'rating',
                'type' => 'number',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Rating',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_5c22fe613e5c2',
                'label' => 'Comment',
                'name' => 'commentbyauthor',
                'type' => 'textarea',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Comment by author',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
        );
        return $candidates_fields;
    }
    function candidate_add_meta_box() {
        //this will add the metabox for the vacancy post type
        $screens = array( 'candidate' );

        foreach ( $screens as $screen ) {

            add_meta_box(
                'candidate_sectionid',
                __( 'Candidate', 'candidate' ),
                'candidate_meta_box_callback',
                $screen
            );
        }
    }
    add_action( 'add_meta_boxes', 'candidate_add_meta_box', 0 );

    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function candidate_meta_box_callback( $post ) {
        wp_nonce_field( 'candidate_save_meta_box_data', 'candidate_meta_box_nonce' );
        $candidate_name = get_post_meta( $post->ID, 'candidate_name', true );
        $location = get_post_meta( $post->ID, 'location', true );
        $candidate_fields = candidate_fields();
        echo '<div class="candidate-area">';
            foreach ($candidate_fields as $key => $value) {
                $fieldset = get_post_meta( $post->ID, $value["name"], true );
                if ($value["type"] == 'text') {
                    echo '<div class="col-sm-12 '. $value["name"] .'">';
                    echo '<label for="'. $value["name"] .'">';
                    _e( $value["label"], 'candidate' );
                    echo '</label> ';
                    echo '<input type="'. $value["type"] .'" id="'. $value["name"] .'" name="'. $value["name"] .'" value="' . esc_attr( $fieldset ) . '" size="25" placeholder="'. $value["label"] .'" />';
                    echo "</div>";
                }elseif($value["type"] == 'number'){
                    echo '<div class="col-sm-12 '. $value["name"] .'">';
                    echo '<label for="'. $value["name"] .'">';
                    _e( $value["label"], 'candidate' );
                    echo '</label> ';
                    echo '<input type="'. $value["type"] .'" id="'. $value["name"] .'" name="'. $value["name"] .'" value="' . esc_attr( $fieldset ) . '" size="25" placeholder="'. $value["label"] .'" min="'. $value["min"] .'" max="'. $value["max"] .'"/>';
                    echo "</div>";
                }elseif($value["type"] == 'textarea'){
                    echo '<div class="col-sm-12 '. $value["name"] .'">';
                    echo '<label for="'. $value["name"] .'">';
                    _e( $value["label"], 'candidate' );
                    echo '</label> ';
                    echo '<textarea type="'. $value["type"] .'" id="'. $value["name"] .'" name="'. $value["name"] .'" value="' . esc_attr( $fieldset ) . '" size="25" placeholder="'. $value["label"] .'">' . esc_attr( $fieldset ) . '</textarea>';
                    echo "</div>";
                }elseif($value["type"] == 'file'){
                    echo '<div class="col-sm-12 '. $value["name"] .'">';
                    echo '<label for="'. $value["name"] .'">';
                    _e( $value["label"], 'candidate' );
                    echo '</label> ';
                    echo '<input type="'. $value["type"] .'" id="wp_custom_attachment" name="'. $value["name"] .'" value="' . esc_attr( $fieldset ) . '" size="25" placeholder="'. $value["label"] .'"/>';
                    echo "</div>";
                }
            }
        echo "</div>";
    }

    function candidate_save_meta_box_data( $post_id ) {
        $candidate_fields = candidate_fields();
        if ( ! isset( $_POST['candidate_meta_box_nonce'] ) ) { return; }
        if ( ! wp_verify_nonce( $_POST['candidate_meta_box_nonce'], 'candidate_save_meta_box_data' ) ) { return; }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) { return; }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }
        }
        foreach ($candidate_fields as $key => $value) {
            if ($value["type"] == 'file') {
                if ( ! empty( $_FILES[$value["name"]] ) ) {
                    var_dump($_FILES[$value["name"]]);die();
                    $supported_types = array( 'application/pdf' );
                    $arr_file_type = wp_check_filetype( basename( $_FILES[$value["name"]] ) );
                    $uploaded_type = $arr_file_type['type'];

                    if ( in_array( $uploaded_type, $supported_types ) ) {
                        $upload = wp_upload_bits($_FILES[$value["name"]], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
                        if ( isset( $upload['error'] ) && $upload['error'] != 0 ) {
                            wp_die( 'There was an error uploading your file. The error is: ' . $upload['error'] );
                        } else {
                            add_post_meta( $id, 'wp_custom_attachment', $upload );
                            update_post_meta( $id, 'wp_custom_attachment', $upload );
                        }
                    }
                    else {
                        wp_die( "The file type that you've uploaded is not a PDF." );
                    }
                }
            }else {
                if ( ! isset( $_POST[$value["name"]] ) ) { return; }
                $my_data = sanitize_text_field( $_POST[$value["name"]] );
                update_post_meta( $post_id, $value["name"] , $my_data );
            }
        }

    }
    add_action( 'save_post', 'candidate_save_meta_box_data' );
?>
