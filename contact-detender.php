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
    get_template_directory('/functions/mrfeeders.php', true);
    get_template_directory('/functions/mrfeeder.php', true);
    function contact_plugin_setup_menu(){
        add_menu_page( 'Contact Mrfeeder Plugin Page', 'Contact Mrfeeder Plugin', 'manage_options', 'contact-mrfeeder', 'contact_mrfeeder_init' );
    }
    function contact_mrfeeder_init(){
        echo "<h1>Contact of Mrfeeder</h1>
            <button type=''>Add New</button>
            <div id='form-mrfeeder'>
                <div class='area-for-element'>
                    <ul class='nav nav-tabs'>
                      <li class='active'><a data-toggle='tab' href='#home'>constructor</a></li>
                      <li><a data-toggle='tab' href='#menu1'>element</a></li>
                      <li><a data-toggle='tab' href='#menu2'>properties</a></li>
                    </ul>

                    <div class='tab-content'>
                      <div id='home' class='tab-pane fade in active show'>
                        <div class='col-md-1'>div 1/12 column</div>
                        <div class='col-md-2'>div 2/12 columns</div>
                        <div class='col-md-3'>div 3/12 columns</div>
                        <div class='col-md-4'>div 4/12 columns</div>
                        <div class='col-md-5'>div 5/12 columns</div>
                        <div class='col-md-6'>div 6/12 columns</div>
                        <div class='col-md-7'>div 7/12 columns</div>
                        <div class='col-md-8'>div 8/12 columns</div>
                        <div class='col-md-9'>div 9/12 columns</div>
                        <div class='col-md-10'>div 10/12 columns</div>
                        <div class='col-md-11'>div 11/12 columns</div>
                        <div class='col-md-12'>div 12/12 columns</div>
                        <div>section</div>
                        <div>color section</div>
                      </div>
                      <div id='menu1' class='tab-pane fade'>
                        <div>image</div>
                        <div>slider</div>
                        <div>text</div>
                        <div>email</div>
                        <div>input</div>
                        <div>div</div>
                        <div>ul</div>
                        <div>ol</div>
                        <div>li</div>
                        <div>video</div>
                        <div>link</div>
                        <div>table</div>
                        <div>td</div>
                        <div>th</div>
                        <div>tr</div>
                        <div>textarea</div>
                      </div>
                      <div id='menu2' class='tab-pane fade'>
                        <div>class</div>
                        <div>id</div>
                        <div>style</div>
                      </div>
                    </div>
                </div>
                <div class='outside-area-drop'><div class='area-for-drop'>

                </div></div>
                <button type='submit' id='custom_editor_box'>sav</button>
            </div>
        ";
    }
    add_action('admin_menu', 'contact_plugin_setup_menu');


    // $editor_id = 'custom_editor_box';
    // $uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
    // wp_editor( $uploaded_csv, $editor_id );

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

    function mood_music( $post_id, $action = 'get', $mood = 0, $listening_to = 0 ) {
      switch ($action) {
        case 'update' :
          if( ! $mood && ! $listening_to )
            //If nothing is given to update, end here
            return false;
          if( $mood ) {
            add_post_meta( $post_id, 'mood', $mood );
            return true;
            }
          if( $listening_to ) {
            add_post_meta( $post_id, 'listening_to', $listening_to, true ) or
              update_post_meta( $post_id, 'listening_to', $listening_to );
            return true;
          }
        case 'delete' :
          delete_post_meta( $post_id, 'mood' );
          delete_post_meta( $post_id, 'listening_to' );
        break;
        case 'get' :
          $stored_moods = get_post_meta( $post_id, 'mood' );
          $stored_listening_to = get_post_meta( $post_id, 'listening_to', 'true' );
          $return = '<div class="mood-music">';
          if ( ! empty( $stored_moods ) )
            $return .= '<strong>Current Mood</strong>: ';
          foreach( $stored_moods as $mood )
            $return .= $mood . ', ';
          $return .= '<br/>';

          if ( ! empty( $stored_listening_to ) ) {
            $return .= '<strong>Currently Listening To</strong>: ';
            $return .= $stored_listening_to;
            }
          $return .= '</div>';

          return $return;
        default :
          return false;
        break;
      }
    }


    // add_action( 'admin_init', 'mrfeeder_admin_init' );

    // function mrfeeder_admin_init() {
    //     do_action( 'mrfeeder_admin_init' );
    // }

    // add_action( 'admin_menu', 'mrfeeder_admin_menu', 9 );

    // function mrfeeder_admin_menu() {
    //     global $_wp_last_object_menu;

    //     $_wp_last_object_menu++;

    //     add_menu_page( __( 'Contact Form Mrfeeder', 'contact-form-mrfeeder' ),
    //         __( 'Contact', 'contact-form-mrfeeder' ),
    //         'mrfeeder_read_contact_forms', 'mrfeeder',
    //         'mrfeeder_admin_management_page', 'dashicons-email',
    //         $_wp_last_object_menu );

    //     $edit = add_submenu_page( 'mrfeeder',
    //         __( 'Edit Contact Form', 'contact-form-mrfeeder' ),
    //         __( 'Contact Forms', 'contact-form-mrfeeder' ),
    //         'mrfeeder_read_contact_forms', 'mrfeeder',
    //         'mrfeeder_admin_management_page' );

    //     add_action( 'load-' . $edit, 'mrfeeder_load_contact_form_admin' );

    //     $addnew = add_submenu_page( 'mrfeeder',
    //         __( 'Add New Contact Form', 'contact-form-mrfeeder' ),
    //         __( 'Add New', 'contact-form-mrfeeder' ),
    //         'mrfeeder_edit_contact_forms', 'mrfeeder-new',
    //         'mrfeeder_admin_add_new_page' );

    //     add_action( 'load-' . $addnew, 'mrfeeder_load_contact_form_admin' );

    // }

    // add_filter( 'set-screen-option', 'mrfeeder_set_screen_options', 10, 3 );

    // function mrfeeder_load_contact_form_admin() {
    //     global $plugin_page;

    //     $action = mrfeeder_current_action();

    //     if ( 'save' == $action ) {
    //         $id = $_POST['post_ID'];
    //         check_admin_referer( 'mrfeeder-save-contact-form_' . $id );

    //         if ( ! current_user_can( 'mrfeeder_edit_contact_form', $id ) )
    //             wp_die( __( 'You are not allowed to edit this item.', 'contact-form-mrfeeder' ) );

    //         $id = mrfeeder_save_contact_form( $id );

    //         $query = array(
    //             'message' => ( -1 == $_POST['post_ID'] ) ? 'created' : 'saved',
    //             'post' => $id,
    //             'active-tab' => isset( $_POST['active-tab'] ) ? (int) $_POST['active-tab'] : 0 );

    //         $redirect_to = add_query_arg( $query, menu_page_url( 'mrfeeder', false ) );
    //         wp_safe_redirect( $redirect_to );
    //         exit();
    //     }

    //     if ( 'copy' == $action ) {
    //         $id = empty( $_POST['post_ID'] )
    //             ? absint( $_REQUEST['post'] )
    //             : absint( $_POST['post_ID'] );

    //         check_admin_referer( 'mrfeeder-copy-contact-form_' . $id );

    //         if ( ! current_user_can( 'mrfeeder_edit_contact_form', $id ) )
    //             wp_die( __( 'You are not allowed to edit this item.', 'contact-form-mrfeeder' ) );

    //         $query = array();

    //         if ( $contact_form = mrfeeder_contact_form( $id ) ) {
    //             $new_contact_form = $contact_form->copy();
    //             $new_contact_form->save();

    //             $query['post'] = $new_contact_form->id();
    //             $query['message'] = 'created';
    //         }

    //         $redirect_to = add_query_arg( $query, menu_page_url( 'mrfeeder', false ) );

    //         wp_safe_redirect( $redirect_to );
    //         exit();
    //     }

    //     if ( 'delete' == $action ) {
    //         if ( ! empty( $_POST['post_ID'] ) )
    //             check_admin_referer( 'mrfeeder-delete-contact-form_' . $_POST['post_ID'] );
    //         elseif ( ! is_array( $_REQUEST['post'] ) )
    //             check_admin_referer( 'mrfeeder-delete-contact-form_' . $_REQUEST['post'] );
    //         else
    //             check_admin_referer( 'bulk-posts' );

    //         $posts = empty( $_POST['post_ID'] )
    //             ? (array) $_REQUEST['post']
    //             : (array) $_POST['post_ID'];

    //         $deleted = 0;

    //         foreach ( $posts as $post ) {
    //             $post = mrfeeder_ContactForm::get_instance( $post );

    //             if ( empty( $post ) )
    //                 continue;

    //             if ( ! current_user_can( 'mrfeeder_delete_contact_form', $post->id() ) )
    //                 wp_die( __( 'You are not allowed to delete this item.', 'contact-form-mrfeeder' ) );

    //             if ( ! $post->delete() )
    //                 wp_die( __( 'Error in deleting.', 'contact-form-mrfeeder' ) );

    //             $deleted += 1;
    //         }

    //         $query = array();

    //         if ( ! empty( $deleted ) )
    //             $query['message'] = 'deleted';

    //         $redirect_to = add_query_arg( $query, menu_page_url( 'mrfeeder', false ) );

    //         wp_safe_redirect( $redirect_to );
    //         exit();
    //     }

    //     if ( 'validate' == $action && mrfeeder_validate_configuration() ) {
    //         if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
    //             check_admin_referer( 'mrfeeder-bulk-validate' );

    //             if ( ! current_user_can( 'mrfeeder_edit_contact_forms' ) ) {
    //                 wp_die( __( "You are not allowed to validate configuration.", 'contact-form-mrfeeder' ) );
    //             }

    //             $contact_forms = mrfeeder_ContactForm::find();
    //             $result = array(
    //                 'timestamp' => current_time( 'timestamp' ),
    //                 'version' => mrfeeder_VERSION,
    //                 'count_valid' => 0,
    //                 'count_invalid' => 0 );

    //             foreach ( $contact_forms as $contact_form ) {
    //                 $config_validator = new mrfeeder_ConfigValidator( $contact_form );
    //                 $config_validator->validate();

    //                 if ( $config_validator->is_valid() ) {
    //                     $result['count_valid'] += 1;
    //                 } else {
    //                     $result['count_invalid'] += 1;
    //                 }
    //             }

    //             mrfeeder::update_option( 'bulk_validate', $result );

    //             $query = array(
    //                 'message' => 'validated' );

    //             $redirect_to = add_query_arg( $query, menu_page_url( 'mrfeeder', false ) );
    //             wp_safe_redirect( $redirect_to );
    //             exit();
    //         }
    //     }

    //     $_GET['post'] = isset( $_GET['post'] ) ? $_GET['post'] : '';

    //     $post = null;

    //     if ( 'mrfeeder-new' == $plugin_page ) {
    //         $post = mrfeeder_ContactForm::get_template( array(
    //             'locale' => isset( $_GET['locale'] ) ? $_GET['locale'] : null ) );
    //     } elseif ( ! empty( $_GET['post'] ) ) {
    //         $post = mrfeeder_ContactForm::get_instance( $_GET['post'] );
    //     }

    //     $current_screen = get_current_screen();

    //     $help_tabs = new mrfeeder_Help_Tabs( $current_screen );

    //     if ( $post && current_user_can( 'mrfeeder_edit_contact_form', $post->id() ) ) {
    //         $help_tabs->set_help_tabs( 'edit' );
    //     } else {
    //         $help_tabs->set_help_tabs( 'list' );

    //         if ( ! class_exists( 'Mrfeeder_Contact_Form_List_Table' ) ) {
    //             require_once MRFEEDER_PLUGIN_DIR . '/admin/includes/class-contact-forms-list-table.php';
    //         }

    //         add_filter( 'manage_' . $current_screen->id . '_columns',
    //             array( 'mrfeeder_Contact_Form_List_Table', 'define_columns' ) );

    //         add_screen_option( 'per_page', array(
    //             'default' => 20,
    //             'option' => 'cfseven_contact_forms_per_page' ) );
    //     }
    // }
?>
