<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);



try{

	if(!isset($table)){
		throw new Exception("please define table name");
	}
	
	if(!isset($id)){
		throw new Exception("please define id");
	}

	$check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}' and id != '{$_REQUEST['id']}' ") ;
	if($check_mobile)
	{
	  throw new Exception("Mobile Already Existing");  
	}

	$check_category = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}' and id != '{$_REQUEST['id']}'") ;
	if($check_category)
	{
	  throw new Exception("Email Already Existing");  
	}
	
	if(($_SESSION['login_type'] === "employee" || $_SESSION['login_type'] === 'subscriber') && ($_SESSION['login_id'] != $_REQUEST['id'])){ 
		throw new Exception("You are not Valid user.");  
	}

	
	unset($_REQUEST['table']);
	unset($_REQUEST['packagesid']);  
	unset($_REQUEST['pck_start_date']);  
	


	
// 	 $multiple = '' ;
//      $multiple1 = '' ;
	
	
// 	$q = db_select_query("SELECT * FROM users where id = '$id'")[0] ; 
// 	$multiple.=  $q['packagesid'].',' ; 
// 	$multiple1.= $q['expiry_dates'].',' ;
// 	$multiple2.= $q['hold_dates'].',' ;
// 	$multiple3.= $q['hold_status'].',' ;
	

 if($class_id)
      {

        $countfiles_or = count($_POST['class_id']);
          $mult = '' ;

          for($i=0;$i<$countfiles_or;$i++){
      $class_id=$_POST['class_id'][$i] ;
       $mult.= $class_id.',' ;
    }

      $_REQUEST['class_id']=trim($mult,',') ;
      }

	if($_SESSION['login_type'] === "employee"){
		if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
			$file['files']=$_FILES['image'];
			$file['destination']='../uploaded/employee';
			$_REQUEST['image']=upload_file($file);
		}		
	}else{
		if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
			$file['files']=$_FILES['image'];
			$file['destination']='../uploaded/users';
			$_REQUEST['image']=upload_file($file);
		}
	}

	if(isset($_REQUEST['password'])){
		if($_REQUEST['password'] == ''){
			unset($_REQUEST['password']);
		}
	}

	
	
	
// 	if($packagesid)
//       {

//         $countfiles = count($_POST['packagesid']);
         

//           for($i=0;$i<$countfiles;$i++){
              
//       $package=$_POST['packagesid'][$i] ;
//       $qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
//       $drtn = $qry['duration'] ;
      
//       $today_date = date('Y-m-d');  
//       $exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
//         $hold_date = "00-00-00" ;
//       $hold_status = "Active" ;
      
//       $multiple.= $package.',' ;
//       $multiple1.= $exp_date.',' ;
//         $multiple2.= $hold_date.',' ;
//       $multiple3.= $hold_status.',' ;
       
//     }

//       $_REQUEST['packagesid']=trim($multiple,',') ;
//     $_REQUEST['expiry_dates']=trim($multiple1,',') ;
//      $_REQUEST['hold_dates']=trim($multiple2,',') ;
//      $_REQUEST['hold_status']=trim($multiple3,',') ;
//       }
	
	

	
	$data['table']=$table;
	$data['values']=$_REQUEST;
	$data['where']['id']=$_REQUEST['id'];

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