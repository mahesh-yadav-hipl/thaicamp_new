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
	
	$check_category = db_select_query("SELECT * FROM products WHERE title = '{$_REQUEST['title']}' AND id != '{$_REQUEST['product_id']}' AND  category_id = '{$_REQUEST['category_id']}' ") ;
	if($check_category)
	{
	  throw new Exception("Product Already Existing");  
	}

	// old size not eixt remove
		// delete sizes 
			$productDataD['table'] = 'product_sizes';
			$valuesD['deleted'] = 1;
			$productDataD['values'] = $valuesD;
			$productDataD['where']['product_id']= $_REQUEST['product_id'];
			db_update($productDataD);
			if(isset($_REQUEST['size_old'])){				
				foreach($_REQUEST['size_old'] as $key => $row_unDeletesize){
					$productData['table'] = 'product_sizes';
					$values['deleted'] = 0;
					$values['size_name'] = $row_unDeletesize;
					$productData['values'] = $values;
					$productData['where']['product_id']= $_REQUEST['product_id'];
					$productData['where']['id']= $key;
					db_update($productData);
				}
			}
			unset($_REQUEST['size_old']);
		// delete sizes 
		// new size Add
			if(isset($_REQUEST['size'])){
				$size_array = $_REQUEST['size'];
				foreach($size_array as $product_size){
					if($product_size != ""){
						$size_data['table']="product_sizes";								
						$insert_data['product_id'] = $_REQUEST['product_id'];
						$insert_data['size_name'] = $product_size;
						$insert_data['deleted'] = 0;
						$insert_data['created_at'] = date('Y-m-d h:i:s');
						$size_data['values']=$insert_data;
						if($usr_id = db_insert($size_data)){
						}
					}
				}
				unset($_REQUEST['size']);
			}
		// new size Add

	// old size not eixt remove 



	if(isset($_FILES['featued_image']['name']) && !empty($_FILES['featued_image']['name'])){
		$file['files']=$_FILES['featued_image'];
		$file['destination']='../uploaded/product';
		$_REQUEST['featued_image']=upload_file($file);
	}

	$data['table']=$table;
	unset($_REQUEST['table']);
	$data['where']['id']=$_REQUEST['product_id'];
	unset($_REQUEST['product_id']);
	$data['values']=$_REQUEST;
	if(db_update($data)){
		$json['result']=true;	
		$json['message']="Updated Successfully";
	}else{
		switch ($table) {
			case 'admins':
				// throw new Exception("No changes made");
				$json['result']=true;	
				$json['message']="Updated Successfully";
			break;
			
			default:
				// throw new Exception("No changes made");
				$json['result']=true;	
			$json['message']="Updated Successfully";
			break;
		}		
	}
	
	}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>