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
                'name'                  => __( 'Vacancy', 'vacancy' ),
                'singular_name'         => __( 'Vacancy Fields', 'vacancy' ),
                'add_new'               => __( 'Add new openings' , 'vacancy' ),
                'add_new_item'          => __( 'Add New Openings' , 'vacancy' ),
                'edit_item'             => __( 'Edit Field Openings' , 'vacancy' ),
                'new_item'              => __( 'New Openings' , 'vacancy' ),
                'view_item'             => __('View Openings', 'vacancy'),
                'search_items'          => __('Search Openings', 'vacancy'),
                'not_found'             => __('No Openings found', 'vacancy'),
                'not_found_in_trash'    => __('No Openings found in Trash', 'vacancy'),
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


    function set_vacancy_columns($columns) {
        return array(
            'title'                         => __('Job Title'),
            '_my_meta_value_status_key'     => __('Status'),
            '_my_meta_value_location_key'   => __('Location'),
            'date'                          => __('Created Date'),
            '_my_meta_value_key'            => __('Expired date'),
        );
    }
    add_filter('manage_vacancy_posts_columns' , 'set_vacancy_columns');

    function add_vacancy_columns( $column ) {
        $screen = array( 'vacancy' );
        switch ( $column ) {
            case '_my_meta_value_status_key' :
                $metaDatastatus = get_post_meta( get_the_ID($screen) , '_my_meta_value_status_key' , true );
                echo $metaDatastatus;
                break;
            case '_my_meta_value_key' :
                $metaDataexpired = get_post_meta( get_the_ID($screen) , '_my_meta_value_key' , true );
                echo $metaDataexpired;
                break;
            case '_my_meta_value_location_key' :
                $metaDataexpired = get_post_meta( get_the_ID($screen) , '_my_meta_value_location_key' , true );
                echo $metaDataexpired;
                break;
        }
    }
    add_action('manage_vacancy_posts_custom_column' , 'add_vacancy_columns');

    function my_sortable_vacancy_column( $columns ) {
        $columns['_my_meta_value_location_key'] = '_my_meta_value_location_key';
        $columns['_my_meta_value_key'] = '_my_meta_value_key';
        $columns['_my_meta_value_status_key'] = '_my_meta_value_status_key';
        return $columns;
    }
    add_filter( 'manage_edit-vacancy_sortable_columns', 'my_sortable_vacancy_column' );



    //Implement custom fields without using any plugins add the metabox Expired date for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/metabox-expired-mrfeeders.php');
    //Implement custom fields without using any plugins add the metabox status for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/metabox-status-mrfeeders.php');
    //Implement custom fields without using any plugins add the metabox location for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/metabox-location-mrfeeders.php');
    //change message default to use vacancy
    include( plugin_dir_path( __FILE__ ) . '/functions/message-mrfeeder.php');
    // candidate
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/candidate.php');

?>
