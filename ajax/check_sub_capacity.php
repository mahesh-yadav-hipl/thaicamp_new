<?php 
include_once('../functions/functions.php');

	$pid = $_POST['pid'] ;
	
		$tdtt = date('Y-m-d'); 
	
	$get_sub_cpc  = db_select_query("SELECT * FROM classes WHERE id = '$pid' ")[0] ;
	$cap = $get_sub_cpc['capacity'] ;
	
// 	$get_act_sub  = db_select_query("SELECT * FROM users WHERE class_id = '$pid' and package_class != '0' and expiry_dates >= '$tdtt'  ") ;
//     $cn = count($get_act_sub) ;
    
     $all_us = db_select_query("select * from users where package_class != '0' and expiry_dates >= '$tdtt'") ;
                                    $cn = 0 ;
                                    foreach($all_us as $g)
                                    {
                                     $gr = explode(',', $g['class_id']);
                                      if(in_array($pid, $gr))
                                      {
                                        $cn++ ;  
                                      }
                                    
                                    }
    
    
     if($cap < $cn)
     {
       	$json['result']=true;
       	$json['cnt'] = $cn ;
      
       
     }
     else
     {
        $json['result']=false;
      
     }
echo json_encode($json);	
	
?>