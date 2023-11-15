<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);




$quantiy = $check_quantity = $_REQUEST['quantiy'];
$product_id = $_REQUEST['product_id'];

if($quantiy < 1){
	$json['result']=false;	
	$json['message']='<span class="text-danger">Please select at least one quantity</span>';
	echo json_encode($json);exit;
}

// check quantity
	// if (isset($_SESSION['cart'])) {
	// 	if(array_key_exists($product_id, $_SESSION['cart'])) {
	// 		$check_quantity = $quantiy+$_SESSION['cart'][$product_id]['quantiy'];
	// 	}
	// }
// check quantity

if($quantiy != '' && $product_id !=''){
	$product = db_select_query("SELECT * FROM products WHERE id = '$product_id'")[0];
	if($product['stock'] < $check_quantity){
		$json['result']=false;	
		$json['message']='<span class="text-danger">Quantity out of stock. Max available quantity is '.$product['stock'].'</span>';
	}else{
		if (isset($_SESSION['cart'])) {
			if(array_key_exists($product_id, $_SESSION['cart'])) {
				// $_SESSION['cart'][$product_id]['quantiy'] += $quantiy;
				$_SESSION['cart'][$product_id]['quantiy'] = $quantiy;
			}else{
				$items = [ "product_id" => $product_id, "quantiy" => $quantiy]; 
				$_SESSION['cart'][$product_id] = $items;
			}
		}else{
			$items = [ "product_id" => $product_id, "quantiy" => $quantiy]; 
			$_SESSION['cart'][$product_id] = $items;
		}
		$json['result']=true;	
		$json['message']='<span class="text-danger">Add to cart Successfully</span>';		
	}
}
$json['total_cart']= count($_SESSION['cart']); 
echo json_encode($json);exit;


?>