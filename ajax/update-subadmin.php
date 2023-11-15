<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
try{
	if(!isset($id)){
		throw new Exception("please define id");
	}
	
	$check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}' and id != '{$_REQUEST['id']}' ") ;
	if($check_mobile)
	{
	  throw new Exception("Mobile Already Existing");  
	}

	$check_category = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}' and id != '{$_REQUEST['id']}'") ;
	if($check_category)
	{
	  throw new Exception("Email Already Existing");  
	}

	
	$data['table']="users";
	$data['values']=$_REQUEST;
	$data['where']['id']=$_REQUEST['id'];

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