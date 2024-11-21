<?php
/*
Plugin Name:Search product
Description:Custom search plugin
*/

/*****************This function to add menu to wordpress admin dashboard***************************/
add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Search woo Product', 'Search woo Product', 'manage_options', 'search_product', 'create_search_plugin', 'dashicons-welcome-widgets-menus', 10 );
}
/*****************End code for This function to add menu to wordpress dashboard***************************/


/****************************Enqueue plugin style/script for admin user role*****************************/
add_action( 'admin_enqueue_scripts', 'add_search_admin_style' );
function add_search_admin_style() {
	wp_enqueue_script( 'jquery' ); //Enqueue jquery for admin
	wp_enqueue_style( 'wp-color-picker' );//Enqueue style of wp color picker in admin
    wp_enqueue_style( 'search-admin-style', plugins_url('admin/assets/css/search-admin-style.css', __FILE__) );//link for admin css
	wp_enqueue_script( 'search-admin-scripts', plugins_url('admin/assets/js/search-admin-script.js', __FILE__) );//link for admin js
	wp_enqueue_script( 'color-picker-script', plugins_url('admin/assets/js/input-picker.js', __FILE__) );//link for admin wp picker js
}	
/****************************End code for Enqueue plugin style/script for admin*****************************/


/**************This function is used to show infomation on the plugin page*******************/
function create_search_plugin(){
$message_show="";//Take empty variable to show success message on it after submit 
if(isset($_POST['submit_btn'])){
$cat_listing= $_POST['cat_listing'];//Cat listing option value	
$product_count= $_POST['product_count'];//Cat product count
$product_option= $_POST['product_option'];//Product title option
$category_option= $_POST['category_option'];//Product category title
$pro_imgg= $_POST['pro_imgg'];//Product image
$product_price= $_POST['product_price'];//Product price
$category_list_head= $_POST['category_list_head'];//Category Heading title color 
$pro_title_color= $_POST['pro_title_color'];//Product title color
$pro_cat_color= $_POST['pro_cat_color'];//Product cat color
$pro_price_color= $_POST['pro_price_color'];//Product price color  
$cat_listing = ($cat_listing == "catlisting")? "yes" : "no";//Condition on category title listing value 
$product_count = ($product_count == "product_count")? "yes" : "no";//Condition on category count
$product_option = ($product_option == "productoption")? "yes" : "no";//Condition on product title
$category_option = ($category_option == "catoption")? "yes" : "no";//Condition on product category title
$pro_imgg = ($pro_imgg == "productimg")? "yes" : "no";//Condition on product image
$product_price = ($product_price == "productprice")? "yes" : "no";//Condition on product price
update_option('category_listing', $cat_listing );//Save category title value
update_option('product_count_option', $product_count );//Save product count value
update_option('product_title', $product_option );	//Save product title value
update_option('category_title', $category_option );//Save product category title value
update_option('product_imagee', $pro_imgg );//Save product image
update_option('product_price_option', $product_price );//Save product price
update_option('cat_heading_color', $category_list_head );//Save cat heading value
update_option('product_heading_color', $pro_title_color );//Save product heading color value
update_option('product_cat_color', $pro_cat_color );//Save product heading color value
update_option('product_price_color', $pro_price_color );//Save product price color value
$message_show="<span class='success_message'>Setting is saved</span>";//This variable is used for the success message
}

//Get values from the database
$get_cat_listing = get_option('category_listing',true);//Get the category titles option value
$product_count_option = get_option('product_count_option',true);//Get the category count option value
$product_title_get = get_option('product_title',true);//Get the product titles option value
$category_title_get = get_option('category_title',true);//Get the product category titles option value
$product_imagee = get_option('product_imagee',true);//Get the product image option value
$product_price_get = get_option('product_price_option',true);//Get the prouduct price option value
$cat_heading_color = get_option('cat_heading_color',true);//Get category heading title color option value
$product_title_color = get_option('product_heading_color',true);//Get product title color option value
$product_cat_color = get_option('product_cat_color',true);//Get category heading title color option value
$product_price_color = get_option('product_price_color',true);//Get product price color option value
?>
<div class="search_option_plugin">
<ul class="option_lists">
<li class="active_option">General Tab</li>
<li>Style Tab</li>
</ul>
<form method="post">
<div class="inner_options_sec option_common">
<div class="option_general_tab">
	<div class="tab-inner-data">
		<div class="option-select cat-option">
			<div class="option-head"><h3>Category options</h3></div>
			<div class="option-cont">
				<input type="checkbox" name="cat_listing" value="catlisting" <?php if($get_cat_listing == "yes"){ ?> checked="checked"<?php }?>><label>Category listing</label><br>
				<input type="checkbox" name="product_count" value="product_count" <?php if($product_count_option == "yes"){ ?> checked="checked"<?php }?>><label>Category count</label>
			</div>
		</div>
	    <div class="option-select pro-option">
			<div class="option-head"><h3>Products options</h3></div>
			<div class="option-cont">
				<input type="checkbox" name="product_option" value="productoption" <?php if($product_title_get == "yes"){ ?> checked="checked"<?php }?>><label>Product Title</label><br>
				<input type="checkbox" name="category_option" value="catoption" <?php if($category_title_get == "yes"){ ?> checked="checked"<?php }?>><label>Product Category</label><br>
				<input type="checkbox" name="pro_imgg" value="productimg" <?php if($product_imagee == "yes"){ ?> checked="checked" <?php } ?>><label>Product image</label><br>
				<input type="checkbox" name="product_price" value="productprice" <?php if($product_price_get == "yes"){ ?>checked="checked"<?php }?>><label>Product price</label><br>
			</div>
		</div>
		
		<?php echo $message_show;?></span>
	</div>  
</div>
<div class="option_style_tab">
	<div class="tab-inner-data">
		<div class="category_style_sec search-ad-style">
			<h3>Category listing style</h3>
			<label>Category listing title</label>
			<input type="text" name="category_list_head" value="<?php echo $cat_heading_color;?>" class="style_picker_color">
		</div>
		<div class="product_style_options search-ad-style">
			<h3>Product area style</h3>
			<label>Product title</label>
			<input type="text" name="pro_title_color" value="<?php echo $product_title_color;?>" class="style_picker_color"><br><br>
			<label>Product category heading</label>
			<input type="text" name="pro_cat_color" value="<?php echo $product_cat_color;?>" class="style_picker_color"><br><br>
			<label>Product price</label>
			<input type="text" name="pro_price_color" value="<?php echo $product_price_color;?>" class="style_picker_color">
		</div>
	</div>
</div>
</div>
<input type="submit" name="submit_btn">
</form>
</div>
<?php	
}
/**************End code for This function is used to show infomation on the plugin page*******************/

/********************This function create a shortcode for frontend we can use anywhere this shortcode to get search form**********************/
function add_search_form(){
ob_start();	

if(isset($_POST['search_product_input']))
{
   $search_txt_get = $_POST['search_product_input'];
   if($search_txt_get){
   wp_redirect(site_url()."?s=$search_txt_get");
   exit();  
   }
 
}
?>
<form name="submit_searchh" method="post" class="search_form_post">
<input type="text" name="search_product_input" class="search_input_field" placeholder="Search" autocomplete="off">
<button type="button" class="search_icon_btn search_script"><img class="sear-icon-imgg" src="<?php echo site_url();?>/wp-content/uploads/2024/10/s1.png"></button>
</form>
<div class="data_search_show">

</div>
<?php
return $content = ob_get_clean();
} 
add_shortcode("search_product_form","add_search_form");
/**********************End code for This function create a shortcode for frontend we can use anywhere********************/
/***********************Code for ajax search start*******************************/
function search_ajax_data_get(){
 global $wpdb;	
$product_counts= get_option('product_count_option',true);//Count option form backend
$cat_color_list = get_option('cat_heading_color',true);
if($cat_color_list){
$cat_color_list = "$cat_color_list";	
}
/******************Product title color*********************/
$product_title_color = get_option('product_heading_color',true);
if($product_title_color){
$product_title_color =$product_title_color; 	
}
/******************End code for Product title color*********************/
/*****************Product category title color**************************/
$product_cat_color = get_option('product_cat_color',true);
if($product_cat_color){
$product_cat_color = $product_cat_color;	
}
/*****************End code for Product category title color**************************/

/**********************Product price color code**************************/ 
$product_price_color = get_option('product_price_color',true);
if($product_price_color){
$product_price_color=$product_price_color;	
}
/**********************End code for Product price color code**************************/
?>
<style>
/*************Internal style for Category title,product title,product category title,product price color***************/
<?php
if($cat_color_list){ ?>
.category_list_search ul li a{
color:<?php echo $cat_color_list;?>;	
}
<?php } ?>
<?php if($product_title_color) { ?>	
.products-grid .prod-name a{
color:<?php echo $product_title_color;?>	
}
<?php } ?>

<?php if($product_cat_color) { ?>
.products-grid .product-content span.pro-cat{
color:<?php echo $product_cat_color;?>	
}
<?php } ?>
<?php if($product_price_color){ ?>
.products-grid .product-content span.pro-price{
color:<?php echo $product_price_color;?>	
}	
<?php } ?>

/*************End code for Internal style for Category title,product title,product category title,product price color***************/
</style>  
<?php
$firestsearch  = $_POST['search_field'];//Get the search input 
$search_field = $_POST['search_field'];//Get the search input
$explode1 = explode(" ",$search_field);//Explode the string into array

/**************Pa_color_taxonomy code**********************/
$terms2_get = get_terms( array( 
    'taxonomy' => 'pa_colour',
    'parent'   => 0
) );
$get_term = array();
foreach($terms2_get as $terms2_get2){	
$term_name = $terms2_get2->slug;
$get_term[]=$term_name;
}
$result = array_intersect($get_term,$explode1); 
$results = array_values($result);  
$get_slug_term = $results[0];
if($get_slug_term){
$color_query = "AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'";	
}
else{
$color_query ="";
}
/**************End code for Pa_color_taxonomy**********************/

/*******************Pa_brand taxonomy code********************/
$pa_brand_tax = get_terms( array( 
    'taxonomy' => 'pa_brand',
    'parent'   => 0
) );

$get_brand_array = array();

foreach($pa_brand_tax as $pa_brand_tax2){
$slug_brand = $pa_brand_tax2->slug;	
$get_brand_array[] = $slug_brand;
}
$get_inter_arr = array_intersect($get_brand_array,$explode1); 
$get_inter_arr = array_values($get_inter_arr);  
$get_output_brand = $get_inter_arr[0];
/*******************End code for Pa_brand taxonomy code**********************/ 


/***************Search the pa_Color taxonomy term in array found then remove form array************/

if (in_array($get_slug_term, $explode1)) 
{
    unset($explode1[array_search($get_slug_term,$explode1)]);
}

/***************End code for Search the pa_Color taxonomy term in array found then remove form array************/
 $explode1 = array_values($explode1);//Reindex array values for pa color taxonomy
$searchstring = array();//Create empty variable
$newsearch = array(); 
/*******************Loop thorug the array of search***************************/
 foreach($explode1 as $explode2) {
	  $explode2 = trim($explode2);
	  if(!empty($explode2)){
		  $searchstring[] = " $wpdb->posts.post_title like '%$explode2%'";
	      $newsearch[] = "$wpdb->posts.post_title like '%$explode2%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";
	  }
} 
/*   echo"<pre>";
print_r($explode1);  */
/*******************End code for Loop thorug the array of search***************************/

/*   echo"<pre>";
print_r($searchstring); */

/*****************Check the sql array for query is empty or not**********************/ 
$str_implode = implode('AND',$searchstring);	
$str_implode2 = implode('AND',$searchstring);
if($str_implode2){
$str_implode2 = "AND ".$str_implode2;	
}
$str_implode3 = implode('OR',$searchstring);
if($str_implode3){
$str_implode3 = "AND ".$str_implode3;	
}
$str_implode4 = implode('AND',$searchstring);
if($str_implode4){
$str_implode4 = "OR ".$str_implode4;	
}
$str_implode5 = implode('OR ',$newsearch);
if($str_implode5){
$str_implode5 = "AND ".$str_implode5; 	
}
$str_implode6 = implode('OR ',$newsearch);
if($str_implode6){
$str_implode6 = "OR ".$str_implode6;	
}
   $query_res1 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode
    LIMIT 5");   
	
 $query_res2 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT 5");	
	
   
 /*   $query_res3 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode3
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5");  */
/*  echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode3
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; */
 
    $query_res4 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5");
 	$query_res5 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 $str_implode2  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT 5");
	 $forvariale6_only = $str_implode4."AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";	
 	 $query_res6 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT 5");
	 $query_res7 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' 
	 $str_implode5 ORDER BY wp_posts.post_title LIMIT 5");
	 $query_res8 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT 5");
 
if(!empty($query_res1)){  
if($query_res1){
$result22 = $query_res1;	
/*  echo"condtion1";
    echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    $str_implode
    LIMIT 5";  */
}   
 }
else{
  if($query_res2){
/* echo"condtion2";	 
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT 5"; 	  */ 
 $result22 = $query_res2;	 
 
  }
  else{
	   	  
	  
   if($query_res3){
 	  echo"lastif";
 /* echo"condition3";
	   echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode3
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; */
	$result22 = $query_res3;   
   }
   else{
   if($query_res4){
/*  echo"condition4";    
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; */
	$result22 = $query_res4;    
   }
   else{
  
 
   if($query_res5){
/* 	   echo "condition5"; 
	 echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 $str_implode2  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT 5";  */
	 $result22 = $query_res5;    
   }
   else{

	 $result22 = $query_res6;    
    if($query_res6){
 /*      echo "condition6";
        
	 echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT 5"; 	 */
	 $result22 = $query_res6;  	
	}
	else{
		

	 if($query_res7){
/* 	 echo "condition7"; 	 
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode5 ORDER BY wp_posts.post_title LIMIT 5";	  */
	$result22 = $query_res7;	 
	 }
	 else{
/* 	 echo "condition8"; 	 
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT 5";	 */ 
	$result22 = $query_res8;	 
	 }
	 
	 
	}
   
   }
  
  
   }
   
   }
  
  }
  
	 
 }
  
$searchfield = ucwords($search_field);?>
<div class="search-result-box">
<?php
$args = array(
    'taxonomy'      => array( 'product_cat' ), // taxonomy name
    'fields'        => 'all',
    'name__like'    => $firestsearch
);
$cat_listing_check = get_option('category_listing',true); 
$terms_new = get_terms( $args );
if($cat_listing_check == "yes"){ ?>
<div class="category_list_search sugg-grid">	
<?php 
if(!empty($terms_new)){
?>
<h4>SUGGESTIONS</h4>
<ul>
<?php
foreach($terms_new as $terms_new2){
$term_name =$terms_new2->name;
$count_cat_post = $terms_new2->count;
?>
<li><a href="#"><?php echo $term_name;?></a><span class="pro-qu">(<?php echo $count_cat_post;?>)</span></li>
<?php
}
?>
</ul>
<?php
} 
else{
echo"<p class='no_sugg'>NO-SUGGESTIONS</p>";	
}

?>
</div>
 <?php } ?>
<div class="products-grid">
<h4>Products</h4>
<div class="find-product-list">
<?php
$arr11 = array_values(array_column($result22, null, 'ID'));
$search_not_found="";

if(!empty($result22)){
foreach($arr11 as $result_get){  
$product_id = $result_get->ID;
$product_title = get_the_title($product_id);
$product_title = preg_replace('#'. preg_quote($search_field) .'#i', '<b>'.$searchfield.'</b>', $product_title);
$products = wc_get_product($product_id);
$get_price = $products->get_price();
$current_currency = get_woocommerce_currency_symbol();
$get_term_name = get_the_terms( $product_id, 'product_cat' );
$_product = new WC_Product_Variable($product_id);
$variation_data = $_product->get_variation_attributes(); 
$pa_color = $variation_data['pa_colour'];
$color_arr=array();
foreach($pa_color as $pa_color2){
	$color_arr[]=$pa_color2;
}
$count_color_attr = count($color_arr);      
if($get_slug_term){	
$product = new WC_Product_Variable( $product_id );
$variations = $product->get_available_variations();
$imag_variation = "";
foreach ( $variations as $variation ) {	
$attribute_name = $variation['attributes']['attribute_pa_colour'];
if($attribute_name == $get_slug_term){
$imag_variation = $variation['variation_image_id'];

}

}

$explode_arr = explode(',',$imag_variation);

$filter_arr = array_filter($explode_arr);
$filter_arr = array_values($filter_arr);
if(!empty($filter_arr)){
	
foreach($filter_arr as $filter_arr2){
$image_array = wp_get_attachment_image_src($filter_arr2, 'thumbnail');
$feat_image_url = $image_array[0];

}

}
else{
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
$feat_image_url = $thumb[0];
}

}   
else{
$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
$feat_image_url = $thumb2[0];	
} 
?>
<div class="product_search_loop all-shown-products">
<?php 
$product_imagee = get_option('product_imagee',true);
if($product_imagee == "yes"){ ?>
<div class="product-image">
<img src="<?php echo $feat_image_url;?>" class="product_imgg">
</div>	
<?php } ?>
<div class="product-content">
<?php
$get_title = get_option('product_title',true);
if($get_title == "yes"){?>
<p class="prod-name">
<a href="<?php echo get_the_permalink($product_id);?>"><?php echo $product_title;?></a>
</p>	
<?php }
else{
	
}

$get_cat_title = get_option('category_title',true);
if($get_cat_title == "yes"){ 
$cat_title = $get_term_name[0]->name;
if($cat_title == "Uncategorized"){
	
}
else { ?>
<span class="pro-cat"><?php echo $get_term_name[0]->name;?></span>		
<?php }
 }?>
<?php
if( $products->is_type('simple') ){
	
}
else{
if($count_color_attr == 0){
	
}
elseif($count_color_attr == 1){ ?>
<span class="available_var_get">Available in <?php echo $count_color_attr;?> color</span> 	
<?php }
else { ?>
<span class="available_var_get">Available in <?php echo $count_color_attr;?> colors</span> 	
<?php }
}
?>
 <?php
$product_price_get = get_option('product_price_option',true);
if($product_price_get == "yes"){ ?>
<?php
if($get_price){ ?>
<span class="pro-price"><?php echo $current_currency.$get_price;?></span>	
<?php }  
?>
	
<?php } ?>
</div>
</div> 
<?php
}
$result_status = "dataactive";
}
else{
echo $search_not_found = "<span class='search_not_found'>No search found</span>";	
$result_status = "datanotactive";
}
?>
</div>
</div>  
</div>    
<?php
if($result_status == "dataactive") { 
$site_urll = site_url();
$search_btn_data ="<a href='$site_urll?s=$firestsearch'>SEE ALL</a>";	
}
else {
$search_btn_data ="<a href='#'>SEE ALL</a>";	
}
?>
<div class="see-all-pro"><?php echo $search_btn_data;?></div>
<?php

die();	     
}
add_action('wp_ajax_get_data_search', 'search_ajax_data_get');
add_action('wp_ajax_nopriv_get_data_search', 'search_ajax_data_get');
/***********************End code for ajax search*******************************/

/*************************Filter modify for the search begin with starting letters**********************/
/*************************End code for Filter modify for the search begin with starting letters**********************/
/**************************Enqueue search style for fronend*****************************/
function add_style_frontend() {
   wp_enqueue_script( 'jquery' ); 	
   wp_enqueue_style( 'style-frontend', plugins_url('frontend/assets/css/search-style.css', __FILE__) );
   wp_enqueue_script( 'script-frontends', plugins_url('frontend/assets/js/search-script.js', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'add_style_frontend' );   

/**************************Enqueue search style for fronend*****************************/

add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
  if ( current_user_can('subscriber') ) {
   remove_menu_page('search_product'); // Posts
  }
}


/********************Search page code as shortcode***********************/
function add_search_code(){
ob_start();
global $wpdb;	
$firestsearch  = $_GET['s'];//Get the search input 
$search_field = $_GET['s'];//Get the search input
$explode1 = explode(" ",$search_field);//Explode the string into array
$limit=8;
/**************Pa_color_taxonomy code**********************/
$terms2_get = get_terms( array( 
    'taxonomy' => 'pa_colour',
    'parent'   => 0
) );
$get_term = array();
foreach($terms2_get as $terms2_get2){	
$term_name = $terms2_get2->slug;
$get_term[]=$term_name;
}
$result = array_intersect($get_term,$explode1); 
$results = array_values($result);  
$get_slug_term = $results[0];
if($get_slug_term){
$color_query = "AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'";	
}
else{
$color_query ="";
}
/**************End code for Pa_color_taxonomy**********************/

/*******************Pa_brand taxonomy code********************/
$pa_brand_tax = get_terms( array( 
    'taxonomy' => 'pa_brand',
    'parent'   => 0
) );

$get_brand_array = array();

foreach($pa_brand_tax as $pa_brand_tax2){
$slug_brand = $pa_brand_tax2->slug;	
$get_brand_array[] = $slug_brand;
}
$get_inter_arr = array_intersect($get_brand_array,$explode1); 
$get_inter_arr = array_values($get_inter_arr);  
$get_output_brand = $get_inter_arr[0];
/*******************End code for Pa_brand taxonomy code**********************/ 


/***************Search the pa_Color taxonomy term in array found then remove form array************/

if (in_array($get_slug_term, $explode1)) 
{
    unset($explode1[array_search($get_slug_term,$explode1)]);
}

/***************End code for Search the pa_Color taxonomy term in array found then remove form array************/
 $explode1 = array_values($explode1);//Reindex array values for pa color taxonomy
$searchstring = array();//Create empty variable
$newsearch = array(); 
/*******************Loop thorug the array of search***************************/
 foreach($explode1 as $explode2) {
	  $explode2 = trim($explode2);
	  if(!empty($explode2)){
		  $searchstring[] = " $wpdb->posts.post_title like '%$explode2%'";
	      $newsearch[] = "$wpdb->posts.post_title like '%$explode2%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";
	  }
} 
/*   echo"<pre>";
print_r($explode1);  */
/*******************End code for Loop thorug the array of search***************************/

/*   echo"<pre>";
print_r($searchstring); */

/*****************Check the sql array for query is empty or not**********************/ 
$str_implode = implode('AND',$searchstring);	
$str_implode2 = implode('AND',$searchstring);
if($str_implode2){
$str_implode2 = "AND ".$str_implode2;	
}
$str_implode3 = implode('OR',$searchstring);
if($str_implode3){
$str_implode3 = "AND ".$str_implode3;	
}
$str_implode4 = implode('AND',$searchstring);
if($str_implode4){
$str_implode4 = "OR ".$str_implode4;	
}
$str_implode5 = implode('OR ',$newsearch);
if($str_implode5){
$str_implode5 = "AND ".$str_implode5;	
}
$str_implode6 = implode('OR ',$newsearch);
if($str_implode6){
$str_implode6 = "OR ".$str_implode6;	
}
$str_implode7 = implode('AND',$searchstring);
if($str_implode7){
$str_implode7 = $str_implode7;	
}


   $query_res1 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode
    LIMIT $limit");   
	$query_res_total1 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode");
	
 $query_res2 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT $limit");	
	$query_res_total2 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2");
    $query_res4 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT $limit");
	$query_res_total4 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'");
 	$query_res5 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE 
	 $str_implode7  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit");
	$query_res_total5 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE 
	 $str_implode7  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title");
	 $query_res52 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total52 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title");
	 $forvariale6_only = $str_implode4."AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";	
 	 $query_res6 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total6 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title");
	 $query_res7 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' 
	 $str_implode5 ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total7 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' 
	 $str_implode5 ORDER BY wp_posts.post_title");
	 $query_res8 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT $limit");
	  $query_res_total8 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6");
 
if(!empty($query_res1)){  
if($query_res1){
$result22 = $query_res1;

$full_query=$query_res_total1;	
/*  echo"condtion1";
    echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    $str_implode
    LIMIT 5";  */
}   
 }
else{
  if($query_res2){
/*  echo"condtion2";	 
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT 5"; */
 $result22 = $query_res2;	 
 $full_query=$query_res_total2;	
  }
  else{
	   	  
	  
   if($query_res3){
/*  echo"condition3";
	   echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode3
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5";  */
	$result22 = $query_res3; 
 
   }
   else{
   if($query_res4){
/*   echo"condition4";    
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; */
	$result22 = $query_res4;    
	$full_query=$query_res_total4;	
   }
   else{ 
   if($query_res5){
/* 	   echo "condition5"; 
	 echo"SELECT * FROM $wpdb->posts WHERE 
	 $str_implode7  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT 5";  */
	 $result22 = $query_res5;   
    $full_query=$query_res_total5;	 
   }
   else{

    	
      if($query_res52){
/* 	echo"condition52";	  
	echo "SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit"; */  
	   $result22 = $query_res52;
      $full_query=$query_res_total52;	   
	  }

    else{ 
    if($query_res6){
/* 	echo "condition6";	
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT $limit"; */	
	 $result22 = $query_res6; 
     $full_query=$query_res_total6;	 
	}
	
	else{
	if($query_res7){
/* 	echo"condition7";	
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode5 ORDER BY wp_posts.post_title LIMIT $limit"; */	
	$result22 = $query_res7;	
    $full_query=$query_res_total7;		
	}
 	else{
	if($query_res8){
/* 	echo"condition8";	
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT $limit";	 */
	$result22 = $query_res8;
    $full_query=$query_res_total8;	
	}	
	}
		
	}
	
  	
	}
   
   }
  
  
   }
   
   }
  
  }
  
	 
 }
?>

<?php
if(!empty($full_query)){?>
<div class="search_page_sec">
<?php 	
$count_total = count($full_query);
foreach($result22 as $result23){
$product_id = $result23->ID;
$product_title = get_the_title($product_id);
$products = wc_get_product($product_id);
$get_price = $products->get_price();
$current_currency = get_woocommerce_currency_symbol();
$get_term_name = get_the_terms( $product_id, 'product_cat' );
$image_id2  = $products->get_image_id();
/* $attributes_pro = $products->get_variation_attributes();
$attribute_keys = array_keys( $attributes_pro );
foreach($attributes_pro as $attribute_name => $options ){
echo"<pre>";
print_r($attribute_name);	
} */
$terms_get = wc_get_product_terms( $products->get_id(),'pa_colour', array( 'fields' => 'all' ) );

if($get_slug_term){	
$product = new WC_Product_Variable( $product_id );
$variations = $product->get_available_variations();
$imag_variation = "";
foreach ( $variations as $variation ) {	
$attribute_name = $variation['attributes']['attribute_pa_colour'];
if($attribute_name == $get_slug_term){
$imag_variation = $variation['variation_image_id'];

}

}

$explode_arr = explode(',',$imag_variation);

$filter_arr = array_filter($explode_arr);
$filter_arr = array_values($filter_arr);
if(!empty($filter_arr)){
	
foreach($filter_arr as $filter_arr2){
$image_array = wp_get_attachment_image_src($filter_arr2, 'thumbnail');
$feat_image_url = $image_array[0];

}

}
else{
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
$feat_image_url = $thumb[0];
}

}   
else{
$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
	
if($feat_image_url){
$feat_image_url = $thumb2[0];	
}
else{
$feat_image_url = site_url()."/wp-content/uploads/woocommerce-placeholder.png";	

}

} 
?>
<div class="product_search_page" data-pro="<?php echo $product_id;?>">
<?php 
$product_imagee = get_option('product_imagee',true);?>
<div class="product-image-search">
<img src="<?php echo $feat_image_url;?>" class="product_imgg_searchh">
<div class="varition_change_image">
<?php
$current_products = $products->get_children();
if(!empty($current_products)){
$allVariations = $products->get_available_variations();
$array_atribute = array();
$newattr = array();
foreach($allVariations as $allvariations2){
$attribute_name = $allvariations2['attributes']['attribute_pa_colour'];	
$imag_variation = $allvariations2['variation_image_id'];
$image_array = wp_get_attachment_image_src($imag_variation, 'thumbnail');
$url_img = $image_array[0];
$array_atribute[]=$url_img;
$newattr[]=$attribute_name;
}
$pro_attr_name = array_unique($newattr);
$pro_attr_name = array_values($pro_attr_name);
$pro_var_url = array_unique($array_atribute);
$pro_var_url = array_values($pro_var_url);
$count_array = count($pro_var_url);
for($i=0;$i<$count_array;$i++){
	$attribute_name = $pro_attr_name[$i];
	$provar_img_url = $pro_var_url[$i];
	?>
   <img class="product_comon_img show_img_<?php echo $attribute_name;?>" src="<?php echo $provar_img_url;?>" data-title-color="<?php echo $attribute_name;?>">	  
	<?php
}
}
?>
</div>
</div>	

<div class="product-content">
<?php
$get_title = get_option('product_title',true);?>
<p class="prod-name_search">
<a href="<?php echo get_the_permalink($product_id);?>"><?php echo $product_title;?></a>
</p>		
<?php
if($get_price){ ?>
<span class="pro-price-search"><?php echo $current_currency.$get_price;?></span>		
<?php }
?>

<?php  if( $products->is_type('variable') ){ ?>
<ul class="list_colors">
<?php 
$array_atribute1=array();
$newattr1=array();
foreach($allVariations as $allvariations4){
$attribute_name1 = $allvariations4['attributes']['attribute_pa_colour'];
$imag_variation1 = $allvariations4['variation_image_id'];
$image_array1 = wp_get_attachment_image_src($imag_variation1, 'thumbnail');
$url_img1 = $image_array1[0];
$array_atribute1[]=$url_img1;
$newattr1[]=$attribute_name1;
}

$array_atribute1 = array_unique($array_atribute1);
$array_atribute1 = array_values($array_atribute1);
$newattr1 = array_unique($newattr1);
$newattr1 = array_values($newattr1);
$count_attr = count($newattr1);


for($i=0;$i<$count_attr;$i++){			
	
	//$get_term_name = get_term_by('name', $newattr1[$i], 'pa_colour');	
$category_get = get_term_by('slug', $newattr1[$i], 'pa_colour');
	/* echo"<pre>";
	print_r($category_get); */
	$term_id_get = $category_get->term_id;
    $color_code_get = get_term_meta( $term_id_get, 'product_attribute_color', true );
	if(preg_match('#(-\s*)+#i', $newattr1[$i])){
		?>
	<li class="radio_color_selct add_hypen_color" data-color="<?php echo $newattr1[$i];?>"><img class="image_varr_show" src="<?php echo $array_atribute1[$i];?>"></li>	
	<?php	
		
	}
	else{
	if($newattr1[$i] == "white"){
	  $color_white = "white_color_pro";	?>
	  <li class="radio_color_selct <?php echo $newattr1[$i];?>_color_product" data-color="<?php echo $newattr1[$i];?>" style="background:<?php echo $color_code_get;?>;width:20px;height:20px;border-radius: 20px;"></li>
	<?php }
    else { ?>
	<li class="radio_color_selct" data-color="<?php echo $newattr1[$i];?>" style="background:<?php echo $color_code_get;;?>;width:20px;height:20px;border-radius: 20px;"></li>	
	<?php }	
	?>
	
	<?php }
} 
?>
</ul>
<?php } ?>
</div>
</div> 

<?php
}
?>

</div>
<?php
}
else{
$search_para = $_GET['s'];	
echo'<div class="search_not_foundd"><p>No search found for <b>"'.$search_para.'"</b></p></div>';	
}

if($count_total>8){ ?>
 <div class="load_more_sec">
   <a href="#" data-ids="" data-cat="<?php //echo $category_idd;?>" data-count="<?php echo $count_total;?>" class="load_more_search">Load More</a> 
   </div>	
<?php } 
?>

<script>
jQuery('.radio_color_selct').click(function(){
//var get_val_color = jQuery(this).val();
var get_val_color = jQuery(this).attr('data-color');	
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.product_imgg_searchh').hide();
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.varition_change_image').children('.product_comon_img').hide();
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.varition_change_image').children('.show_img_'+get_val_color).show();
});
</script>
<script>
jQuery('ul.list_colors li.radio_color_selct').hover(function(){
	if (jQuery(this).hasClass("checke_color")) {
	
	}
	else{
	jQuery('ul.list_colors li.radio_color_selct').removeClass("checke_color");
	jQuery(this).addClass("checke_color");
	jQuery(this).trigger("click");
	}
});
</script>
<script>
 var page = 1; 
 var arr=new Array();
 var site_url_get = window.location.hostname; 
jQuery(function($) {
    jQuery(document).on("click",".load_more_search",function(e) {
		
        var total_count = jQuery(this).data('count');
		var urlParams = new URLSearchParams(window.location.search);
			
		var search_key = urlParams.get('s');
			
		jQuery('.search_page_sec .product_search_page').each(function(i,val){
			 var product = jQuery(this).data('pro');
			 arr.push(product); 
		});
		//  alert(arr);
/* 		 var myArrayNew = arr.filter(function (el) {
    return el != null && el != "";
  });  */
		jQuery(this).attr("data-ids",arr);  
       var post_ids = jQuery('.load_more_search').attr('data-ids');
		e.preventDefault();
		
        var button = jQuery(this),
            data = {
                'action':'loadmoresearchcode',
                'offset': page * 2,
				'post_ids':post_ids,
				'search_key':search_key
			};
          
       jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
			type:'post',  
            data: data,
            beforeSend: function(xhr) {
            button.text('Loading...'); // change the button text, you can also add a preloader image
            },
            success: function(data){	
			//console.log(data);
               var checkdiv = jQuery('.search_page_sec .product_search_page').length;				   
			   if(checkdiv >= total_count || data == 0){
				jQuery('.load_more_search').text("No More Products");
				setTimeout(function() { 
				jQuery('.load_more_search').hide();
				}, 2000);
				}			  
				else{ 			
				jQuery(".search_page_sec").append(data); 
					button.text('Load More'); 
					page++;					
				} 
				
			
            }  
        });
    });
});  
</script>
<?php
return $content = ob_get_clean();	
}
add_shortcode("search_code","add_search_code");


function search_ajax_code(){
$search_key = $_POST['search_key'];
$post_ids = $_POST["post_ids"];	
$post_ids = explode(',',$post_ids);
$post_ids = array_unique($post_ids); 
$post_ids = implode(',',$post_ids);
global $wpdb;	
$firestsearch  = $_POST['search_key'];//Get the search input 
$search_field =  $_POST['search_key'];;//Get the search input
$explode1 = explode(" ",$search_field);//Explode the string into array
$limit=8;
/**************Pa_color_taxonomy code**********************/
$terms2_get = get_terms( array( 
    'taxonomy' => 'pa_colour',
    'parent'   => 0
) );
$get_term = array();  
foreach($terms2_get as $terms2_get2){	
$term_name = $terms2_get2->slug;
$get_term[]=$term_name;
}
$result = array_intersect($get_term,$explode1); 
$results = array_values($result);  
$get_slug_term = $results[0];
if($get_slug_term){
$color_query = "AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'";	
}
else{
$color_query ="";
}
/**************End code for Pa_color_taxonomy**********************/

/*******************Pa_brand taxonomy code********************/
$pa_brand_tax = get_terms( array( 
    'taxonomy' => 'pa_brand',
    'parent'   => 0
) );

$get_brand_array = array();

foreach($pa_brand_tax as $pa_brand_tax2){
$slug_brand = $pa_brand_tax2->slug;	
$get_brand_array[] = $slug_brand;
}
$get_inter_arr = array_intersect($get_brand_array,$explode1); 
$get_inter_arr = array_values($get_inter_arr);  
$get_output_brand = $get_inter_arr[0];
/*******************End code for Pa_brand taxonomy code**********************/ 


/***************Search the pa_Color taxonomy term in array found then remove form array************/

if (in_array($get_slug_term, $explode1)) 
{
    unset($explode1[array_search($get_slug_term,$explode1)]);
}

/***************End code for Search the pa_Color taxonomy term in array found then remove form array************/
 $explode1 = array_values($explode1);//Reindex array values for pa color taxonomy
$searchstring = array();//Create empty variable
$newsearch = array(); 
/*******************Loop thorug the array of search***************************/
 foreach($explode1 as $explode2) {
	  $explode2 = trim($explode2);
	  if(!empty($explode2)){
		  $searchstring[] = " $wpdb->posts.post_title like '%$explode2%'";
	      $newsearch[] = "$wpdb->posts.post_title like '%$explode2%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";
	  }
} 
/*   echo"<pre>";
print_r($explode1);  */
/*******************End code for Loop thorug the array of search***************************/

/*   echo"<pre>";
print_r($searchstring); */

/*****************Check the sql array for query is empty or not**********************/ 
$str_implode = implode('AND',$searchstring);	
$str_implode2 = implode('AND',$searchstring);
if($str_implode2){
$str_implode2 = "AND ".$str_implode2;	
}
$str_implode3 = implode('OR',$searchstring);
if($str_implode3){
$str_implode3 = "AND ".$str_implode3;	
}
$str_implode4 = implode('AND',$searchstring);
if($str_implode4){
$str_implode4 = "OR ".$str_implode4;	
}
$str_implode5 = implode('OR ',$newsearch);
if($str_implode5){
$str_implode5 = "AND ".$str_implode5;	
}
$str_implode6 = implode('OR ',$newsearch);
if($str_implode6){
$str_implode6 = "OR ".$str_implode6;	
}
$str_implode7 = implode('AND',$searchstring);
if($str_implode7){
$str_implode7 = "AND ".$str_implode7;	
}


   $query_res1 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.ID NOT IN ($post_ids) AND $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode
    LIMIT $limit");   
	$query_res_total1 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.ID NOT IN ($post_ids)
	AND $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode");
	
 $query_res2 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.ID NOT IN ($post_ids)
	AND $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT $limit");	
	$query_res_total2 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2");
    $query_res4 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.ID NOT IN ($post_ids)
	AND $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT $limit");
	$query_res_total4 = $wpdb->get_results("SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'");
 	$query_res5 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE 
	 $wpdb->posts.ID NOT IN ($post_ids) $str_implode7  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit");
	$query_res_total5 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 $str_implode2  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title");
	 $query_res52 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total52 = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title");
	 $forvariale6_only = $str_implode4."AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'";	
 	 $query_res6 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total6 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title");
	 $query_res7 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode5 ORDER BY wp_posts.post_title LIMIT $limit");
	 $query_res_total7 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' 
	 $str_implode5 ORDER BY wp_posts.post_title");
	 $query_res8 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT $limit");
	  $query_res_total8 =  $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6");
 
if(!empty($query_res1)){  
if($query_res1){
$result22 = $query_res1;
$full_query=$query_res_total1;	
  echo"condtion1";
    echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    $str_implode
    LIMIT 5";  
}   
 }
else{
  if($query_res2){
  echo"condtion2";	 
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode2
    LIMIT 5"; 
 $result22 = $query_res2;	 
 $full_query=$query_res_total2;	
  }
  else{
	   	  
	  
   if($query_res3){
 echo"condition3";
	   echo "SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
	$str_implode3
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; 
	$result22 = $query_res3; 
 
   }
   else{
   if($query_res4){
  echo"condition4";    
	echo"SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'product' 
	AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->term_taxonomy.taxonomy = 'pa_colour'
	AND $wpdb->terms.slug = '$get_slug_term'
    LIMIT 5"; 
	$result22 = $query_res4;    
	$full_query=$query_res_total4;	
   }
   else{ 
   if($query_res5){
	   echo "condition5"; 
	 echo"SELECT * FROM $wpdb->posts WHERE 
	 $str_implode7  AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT 5"; 
	 $result22 = $query_res5;   
    $full_query=$query_res_total5;	 
   }
   else{

    	
      if($query_res52){
/* 	echo"condition52";	  
	echo "SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
     ORDER BY wp_posts.post_title LIMIT $limit";   */
	   $result22 = $query_res52;
      $full_query=$query_res_total52;	   
	  }

    else{ 
    if($query_res6){
	echo "condition6";	
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' 
	 AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product'
	 $forvariale6_only 
	 ORDER BY wp_posts.post_title LIMIT $limit"; 
	 $result22 = $query_res6; 
     $full_query=$query_res_total6;	 
	}
	
	else{
	if($query_res7){
	echo"condition7";	
	echo"SELECT * FROM $wpdb->posts WHERE $wpdb->posts.ID NOT IN ($post_ids) AND wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode5 ORDER BY wp_posts.post_title LIMIT $limit";
	$result22 = $query_res7;	
    $full_query=$query_res_total7;		
	}
 	else{
	if($query_res8){
 	echo"condition8";	
	echo"SELECT * FROM $wpdb->posts WHERE wp_posts.post_title like '%$firestsearch%' AND $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'product' $str_implode6
	 LIMIT $limit";	
	$result22 = $query_res8;
    $full_query=$query_res_total8;	
	}	
	}
		
	}
	
  	
	}
   
   }
  
  
   }
   
   }
  
  }
  
	 
 }

$count_total = count($full_query);
foreach($result22 as $result23){
$product_id = $result23->ID;
$product_title = get_the_title($product_id);
$products = wc_get_product($product_id);
$get_price = $products->get_price();
$current_currency = get_woocommerce_currency_symbol();
$get_term_name = get_the_terms( $product_id, 'product_cat' );
$image_id2  = $products->get_image_id();
/* $attributes_pro = $products->get_variation_attributes();
$attribute_keys = array_keys( $attributes_pro );
foreach($attributes_pro as $attribute_name => $options ){
echo"<pre>";
print_r($attribute_name);	
} */
$terms_get = wc_get_product_terms( $products->get_id(),'pa_colour', array( 'fields' => 'all' ) );

if($get_slug_term){	
$product = new WC_Product_Variable( $product_id );
$variations = $product->get_available_variations();
$imag_variation = "";
foreach ( $variations as $variation ) {	
$attribute_name = $variation['attributes']['attribute_pa_colour'];
if($attribute_name == $get_slug_term){
$imag_variation = $variation['variation_image_id'];

}

}

$explode_arr = explode(',',$imag_variation);

$filter_arr = array_filter($explode_arr);
$filter_arr = array_values($filter_arr);
if(!empty($filter_arr)){
	
foreach($filter_arr as $filter_arr2){
$image_array = wp_get_attachment_image_src($filter_arr2, 'thumbnail');
$feat_image_url = $image_array[0];

}

}
else{
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
$feat_image_url = $thumb[0];
}

}   
else{
$thumb2 = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );	
$feat_image_url = $thumb2[0];	
} 
?>
<div class="product_search_page" data-pro="<?php echo $product_id;?>">
<?php 
$product_imagee = get_option('product_imagee',true);?>
<div class="product-image-search">
<img src="<?php echo $feat_image_url;?>" class="product_imgg_searchh">
<div class="varition_change_image">
<?php
$current_products = $products->get_children();
if(!empty($current_products)){
$allVariations = $products->get_available_variations();
$array_atribute = array();
$newattr = array();
foreach($allVariations as $allvariations2){
$attribute_name = $allvariations2['attributes']['attribute_pa_colour'];	
$imag_variation = $allvariations2['variation_image_id'];
$image_array = wp_get_attachment_image_src($imag_variation, 'thumbnail');
$url_img = $image_array[0];
$array_atribute[]=$url_img;
$newattr[]=$attribute_name;
}
$pro_attr_name = array_unique($newattr);
$pro_attr_name = array_values($pro_attr_name);
$pro_var_url = array_unique($array_atribute);
$pro_var_url = array_values($pro_var_url);
$count_array = count($pro_var_url);
for($i=0;$i<$count_array;$i++){
	$attribute_name = $pro_attr_name[$i];
	$provar_img_url = $pro_var_url[$i];
	?>
   <img class="product_comon_img show_img_<?php echo $attribute_name;?>" src="<?php echo $provar_img_url;?>" data-title-color="<?php echo $attribute_name;?>">	  
	<?php
}
}
?>
</div>
</div>	

<div class="product-content">
<?php
$get_title = get_option('product_title',true);?>
<p class="prod-name_search">
<a href="<?php echo get_the_permalink($product_id);?>"><?php echo $product_title;?></a>
</p>	
<?php
if($get_price){ ?>
<span class="pro-price-search"><?php echo $current_currency.$get_price;?></span>	
<?php } ?>

<?php  if( $products->is_type('variable') ){ ?>
<ul class="list_colors">
<?php 
$array_atribute1=array();
$newattr1=array();
foreach($allVariations as $allvariations4){
$attribute_name1 = $allvariations4['attributes']['attribute_pa_colour'];
$imag_variation1 = $allvariations4['variation_image_id'];
$image_array1 = wp_get_attachment_image_src($imag_variation1, 'thumbnail');
$url_img1 = $image_array1[0];
$array_atribute1[]=$url_img1;
$newattr1[]=$attribute_name1;
}

$array_atribute1 = array_unique($array_atribute1);
$array_atribute1 = array_values($array_atribute1);
$newattr1 = array_unique($newattr1);
$newattr1 = array_values($newattr1);
$count_attr = count($newattr1);


for($i=0;$i<$count_attr;$i++){			
	
	//$get_term_name = get_term_by('name', $newattr1[$i], 'pa_colour');	
$category_get = get_term_by('slug', $newattr1[$i], 'pa_colour');
	/* echo"<pre>";
	print_r($category_get); */
	$term_id_get = $category_get->term_id;
    $color_code_get = get_term_meta( $term_id_get, 'product_attribute_color', true );
	if(preg_match('#(-\s*)+#i', $newattr1[$i])){
		?>
	<li class="radio_color_selct add_hypen_color" data-color="<?php echo $newattr1[$i];?>"><img class="image_varr_show" src="<?php echo $array_atribute1[$i];?>"></li>	
	<?php	
		
	}
	else{
	if($newattr1[$i] == "white"){
	  $color_white = "white_color_pro";	?>
	  <li class="radio_color_selct <?php echo $newattr1[$i];?>_color_product" data-color="<?php echo $newattr1[$i];?>" style="background:<?php echo $color_code_get;?>;width:20px;height:20px;border-radius: 20px;"></li>
	<?php }
    else { ?>
	<li class="radio_color_selct" data-color="<?php echo $newattr1[$i];?>" style="background:<?php echo $color_code_get;;?>;width:20px;height:20px;border-radius: 20px;"></li>	
	<?php }	
	?>
	
	<?php }
} 
?>
</ul>
<?php } ?>
</div>
</div> 
<?php
}?>
<script>
jQuery('.radio_color_selct').click(function(){
//var get_val_color = jQuery(this).val();
var get_val_color = jQuery(this).attr('data-color');	
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.product_imgg_searchh').hide();
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.varition_change_image').children('.product_comon_img').hide();
jQuery(this).parent('.list_colors').parent('.product-content').parent('.product_search_page').children('.product-image-search').children('.varition_change_image').children('.show_img_'+get_val_color).show();
});

jQuery('ul.list_colors li.radio_color_selct').hover(function(){
	if (jQuery(this).hasClass("checke_color")) {
	
	}
	else{
	jQuery('ul.list_colors li.radio_color_selct').removeClass("checke_color");
	jQuery(this).addClass("checke_color");
	jQuery(this).trigger("click");
	}
	
});
</script>
<?php 
die();
}
add_action('wp_ajax_loadmoresearchcode', 'search_ajax_code');
add_action('wp_ajax_nopriv_loadmoresearchcode', 'search_ajax_code'); 



/****************Show the heading text for search page()**********************/

function add_search_heading_bar(){
ob_start();
$search_texts = $_GET['s'];
?>
<h2>Search for "<span class="search_b"><?php echo $search_texts;?></span>"</h2>
<?php
return $content = ob_get_clean();		
}
add_Shortcode("search_heading_bar","add_search_heading_bar");