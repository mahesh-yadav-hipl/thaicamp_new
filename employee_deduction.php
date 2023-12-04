<?php include('head.php') ;
$employee_deduction = db_select_query("SELECT employee_deduction.*, employee.name as employee_name FROM employee_deduction
    LEFT JOIN users AS employee
    ON employee_deduction.employee_id = employee.id 
 Where employee_deduction.deleted = 0 ORDER BY employee_deduction.id DESC");?>
 <link type="text/css" href="css/new_custom.css" rel="stylesheet">
<body>
<div class="se-pre-con2"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');?>        
<aside class="right-side right-padding n_tabledata">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Employees Deduction</h2>                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Employees Deduction List
                                </h4>
                               <span class="pull-right">
                                    <a  href="add_employee_deduction.php" class="btn btn-primary">Add Employee Deduction</a>
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th style="width: 100px;">Sr No.</th>
                                             <th>Name</th>
                                             <th>Deduction Amount</th>
                                             <th>Reason</th>
                                             <th>Created at</th>
                                             <th>Action</th>
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    if($employee_deduction) {
                                     $i = 1 ;
                                    foreach($employee_deduction as $k =>$v){  ?>    
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                            <td><?= ucfirst($v['employee_name']); ?></td>
                                            <td><?=(int)$v['deduction_amount']?></td>
                                            <td>
                                                <?php    
                                                    if(strlen($v['reason']) > 50){
                                                       echo substr($v['reason'],0,47).'....';
                                                    }else{
                                                        echo $v['reason'];
                                                    }
                                                ?></td>
                                            <td><?=$v['created_at']?></td>
                                            <td class="action-area">
                                                <a class="btn btn-info btn-sm default-btns" href="view_deduction.php?id=<?=$v['id']?>" style="margin-bottom:5px">View</a>
                                                <a class="btn btn-primary btn-sm default-btns" href="edit_employee_deduction.php?id=<?=$v['id']?>" style="margin-bottom:5px">Edit</a>
                                                <a class="btn btn-danger btn-sm remove" href="#" data-table='employee_deduction' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a>
                                            </td>                                                                                     
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
                       setTimeout(function(){ location.href='employee_deduction.php'; },1500); 
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
         
         window.onload = (event) => {
        $('.se-pre-con2').css('display','none');
    }       
         

</script>
</body>
</html>