<?php 
include_once('../functions/functions.php');

	$pck_id = $_POST['pck_id'] ;
	
	
	$get_package  = db_select_query("SELECT * FROM packages WHERE id = '$pck_id' ")[0] ;
    $package_price = !empty($get_package['price'])?$get_package['price']:"" ;
    
    
     
       	$json['result']=true;
       	$json['package_price'] = $package_price ;
      
      
    
echo json_encode($json);	
	
?>