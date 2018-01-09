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
    // if (!class_exists('Contact_detender')) {

    //     class Contact_detender
    //     {

    //         function __construct()
    //         {
    //             if (!function_exists('add_shortcode')) {
    //                 return;
    //             }
    //             add_shortcode( 'hello' , array(&$this, 'hello_func') );
    //         }
    //         function hello_func($atts = array(), $content = null){
    //             extract(shortcode_atts(array('name' => 'Word'), $atts));
    //             return '<div>
    //                 <p>Hello '.$name.'!!!</p>
    //             </div>';
    //         }
    //     }
    //     function mfpd_load(){
    //         global $mfpd;
    //         $mfpd = new Contact_detender();
    //     }
    // }
    // add_action( 'plugins_loaded', 'mfpd_load' );

    function contact_plugin_setup_menu(){
        add_menu_page( 'Contact Mrfeeder Plugin Page', 'Contact Mrfeeder Plugin', 'manage_options', 'contact-mrfeeder', 'contact_mrfeeder_init' );
    }
    function contact_mrfeeder_init(){
        echo "<h1>Hello World!</h1>";
    }
    add_action('admin_menu', 'contact_plugin_setup_menu');
?>
