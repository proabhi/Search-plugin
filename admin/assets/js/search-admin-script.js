jQuery(document).on("click",".option_lists li",function(){
jQuery(".option_lists li").removeClass("active_option");
jQuery(this).addClass("active_option");	
var get_tab_txt = jQuery(this).text();
if(get_tab_txt == "General Tab"){
jQuery(".option_general_tab").show();
jQuery(".option_style_tab").hide();	
}
else{
jQuery(".option_general_tab").hide();
jQuery(".option_style_tab").show();		
}
});