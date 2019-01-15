<?php
    function load_styles__plugin_scripts() {
        wp_register_style( 'bootstrap', plugins_url('/../../css/bootstrap.min.css', __FILE__ ));
        wp_register_style( 'app', plugins_url('/../../css/app.css', __FILE__ ));
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-1.12.4.min.js');
        wp_register_script( 'jqueryui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
        wp_register_script( 'tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js');
        wp_register_script( 'bootstrapjs', plugins_url('/../../js/bootstrap.min.js', __FILE__ ));
        wp_register_script( 'sortElemenets', plugins_url('/../../js/sortElemenets.js', __FILE__ ));
        wp_register_script( 'mainjs', plugins_url('/../../js/main-script.js', __FILE__ ));
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'app' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jqueryui' );
        wp_enqueue_script( 'tether' );
        wp_enqueue_script( 'bootstrapjs' );
        wp_enqueue_script( 'sortElemenets' );
        wp_enqueue_script( 'mainjs' );
    }
    add_action('admin_init', 'load_styles__plugin_scripts');

    /**
     * Adds a submenu page under a custom post type parent.
     */
    function candidate_register_ref_page() {
        add_submenu_page(
            'edit.php?post_type=candidate',
            __( 'Candidates Statistical', 'candidate' ),
            __( 'Candidates Statistical', 'candidate' ),
            'manage_options',
            'candidate-statistical-ref',
            'candidate_ref_page_callback'
        );
    }
    add_action('admin_menu', 'candidate_register_ref_page');

    /**
     * Display callback for the submenu page.
     */
    function candidate_ref_page_callback() {
        include( plugin_dir_path( __FILE__ ) . '/layout/candidate-layout.php');
    }
?>