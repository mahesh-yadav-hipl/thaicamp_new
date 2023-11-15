<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);

if(!isset($table))
{
	throw new Exception("Please define table name");
}
try{
	if(!isset($employee_id)){
		throw new Exception("please define Trainer");
	}	
	if(!isset($pt_start_date)){
		throw new Exception("please define PT Start Date");
	}	
	////// $getall_package = db_select_query("SELECT * FROM users Where id = '$employee_id' AND role = 'employee'  And subscriber_buy_price > 0 ")[0];
	$getall_package = db_select_query("SELECT * FROM users Where id = '$employee_id' AND role = 'employee' ")[0];
	$json['page_redirect']= 'No';
	$json['Knet_payment_redirect_url'] ='';
	if($getall_package){

		$FourDigitRandomNumber = mt_rand(1111,9999);
		$FourDigitRandomNumbermore = mt_rand(1111,9999);
		$_REQUEST['order_id'] = $order_id = 'PT-'.$FourDigitRandomNumber.strtotime(date('Y-m-d h:i:s')).$FourDigitRandomNumbermore;
		$_REQUEST['subscriber_id'] = $_SESSION['login_id'];
		$_REQUEST['created_at'] = date('Y-m-d h:i:s');

		////// $_REQUEST['price'] = $getall_package['subscriber_buy_price'];
		 $_REQUEST['price'] = $_REQUEST['pt_price'];
		$_REQUEST['pt_percentage'] = $getall_package['employee_percentage'];

		$_REQUEST['pt_start_date'] = date('Y-m-d 00:00:00',strtotime($_REQUEST['pt_start_date']));
		////// $e_commission = $getall_package['subscriber_buy_price'] * ($getall_package['employee_percentage']/100);
		 $e_commission = $_REQUEST['pt_price'] * ($getall_package['employee_percentage']/100);
		$_REQUEST['employee_commission'] = $e_commission;
		$data['table']=$table;
		unset($_REQUEST['table']);
		unset($_REQUEST['pt_price']);
		$data['values']=$_REQUEST;
		if($usr_id = db_insert($data)){	    

			// Knet payment Integrate
			$pt_data_get = db_select_query("SELECT * FROM  private_training_generate WHERE order_id = '$order_id' AND deleted = 0 ");
			if(count($pt_data_get) > 0){
					$order_id = $pt_data_get[0]['order_id'];
					$total_price = $pt_data_get[0]['price'];               
					if( $total_price > 0){
						// for payment  
								$extraMerchantsData = array();
								// for test
									// $merchant_id = '1201';
									// $username = 'test';
									// $password = 'test';
									// $api_key = 'jtest123';
									// $success_url = URL.'knet_payment_private_trainer_suceess.php';
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
											    $success_url = URL.'knet_payment_private_trainer_suceess.php';
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
						   $json['page_redirect']="Yes";
						   $json['Knet_payment_redirect_url'] = $server_output['paymentURL'];	
					}
				}
		// Knet payment Integrate


				$json['result']=true;	
				$json['message']="Added Successfully"; 
		}
	}
}catch(Exception $e){
		$json['result']=false;	
		$json['message']=$e->getMessage();
}

echo json_encode($json);	
?>