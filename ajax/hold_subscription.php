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
		throw new Exception("please define user id");
	}
	

	$u = db_select_query("SELECT * FROM users where id = '$user_id' ")[0] ;

	$packages_id = explode(",",$u['packagesid']);
	$hold_dates = explode(",",$u['hold_dates']);
	$hold_status = explode(",",$u['hold_status']);
	foreach($packages_id as $key => $pack_id) {
		if($pack_id == $package_id)
		{
			$today_date = date('Y-m-d');  
			$hold_dates[$key] = $today_date ;
			$hold_status[$key] = "Hold" ;
		}
	}
	$hold_dates = implode(",", $hold_dates);
	$hold_status = implode(",", $hold_status);
	
	
	$save['hold_dates']=$hold_dates ;

	if(isset($hold_package_days)){
		$save['hold_days']=$hold_package_days;
		$save['hold_end_date']= Date('Y-m-d', strtotime('+'.$hold_package_days.' days'));
	}

	$save['hold_status']=$hold_status ;
	
	$data['table']="users";
	$data['values']=$save;
	$data['where']['id']=$user_id;

	if(db_update($data)){
		$json['result']=true;	
		$json['message']="Package Hold Successfully";
	}else{
		switch ($table) {
			case 'admins':
				throw new Exception("No changes made");
			break;
			
			default:
				throw new Exception("Something went wrong");
			break;
		}
		
	}
}catch(Exception $e){
	$json['result']=false;	
	$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>