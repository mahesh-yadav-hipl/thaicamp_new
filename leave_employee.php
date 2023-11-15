<?php include('head.php') ;
$employee_leave = db_select_query("SELECT * FROM  user_leaves Where user_id = ".$_SESSION['login_id']." ORDER BY id DESC");

?>
<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');

?>        
<aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Leaves</h2>
                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Leaves List
                                </h4>
                               <span class="pull-right">
                                    <a  href="add_leave.php" class="btn btn-primary">Add Leave</a>
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-bordered" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th>Sr No.</th>
                                             <th>From</th>
                                             <th>To</th>
                                             <th>Duration</th>
                                             <th>Reason</th>
                                             <th>Status</th>
                                             <th>Created  at</th>
                                             <th>Action</th>
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    if($employee_leave) {
                                     $i = 1 ;
                                    foreach($employee_leave as $k =>$v){  ?>    
                                    <tr class="odd">
                                        <td><?=$i?></td>
                                            <td><?=$v['leave_from']?></td>
                                            <td><?=$v['leave_to']?></td>
                                            <td><?php 
                                              $totoaldate =   createDateRangeArray($v['leave_from'],$v['leave_to']);
                                               echo count($totoaldate) .' Days';
                                            
                                            ?></td>
                                            <td><?=$v['reason']?></td>
                                            <td><?php 
                                                $btn_color = "primary";
                                                if($v['status'] == 'Declined'){
                                                    $btn_color = "danger"; 
                                                }
                                                if($v['status'] == 'Approved'){
                                                    $btn_color = "success"; 
                                                }
                                                echo "<span class='btn btn-".$btn_color." ' style='cursor:default'>".$v['status']."</span>";
                                            ?></td>
                                            <td><?=$v['created_at']?></td>
                                            <td>
                                           <?php  if($v['status'] == 'Pending'){ ?>
                                                <a class="btn btn-primary" href="edit_leave.php?id=<?=$v['id']?>">
                                                     Edit
                                                </a>
                                                <a class="btn btn-danger remove" href="#" data-table='user_leaves' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a>
                                            <?php }else{?>
                                                <a class="btn btn-primary disabled "?>Edit</a>
                                                <a class="btn btn-danger disabled "> <i class="fa fa-fw fa-trash"></i></a>
                                            <?php } ?>
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
            <?php  function createDateRangeArray($strDateFrom,$strDateTo)
        { 
            $aryRange = [];   
            $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
            $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
            if ($iDateTo >= $iDateFrom) {
                array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
                while ($iDateFrom<$iDateTo) {
                    $iDateFrom += 86400; // add 24 hours
                    array_push($aryRange, date('Y-m-d', $iDateFrom));
                }
            }
            return $aryRange;
        }?>
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
                    url:'ajax/leave_delete.php',
                    type:'POST',
                    data:{'table':table_name,'key':'id','value':id},
                    dataType:'json',
                    success: function(response){
                          
                        toastr.success(response.message);                  
                       setTimeout(function(){ location.href='leave_employee.php'; },1500); 
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
