<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
try{
	$check = db_select_query("SELECT * FROM email_format WHERE type = 'Email_FROM_ADDRESS'") ;
	if(!$check)
	{
	  throw new Exception("Email From Address not Defined");  
	}
    $_REQUEST['detail'] = $_REQUEST['email'];
    unset($_REQUEST['email']);
	$data['table']="email_format";
	$data['values']=$_REQUEST;
	$data['where']['id']=$check['0']['id'];

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