/***********************Ajax search script*************************************/
jQuery(document).on("keyup",".search_input_field",function(){
var search_field = jQuery(this).val();
var base_url = window.location.origin;
if(search_field == ""){
jQuery(".data_search_show").html("");
jQuery('.data_search_show').hide();
jQuery('body').removeClass("search_box_active");
}
else if(search_field.length<2){
jQuery(".data_search_show").html("");	
}
else{
 jQuery.ajax({
	url:base_url+"/wp-admin/admin-ajax.php",
    type: "post",
    data:{
	action:'get_data_search',
	search_field:search_field   
    },
    success: function(msg){	   
	jQuery('.data_search_show').html(msg);
	jQuery('.data_search_show').show();
	jQuery('body').addClass("search_box_active");
    }

});	 
}
});

/*************************End code for Ajax search script******************************/


/*******************Focus code input search*************************/
/* jQuery(document).click(function() {
   jQuery(".data_search_show").hide(); //click came from somewhere else 
});

jQuery(document).on("click",'.data_search_show,.search_input_field',function(e) { 
   e.stopPropagation();
});  
   */
  
  
 /************************Search btn script code*****************************/
 var site_url_get = window.location.hostname;
 jQuery(document).on("click",".search_script",function(){
  var search_val_get = jQuery('.search_input_field').val();
  if(search_val_get == ""){
	  
  }
  else{
  window.location.href = '/?s='+search_val_get;  
  }
  

 });
 
