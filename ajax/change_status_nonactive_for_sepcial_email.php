<?php 
include_once('../functions/functions.php');


  
          
          $save['status'] = "Non-Active" ;
          
          $data['table']="email_format";
	$data['values']=$save;
	$data['where']['type']="Special";

	if(db_update($data)){
		$json['result']=true;	
		$json['message']="Updated Successfully";
	}else{
	
		$json['result']=false;	
		$json['message']="Not Updated Successfully";	
	}
		    
		
		
		

    
    
echo json_encode($json);	
	
?>