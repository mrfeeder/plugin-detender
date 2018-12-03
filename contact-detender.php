<?php
    /**
    * Plugin Name:  Vacancy
    * Plugin URI:  http://google.com
    * Description: this is plugin for Vacancy
    * Version: 1.0
    * Author: Mr Mrfeeder
    * Author URI: http://facebook.com
    * License: GPLv2 or later
    */
?>
<?php
    if (!function_exists('create_vacancy_type')){

        function create_vacancy_type() {
            $labels = array(
                'name' => __( 'Vacancy', 'vacancy' ),
                'singular_name' => __( 'Vacancy Fields', 'vacancy' ),
                'add_new' => __( 'Add new openings' , 'vacancy' ),
                'add_new_item' => __( 'Add New Openings' , 'vacancy' ),
                'edit_item' =>  __( 'Edit Field Openings' , 'vacancy' ),
                'new_item' => __( 'New Openings' , 'vacancy' ),
                'view_item' => __('View Openings', 'vacancy'),
                'search_items' => __('Search Openings', 'vacancy'),
                'not_found' =>  __('No Openings found', 'vacancy'),
                'not_found_in_trash' => __('No Openings found in Trash', 'vacancy'),
            );
            register_post_type('vacancy', array(
                'labels' => $labels,
                'public'             => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'rewrite'            => array( 'slug' => 'vacancy' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'menu_position'      => 5,
                'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' )
            ));
        }
        add_action( 'init', 'create_vacancy_type', 12 );
    }

    function add_vacancy_columns($columns) {
        return array_merge($columns,
                  array('publisher' => __('Publisher'),
                        'book_author' =>__( 'Book Author')));
    }
    add_filter('manage_vacancy_posts_columns' , 'add_vacancy_columns');

    function set_vacancy_columns($columns) {
        return array(
            'title' => __('Job Title'),
            'date' => __('Created Date'),
            'publisher' => __('Status'),
        );
    }
    add_filter('manage_vacancy_posts_columns' , 'set_vacancy_columns');



    //Implement custom fields without using any plugins
    include( plugin_dir_path( __FILE__ ) . '/functions/mrfeeders.php');
    //change message default to use vacancy
    include( plugin_dir_path( __FILE__ ) . '/functions/mrfeeder.php');

?>
