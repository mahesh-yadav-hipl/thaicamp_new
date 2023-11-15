<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
// print_r($_REQUEST);
// exit() ;

try{

	if($type == 'sub-admin')
	{
	  $check_mobile = db_select_query("SELECT * FROM admin WHERE type = 'sub-admin' and mobile = '{$_REQUEST['mobile']}'") ;
	if($check_mobile)
	{
	  throw new Exception("Mobile Already Existing");  
	}
	
	$check_email = db_select_query("SELECT * FROM admin WHERE type = 'sub-admin' and  email = '{$_REQUEST['email']}'") ;
	if($check_email)
	{
	  throw new Exception("Email Already Existing");  
	}  
	}
	else
	{
	    // $check_mobile = db_select_query("SELECT * FROM admin WHERE type = 'admin' and mobile = '{$_REQUEST['mobile']}'") ;
		// if($check_mobile)
		// {
		// throw new Exception("Mobile Already Existing");  
		// }
	
		// $check_email = db_select_query("SELECT * FROM admin WHERE type = 'admin' and  email = '{$_REQUEST['email']}'") ;
		// if($check_email)
		// {
		// throw new Exception("Email Already Existing");  
		// }

		$check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}'") ;
		if($check_mobile)
		{
			throw new Exception("Mobile Already Existing");  
		}
		$check_category = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}'") ;
		if($check_category)
		{
			throw new Exception("Email Already Existing");  
		}
	}
	
	$data['table']="users";
	$data['values']=$_REQUEST;
	
	if(db_insert($data)){	    
	   	$json['result']=true;	
		$json['message']="Added Successfully";
	}else{
		throw new Exception("Something went wrong");
	}
}catch(Exception $e){
	$json['result']=false;	
	$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>