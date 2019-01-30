<?php
    if (!function_exists('create_candidate_type')){
        function create_candidate_type() {
            $labels = array(
                'name'                  => __( 'Candidates', 'candidate' ),
                'singular_name'         => __( 'Candidate Fields', 'candidate' ),
                'add_new'               => __( 'Add New Candidate' , 'candidate' ),
                'add_new_item'          => __( 'Add New Candidate' , 'candidate' ),
                'edit_item'             => __( 'Edit Field Candidate' , 'candidate' ),
                'new_item'              => __( 'New Candidate' , 'candidate' ),
                'view_item'             => __('View Candidate', 'candidate'),
                'search_items'          => __('Search Candidate', 'candidate'),
                'not_found'             => __('No Candidate found', 'candidate'),
                'not_found_in_trash'    => __('No Candidate found in Trash', 'candidate'),
            );
            register_post_type('candidate', array(
                'labels'             => $labels,
                'public'             => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'rewrite'            => array( 'slug' => 'candidate' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'menu_position'      => 5,
                'supports'           => array( 'title', 'thumbnail', 'comments' )
            ));
        }
        add_action( 'init', 'create_candidate_type', 12 );
    }
    function send_smtp_email( $phpmailer ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = SMTP_HOST;
        $phpmailer->SMTPAuth   = SMTP_AUTH;
        $phpmailer->Port       = SMTP_PORT;
        $phpmailer->SMTPSecure = SMTP_SECURE;
        $phpmailer->Username   = SMTP_USERNAME;
        $phpmailer->Password   = SMTP_PASSWORD;
        $phpmailer->From       = SMTP_FROM;
        $phpmailer->FromName   = SMTP_FROMNAME;
    }

    add_action( 'phpmailer_init', 'send_smtp_email' );
?>