<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
// print_r($_REQUEST);
// exit() ;

try{

	
	$data['table']="expenses";
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