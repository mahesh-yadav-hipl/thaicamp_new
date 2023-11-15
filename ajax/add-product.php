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
	$data['table']=$table;
	unset($_REQUEST['table']);
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