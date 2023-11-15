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

	$leave = db_select_query("SELECT * FROM user_leaves WHERE id = '{$_REQUEST['leave_id']}' AND user_id = '{$_SESSION['login_id']}' AND status = 'Pending' ");
	if(count($leave) == 0){
		throw new Exception("You are not Valid Employee");  
	}

	$check_category = db_select_query("SELECT * FROM user_leaves WHERE id != '{$_REQUEST['leave_id']}' AND  user_id = '{$_SESSION['login_id']}' AND leave_from BETWEEN '{$_REQUEST['leave_from']}' AND '{$_REQUEST['leave_to']}';") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}
	$check_category = db_select_query("SELECT * FROM user_leaves WHERE  id != '{$_REQUEST['leave_id']}' AND  user_id = '{$_SESSION['login_id']}' AND leave_to BETWEEN '{$_REQUEST['leave_from']}' AND '{$_REQUEST['leave_to']}';") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}
	
	$check_category = db_select_query("SELECT * FROM user_leaves WHERE id != '{$_REQUEST['leave_id']}' AND user_id = '{$_SESSION['login_id']}' AND '{$_REQUEST['leave_from']}' BETWEEN leave_from AND leave_to;") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}

	$start_date = strtotime($_REQUEST['leave_from']);
	$end_date = strtotime($_REQUEST['leave_to']);
	if($start_date > $end_date){
		throw new Exception("From date must be Less-then or equl-to To date");  
	}

	$data['table']=$table;
	unset($_REQUEST['table']);
	$data['where']['id']=$_REQUEST['leave_id'];
	unset($_REQUEST['leave_id']);
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