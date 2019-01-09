<?php

    if (!function_exists('create_vacancy_type')){

        function create_vacancy_type() {
            $labels = array(
                'name'                  => __( 'Vacancy', 'vacancy' ),
                'singular_name'         => __( 'Vacancy Fields', 'vacancy' ),
                'add_new'               => __( 'Add New Vacancys' , 'vacancy' ),
                'add_new_item'          => __( 'Add New Vacancy' , 'vacancy' ),
                'edit_item'             => __( 'Edit Field Vacancy' , 'vacancy' ),
                'new_item'              => __( 'New Vacancy' , 'vacancy' ),
                'view_item'             => __('View Vacancy', 'vacancy'),
                'search_items'          => __('Search Vacancy', 'vacancy'),
                'not_found'             => __('No Vacancy found', 'vacancy'),
                'not_found_in_trash'    => __('No Vacancy found in Trash', 'vacancy'),
            );
            register_post_type('vacancy', array(
                'labels'             => $labels,
                'public'             => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'rewrite'            => array( 'slug' => 'vacancy' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'menu_position'      => 5,
                'supports'           => array( 'title', 'editor', 'thumbnail' )
            ));
        }
        add_action( 'init', 'create_vacancy_type', 12 );
    }
?>