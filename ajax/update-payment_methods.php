<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);


try{

	
	$data['table']="payment_methods";
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