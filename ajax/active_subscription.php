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
	if(!isset($hold_date)){
		throw new Exception("please define hold date");
	}
	if(!isset($hold_status)){
		throw new Exception("please define hold status");
	}
	
  	$multiple = '' ;
    $multiple1 = '' ;
    $multiple3 = '' ;
    $multiple4 = '' ;
     
     
	$u = db_select_query("SELECT * FROM users where id = '$user_id' ")[0] ;
     
	$packages_id = explode(",",$u['packagesid']);
	$expiry_dates = explode(",",$u['expiry_dates']);
	$hold_dates = explode(",",$u['hold_dates']);
	$hold_status = explode(",",$u['hold_status']);
                  
	foreach($packages_id as $key => $pack_id) {
		if($pack_id == $package_id)
		{
		
			$today_date = date('Y-m-d');
			//$today_date = '2023-01-20';
			$datediff = strtotime($today_date) - strtotime($hold_dates[$key]) ;

			$rs = round($datediff / (60 * 60 * 24));

			$expiry_dates[$key] = date('Y-m-d', strtotime($expiry_dates[$key]. ' + '.$rs.' days')) ;
			
			$hold_status[$key] = "Active" ;
		
		}
	}
	$expiry_dates = implode(",", $expiry_dates);
	$hold_status = implode(",", $hold_status);
          
	$save['expiry_dates']=$expiry_dates ;
	$save['hold_status']=$hold_status ;
	
	$data['table']="users";
	$data['values']=$save;
	$data['where']['id']=$user_id;

	if(db_update($data)){
		$json['result']=true;	
		$json['message']="Package Active Successfully";
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