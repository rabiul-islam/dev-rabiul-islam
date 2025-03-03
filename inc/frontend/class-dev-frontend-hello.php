<?php 
// Exit if accessed directly    
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//dev frontend class
final class DEV_Frontend_Hello{
    
    //instance
    public static $_instance;
    //file
    public $file = __FILE__;

    // Constructor
    public function __construct() { 
        add_shortcode( 'applicant_form', array($this,'dev_rabi_custom_user_registration_form')); 
    } 
    public static function dev_get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DEV_Frontend_Hello();
        }
        return self::$_instance;
    }
    public function dev_rabi_custom_user_registration_form( $atts ) {
        ob_start();
        require_once plugin_dir_path(  __FILE__  ) . 'crud-frondend-functions.php';
        require_once plugin_dir_path(  __FILE__  ) . 'html-dev-frontend.php';
       
        return ob_get_clean();
    }

}
