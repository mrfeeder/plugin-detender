<?php

function load_styles__plugin_scripts() {
    wp_register_style( 'bootstrap', plugins_url('/../../css/bootstrap.min.css', __FILE__ ));
    wp_register_style( 'app', plugins_url('/../../css/app.css', __FILE__ ));
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'app' );
}
add_action('admin_init', 'load_styles__plugin_scripts');



/**
 * Adds a submenu page under a custom post type parent.
 */
function candidate_register_ref_page() {
    add_submenu_page(
        'edit.php?post_type=vacancy',
        __( 'Candidates', 'vacancy' ),
        __( 'Candidates', 'vacancy' ),
        'manage_options',
        'candidate-shortcode-ref',
        'candidate_ref_page_callback'
    );
}
add_action('admin_menu', 'candidate_register_ref_page');
/**
 * Display callback for the submenu page.
 */
function candidate_ref_page_callback() {
    ?>
    <?php
        // candidate
    include( plugin_dir_path( __FILE__ ) . '/candidate-layout.php');
}
?>