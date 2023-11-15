<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);



$product_id = $_REQUEST['product_id'];
if($product_id !=''){	
	if (isset($_SESSION['cart'])) {
		if(array_key_exists($product_id, $_SESSION['cart'])) {
			unset($_SESSION['cart'][$product_id]);
		}
		$json['result']=true;	
		$json['message']='<span class="text-danger">Item cart to remove successfully</span>';
	}	
}
echo json_encode($json);exit;





?>