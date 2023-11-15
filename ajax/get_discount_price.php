<?php 
include_once('../functions/functions.php');

	$code_id = $_POST['code_id'] ;
	$pck_price = !empty($_POST['pck_price'])?$_POST['pck_price']:0 ; ;
	
	
	$get_discount  = db_select_query("SELECT * FROM discount_code WHERE id = '$code_id' ")[0] ;
    $discount_price = !empty($get_discount['price'])?$get_discount['price']:0 ;
    
     $total_price = $pck_price -   $discount_price ;
     
       	$json['result']=true;
       	$json['total_price'] = $total_price ;
      
      
    
echo json_encode($json);	
	
?>