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
				throw new Exception("No changes made");
			break;
			
			default:
				throw new Exception("No changes made");
			break;
		}		
	}
	
	}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>