<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');

$mode = $_REQUEST['mode'];

if($mode == 'get_product_stock'){
	$products =  db_select_query("SELECT * FROM products where id=".$_REQUEST['product_id']);

	if(!empty($products)){
		$j_data = [
			'status' => true,
			'quantity' => $products[0]['stock'],
			'message' => 'Data found',
		];
	} else {
		$j_data = [
			'status' => false,
			'message' => 'Product Not found',
		];
	}
	echo json_encode($j_data);
}

?>