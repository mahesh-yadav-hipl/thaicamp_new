<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);
// print_r($_REQUEST);
// exit() ;


try{

	if(!isset($packagesid)){
		throw new Exception("please select packages");
	}
	
	if(!isset($id)){
		throw new Exception("please define id");
	}
	

	
	 $multiple = '' ;
     $multiple1 = '' ;
	
	
	$q = db_select_query("SELECT * FROM users where id = '$id'")[0] ; 
	$multiple.=  $q['packagesid'].',' ; 
	$multiple1.= $q['expiry_dates'].',' ;
	$multiple2.= $q['hold_dates'].',' ;
	$multiple3.= $q['hold_status'].',' ;
	

	
	if($packagesid)
      {

        $countfiles = count($_POST['packagesid']);
         

          for($i=0;$i<$countfiles;$i++){
              
      $package=$_POST['packagesid'][$i] ;
      $qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
       $drtn = $qry['duration'] ;
      
       $today_date = date('Y-m-d');  
      $exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
        $hold_date = "00-00-00" ;
      $hold_status = "Active" ;
      
       $multiple.= $package.',' ;
       $multiple1.= $exp_date.',' ;
        $multiple2.= $hold_date.',' ;
       $multiple3.= $hold_status.',' ;
       
    }

      $_REQUEST['packagesid']=trim($multiple,',') ;
    $_REQUEST['expiry_dates']=trim($multiple1,',') ;
     $_REQUEST['hold_dates']=trim($multiple2,',') ;
     $_REQUEST['hold_status']=trim($multiple3,',') ;
      }
	

	
	$data['table']="users";
	$data['values']=$_REQUEST;
	$data['where']['id']=$_REQUEST['id'];

	if(db_update($data)){
		$json['result']=true;	
		$json['message']="Packages Added Successfully";
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