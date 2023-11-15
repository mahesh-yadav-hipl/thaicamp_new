<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);

try{

	if(!isset($package_id)){
		throw new Exception("please define package id");
	}
	if(!isset($user_id)){
		throw new Exception("please define user id ");
	}
	if(!isset($entered_time)){
		throw new Exception("please define entered time ");
	}
	


	  $tdate = date('Y-m-d'); 
	  
	  $check_entry = db_select_query("select * from attendance where user_id = '$user_id' and package_id = '$package_id' and date = '$tdate' ")[0] ;
	  if($check_entry)
	  {
	    throw new Exception("Already Done Entry For The Subscriber");  
	  }

	$data['table']="attendance";
	$data['values']=$_REQUEST;
	
	if(db_insert($data)){
	    
	    $qr = db_select_query("select package_class from users where id = '$user_id'")[0] ;
	    $cls = $qr['package_class'] ;
	    
	    $cls1 = $cls - 1 ;
	    
	    db_update_query("update users set package_class = '$cls1' where id = '$user_id'") ;
	    
	    
	    $json['result']=true;	
		$json['message']="Entry Added Successfully";
	}else{
		throw new Exception("Something went wrong");
		
	}
}catch(Exception $e){	
	$json['result']=false;	
	$json['message']=$e->getMessage();
}	
echo json_encode($json);	
?>