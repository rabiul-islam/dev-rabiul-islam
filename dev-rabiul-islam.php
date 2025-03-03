<?php 
/*
Plugin Name: Dev Rabiul Islam
Plugin URI: https://rabiulislam.com/
Description: Welcome to the Wp Rabiul Islam plugin. This plugin is developed by Rabiul Islam. This plugin is used for testing purpose.
Version: 1.0.0
Tested up to: 5.8
Requires at least: 5.8
Author: wp-rabiul-islam
Author URI: https://rabiulislam.com/
License: GPLv2 or later
Text Domain: app-list
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once __DIR__ . '/inc/admin/applicant-list-widgets.php';
//main class
class DevRabi{
    //version
    const version = '1.0.0';
    // Constructor
    private function __construct() {
        $this->define_constants();
        //text domain
        add_action('init', array($this, 'dev_rabi_load_textdomain'));
        //register activation hook
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        //register deactivation hook
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );
        //plugin loaded action
        add_action( 'plugins_loaded', array( $this, 'applicant_init' ) );
        add_action('widgets_init', array($this, 'register_widgets'));
    }
    //text domain
    public function dev_rabi_load_textdomain(){
        load_plugin_textdomain('rabiu-islam', false, dirname(__FILE__).'/languages');
    }
    public function register_widgets() {
        register_widget('applicant_list_Widgets');
    }
    //plugin loaded action
    public function applicant_init(){
        if(is_admin()){
            //admin class
            require_once RABIUL_ISLAM_PATH . '/inc/admin/class-admin-dev-hello.php'; 
            Dev_Hello::dev_get_instance();
            
            //admin enqueue scripts
            add_action('admin_enqueue_scripts', array($this, 'dev_rabi_admin_enqueue_scripts'));
        }else{
            //frontend class
            require_once RABIUL_ISLAM_PATH . '/inc/frontend/class-dev-frontend-hello.php';

            DEV_Frontend_Hello::dev_get_instance();

            //frontend enqueue scripts
            add_action('wp_enqueue_scripts', array($this, 'dev_rabi_frontend_enqueue_scripts'));
        }
    }
    // Initialize the plugin
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
   
    //constants define
    public function define_constants() {
        define( 'RABIUL_ISLAM_VERSION', self::version );
        define( 'RABIUL_ISLAM_FILE', __FILE__ );
        define( 'RABIUL_ISLAM_PATH', __DIR__ );
        define( 'RABIUL_ISLAM_URL', plugins_url( '', RABIUL_ISLAM_FILE ) );
    }
    //admin enqueue scripts
    public function dev_rabi_admin_enqueue_scripts(){
        wp_enqueue_style('dev-rabiul-islam-admin', RABIUL_ISLAM_URL . '/assets/css/admin/admin.css', [], time(), 'all'); 
       
        wp_enqueue_script('dev-rabiul-islam-admin', RABIUL_ISLAM_URL . '/assets/js/admin/admin.js', ['jquery'], time(), true);
        
        wp_enqueue_script('dev-rabiul-islam-admin');
        wp_localize_script('dev-rabiul-islam-admin', 'applicant_list_ajax', array('custom_ajax_url' => admin_url('admin-ajax.php')));

    }
    //frontend enqueue scripts
    public function dev_rabi_frontend_enqueue_scripts(){
        wp_enqueue_style('dev-rabiul-islam-frontend', RABIUL_ISLAM_URL . '/assets/css/frontend/frontend.css', [], time(), 'all');
        wp_enqueue_script('dev-rabiul-islam-frontend', RABIUL_ISLAM_URL . '/assets/js/frontend/frontend.js', ['jquery'], time(), true);
    }
    //activation
    public function activate() {
        $installed = get_option( 'rabiul_islam_installed' );

        if ( ! $installed ) {
            update_option( 'rabiul_islam_installed', time() );
        }
        update_option( 'rabiul_islam_version', RABIUL_ISLAM_VERSION );

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );        
        //applicant_submissions table create
        $table_applicant_submissions = $wpdb->prefix . 'applicant_submissions';
        $submissions_sql = "CREATE TABLE $table_applicant_submissions (
          `id` bigint(20) AUTO_INCREMENT NOT NULL,
          `first_name` varchar(63) COLLATE utf8mb4_unicode_520_ci NOT NULL,
          `last_name` varchar(63) COLLATE utf8mb4_unicode_520_ci NOT NULL, 
          `present_address` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,       
          `email_address` varchar(63) COLLATE utf8mb4_unicode_520_ci NOT NULL, 
          `mobile_no` int(3) NOT NULL, 
          `post_name` varchar(63) COLLATE utf8mb4_unicode_520_ci NOT NULL, 
          `file_url` varchar(10000) COLLATE utf8mb4_unicode_520_ci NOT NULL,         
          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
           PRIMARY KEY  (id)
        );";
      dbDelta( $submissions_sql);
    }
    //deactivation
    public function deactivate() {
        delete_option( 'rabiul_islam_installed' );
        global $wpdb;
        $table_name = $wpdb->prefix . 'applicant_submissions';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql); 
    }
}

//initialize the plugin
DevRabi::init();