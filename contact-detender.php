<?php
    /**
    * Plugin Name:  Contact Mrfeeder
    * Plugin URI:  http://google.com
    * Description: this is plugin for increase contact
    * Version: 1.0
    * Author: Mr Mrfeeder
    * Author URI: http://facebook.com
    * License: GPLv2 or later
    */
?>
<?php

    include( plugin_dir_path( __FILE__ ) . '/functions/mrfeeders.php');
    include( plugin_dir_path( __FILE__ ) . '/functions/mrfeeder.php');

    function contact_plugin_setup_menu(){
        add_menu_page( 'Contact Mrfeeder Plugin Page', 'Contact Mrfeeder Plugin', 'manage_options', 'contact-mrfeeder', 'contact_mrfeeder_init' );
    }


    function save_wp_editor_fields(){
        global $post;
        update_post_meta($post->ID, 'custom_editor_box', $_POST['custom_editor_box']);
    }
    add_action( 'save_post', 'save_wp_editor_fields' );




    function my_theme_scripts() {
        wp_enqueue_script( 'jquery-ui', plugin_dir_url( __FILE__ ) . '/js/jquery-ui.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js', array( 'jquery-ui' ), '1.0.0', true );
        wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . '/js/bootstrap.min.js', array( 'tether' ), '1.0.0', true );
        wp_enqueue_script( 'main-script', plugin_dir_url( __FILE__ ) . '/js/main-script.js', array( 'bootstrap' ), '1.0.0', true );
        wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', '1.0.0', true );
        wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', '1.0.0', true );
        wp_enqueue_style( 'app', plugin_dir_url( __FILE__ ) . 'css/app.css', '1.0.0', true );
    }
    add_action( 'admin_enqueue_scripts', 'my_theme_scripts' );

    // function mood_music( $post_id, $action = 'get', $mood = 0, $listening_to = 0 ) {
    //   switch ($action) {
    //     case 'update' :
    //       if( ! $mood && ! $listening_to )
    //         //If nothing is given to update, end here
    //         return false;
    //       if( $mood ) {
    //         add_post_meta( $post_id, 'mood', $mood );
    //         return true;
    //         }
    //       if( $listening_to ) {
    //         add_post_meta( $post_id, 'listening_to', $listening_to, true ) or
    //           update_post_meta( $post_id, 'listening_to', $listening_to );
    //         return true;
    //       }
    //     case 'delete' :
    //       delete_post_meta( $post_id, 'mood' );
    //       delete_post_meta( $post_id, 'listening_to' );
    //     break;
    //     case 'get' :
    //       $stored_moods = get_post_meta( $post_id, 'mood' );
    //       $stored_listening_to = get_post_meta( $post_id, 'listening_to', 'true' );
    //       $return = '<div class="mood-music">';
    //       if ( ! empty( $stored_moods ) )
    //         $return .= '<strong>Current Mood</strong>: ';
    //       foreach( $stored_moods as $mood )
    //         $return .= $mood . ', ';
    //       $return .= '<br/>';

    //       if ( ! empty( $stored_listening_to ) ) {
    //         $return .= '<strong>Currently Listening To</strong>: ';
    //         $return .= $stored_listening_to;
    //         }
    //       $return .= '</div>';

    //       return $return;
    //     default :
    //       return false;
    //     break;
    //   }
    // }

?>
