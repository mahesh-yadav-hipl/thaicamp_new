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
	$check_category = db_select_query("SELECT * FROM categories WHERE name = '{$_REQUEST['name']}'") ;
	if($check_category)
	{
	  throw new Exception("Category Already Existing");  
	}
	if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
		$file['files']=$_FILES['image'];
		$file['destination']='../uploaded/category';
		$_REQUEST['image']=upload_file($file);
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