<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");

extract($_REQUEST);



try{
    
	if($packagesid){
		$getall_package = db_select_query("SELECT * FROM packages Where id = '$packagesid' ")[0];
		// check if discount not apply and price is actual or not
		if(($discount_code == '') && ($getall_package['price'] != $after_discount_price)){
			throw new Exception("Please Check Price");
		}
		// check if discount price is valid or not
		if(($discount_code !='') && ($getall_package['price'] != $after_discount_price)){
			$discount_codedata = db_select_query("SELECT * FROM discount_code WHERE code = '$discount_code'")[0];
			$total_amount_after_discount = $getall_package['price'] - $discount_codedata['price'];
			if($total_amount_after_discount != $after_discount_price){
				throw new Exception("Please Check discount Price");
			}		
		}
	}
    
    if(!isset($packagesid)){
		throw new Exception("please define package id");
	}
	
	 if(!isset($pck_start_date)){
		throw new Exception("please define package start date");
	}
	if($pck_start_date == ''){
		throw new Exception("please define package start date");
	}
	
	if(!isset($id)){
		throw new Exception("please define user id");
	}
	
	if(!isset($payment_method)){
		throw new Exception("please select payment_method");
	}	
	if($after_discount_price < 1){
		throw new Exception("Please Check Price. Price not valid.");
	}
	$td = date('Y-m-d'); 
	$json['page_redirect']="NO";
	$FourDigitRandomNumber = mt_rand(1111,9999);
	$FourDigitRandomNumbermore = mt_rand(1111,9999);
	$insert_data['order_id'] = 'PACK-'.$FourDigitRandomNumber.strtotime(date('Y-m-d h:i:s')).$FourDigitRandomNumbermore;
	$insert_data['user_id'] = $id;
	$insert_data['packagesid'] = $packagesid;

	$insert_data['pck_start_date'] = $pck_start_date;
	//$insert_data['package_class'] = $packagesid;
	$insert_data['payment_method'] = $payment_method;
	$insert_data['discount_code'] = $discount_code;
	$insert_data['after_discount_price'] = $after_discount_price;

	if($class_id)
	{
		$countfiles_or = count($_POST['class_id']);
		$mult = '' ;
		for($i=0;$i<$countfiles_or;$i++){
			$class_id=$_POST['class_id'][$i] ;
			$mult.= $class_id.',' ;
		}
		$insert_data['class_id']=trim($mult,',') ;
	}

	$insert_data['created_at'] = date('Y-m-d h:i:s');	
	$insert_data['deleted'] = 0;	
	$data['table']=$table;
	$data['values']=$insert_data;
	if($usr_id = db_insert($data)){	    
		// Knet payment Integrate
			$order_id = $insert_data['order_id'];
			$package_data = db_select_query("SELECT * FROM  upcoming_packages_generate WHERE order_id = '$order_id' AND deleted = 0 ");
			if(count($package_data) > 0){
					$order_id = $package_data[0]['order_id'];
					$total_price = $package_data[0]['after_discount_price'];               
					if( $total_price > 0){
						// for payment  
								$extraMerchantsData = array();
								// for test
									// $merchant_id = '1201';
									// $username = 'test';
									// $password = 'test';
									// $api_key = 'jtest123';
									// $success_url = URL.'knet_payment_package_suceess.php';
									// $error_url = URL.'knet_payment_error.php';
									// $test_mode = 1;
									// $CURLOPT_URL = "https://api.upayments.com/test-payment";									
									//$order_id =time();
								// for test
												
								// for production
											$merchant_id = '41858';
											$username = 'coachgazi';
											$password = 'GcRDB5[NNMnP';
											$api_key = 'd04d6a6319739b7e149956d6382ecbb6717f0cee';
											    $success_url = URL.'knet_payment_package_suceess.php';
											    $error_url = URL.'knet_payment_error.php';
											$test_mode = 0;
											$CURLOPT_URL = "https://api.upayments.com/payment-request";
								// for production
	
								ini_set('display_errors', 1);
								ini_set('display_startup_errors', 1);
								error_reporting(E_ALL);
								$fields = array(
								'merchant_id'=>$merchant_id,
								'username' => $username,
								'password'=>stripslashes($password),
							  
							//////  'api_key'=>$api_key, // in sandbox request
	 						    'api_key' =>password_hash($api_key,PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
							   
								'order_id'=>$order_id, // MIN 30 characters with strong unique function (like hashing function with time)
								'total_price'=>$total_price,	
								'CurrencyCode'=>'KWD',//only works in production mode	
								'CstFName'=>'Test Name',
								'CstEmail'=>'test@test.com',
								'CstMobile'=>'12345678',
								'success_url'=>$success_url,
								'error_url'=>$error_url,
								'test_mode'=>$test_mode, // test mode enabled
								'customer_unq_token'=>65920000, //pass unique customer identifier (eg: mobile number)
								'kfast_card_token'=>'5On9XaeXNM',//pass encrypted kfast card token received through user card token API
								'credit_card_token'=>'dzk9Z1Lr7q',// pass encrypted credit card token received through user card token API
							/// 'whitelabled'=>true, // only accept in live credentials (it will not work in test)
								'whitelabled'=>false, // only accept in live credentials (it will not work in test)
								'payment_gateway'=>'knet',// only works in production mode
								'ProductName'=>json_encode(['computer','television']),
								'ProductQty'=>json_encode([2,1]),
								'ProductPrice'=>json_encode([150,1500]),
								'reference'=>'Ref00001', // Reference that you want to show in invoice in ref column
								'ExtraMerchantsData'=>json_encode($extraMerchantsData)
								);
							$fields_string = http_build_query($fields);
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL,$CURLOPT_URL);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
							// receive server response ...
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$server_output = curl_exec($ch);
							curl_close($ch);
							$server_output = json_decode($server_output,true);
							// window.location.href=$server_output[‘paymentURL’]; // javascript                        
						   // header('Location:'.$server_output['paymentURL']); // PHP						   
						   $json['page_redirect']="Yes";
						   $json['Knet_payment_redirect_url'] = $server_output['paymentURL'];	
					}
				}
		// Knet payment Integrate
		
		
		$json['result']=true;	
		
		$json['order_data']= $insert_data['order_id'];
		$json['message']="Added Successfully"; 

		
	}
	 


}catch(Exception $e){
	$json['result']=false;	
	$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>