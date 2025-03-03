<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin. 
 */ 
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wpbody-content">
<div class="wrap applicant_list_admin">   
 <h2><?php echo _e('All Applicant List ','app-list'); ?></h2>
 <form method="POST" id="id_form"> 
		<p class="search-box">
			<label class="screen-reader-text" for="user-search-input"><?php echo _e('Search Users:','app-list'); ?></label>
			<input type="search" id="user-search-input" name="search_name" placeholder="<?php echo _e('Search by name/email/postname','app-list'); ?>">
			<input type="submit" id="search-submit" class="button" value="<?php echo _e('Search Applicant','app-list'); ?>"></p> 
		</form>
	<table class="wp-list-table widefat fixed striped table-view-list posts applicant_list_table"> 
    <thead>
	    <tr> 
			<th width="3%"><?php echo _e('#ID', 'app-list'); ?></th>
			<th><?php echo _e('First Name', 'app-list'); ?></th>  
			<th><?php echo _e('Last Name', 'app-list'); ?></th>
			<th width="20%"><?php echo _e('Present Address', 'app-list'); ?></th> 
			<th><?php echo _e('Email Address', 'app-list'); ?></th> 
			<th><?php echo _e('Mobile No', 'app-list'); ?></th> 
			<th><?php echo _e('Post Name', 'app-list'); ?></th>  
			<th><?php echo _e('CV Download', 'app-list'); ?></th> 
			<th><?php echo _e('Date', 'app-list'); ?></th> 
			<th><?php echo _e('Action', 'app-list'); ?></th> 
		</tr>
    </thead>
   
    <tbody id="the-list"> 
	<!--custom-->
	<?php    
	$key = 1;
	if ( !empty($all_applicant_submissions_array) )
    {
		foreach($all_applicant_submissions_array as $applicant){
	?>
		<tr>   
			<td><?php echo $applicant->id; ?></td>
			<td><?php echo $applicant->first_name; ?></td>
			<td><?php echo $applicant->last_name; ?></td> 
			<td><?php echo $applicant->present_address; ?></td> 
			<td><?php echo $applicant->email_address; ?></td> 
			<td><?php echo $applicant->mobile_no; ?></td> 
			<td><?php echo $applicant->post_name; ?></td> 
			<td><a href="<?php echo $applicant->file_url; ?>" Download><?php echo _e('Download', 'app-list'); ?></a></td> 
			<td><?php echo date('Y-m-d', strtotime($applicant->created_at)); ?></td>  
			<td><a href="?page=applicant_list&delete=<?php echo $applicant->id; ?>" class="button button-delete"><?php echo _e('Delete', 'app-list'); ?></a></td> 
		</tr>
	  <?php $key++; }}else{ ?>  
        <tr>  
            <td colspan="10"><?php echo _e('No data Found..', 'app-list'); ?></td>   
        </tr> 
	  <?php } ?>
	</tbody>

    <tfoot> 
	    <tr> 
			<th width="3%"><?php echo _e('#ID', 'app-list'); ?></th>
			<th><?php echo _e('First Name', 'app-list'); ?></th>  
			<th><?php echo _e('Last Name', 'app-list'); ?></th>
			<th width="20%"><?php echo _e('Present Address', 'app-list'); ?></th> 
			<th><?php echo _e('Email Address', 'app-list'); ?></th> 
			<th><?php echo _e('Mobile No', 'app-list'); ?></th> 
			<th><?php echo _e('Post Name', 'app-list'); ?></th>  
			<th><?php echo _e('CV Download', 'app-list'); ?></th> 
			<th><?php echo _e('Date', 'app-list'); ?></th> 
			<th><?php echo _e('Action', 'app-list'); ?></th> 
		</tr>
    </tfoot>
  </table> 
  
  <?php  pagination($page,$num_page); // Pagination Function ?>
  <div class="tablenav-pages one-page">
  	<span class="displaying-num"> <?php echo $total;?>  <?php echo _e('items', 'app-list'); ?></span>
 </div> 
	
</div> <!--list_admin close--> 
</div>
  