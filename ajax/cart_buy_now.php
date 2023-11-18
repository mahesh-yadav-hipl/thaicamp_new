<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
	
if (isset($_SESSION['cart']) && isset($_SESSION['login_type'])) {
	 if($_SESSION['login_type'] === "admin"){
		$_REQUEST['crreated_by'] = 'Admin';
		$_REQUEST['payment_status'] = 'Complete';
		$data['table']='sell_products';		
		$json['created_by']='Admin';

		// date of purchase new functinaliy if you remove then uncomment date "$_REQUEST['created_at']"
			$_REQUEST['created_at'] = $createdat = date('Y-m-d 02:00:40', strtotime($_REQUEST['date_of_purchase']));
			unset($_REQUEST['date_of_purchase']);
	}else{
			$_REQUEST['created_at'] = date('Y-m-d h:i:s');
			unset($_REQUEST['date_of_purchase']);
		// date of purchase new functinaliy
	 }

	 if($_SESSION['login_type'] === "subscriber"){
		$_REQUEST['crreated_by'] = 'Subscriber';
		$_REQUEST['payment_status'] = 'Pending';
		$data['table']='sell_product_generate';
		$json['created_by']='Subscriber';
	}
	$_REQUEST['created_by_id']=$_SESSION['login_id'];

	unset($_REQUEST['buy_now']);
	$FourDigitRandomNumber = mt_rand(1111,9999);
	$FourDigitRandomNumbermore = mt_rand(1111,9999);
	$_REQUEST['order_id'] = 'TCOR-'.$FourDigitRandomNumber.strtotime(date('Y-m-d h:i:s')).$FourDigitRandomNumbermore;
	///// $_REQUEST['created_at'] = date('Y-m-d h:i:s');	
	$json['page_redirect']= 'Yes';
	$json['order_data']='';	
	$json['Knet_payment_redirect_url'] = '';
	if(count($_SESSION['cart']) > 0){
		// buy befor check
		foreach($_SESSION['cart'] as $row){
			if($row['quantiy'] > 0){
				$product_id = $row['product_id'];
				$quantiy = $row['quantiy'];
				$product = db_select_query("SELECT * FROM products WHERE id = '$product_id'")[0];
				if($product['stock'] < $quantiy) {
					$json['result']=true;
					$json['page_redirect']= 'No';	
					$json['message']='<span class="text-danger">Out of stock Product: <b>'.$product['title'].'</b></span>';
					echo json_encode($json);exit;	
				}
			}
		}
		// buy befor check
		foreach($_SESSION['cart'] as $row){
			if($row['quantiy'] > 0){
				$product_id = $row['product_id'];
				$quantiy = $row['quantiy'];
				$product = db_select_query("SELECT * FROM products WHERE id = '$product_id'")[0];
				if($product['stock'] < $quantiy) {
					$json['result']=true;
					$json['page_redirect']= 'No';	
					$json['message']='<span class="text-danger">Out of stock Product: <b>'.$product['title'].'</b></span>';
					echo json_encode($json);exit;	
				}else{
					// admin can direct buy
							//update quantity
								$productData['table'] = 'products';
								$productStock = (int)$product['stock'] - (int)$quantiy;
								$values['stock'] = $productStock;
								$productData['values'] = $values;
								$productData['where']['id']=$product_id;
								db_update($productData);
							//update quantity
							//add product
								$_REQUEST['product_detail'] = json_encode($product);
								$_REQUEST['product_id'] = $product_id;
								$_REQUEST['quantity'] = $quantiy;
								$_REQUEST['deleted'] =0;
								$data['values']=$_REQUEST;
								if($order = db_insert($data)){
									$json['order_data']=$_REQUEST['order_id'];
									// Knet payment Integrate
										if($_SESSION['login_type'] === "subscriber"){
											$order_id = $_REQUEST['order_id'];
											$product = db_select_query("SELECT * FROM sell_product_generate WHERE order_id = '$order_id' AND deleted = 0 ");
											if(count($product) > 0){
													$order_id = $product[0]['order_id'];
													$total_price = $product[0]['total_amount']-$product[0]['discount_amount'];               
													if( $total_price > 0){
														// for payment  
															$extraMerchantsData = array();
																// for test
																	// $merchant_id = '1201';
																	// $username = 'test';
																	// $password = 'test';
																	// $api_key = 'jtest123';
																    // $success_url = URL.'knet_payment_suceess.php';
																    // $error_url = URL.'knet_payment_error.php';
																	// $test_mode = 1;
																	// $CURLOPT_URL = "https://api.upayments.com/test-payment";
																// for test
																				
																// for production
																			$merchant_id = '41858';
																			$username = 'coachgazi';
																			$password = 'GcRDB5[NNMnP';
																			$api_key = 'd04d6a6319739b7e149956d6382ecbb6717f0cee';
																			    $success_url = URL.'knet_payment_suceess.php';
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
															  
													//////		  'api_key'=>$api_key, // in sandbox request
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
														   $json['Knet_payment_redirect_url'] = $server_output['paymentURL'];
													}
												}
										}
									// Knet payment Integrate

								}
							//add product				
					}
			}
		}
		//session unsert
			unset($_SESSION['cart']);
		//session unsert
	}
	$json['result']=true;	
	$json['message']='<span class="text-danger">Order Successful</span>';
}	
echo json_encode($json);exit;





?>