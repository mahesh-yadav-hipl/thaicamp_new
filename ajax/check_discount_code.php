<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
$discount_code = $_REQUEST['discount_code'];
if($discount_code != ''){
	$product = db_select_query("SELECT * FROM discount_code WHERE code = '$discount_code'")[0];
	
	if($product){
		if($product['price'] > 0){
			$json['result']=true;	
			$json['message']='<span class="text-danger">Discount Code Successfully Apply</span>';
			$json['discount_price'] = $product['price'];
			echo json_encode($json);exit;
		}
	}
	$json['result']=false;	
	$json['message']='<span class="text-danger">Invalid Discount Code</span>';
	$json['discount_price'] = 0;
	echo json_encode($json);exit;
}
?>