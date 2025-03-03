<?php 
 global $wpdb;  
if(isset($_GET['delete'])){   
    $table_name = $wpdb->prefix."applicant_submissions";
    $id = $_GET['delete']; 
    $wpdb->query("DELETE  FROM $table_name WHERE id= '$id'");

    $location ='?page=applicant_list';
    echo '<script type="text/javascript">window.location.href = "'.$location.'"</script>';
} 
//pagination start
$start = 0;
$limit = 5; 
$page = 0;

if (isset($_GET['p'])) {
    $page = $_GET['p'];
    $start= ($page-1) * $limit; 
}   
$table_name = $wpdb->prefix."applicant_submissions";  
$total_array = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY created_at DESC" );
$total = $wpdb->num_rows;

$all_applicant_submissions_array = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY created_at DESC LIMIT $start, $limit" ); 
$num_page = round($total / $limit); 

/* ** pagination method start ** */
function pagination($page,$num_page)
{
  $Request_globals = admin_url().'/admin.php?page=applicant_list';
  $Request_URI_part = explode('&p=', $Request_globals);
  $Request_URI = $Request_URI_part[0];

  $num_page_prv  = $page-1;
  $num_page_next  = $page+1;

  echo'<ul class="pagination_box">';
   if($page > 1){
   echo'<li><a class="prv" href="'.$Request_URI.'&p='.$num_page_prv.'">PRV </a> </li>';
 }
  if($page > 5){
    echo'<li><a href="'.$Request_URI.'&p=1"> 1</a></li>';
    echo'<li class="lastlinkDot"> <a class="lastlink "> ... </a></li>';
  }
  if ($page == 5) {
    echo'<li> <a href="'.$Request_URI.'&p=1"> 1</a></li>';
  }
  for($i=1;$i<=$num_page;$i++) {

    $strlen = strlen((string) $i);
    $num_len = '';

    if ($strlen > 1) {
      $num_len = 'num_len_2';
    }

    if($i==$page){
      echo'<li class="activelink '.$num_len.'"><a href="'.$Request_URI.'&p='.$i.'">'.$i.'</a></li>';
    }else {  
      $startpagelink = $page - 3;
      $endpagelink = $page + 3;

      if($i > $startpagelink && $i <= $endpagelink){
        echo'<li><a class="'.$num_len.'" href="'.$Request_URI.'&p='.$i.'">'.$i.'</a></li>';
      }  
    }
  }
  if($page < ($num_page - 3)){
    echo'<li class="lastlinkDot"> <a class="lastlink"> ... </a></li>';
    echo'<li><a class="lastlink" href="'.$Request_URI.'&p='.$num_page.'">'. $num_page.' </a> </li>';
  }
if($page > 1){
    echo'<li><a class="next" href="'.$Request_URI.'&p='.$num_page_next.'">NEXT </a> </li>';
}
 /*  echo'<li><a class="all" href="'.$Request_URI.'&p=ALL">ALL </a> </li>';*/

  echo'</ul>';
}

/* ** pagination method end ***/  
 