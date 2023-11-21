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

	$check_category = db_select_query("SELECT * FROM products WHERE title = '{$_REQUEST['title']}' AND  category_id = '{$_REQUEST['category_id']}' ") ;
	if($check_category)
	{
	  throw new Exception("Product Already Existing");  
	}
	if(isset($_FILES['featued_image']['name']) && !empty($_FILES['featued_image']['name'])){
		$file['files']=$_FILES['featued_image'];
		$file['destination']='../uploaded/product';
		$_REQUEST['featued_image']=upload_file($file);
	}
	$_REQUEST['created_at'] = date('Y-m-d h:i:s');
	
	$FourDigitRandomNumber = mt_rand(1111,9999);
    $FourDigitRandomNumbermore = mt_rand(1111,9999);
    $_REQUEST['product_unique_id'] = $porduct_id = 'Product_'.$FourDigitRandomNumber.strtotime(date('Y-m-d h:i:s')).$FourDigitRandomNumbermore;
	
	$data['table']=$table;
	unset($_REQUEST['table']);

	$size_array = "";
	if(isset($_REQUEST['size'])){
		$size_array = $_REQUEST['size'];
		unset($_REQUEST['size']);
	}

	$data['values']=$_REQUEST;
	if($usr_id = db_insert($data)){	

			if($size_array != ""){
				$product_data = db_select_query("SELECT * FROM  products WHERE product_unique_id = '$porduct_id' AND deleted = 0 ");
				if(count($product_data) > 0){	
					foreach($size_array as $product_size){
						if($product_size != ""){
							$size_data['table']="product_sizes";								
							$insert_data['product_id'] = $product_data['0']['id'];
							$insert_data['size_name'] = $product_size;
							$insert_data['deleted'] = 0;
							$insert_data['created_at'] = date('Y-m-d h:i:s');
							$size_data['values']=$insert_data;
							if($usr_id = db_insert($size_data)){
							}
						}
					}
				}
			}

			$json['result']=true;	
			$json['message']="Added Successfully"; 
		}
	}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>