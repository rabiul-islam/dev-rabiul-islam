 
<div class="rPlug-in-registration-section">
<!-- This file should primarily consist of HTML with a little bit of PHP. -->  
 
<div class="rPlug-in-registration-wrapper">  
	<div class="rPlug_in_registration_form">
		<?php
			if(isset($_POST['registration_submit_btn'])){ 
				if(isset($msg)){ 
					echo '<div class="message">'.$msg.'</div>';
				}
			} 
		 ?>  
		<form method="post" id="store_closed_form_id" autocomplete="on" enctype="multipart/form-data"  >
			<table> 
			  <tr>
			    <td></td>
			    <td><h1>Registration form</h1></td> 
			  </tr>
			  <tr>
			    <td> <label for="first_name">First Name</label></td>
			    <td> <input type="text" id="first_name" name="first_name" placeholder="First Name Here" required></td> 
			  </tr>
			  <tr>
			    <td> <label for="last_name">Last Name</label></td> 
			    <td> <input type="text" id="last_name" name="last_name"placeholder="Last Name Here" required></td> 
			  </tr>
			  <tr>
			    <td> <label for="present_address">Present Address</label></td>
			    <td> <textarea row="4" cols="4" id="present_address" name="present_address" placeholder="Present Address" required></textarea></td>
			  </tr>
			  <tr>
			    <td> <label for="email_address">Email Address</label></td> 
			    <td> <input type="email" id="email_address" name="email_address" placeholder="Enter Email Address Here" required></td> 
			  </tr>
			  <tr>
			    <td> <label for="mobile_no">Mobile No</label></td> 
			    <td> <input type="text" id="mobile_no" name="mobile_no"placeholder="Enter Mobile Number Here" required></td> 
			  </tr> 
			  <tr>
			    <td> <label for="post_name">Post Name</label></td>
			    <td> <input type="text" id="post_name" name="post_name"placeholder="Post Name Here" required></td> 
			  </tr>
			  <tr>
			    <td> <label for="CV">CV </label></td>
			    <td>
			    	<input type="hidden" name="MAX_FILE_SIZE" value="500000000" /> <input name="fileToUpload" type="file" required class="files_name" id="upload" placeholder="cv" /> 
			    </td>
			  </tr> 
			  <tr>
			    <td></td> 
			    <td> <input type="submit" id="registration_submit_btn" name="registration_submit_btn" value="SUBMIT"></td>
			  </tr>
			</table>
		</form>
	</div> 
</div> 
</div>