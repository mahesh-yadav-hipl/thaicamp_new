<?php include('head.php') ;?>
<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');
if (! function_exists( 'curl_version' )) { exit
    ( "Enable cURL in PHP" );
    } 
?>      


<aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Knet </h2>                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Knet
                                </h4>
                            </div>
                            <div class="row">
        <?php 
        $order_id = $_GET['order_id'];
        $package_data = db_select_query("SELECT * FROM  upcoming_packages_generate WHERE order_id = '$order_id' AND deleted = 0 ");
            if(count($package_data) > 0){
            // $order_id = 'aaaaaaaaaaa'.time().time();
                $order_id = $package_data[0]['order_id'];
                $total_price = $package_data[0]['after_discount_price'];               
                if( $total_price > 0){
                    // for payment  
                        $extraMerchantsData = array();
                            // for test
                                $merchant_id = '1201';
                                $username = 'test';
                                $password = 'test';
                                $api_key = 'jtest123';
                               $success_url = URL.'knet_payment_package_suceess.php';
                               $error_url = URL.'knet_payment_error.php';
                                $test_mode = 1;
                                $CURLOPT_URL = "https://api.upayments.com/test-payment";
                                
                                //$order_id =time();
                            // for test
                                            
                            // for production
                                        // $merchant_id = '41858';
                                        // $username = 'coachgazi';
                                        // $password = 'GcRDB5[NNMnP';
                                        // $api_key = 'd04d6a6319739b7e149956d6382ecbb6717f0cee';
                                        //     $success_url = URL.'/knet_payment_suceess.php';
                                        //     $error_url = URL.'/knet_payment_error.php';
                                        // $test_mode = 0;
                                        // $CURLOPT_URL = "https://api.upayments.com/payment-request";
                            // for production

                            ini_set('display_errors', 1);
                            ini_set('display_startup_errors', 1);
                            error_reporting(E_ALL);
                            $fields = array(
                            'merchant_id'=>$merchant_id,
                            'username' => $username,
                            'password'=>stripslashes($password),
                          
                          'api_key'=>$api_key, // in sandbox request
  //////                   'api_key' =>password_hash($api_key,PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
                           
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
            
                }
            }
             ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-md-6 -->
                <!--row -->
            </div>
            <!--row ends-->
            <!-- /.content -->
        </aside>        <!-- /.right-side -->
    </div>
    <!-- /.right-side -->
    <!-- ./wrapper -->
     <!-- global js -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-validate.min.js"></script>
        <script src="js/toastr.min.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/custom_js/app.js" type="text/javascript"></script>
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
    <script src="vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/courses.js" type="text/javascript"></script>

    <script>
            $(document).ready(function(){
                window.location.href="<?php echo $server_output['paymentURL'];?>";
            })
        </script>
    <!-- end of page level js -->
</body>
<style>
    .panel-body.table-responsive {
    float: left;
    width: 100%;
}
.panel-danger > .panel-heading {

    float: left;
    width: 100%;
}
.panel-title {
    line-height: 20px;
    font-size: 15px;
    float: left;
    width: 70%;
}
.panel-heading span {
    margin-top: 0;
    font-size: 12px;
}
</style>
</html>

