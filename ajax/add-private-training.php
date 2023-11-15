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
	// $check_category = db_select_query("SELECT * FROM products WHERE title = '{$_REQUEST['title']}' AND  category_id = '{$_REQUEST['category_id']}' ") ;
	// if($check_category)
	// {
	//   throw new Exception("Product Already Existing");  
	// }

		

	$_REQUEST['created_at'] = date('Y-m-d h:i:s');
	$_REQUEST['pt_start_date'] = date('Y-m-d 00:00:00',strtotime($_REQUEST['pt_start_date']));
	$_REQUEST['pt_end_date'] = date('Y-m-d 23:59:59',strtotime($_REQUEST['pt_end_date']));
	if($_REQUEST['pt_start_date'] > $_REQUEST['pt_end_date']) 
	{
	  throw new Exception("End Date must be greater than Start Date");
	}
	$e_commission = $_REQUEST['price'] * ($_REQUEST['pt_percentage']/100);
	$_REQUEST['employee_commission'] = $e_commission;
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