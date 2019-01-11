<?php
    /**
     * Adds a submenu page candidate details under a custom post type parent.
     */
    function candidate_details_register_ref_page() {
        add_submenu_page(
            'edit.php?post_type=candidate',
            __( 'Candidate Details', 'candidate' ),
            __( 'Candidate Details', 'candidate' ),
            'manage_options',
            'candidate-details-shortcode-ref',
            'candidate_details_ref_page_callback'
        );
    }
    add_action('admin_menu', 'candidate_details_register_ref_page');

    /**
     * Display callback for the submenu page.
     */
    function candidate_details_ref_page_callback() {
        include( plugin_dir_path( __FILE__ ) . '/layout/header-candidate--details.php');
        include( plugin_dir_path( __FILE__ ) . '/layout/candidate--details-layout.php');
    }
?>