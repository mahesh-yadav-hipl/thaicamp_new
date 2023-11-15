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
<style>
    .order_page{width: 300px;
    margin: 51px auto;
    text-align: center;
    font-size: 30px;
    font-weight: 600;
    border: 1px solid #fc7070;
    padding: 46px 15px;
    box-sizing: border-box;}
    .order_id{
    font-weight: 100;
}
</style>

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
                                    <i class="fa fa-fw fa-users"></i> Payment Successful
                                </h4>
                            </div>
                            <div class="row">
                            <?php 
                                     $order_id = $_GET['OrderID'];
                                     $pt_data_get = db_select_query("SELECT * FROM private_training_generate WHERE order_id = '$order_id' AND deleted = 0 ");
                                    if(count($pt_data_get) > 0){
                                         foreach($pt_data_get as $row){
                                            
                                             $order_data['created_by'] = 'Subscriber';
                                             $order_data['employee_id'] = $row['employee_id'];
                                             $order_data['subscriber_id'] = $row['subscriber_id'];
                                             $order_data['price'] = $row['price'];
                                             $order_data['pt_percentage'] = $row['pt_percentage'];
                                             $order_data['pt_start_date'] = $row['pt_start_date'];
                                             $order_data['employee_commission'] = $row['employee_commission'];
                                             $order_data['created_at'] = $row['created_at'];                                   

                                              $data['table']='private_training';	
                                              $data['values']=$order_data;
                                             if($order = db_insert($data)){
                                                    $ProductGenerate['table'] = 'private_training_generate';
                                                    $values['deleted'] = 1;
                                                    $values['payment_status'] = 'Completed';
                                                    $values['payment_data'] = json_encode($_REQUEST);
                                                    $ProductGenerate['values'] = $values;
                                                    $ProductGenerate['where']['id']=$row['id'];
                                                    db_update($ProductGenerate);
                                                }
                                         }
                                     }
                            ?>



                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                                    <div class="order_page">
                                        Thank you
                                        <p class="order_id"><strong>Payment Id: </strong> <?php echo $order_id;?></p>
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

