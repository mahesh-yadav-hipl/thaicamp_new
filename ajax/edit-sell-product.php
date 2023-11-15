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
	$data['table']=$table;
	unset($_REQUEST['table']);
	$data['where']['id']=$_REQUEST['sell_product_id'];
	unset($_REQUEST['sell_product_id']);
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