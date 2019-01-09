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
    //Initialization vacancy
    include( plugin_dir_path( __FILE__ ) . '/functions/vacancy/init-vacancy.php');
    //Initialization candidate
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/init-candidate.php');
    //Implement custom fields without using any plugins add the metabox Expired date for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/vacancy/metabox-expired-mrfeeders.php');
    //Implement custom fields without using any plugins add the metabox status for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/vacancy/metabox-status-mrfeeders.php');
    //Implement custom fields without using any plugins add the metabox location for the vacancy post type
    include( plugin_dir_path( __FILE__ ) . '/functions/vacancy/metabox-location-mrfeeders.php');
    //Change Message Default to Use Vacancy
    include( plugin_dir_path( __FILE__ ) . '/functions/vacancy/message-mrfeeder.php');
    //Candidate
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/statistical-candidate.php');
    //Change Message Default to Use Candidate
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/message-candidate-mrfeeder.php');
    //////////////warning: Required ACF Plugin
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/insert-candidate.php');
    //Candidate Details
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/candidate-details.php');
    // Add more rating to comment form default
    include( plugin_dir_path( __FILE__ ) . '/functions/custom-addmore-rating-comment.php');


    //other path ver 2
    include( plugin_dir_path( __FILE__ ) . '/functions/candidate/create-table.php');

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


    //add feature image
    function ja_theme_setup() {
        add_theme_support( 'post-thumbnails', array( 'candidate' ) );
        add_theme_support( 'html5', array( 'comment-form' ) );
    }
    add_action( 'after_setup_theme', 'ja_theme_setup' );


    function my_plugin_templates( $template ) {
        $post_types = array('candidate');
        $current_user = wp_get_current_user();
        if (user_can( $current_user, 'administrator' )) {
            if (is_singular($post_types)) {
                $template = plugin_dir_path( __FILE__ ) . 'functions/candidate/candidate--details-layout.php';
            }
            return $template;
        }
    }
    add_filter('template_include', 'my_plugin_templates');


?>
