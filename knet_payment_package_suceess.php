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
                                    <i class="fa fa-fw fa-users"></i> Package Buy Successful
                                </h4>
                            </div>
                            <div class="row">
                            <?php 
                                     $order_id = $_GET['OrderID'];
                                     $package_data = db_select_query("SELECT * FROM  upcoming_packages_generate WHERE order_id = '$order_id' AND deleted = 0")['0'];
                                     //$package_data = 1;
                                    if($package_data){ ?>
                                            <!-- form created  -->
                                            <form id="edit-user-form"  method="post" action="ajax/renew_package.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                            <input type="hidden" name="table" value="users" >
                                            <input type="hidden" name="id" value="<?=$package_data['user_id']?>" >
                                            <input type="hidden" name="cash_flow_created_by" value="Subscriber" >
                                            <input type="hidden" name="packagesid"  value="<?php echo $package_data['packagesid'] ?>" >
                                            <input type="hidden" name="pck_start_date"  value="<?php echo $package_data['pck_start_date'] ?>">
                                            <input type="hidden"  value="1" name="payment_method">
                                            <input type="hidden"  value="<?php echo $package_data['discount_code'] ?>" name="discount_code">
                                            <input type="hidden"  value="<?php echo $package_data['after_discount_price'] ?>" name="after_discount_price">                                            
                                            <?php                                              
                                            if($package_data['class_id'] != ''){
                                                $class_array = explode(',', $package_data['class_id']);
                                                if(count($class_array) > 0){ 
                                                    foreach($class_array as $row){
                                                    ?>
                                                    <input type="hidden" class="class_id" value="<?= $row;?>" name="class_id[]">
                                                <?php } } ?>
                                            <?php  } ?>
                                            <button type="submit" class="btn btn-warning btn_onload_submit">Update</button>
                                            </form>
                                            <!-- form created  -->
                                            <?php

                                            $ProductGenerate['table'] = 'upcoming_packages_generate';
                                            $values['payment_data'] = json_encode($_REQUEST);
                                            $values['deleted'] = 1;
                                            $values['payment_status'] = 'Completed';
                                            $ProductGenerate['values'] = $values;
                                            $ProductGenerate['where']['id']=$package_data['id'];
                                            db_update($ProductGenerate);

                                        }  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                                    <div class="order_page">
                                        Thank you
                                        <p class="order_id"><strong>Package Buy Id: </strong> <?php echo $order_id;?></p>
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
.btn_onload_submit {
    visibility: hidden;
    height: 0px;
    padding: 0;
    margin: 0;
    position: absolute;
}
</style>

<script>        
    $(document).ready(function(){
        $('.btn_onload_submit').trigger('click');
    })
 $("#edit-user-form").validate({
         rules:{             
      packagesid:{
            required:true,    
        },
        class_id:{
                required:true,           
            },         
        },
        messages:{
        packagesid:{
                    required:"Select Package",
            
                },
            class_id:{
                    required:"Choose Class",
                    
                },  
        },
         submitHandler: async (form, event)=>{
            event.preventDefault();           
            var data=new FormData($(form)[0]);            
            try {
               var response=await fetch(form.action,{
                           method:form.method, 
                           body: data, 
                           dataType:'JSON',
                           credentials: 'same-origin',
                        });
               
               var json= await response.json();
                     $(form).trigger('reset');
            //    if (json.result){

            //          toastr.success(json.message) ; 
            //          var id = json.uid ;
            //          setTimeout(function(){ 
            //             location.href="view_user.php?id="+id; 
            //          }, 3000);                      
            //    }else{
            //       toastr.info(json.message);
            //    }    
            }catch(err) {              
              // toastr.error(err);
            }            
         }  
      }); 
</script>
</html>

