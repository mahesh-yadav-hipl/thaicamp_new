<?php include('head.php') ;
$login_id = $_SESSION['login_id'];
if($_SESSION['login_type'] == "admin"){
	$employee_name = db_select_query("SELECT private_training.*,employee.name AS employee_name, subscriber.expiry_dates AS expiry_dates, subscriber.name AS subscriber_name FROM private_training
	LEFT JOIN users AS employee
	ON private_training.employee_id = employee.id 
	LEFT JOIN users AS subscriber
	ON private_training.subscriber_id = subscriber.id  ORDER BY private_training.id DESC");  
}elseif($_SESSION['login_type'] == "employee"){
	$employee_name = db_select_query("SELECT private_training.*,employee.name AS employee_name, subscriber.expiry_dates AS expiry_dates, subscriber.name AS subscriber_name FROM private_training
	LEFT JOIN users AS employee
	ON private_training.employee_id = employee.id 
	LEFT JOIN users AS subscriber
	ON private_training.subscriber_id = subscriber.id
    where private_training.employee_id = $login_id ORDER BY private_training.id DESC");
}else{
	$employee_name = db_select_query("SELECT private_training.*,employee.name AS employee_name, subscriber.expiry_dates AS expiry_dates, subscriber.name AS subscriber_name FROM private_training
	LEFT JOIN users AS employee
	ON private_training.employee_id = employee.id 
	LEFT JOIN users AS subscriber
	ON private_training.subscriber_id = subscriber.id
    where private_training.subscriber_id = $login_id ORDER BY private_training.id DESC");
}

?>


<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');?>        
<aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Private Training</h2>                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Private Training List
                                </h4>
	                            <span class="pull-right">
                                	<?php if($_SESSION['login_type'] == "admin"){ ?> 
	                                    <a  href="assign_private_trainee.php" class="btn btn-primary">Assign Trainee</a>
                            		<?php } if($_SESSION['login_type'] == "subscriber"){?>
                                        <a  href="buy_private_trainee.php" class="btn btn-primary">Buy Private Trainer</a>
                                    <?php } ?>

                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-bordered" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th style="width:100px;">Sr No.</th>
                                             <th>Employee Name</th>
                                             <th>Subscriber Name</th>
                                             <?php if($_SESSION['login_type'] === "admin" || $_SESSION['login_type'] === "employee"){?>
                                             <th>Price</th>
                                             <?php } ?>
                                             <th>PT Start Date</th>
                                             <th>PT End Date</th>
                                             <!-- <th>Price</th> -->
                                             <?php if($_SESSION['login_type'] === "admin"){?>
                                             <th>PT %</th>
                                             <th>Payment Method</th>
                                             <?php } ?>
                                             <th>Created at</th>
                                             <?php if($_SESSION['login_type'] === "admin"){?>
                                             <th>Action</th>
                                             <?php } ?>
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    if($employee_name) {
                                     $i = 1 ;
                                    foreach($employee_name as $k =>$v){ ?>    
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                            <td><?= ucfirst($v['employee_name']); ?></td>
                                            <td><?= ucfirst($v['subscriber_name']);?></td>
                                            <?php if($_SESSION['login_type'] === "admin"){?>
                                            <td><?= $v['price']?> KD</td>
                                            <?php } if($_SESSION['login_type'] === "employee") {?>
                                                <td><?= $v['employee_commission']?></td>
                                                <?php } ?>
                                            <td><?= ($v['pt_start_date']) != '' ? date("Y-m-d", strtotime($v['pt_start_date'])): '' ;?></td>
                                            <td><?= ($v['pt_end_date']) != '' ? date('Y-m-d', strtotime($v['pt_end_date'])): '' ; ?></td>
                                            <!-- <td><?//= $v['price']?></td> -->
                                            <?php if($_SESSION['login_type'] === "admin"){?>
                                                <td><?= $v['pt_percentage']?></td>
                                                <td><?php
                                                $pay_by = 'Cash';
                                                 if($v['payment_method'] == '1'){
                                                        $pay_by = 'Knet';
                                                    } 
                                                if($v['payment_method'] == '3'){
                                                    $pay_by = 'Visa';
                                                }   
                                                echo $pay_by;
                                                ?></td>
                                            <?php } ?>
                                            <td><?=$v['created_at']?></td>
                                            <?php if($_SESSION['login_type'] === "admin"){?>
                                            <td>
                                                <!-- <a class="btn btn-primary btn-sm" href="view_private_training.php?id=<?=$v['id']?>">View</a> -->
                                                <!-- <a class="btn btn-primary btn-sm" href="edit_employee.php?id=<?=$v['id']?>">Edit</a> -->
                                                <a class="btn btn-danger btn-sm remove" href="#" data-table='private_training' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a>
                                            </td> 
                                            <?php } ?> 

                                        </tr>
                                    <?php
                                      $i++ ;
                                    } 
                                    }?>
                                    </tbody>
                                </table>
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

<script>

$('body').on('click','.remove',function(){

        var id = $(this).data('value');
       var table_name= $(this).data('table');

         swal({
            title: 'Are you sure?',
            text: "You want to delete this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff8084',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             console.log(result) ;
            if (result) {
                $.ajax({
                    url:'ajax/delete.php',
                    type:'POST',
                    data:{'table':table_name,'key':'id','value':id},
                    dataType:'json',
                    success: function(response){
                          
                        toastr.success(response.message);                  
                       setTimeout(function(){ location.href='private-training.php'; },1500); 
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }).then(function(){
                    table.page(table.page.info().page).draw(false);
                }); 
            }
         });
         });
         
         
         

</script>
