<?php
/**
 * Creates widget with Ads Widgets
 */
class applicant_list_Widgets extends WP_Widget
{
    function __construct() 
    {
        $widget_opt = array(
            'classname'     => 'applicant_list_widget',
            'description'   => 'Applicant List Widgets'
        ); 
        parent::__construct('applicant_list_widget', esc_html__('Applicant List', 'app-list'), $widget_opt);
    }

    function widget( $args, $instance ){  
        $title = (isset($instance['title'])) ? $instance['title'] : ''; 
        echo wp_kses_post($args['before_widget']);
        if($title != ''): ?>
            <h2 class="widget-title"><?php echo wp_kses_post($title); ?></h2>
        <?php endif;
        ?>
        <div class="applicant-lists-lists custom_widgets"> 
            <table class="wp-list-table widefat fixed striped table-view-list posts table-responsive"> 
            <thead>
                <tr> 
                    <th><?php echo _e('Date', 'app-list'); ?></th> 
                    <th><?php echo _e('Name', 'app-list'); ?></th>  
                    <th><?php echo _e('Email', 'app-list'); ?></th>  
                    <th><?php echo _e('Post', 'app-list'); ?></th>  
                    <th><?php echo _e('Download', 'app-list'); ?></th>   
                </tr>
            </thead>
            <?php 
            global $wpdb;
            $table_name = $wpdb->prefix."applicant_submissions"; 
            $all_applicant_submissions_array = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY created_at DESC Limit 4" );   
                $key = 1;
                if ( !empty($all_applicant_submissions_array) )
                {
                foreach($all_applicant_submissions_array as $applicant){ 
                ?>
                <tr>  
                    <td><?php echo date('Y-m-d', strtotime($applicant->created_at)); ?></td>  
                    <td><?php echo $applicant->first_name.$applicant->last_name; ?></td>  
                    <td><?php echo $applicant->email_address; ?></td>  
                    <td><?php echo $applicant->post_name; ?></td> 
                    <td><a href="<?php echo $applicant->file_url; ?>" Download><?php echo _e('Download', 'app-list'); ?></a></td>  
                </tr>
                <?php $key++; } }else{ ?>
                    <tr>  
                    <td colspan="6"><?php echo _e('No data Found..', 'app-list'); ?></td>   
                </tr>
                <?php
                }  ?>   
        </table> 
        </div> 
        <?php
        echo $args['after_widget'];?>
        <?php
    }
    
    function update ( $new_instance, $old_instance) {
        return $new_instance;
    }    
    function form($instance){ 
        $title = (isset($instance['title'])) ? $instance['title'] : esc_html__( 'Applicant List', 'app-list' );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'app-list' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
    <?php
    }
}
new applicant_list_Widgets;