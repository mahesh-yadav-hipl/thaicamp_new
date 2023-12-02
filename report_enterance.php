<?php include('head.php') ;
$start_date = $end_date = $user_id = '' ;


$getAll_users =  db_select_query("SELECT * FROM users Where `role` = 'subscriber' ");

if(!empty($_REQUEST['user_list'])){
    $user_id = $_REQUEST['user_list'];
}
 

if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])){ 
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $start_date_fitler = date('Y-m-d',strtotime($start_date));
    $end_date_fitler = date('Y-m-d',strtotime($end_date));   
    $wharecondition = "";
    if($user_id != ''){
        $wharecondition = " AND attendance.user_id = ".$user_id;
    }
     $getAll_attendence =  db_select_query("SELECT attendance.*,users.name as user_name, users.email as user_email, users.mobile as user_mabile,  count(user_id) as total_attendance
                            FROM attendance
                            LEFT JOIN users ON users.id = attendance.user_id
                            Where attendance.date BETWEEN '$start_date_fitler' AND '$end_date_fitler' $wharecondition
                            GROUP BY attendance.user_id");
}else if($user_id != ''){
    $getAll_attendence =  db_select_query("SELECT attendance.*,users.name as user_name, users.email as user_email, users.mobile as user_mabile,  count(user_id) as total_attendance
    FROM attendance
    LEFT JOIN users ON users.id = attendance.user_id
    Where  attendance.user_id = $user_id
    GROUP BY attendance.user_id");
}


                                     
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
                <h2>Enterance Report</h2>
                
            </section>
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Enterance Report
                                </h4>
                            </div>

                            <div class="panel-body">
                                <div class="row">                                   
                                    <div class="col-md-12"><br>
                                        <form class="form-horizontal"  method="get" action=" " >
                                            <div class="form-body">
                                                <div  class="form-group"> 
                                                    <!-- <div class="col-md-3">
                                                        Select user
                                                        <select name="user_list" id="user_list" class="form-control">
                                                             <option value="">Select user</option>
                                                            <?php //foreach($getAll_users  as $row){
                                                                    // $selected_user ="";
                                                                    // if($user_id == $row['id']){
                                                                    //     $selected_user ="selected";
                                                                    // }
                                                                ?>
                                                                <option value="<?php // echo $row['id'];?>" <?//= $selected_user;?>><?php //echo $row['name'];?></option>
                                                           <?php //} ?>                                                            
                                                        </select>
                                                    </div>     -->
                                                
                                                    <div class="col-md-3">
                                                        Start Date
                                                        <div class="input-group">
                                                            <input type="date" name="start_date" value="<?php echo $start_date;?>" class="form-control input-style">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        End Date
                                                        <div class="input-group">
                                                            <input type="date" name="end_date" value="<?php echo $end_date;?>"class="form-control input-style">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                    &nbsp;<br>
                                                        <input type="submit"  class="btn btn-primary btn-sm default-btns" value="Search"> &nbsp;                                                 
                                                        <a href="report_enterance.php" class="btn btn-sm btn-success default-btns">Clear</a>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                            </div>

                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table">
                                    <thead>
                                        <tr>
                                            <th  style="width: 100px;">Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($getAll_attendence) {
                                        $i = 1 ;
                                             foreach($getAll_attendence as $k =>$v){                                          
                                        ?>    
                                        <tr class="odd">
                                            <td><?=$i?></td>
                                            <td><?=$v['user_name']?></td>
                                            <td><?=$v['user_email']?></td>
                                            <td><?=$v['user_mabile']?></td>
                                            <td><?=$v['total_attendance']?></td>
                                            <td>
                                                <a class="btn btn-primary btn-style" href="entry_list.php?id=<?= $v['user_id']; ?>">View</a>
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

<script>
    window.onload = (event) => {
    $('.se-pre-con2').css('display','none');
}
</script>
</html>

