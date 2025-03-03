(function( $ ) {
	'use strict'; 

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:  
	 * practising this, we should strive to set a better example in our own work.
	 */
 

$("#id_form").on("submit", function(e){ 
  e.preventDefault();
  var search_str = $('#user-search-input').val();  
  $.ajax({ 
        url: applicant_list_ajax.custom_ajax_url, //did not same function wordpress susch as ajax_url
        type: "POST", 
        data:{
          action:"applicant_ajax_action",
          searchStr: search_str, 
        },
        beforeSend: function(){ 
          $("#the-list").html('<tr><td colspan="10" style="text-align:center;"><h3><strong>Loading....</strong></h3></td></tr>'); 
        }, 
        success: function(html){ 
           //console.log(html); 
          $(".pagination_box").hide();   
          $(".displaying-num").hide();   
          $("#the-list").html(html);   
        }, 
      });
  });  

})(jQuery); 