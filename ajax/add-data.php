<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);

try{

	if(!isset($table))
	{
		throw new Exception("Please define table name");
	}
	
	if(empty($packagesid))
	{
	   	
		throw new Exception("Please select package");
	   
	}
	
	if(empty($pck_start_date))
	{
		throw new Exception("Please select package start date");
	}
	
	if(empty($class_id))
	{
		throw new Exception("Please select classes");
	}
	
	if(empty($payment_method))
	{
		throw new Exception("Please select payment_method");
	}

  

	unset($_REQUEST['table']);
	
	$check_mobile = db_select_query("SELECT * FROM users WHERE mobile = '{$_REQUEST['mobile']}'") ;
	if($check_mobile)
	{
	  throw new Exception("Mobile Already Existing");  
	}
	
	$check_email = db_select_query("SELECT * FROM users WHERE email = '{$_REQUEST['email']}'") ;
	if($check_email)
	{
	  throw new Exception("Email Already Existing");  
	}
	

	if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){

		$file['files']=$_FILES['image'];
		$file['destination']='../uploaded/users';
		$_REQUEST['image']=upload_file($file);
	}
	
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
	
	
	if($packagesid)
    {

        // $countfiles = count($_POST['packagesid']);
        //   $multiple = '' ;
        //  $multiple1 = '' ;
        //   $multiple2 = '' ;
        //   $multiple3 = '' ;
        //   $multiple4 = '' ;
        //   $multiple5 = '' ;

        //   for($i=0;$i<$countfiles;$i++){
              
      	$package=$_POST['packagesid'] ;
      	$qry = db_select_query("SELECT * FROM packages where id = '$package'")[0] ; 
      
       	$drtn = $qry['duration'] ;
       	$cls = $qry['pck_class'] ;
      
       	$today_date = date('Y-m-d' , strtotime($_POST['pck_start_date']))   ;
      	$exp_date = date('Y-m-d', strtotime($today_date. ' + '.$drtn.' days'));
      	$hold_date = "00-00-00" ;
      	$hold_status = "Active" ;
      
		//   $multiple.= $package.',' ;
		//   $multiple1.= $exp_date.',' ;
		//   $multiple2.= $hold_date.',' ;
		//   $multiple3.= $hold_status.',' ;
		//     $multiple4.= $today_date.',' ;
		//      $multiple5.= $cls.',' ;
		
		// }

		$_REQUEST['packagesid']=$package   ;
		$_REQUEST['expiry_dates']=$exp_date  ;
		$_REQUEST['hold_dates']=$hold_date  ;
		$_REQUEST['hold_status']=$hold_status ;
		$_REQUEST['pck_start_date']=$today_date ;
		$_REQUEST['package_class']= $cls ;
    }
      
  
  	$tdt = date('j M, Y' , strtotime($_POST['pck_start_date']))   ;
	
	$get_register_email =  db_select_query("SELECT * FROM email_format where type = 'Register'")[0] ;
	$rand = rand(99999 , 10000) ;
	
	 if(!empty($_REQUEST['discount_code']))
    {
        $_REQUEST['discount_code'] = $_REQUEST['discount_code'] ;  
    }
    else
    {
        $_REQUEST['discount_code'] = "" ;  
    }
	if(!empty($_REQUEST['after_discount_price']))
	{
		$_REQUEST['after_discount_price'] = $_REQUEST['after_discount_price'] ;  
	}
	else
	{
		$_REQUEST['after_discount_price'] = "" ;  
	}
      
	
	
	$data['table']=$table;
	$data['values']=$_REQUEST;
	
	
	if($usr_id = db_insert($data)){
	    
	    $user = db_select_query("select * from users where id = '$usr_id' ")[0] ;
	    
	    
	    if(!empty($_REQUEST['discount_code']) && !empty($_REQUEST['after_discount_price']))
		{
			$prc =  $_REQUEST['after_discount_price']  ;  
			$dscnt_qry = db_select_query("select * from discount_code where id = '{$_REQUEST['discount_code']}' ")[0] ;
			$discnt_code = $dscnt_qry['code'] ;
		}
		else
		{
			$prc =  $qry['price'] ;
			
			$discnt_code = "No Discount" ;
		}
	    
	   
        
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From:".SENDER_NAME." <".SENDER_EMAIL.">" . "\r\n";
        
         
         $message = '<table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
					<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
						<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
						valign="top"></td>
						<td class="container" width="600"
							style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
					<div class="content"
						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0"
							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							   background-color="#fff">
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="alert alert-warning"
									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
									align="center" background-color="#71b6f9" valign="top">
									<img style="width:330px;" src="'.SITE_LOGO.'" alt="">
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
									<h3>'.$get_register_email['greeting'].' '.$name.',</h3>
									<p>'.$get_register_email['intro'].'</p>
									<p>'.$get_register_email['detail'].'</p>
									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
											— <b>'.$get_register_email['closing'].'</b>   
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
    					.$name.'<br>'
    					.$email.'<br>
    					Mobile - '.$mobile.'<br><br>
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
         
       $snt =  @mail($email,$get_register_email['subject'], $message, $headers);
       
        
    if($snt)
    {
       	$json['result']=true;	
		$json['message']="Added Successfully"; 
    }
    
	
	}else{
		throw new Exception("Something went wrong");
	}
}catch(Exception $e){
	$json['result']=false;	
	$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>