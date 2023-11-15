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
	//$check_category = db_select_query("SELECT * FROM categories WHERE name = '{$_REQUEST['name']}'") ;
	$check_category = db_select_query("SELECT * FROM user_leaves WHERE user_id = '{$_SESSION['login_id']}' AND leave_from BETWEEN '{$_REQUEST['leave_from']}' AND '{$_REQUEST['leave_to']}';") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}
	$check_category = db_select_query("SELECT * FROM user_leaves WHERE user_id = '{$_SESSION['login_id']}' AND leave_to BETWEEN '{$_REQUEST['leave_from']}' AND '{$_REQUEST['leave_to']}';") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}
	$check_category = db_select_query("SELECT * FROM user_leaves WHERE user_id = '{$_SESSION['login_id']}' AND '{$_REQUEST['leave_from']}' BETWEEN leave_from AND leave_to;") ;
	if($check_category)
	{
	  throw new Exception("Date Already Existing");  
	}
	$start_date = strtotime($_REQUEST['leave_from']);
	$end_date = strtotime($_REQUEST['leave_to']);
	if($start_date > $end_date){
		throw new Exception("From date must be Less then to date");  
	}
	
	$_REQUEST['created_at'] = date('Y-m-d h:i:s');	
	$_REQUEST['user_id'] = $_SESSION['login_id'];	
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