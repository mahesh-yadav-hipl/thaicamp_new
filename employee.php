<?php include('head.php') ;
$categories = db_select_query("SELECT * FROM users Where role = 'employee' ORDER BY id DESC");?>
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
                <h2>Employees</h2>                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Employees List
                                </h4>
                               <span class="pull-right">
                                    <a  href="add_employee.php" class="btn btn-primary">Add Employee</a>
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th style="width: 100px;">Sr No.</th>
                                             <th>Image</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Mobile</th>
                                             <th>Salary</th>
                                             <th>Created at</th>
                                             <th>Action</th>
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    if($categories) {
                                     $i = 1 ;
                                    foreach($categories as $k =>$v){  ?>    
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                             <td>
                                             <?php 
                                                    $image = URL.'uploaded/employee/'.$v['image'];
                                                    if($v['image'] !=''){
                                                        $url = URL.'uploaded/employee/'.$v['image'];
                                                    }else{
                                                        $url = URL.'uploaded/users/default-user.jpg';
                                                    }?>
                                                    <img src="<?= $url;?>" width="50px" height="50px">
                                            </td>
                                            <td><?= ucfirst($v['name']); ?></td>
                                            <td><?=$v['email']?></td>
                                            <td><?=$v['mobile']?></td>
                                            <td><?=$v['salary']?></td>
                                            <td><?=$v['created_at']?></td>
                                            <td class="action-area">
                                                <a class="btn btn-primary btn-sm default-btns" href="view_employee.php?id=<?=$v['id']?>">View</a>
                                                <a class="btn btn-primary btn-sm default-btns" href="edit_employee.php?id=<?=$v['id']?>">Edit</a>
                                                <a class="btn btn-danger btn-sm remove" href="#" data-table='users' data-key='id' data-value="<?php echo $v['id'] ?>">
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
                       setTimeout(function(){ location.href='employee.php'; },1500); 
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
