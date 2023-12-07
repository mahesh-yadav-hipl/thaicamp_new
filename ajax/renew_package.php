<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);

try{
    
 
    
    if(!isset($packagesid)){
		throw new Exception("please define package id");
	}
	
	 if(!isset($pck_start_date)){
		throw new Exception("please define package start date");
	}
	
	if(!isset($id)){
		throw new Exception("please define user id");
	}
	
	if(!isset($payment_method)){
		throw new Exception("please select payment_method");
	}
	
	$td = date('Y-m-d'); 

	//cash flow income 
	
	if(isset($cash_flow_created_by)){
		$save_cash_flow['created_at'] = date('Y-m-d h:i:s'); 
		$save_cash_flow['user_id'] = $id; 
		$save_cash_flow['packagesid'] = $_POST['packagesid']; 
		$save_cash_flow['price'] = $_POST['after_discount_price']; 
		$save_cash_flow['created_by'] = $cash_flow_created_by;
		$cash_flow_date['table'] = "cash_flow" ;
		$cash_flow_date['values'] = $save_cash_flow ;		
		db_insert($cash_flow_date);
		unset($_REQUEST['cash_flow_created_by']);
	}
	//cash flow income 
	 
	$initial_user_query = db_select_query("select * from users where id = '$id' ")[0] ;

	if($td > $initial_user_query['expiry_dates'] && ($initial_user_query['expiry_dates'] !='')){
		$old_package_id = $initial_user_query['packagesid'] ;
		$old_package_query = db_select_query("select * from packages where id = '$old_package_id' ")[0] ;
		$old_name = $old_package_query['name'] ;
		
		$get_old_package_data = db_select_query("select * from old_packages where user_id = '$id' and name = '$old_name' and start_date = {$initial_user_query['pck_start_date']} ") ; 
		if($get_old_package_data)
		{
			
		}
		else
		{
			$save_old_package['user_id'] = $initial_user_query['id'] ;
			$save_old_package['start_date'] = $initial_user_query['pck_start_date'] ;
			$save_old_package['end_date'] = $initial_user_query['expiry_dates'] ;
			$save_old_package['classes_count'] = $initial_user_query['package_class'] ;
			if(!empty($initial_user_query['discount_code']) && !empty($initial_user_query['after_discount_price']))
			{
				$save_old_package['price'] =  $initial_user_query['after_discount_price'] ;
			} else {
				$save_old_package['price'] = $old_package_query['price'] ;  
			}
			
			$save_old_package['duration'] = $old_package_query['duration'] ;
			$save_old_package['name'] = $old_package_query['name'] ;

			$old_package_data['table'] = "old_packages" ;
			$old_package_data['values'] = $save_old_package ;
			db_insert($old_package_data) ;
			
		}
	}
	
	if(($initial_user_query['package_class'] != '0') && ($td <= $initial_user_query['expiry_dates']) && ($initial_user_query['expiry_dates'] !=''))
	{
		$package =  $_POST['packagesid'] ;
		$qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
		$drtn = $qry['duration'] ;
		$cls = $qry['pck_class'] ;
      
		$today_date = date('Y-m-d' , strtotime($_POST['pck_start_date']))   ;
		$exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
		$hold_date = "00-00-00" ;
		$hold_status = "Active" ;


		$save_upcoming['user_id'] = $id ;
		$save_upcoming['packagesid']=$package ;
		$save_upcoming['expiry_dates']=$exp_date ;
		$save_upcoming['hold_dates']=$hold_date ;
		$save_upcoming['hold_status']=$hold_status ;
		$save_upcoming['pck_start_date']=$today_date ;
		$save_upcoming['package_class']=$cls ;
      
      
		if($class_id)
		{

			$countfiles_or = count($_POST['class_id']);
			$mult = '' ;

			for($i=0;$i<$countfiles_or;$i++){
				$class_id=$_POST['class_id'][$i] ;
				$mult.= $class_id.',' ;
			}

			$save_upcoming['class_id']=trim($mult,',') ;
		}
      
     
    	$save_upcoming['payment_method'] = $_POST['payment_method'] ;
      
		if(!empty($_POST['discount_code']))
		{
			$save_upcoming['discount_code'] = $_POST['discount_code'] ;  
		}
		else
		{
			$save_upcoming['discount_code'] = "" ;  
		}
		if(!empty($_POST['after_discount_price']))
		{
			$save_upcoming['after_discount_price'] = $_POST['after_discount_price'] ;  
		}
		else
		{
			$save_upcoming['after_discount_price'] = "" ;  
		}
      
            
       	$u = db_select_query("SELECT * FROM users where id = '$id' ")[0] ;
		$uemail = $u['email'] ;
		$uname = $u['name'] ;
	       
	                  
   		$get_thankyou_email =  db_select_query("SELECT * FROM email_format where type = 'Thankyou'")[0] ;
   
   
		$rand = rand(99999 , 10000) ;


		$tdt = date("j M, Y");
		$save_upcoming['created_at'] = date('Y-m-d h:i:s'); 
      
		$data_upcoming['table'] = "upcoming_packages";
		$data_upcoming['values'] = $save_upcoming;

	  	if(db_insert($data_upcoming)){
	    
	   		$user = db_select_query("select * from users where id = '$id' ")[0] ;
	    
	    
			if(!empty($_POST['discount_code']) && !empty($_POST['after_discount_price']))
			{
				$prc =  $_POST['after_discount_price']  ;  
				$dscnt_qry = db_select_query("select * from discount_code where id = '{$_POST['discount_code']}' ")[0] ;
				$discnt_code = $dscnt_qry['code'] ;
			}
			else
			{
				$prc =  $qry['price'] ;
				$discnt_code = "No Discount" ;
			}
			$email_form_address = db_select_query("SELECT * FROM email_format WHERE type = 'Email_FROM_ADDRESS'") ;
				if($email_form_address)
				{
					$sender_email_is = $email_form_address['0']['detail'];
				}else{
					$sender_email_is = SENDER_EMAIL;
				}
	    
	  		$headers  = "MIME-Version: 1.0" . "\r\n";
    		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    		$headers .= "From:".SENDER_NAME." <".$sender_email_is.">" . "\r\n";
        
         
         	$message = '<table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
			<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
			<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
			valign="top"></td>
				<td class="container" width="600"
					style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
					valign="top">
					<div class="content"
						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0"
							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							   background-color="#fff">
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="alert alert-warning"
									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
									align="center" background-color="#71b6f9" valign="top">
									<img style="width:330px;" src="'.SITE_LOGO.'" alt="" >
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
									<h3>'.$get_thankyou_email['greeting'].' '.$uname.',</h3>
									<p>'.$get_thankyou_email['intro'].'</p>
									<p>'.$get_thankyou_email['detail'].'</p>
									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
											— <b>'.$get_thankyou_email['closing'].'</b>   
										</p>
									</p>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
					valign="top"></td>
			</tr>
			</table>
		
		 	<div class="container" style="padding:15px;width:96.5%; margin: 0 auto; float:left;border:1px solid #fc7070; padding-bottom:50px; border-top:15px solid #fc7070;">
               
                             
    		<div class="row" style="width:100%; float:left">
        	<div class="col-md-12">
             <h1 style="display: block;margin-left:auto;margin-right:auto;text-align:center;color:#fc7070;">THAICAMP</h1>
    		<div class="invoice-title" style="width:100%; float:left;border-bottom:2px solid #ddd;margin-bottom:20px;padding-right:50px;">
    			<h2 style="width:50%; float:left">Invoice</h2><h3 class="pull-right" style="width:50%; float:left;text-align:right;margin-left: -35px;">Invoice #'.$rand.'</h3>
    		</div>
    		<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;">
    				<strong>Billed To:</strong><br>'
    					.$u['name'].'<br>'
    					.$u['email'].'<br>
    					Mobile - '.$u['mobile'].'<br><br>
    				</address>
    			</div>
    			
    		</div>
    		<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;margin-bottom:25px;">
    					<strong>Payment Date:</strong><br>'
    					.$tdt.'<br>
    				
    				</address>
    			</div>
    		
    		</div>
    		</div>
    		</div>
    
    
			<div class="row" style="width:100%; float:left;box-shadow: 0 1px 1px rgba(0,0,0,.05);">
				<div class="col-md-12">
					<div class="panel panel-default" style="">
						<div class="panel-heading">
							<h3 class="panel-title" style="width:97%;float:left;padding:15px;background:#f2f2f2;margin:0;"><strong>Package summary</strong></h3>
						</div>
						<div class="panel-body" >
							<div class="table-responsive" style="">
								<table class="table table-condensed" style="width:100%; padding:0 15px">
									<thead>
										<tr class="no-line">
											<td style="width:35%; padding:5px; border-bottom:1px solid #ddd;"><strong>ID</strong></td>
											<td style="width:25%; border-bottom:1px solid #ddd;" class="text-center"><strong>Name</strong></td>
											<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Duration</strong></td>
											<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Description</strong></td>
											<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Services</strong></td>
											<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Number of classes</strong></td>
											<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Discount Code</strong></td>
											<td style="width:15%;border-bottom:1px solid #ddd;" class="text-right"><strong>Price</strong></td>
										</tr>
									</thead>
									<tbody>
										
										<tr>
											<td style="width:35%;padding:10px 0;border-bottom:2px solid;">'.$qry['package_id'].'</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['name'].'</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['duration'].' Days</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['description'].'</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['services'].'</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['pck_class'].'</td>
											<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$discnt_code.'</td>
											<td style="width:15%;padding:10px 0;border-bottom:2px solid;" class="text-right">'.$prc.' KD</td>
										</tr>
										
									
										<tr>
											
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line" style="padding:5px"></td>
											<td class="thick-line text-center" style="padding:5px"><strong>Total</strong></td>
											<td class="thick-line text-right" style="padding:5px">'.$prc.' KD</td>
										</tr>
									
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

        
            </div>';
         
       		$snt =  @mail($uemail,$get_thankyou_email['subject'], $message, $headers);
			if($snt)
			{
				$json['result']=true;
				$json['uid'] = $id ;
				$json['message']="Package Added Successfully"; 
			}
	
		}
		else{
			switch ($table) {
				case 'admins':
					throw new Exception("No changes made");
				break;
				
				default:
					throw new Exception("Something went wrong");
				break;
			}
		
		}
	}
	else
	{
	    $save1['packagesid'] = "" ;
     	$save1['class_id'] = "" ;
    	$save1['pck_start_date'] = "" ;
    	$save1['package_class'] = "" ;
    	$save1['hold_dates'] = "" ;
    	$save1['hold_status'] = "" ;
    	$save1['expiry_dates'] = "" ;
    
    
		$data1['table']="users";
		$data1['values']=$save1;
		$data1['where']['id']=$id;
		$updt = db_update($data1) ;

		$qry_userdata = db_select_query("SELECT * FROM users where id = '$id'")[0] ;

		if($updt || $qry_userdata['packagesid'] == ''){
      		$package= $_POST['packagesid'] ;
      		$qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
       		$drtn = $qry['duration'] ;
       		$cls = $qry['pck_class'] ;
      
       		$today_date = date('Y-m-d' , strtotime($_POST['pck_start_date']))   ;
      		$exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
      		$hold_date = "00-00-00" ;
      		$hold_status = "Active" ;

			$save['packagesid']=$package ;
			$save['expiry_dates']=$exp_date ;
			$save['hold_dates']=$hold_date ;
			$save['hold_status']=$hold_status ;
			$save['pck_start_date']=$today_date ;
			$save['package_class']=$cls ;
      
      
      		if($class_id)
      		{

        		$countfiles_or = count($_POST['class_id']);
          		$mult = '' ;

				for($i=0;$i<$countfiles_or;$i++){
					$class_id=$_POST['class_id'][$i] ;
					$mult.= $class_id.',' ;
				}

      			$save['class_id']=trim($mult,',') ;
      		}
      
     
      		$save['payment_method'] = $_POST['payment_method'] ;
      
      		if(!empty($_POST['discount_code']))
      		{
        		$save['discount_code'] = $_POST['discount_code'] ;  
      		}
      		else
			{
				$save['discount_code'] = "" ;  
			}
			if(!empty($_POST['after_discount_price']))
			{
				$save['after_discount_price'] = $_POST['after_discount_price'] ;  
			}
			else
			{
				$save['after_discount_price'] = "" ;  
			}
      
      
      
      
       		$u = db_select_query("SELECT * FROM users where id = '$id' ")[0] ;
	       	$uemail = $u['email'] ;
	       	$uname = $u['name'] ;
	       
	                  
   			$get_thankyou_email =  db_select_query("SELECT * FROM email_format where type = 'Thankyou'")[0] ;
   
   
			$rand = rand(99999 , 10000) ;


			$tdt = date("j M, Y");
	
			$data['table']="users";
			$data['values']=$save;
			$data['where']['id']=$id;

			
			if(db_update($data)){
	     		$user = db_select_query("select * from users where id = '$id' ")[0] ;
	    
	    
	    		if(!empty($user['discount_code']) && !empty($user['after_discount_price']))
    			{
					$prc =  $user['after_discount_price']  ;  
					$dscnt_qry = db_select_query("select * from discount_code where id = '{$user['discount_code']}' ")[0] ;
					$discnt_code = $dscnt_qry['code'] ;
				}
				else
				{
					$prc =  $qry['price'] ;
					
					$discnt_code = "No Discount" ;
				}

				$email_form_address = db_select_query("SELECT * FROM email_format WHERE type = 'Email_FROM_ADDRESS'") ;
				if($email_form_address)
				{
					$sender_email_is = $email_form_address['0']['detail'];
				}else{
					$sender_email_is = SENDER_EMAIL;
				}
				
	  			$headers  = "MIME-Version: 1.0" . "\r\n";
    			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    			$headers .= "From:".SENDER_NAME." <".$sender_email_is.">" . "\r\n";
        
         
         		$message = '<table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
				<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
				<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
				valign="top"></td>
				<td class="container" width="600"
					style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
					valign="top">
					<div class="content"
						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0"
							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							   background-color="#fff">
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="alert alert-warning"
									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
									align="center" background-color="#71b6f9" valign="top">
									<img style="width:330px;" src="'.SITE_LOGO.'" alt="" >
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
									<h3>'.$get_thankyou_email['greeting'].' '.$uname.',</h3>
									<p>'.$get_thankyou_email['intro'].'</p>
									<p>'.$get_thankyou_email['detail'].'</p>
									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
											— <b>'.$get_thankyou_email['closing'].'</b>   
										</p>
									</p>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
					valign="top"></td>
				</tr>
				</table>
		
		 		<div class="container" style="padding:15px;width:96.5%; margin: 0 auto; float:left;border:1px solid #fc7070; padding-bottom:50px; border-top:15px solid #fc7070;">
               
                             
    			<div class="row" style="width:100%; float:left">
        		<div class="col-md-12">
             	<h1 style="display: block;margin-left:auto;margin-right:auto;text-align:center;color:#fc7070;">THAICAMP</h1>
    			<div class="invoice-title" style="width:100%; float:left;border-bottom:2px solid #ddd;margin-bottom:20px;padding-right:50px;">
    			<h2 style="width:50%; float:left">Invoice</h2><h3 class="pull-right" style="width:50%; float:left;text-align:right;margin-left: -35px;">Invoice #'.$rand.'</h3>
    			</div>
    			<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;">
    				<strong>Billed To:</strong><br>'
    					.$u['name'].'<br>'
    					.$u['email'].'<br>
    					Mobile - '.$u['mobile'].'<br><br>
    				</address>
    			</div>
    			
    			</div>
    			<div class="row" style="width:100%; float:left">
    			<div class="col-md-6" style="width:50%; float:left">
    				<address style="font-style:normal;margin-bottom:25px;">
    					<strong>Payment Date:</strong><br>'
    					.$tdt.'<br>
    				
    				</address>
    			</div>
    		
    			</div>
    			</div>
    			</div>
    
    
				<div class="row" style="width:100%; float:left;box-shadow: 0 1px 1px rgba(0,0,0,.05);">
				<div class="col-md-12">
				<div class="panel panel-default" style="">
    			<div class="panel-heading">
    				<h3 class="panel-title" style="width:97%;float:left;padding:15px;background:#f2f2f2;margin:0;"><strong>Package summary</strong></h3>
    			</div>
    			<div class="panel-body" >
    				<div class="table-responsive" style="">
    					<table class="table table-condensed" style="width:100%; padding:0 15px">
    						<thead>
                                <tr class="no-line">
        							<td style="width:35%; padding:5px; border-bottom:1px solid #ddd;"><strong>ID</strong></td>
        							<td style="width:25%; border-bottom:1px solid #ddd;" class="text-center"><strong>Name</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Duration</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Description</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Services</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Number of classes</strong></td>
        							<td style="width:25%;border-bottom:1px solid #ddd;" class="text-center"><strong>Discount Code</strong></td>
        							<td style="width:15%;border-bottom:1px solid #ddd;" class="text-right"><strong>Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							
    							<tr>
    							   	<td style="width:35%;padding:10px 0;border-bottom:2px solid;">'.$qry['package_id'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['name'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['duration'].' Days</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['description'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['services'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$qry['pck_class'].'</td>
    								<td style="width:25%;padding:10px 0;border-bottom:2px solid;" class="text-center">'.$discnt_code.'</td>
    								<td style="width:15%;padding:10px 0;border-bottom:2px solid;" class="text-right">'.$prc.' KD</td>
    							</tr>
    							
                               
    							<tr>
    								
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line" style="padding:5px"></td>
    								<td class="thick-line text-center" style="padding:5px"><strong>Total</strong></td>
    								<td class="thick-line text-right" style="padding:5px">'.$prc.' KD</td>
    							</tr>
    						
    						
    						</tbody>
    					</table>
    				</div>
    			</div>
				</div>
				</div>
				</div>

			
				</div>';
         
       			$snt =  @mail($uemail,$get_thankyou_email['subject'], $message, $headers);
        
        
				if($snt)
				{
					$json['result']=true;
					$json['uid'] = $id ;
					$json['message']="Package Added Successfully"; 
				} 
				// else {
				// 	$json['result']=true;
				// 	$json['uid'] = $id ;
				// 	$json['message']="Package Added Successfully"; 
				// }
	
			}
			else{
				switch ($table) {
					case 'admins':
						throw new Exception("No changes made");
					break;
					
					default:
						throw new Exception("Something went wrong");
					break;
				}
		
			}
	    
	    
		}
	    
	}

}catch(Exception $e){
	$json['result']=false;	
	$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>