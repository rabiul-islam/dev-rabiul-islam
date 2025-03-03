<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//dev admin class
final class DEV_Hello{
    
    //instance
    public static $_instance;
    //file
    public $file = __FILE__;

    // Constructor
    public function __construct() { 
        add_action('admin_menu', array($this, 'applicant_list_manager_menu'));  
        //search ajax add action
        add_action('wp_ajax_applicant_ajax_action', array($this, 'get_applicant_ajax_function'));
        add_action('wp_ajax_nopriv_applicant_ajax_action', array($this, 'get_applicant_ajax_function'));  
    } 
    public static function dev_get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DEV_Hello();
        }
        return self::$_instance;
    }

    public function applicant_list_manager_menu(){    
     add_menu_page('Applicant List','Applicant List','applicantList', 'applicantList', plugin_dir_url( __FILE__ ) .'/images/settings_gray.png');
     add_submenu_page('applicantList', "List", "List", 8, 'applicant_list', array($this, 'applicant_list')); 
    }  
    public function applicant_list(){ 
        require_once plugin_dir_path(  __FILE__  ) . 'crud-admin-functions.php';
        require_once(plugin_dir_path( __FILE__ ). 'html-admin-template.php');

    }
   
    //search ajax data
    public function get_applicant_ajax_function(){   
        global $wpdb;
         $search =  $_POST['searchStr'];  
         $table_name = $wpdb->prefix."applicant_submissions"; 
         $all_applicant_submissions_array = $wpdb->get_results( "SELECT * FROM $table_name where first_name LIKE '%".$search."%' OR last_name LIKE '%".$search."%' OR present_address LIKE '%".$search."%' OR email_address LIKE '%".$search."%' OR created_at LIKE '%".$search."%' ORDER BY created_at DESC" ); 
        $key =1;
        if ( !empty($all_applicant_submissions_array) )
        {
        foreach($all_applicant_submissions_array as $applicant){
            ?>
            <tr>   
                <td><?php echo $key; ?></td>
                <td><?php echo $applicant->first_name; ?></td>
                <td><?php echo $applicant->last_name; ?></td> 
                <td><?php echo $applicant->present_address; ?></td> 
                <td><?php echo $applicant->email_address; ?></td> 
                <td><?php echo $applicant->mobile_no; ?></td> 
                <td><?php echo $applicant->post_name; ?></td> 
                <td><a href="<?php echo esc_url($applicant->file_url); ?>" Download><?php echo _e('Download','app-list'); ?></a></td> 
                <td><?php echo date('Y-m-d', strtotime($applicant->created_at)); ?></td>  
                <td><a href="?page=applicant_list&delete=<?php echo $applicant->id; ?>" class="button button-delete"><?php echo _e('Delete','app-list'); ?></a></td> 
            </tr> 
            <?php
        $key++;  } 
        }else{ ?> 
            <tr>   
                <td colspan="10"><?php echo _e('No data found.....','app-list'); ?></td> 
            </tr> 
        <?php }       
    }  

}