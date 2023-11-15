<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);

try{

	$leave = db_select_query("SELECT * FROM user_leaves WHERE id = '{$_REQUEST['value']}' AND user_id = '{$_SESSION['login_id']}' AND status = 'Pending' ");
	if(count($leave) == 0){
		throw new Exception("You are not Valid Employee");  
	}

	if(!isset($table)){
		throw new Exception("please define table name");
	}
	if(!isset($key)){
		throw new Exception("please define key ");
	}
	if(!isset($value)){
		throw new Exception("please define value ");
	}

	switch($table){
		default:{
			$query="DELETE FROM $table WHERE $key IN ($value)";
		}break;
	}
	
	if(db_delet_query($query)){
		$json['result']=true;	
		$json['message']="Deleted successfully";
	}else{
		throw new Exception("Something went wrong");
		
	}
}catch(Exception $e){	
	$json['result']=false;	
	$json['message']=$e->getMessage();
}	
echo json_encode($json);	
?>