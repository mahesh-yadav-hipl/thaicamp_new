<?php include('head.php') ;
$users = db_select_query("SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users Where role = 'subscriber' ORDER BY id DESC");

?>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
<body>
    <div class="se-pre-con2"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');

?>        
<aside class="right-side right-padding n_tabledata">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Subscribers</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Users</a>
                    </li>
                    <li>
                        <a href="admin_userlist.html">Users </a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Subscribers List
                                </h4>
                               <span class="pull-right">
                                    <a  href="add_user.php" class="btn btn-primary">Add Subscriber</a>
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table1">
                                    <thead>
                                         <tr>
                                             <th style="width: 100px;">Sr No.</th>
                                             <th>Image</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Mobile</th>
                                             <th>Status</th>
                                             <th>View</th>
                                             <th>Action</th>
                                             <!--<th>Delete</th>-->
                                             <!--<th>Entry List</th>-->
                                             <!--<th>Generate Invoice</th>-->
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    if($users) {
                                     $i = 1 ;
                                    foreach($users as $k =>$v){  ?>    
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                            <td class="data-img"><?php 
                                                    //if($v['image']!='' && @getimagesize($v['image'])){ 
                                                    if($v['image']!=''){ 
                                                        $image = $v['image'];
                                                     }else{
                                                         $image = URL.'uploaded/users/default-user.jpg';
                                                     }
                                                ?><img src="<?=$image?>" width="50px" height="50px" alt=""></td>
                                            <td><?=$v['name']?></td>
                                            <td><?=$v['email']?></td>
                                            <td><?=$v['mobile']?></td>
                                            <td class="ac-de-area">
                                            <?php if($v['is_deactivate'] == 1){?>
                                                <span class="btn btn-sm btn-danger">Deactivate</span>
                                                <?php }else{?>
                                                    <span class="btn btn-sm btn-success">Activate</span>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-style" href="view_user.php?id=<?=$v['id']?>">
                                                     Press View
                                                </a>
                                            </td>
                                            <td class="action-area">
                                                <div style="min-width: 140px;">
                                                    <a class="btn btn-danger remove" href="#" data-table='users' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </a>
                                                    <a class="btn btn-primary" href="entry_list.php?id=<?=$v['id']?>">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-primary" href="invoice.php?id=<?=$v['id']?>">
                                                        <i class="fa fa-fw fa-file-text-o"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <!--<td>-->
                                            <!--    <a class="btn btn-danger remove" href="#" data-table='users' data-key='id' data-value="<?php echo $v['id'] ?>">-->
                                            <!--        <i class="fa fa-fw fa-trash"></i>-->
                                            <!--    </a>-->
                                            <!--</td>-->
                                            <!--<td>-->
                                            <!--   <a class="btn btn-primary" href="entry_list.php?id=<?=$v['id']?>">-->
                                            <!--        <i class="fa fa-fw fa-eye"></i>-->
                                            <!--    </a> -->
                                            <!--</td>-->
                                            <!--<td>-->
                                            <!--   <a class="btn btn-primary" href="invoice.php?id=<?=$v['id']?>">-->
                                            <!--        <i class="fa fa-fw fa-file-text-o"></i>-->
                                            <!--    </a> -->
                                            <!--</td>-->
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
                       setTimeout(function(){ location.href='users.php'; },1500); 
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
         
           
         $('#fitness-table1 ').DataTable( {
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"]
            ],
            // set the initial value
            "pageLength": 10
        } );
        
window.onload = (event) => {
    $('.se-pre-con2').css('display','none');
}
       

</script>
