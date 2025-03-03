<?php 
  /* first_name
    last_name
    present_address
    email_address
    mobile_no
    post_name
    file_url
    created_at
*/

global $wpdb; 
if(isset($_GET['delete'])){   
    $table_name = $wpdb->prefix."applicant_submissions";
    $id = $_GET['delete']; 
    $wpdb->query("DELETE  FROM $table_name WHERE id= '$id'");

    $location ='?page=applicant_list';
    echo '<script type="text/javascript">window.location.href = "'.$location.'"</script>';
}


 $upload_dir = wp_upload_dir();   
    //store closed submit
    if(isset($_POST['registration_submit_btn'])){ 
        global $wpdb;  
        $changeTXT = time();
        $uploaderName = strtolower($changeTXT);
        $first_name = sanitize_text_field( $_POST['first_name'] );
        $last_name  = sanitize_text_field( $_POST['last_name'] );
        $present_address  = sanitize_text_field( $_POST['present_address'] );  
        $email_address = sanitize_email( $_POST['email_address'] ); 
        $mobile_no = $_POST['mobile_no'];   
        $post_name  = sanitize_text_field( $_POST['post_name'] ); 
         
         
        $fileToUpload =  $_FILES["fileToUpload"]["name"];  
        $target_dir =  $upload_dir['path']."/";//"uploads/";
        $image_name =  $_FILES["fileToUpload"]["name"];
        $target_files = $target_dir . $uploaderName.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_files,PATHINFO_EXTENSION);
        $target_file = $target_dir . $uploaderName.'.'.$imageFileType;

        $fileToUpload = $upload_dir['url']."/".$uploaderName.'.'.$imageFileType;  

        $user_email = sanitize_email( $_POST['email_address'] );  
            
        $db = $wpdb->prefix.'applicant_submissions';
        $sql = $wpdb->prepare("INSERT INTO $db (`first_name`,`last_name`,`present_address`,`email_address`,`mobile_no`,`post_name`,`file_url`) values ('$first_name','$last_name','$present_address','$email_address','$mobile_no','$post_name','$fileToUpload')");   

            // Check if file already exists
            if (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000000) {
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                 $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
            }

            if($uploadOk == 0){
                $msg = "Sorry, your file was not uploaded.";  
            }else{
                $user_id = $wpdb->query($sql);  
                if($user_id){
                    $msg = "Thank You For Apply. Data Successfully Inserted."; 
                }else{
                    $msg = "Data Not Inserted."; 
                }

                //email
                /*$email = 'admin@gmail.com';//admin email
                $to = $email_address;
                
                $subject = "Thank You For submitting Data"; 
                $headers = "From: $email\n";                
                $message = "Thank you for subscribing to our mailing list.";
                wp_mail($to,$subject,$message,$headers);*/
                
            } 
        }  
 
 ?> 