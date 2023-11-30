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
	
	unset($_REQUEST['table']);
	
	
  $old_data = db_select_query("SELECT * FROM users where id = '$id'")[0] ;
  $old_pckid  = $old_data['packagesid'] ;
  $old_pckclass  = $old_data['package_class'] ;
  $old_pckPrice  = $old_data['after_discount_price'] ;
  $old_start_date  = date('Y-m-d' , strtotime($old_data['pck_start_date']))   ;
  
  
  $old_pck_data = db_select_query("SELECT * FROM packages where id = '$old_pckid'")[0] ;
  $real_pckclass =  $old_pck_data['pck_class'] ;
  
  $count_pck_class =  $real_pckclass -  $old_pckclass ;
  
  
//   $_REQUEST['pck_start_date'] = $_date('Y-m-d' , strtotime($_REQUEST['pck_start_date']))   ;
	



	

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


	
	
if($old_pckid != $_REQUEST['packagesid'] )
      {
       $package=$_POST['packagesid'] ;
      $qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
       $drtn = $qry['duration'] ;
       $cls = $qry['pck_class'] ;
      $_REQUEST['packagesid']=$package   ;
     $_REQUEST['package_class']= $cls - $count_pck_class ;
     
     if($old_start_date != $_REQUEST['pck_start_date'] )
      {
       $today_date = $_REQUEST['pck_start_date'] ;
      $exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
      $_REQUEST['expiry_dates']=$exp_date  ;
    
      $_REQUEST['pck_start_date']=$today_date ;
      
      }
      }
      
      
      if($old_pckid == $_REQUEST['packagesid'] )
      {
       $package=$old_pckid ;
      $qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
       $drtn = $qry['duration'] ;
     
     if($old_start_date != $_REQUEST['pck_start_date'] )
      {
       $today_date = $_REQUEST['pck_start_date'] ;
      $exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
      $_REQUEST['expiry_dates']=$exp_date  ;
    
      $_REQUEST['pck_start_date']=$today_date ;
      
      }
      }

      if($old_pckPrice != $_REQUEST['package_price']){
          $_REQUEST['after_discount_price']= $_REQUEST['package_price'];         
          $save_cash_flow['created_at'] = date('Y-m-d h:i:s'); 
          $save_cash_flow['user_id'] = $id; 
          $save_cash_flow['packagesid'] = $_REQUEST['packagesid']; 
          $save_cash_flow['price'] = $_REQUEST['package_price']; 
          $save_cash_flow['created_by'] = 'Admin';
          $cash_flow_date['table'] = "cash_flow" ;
          $cash_flow_date['values'] = $save_cash_flow ;		
          db_insert($cash_flow_date);         
        }
        unset($_REQUEST['package_price']);

	
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