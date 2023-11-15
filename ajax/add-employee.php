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

	$check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}'") ;
	if($check_mobile)
	{
	  throw new Exception("Mobile Already Existing");  
	}

	//$check_category = db_select_query("SELECT * FROM employee WHERE email = '{$_REQUEST['email']}'") ;
	$check_category = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}'") ;
	if($check_category)
	{
	  throw new Exception("Email Already Existing");  
	}
	if(isset($_FILES['profile']['name']) && !empty($_FILES['profile']['name'])){
		$file['files']=$_FILES['profile'];
		$file['destination']='../uploaded/employee';
		$_REQUEST['image']=upload_file($file);
	}
	$_REQUEST['role']='employee';
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