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
	$check_category = db_select_query("SELECT * FROM categories WHERE name = '{$_REQUEST['name']}' and id != '{$_REQUEST['category_id']}'") ;
	if($check_category)
	{
	  throw new Exception("Category Already Existing");  
	}
	if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
		$file['files']=$_FILES['image'];
		$file['destination']='../uploaded/category';
		$_REQUEST['image']=upload_file($file);
	}
	//$_REQUEST['created_at'] = date('Y-m-d h:i:s');	
	$data['table']=$table;
	unset($_REQUEST['table']);
	$data['where']['id']=$_REQUEST['category_id'];
	unset($_REQUEST['category_id']);
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