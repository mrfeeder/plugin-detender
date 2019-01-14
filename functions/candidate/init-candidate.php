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
?>