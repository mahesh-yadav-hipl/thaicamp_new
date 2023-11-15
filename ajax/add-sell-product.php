<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);

if(!isset($table))
{
	throw new Exception("Please define table name");
}

try{
	$_REQUEST['order_id'] = 'TCOR-'.strtotime(date('Y-m-d h:i:s'));
	$_REQUEST['created_at'] = date('Y-m-d h:i:s');	
	$data['table']=$table;
	unset($_REQUEST['table']);

	$products =  db_select_query("SELECT * FROM products where id=".$_REQUEST['product_id']);
	
	$productData['table'] = 'products';
	$quantity = $_REQUEST['quantity'];

	$productStock = (int)$products[0]['stock'] - (int)$quantity;

	$values['stock'] = $productStock;

	$productData['values'] = $values;

	$productData['where']['id']=$_REQUEST['product_id'];

	db_update($productData);

	/* echo "<pre>";
	print_r($products[0]['stock']);die; */
	$_REQUEST['product_detail'] = json_encode($products[0]);
	$data['values']=$_REQUEST;
	if($usr_id = db_insert($data)){	    
			$json['result']=true;	
			$json['message']="Added Successfully"; 
		}
	}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>