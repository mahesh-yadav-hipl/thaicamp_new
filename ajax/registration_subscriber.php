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
	// $check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}'") ;
	// if($check_mobile)
	// {
	//   throw new Exception("Mobile Already Existing");  
	// }
	if($_REQUEST['password'] != $_REQUEST['confirm_password']){
		throw new Exception("Password and confirm password does not match");
	}

	$check_category = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}'") ;
	if($check_category)
	{
	  throw new Exception("Email Already Existing");  
	}

	if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
		$file['files']=$_FILES['image'];
		$file['destination']='../uploaded/users';
		$_REQUEST['image']=upload_file($file);
	}
	
	$_REQUEST['role']='subscriber';
	$_REQUEST['created_at'] = date('Y-m-d h:i:s');	
	$data['table']=$table;
	unset($_REQUEST['table']);
	unset($_REQUEST['confirm_password']);
	$data['values']=$_REQUEST;
	if($usr_id = db_insert($data)){	    
			$json['result']=true;	
			$json['message']="Registration successfully"; 
		}
	}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>