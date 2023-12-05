<?php include('head.php') ;
if($_SESSION['login_type'] != "admin")
{
  redirect(URL.'dashboard.php');
}
$id=!empty($_GET['id'])?$_GET['id']:"" ;
$get_all_payment_methods =  db_select_query("SELECT * FROM payment_methods ORDER BY id DESC") ;
$payment_method = db_select_query("SELECT * FROM payment_methods where id = '$id'")[0] ; 

?>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
<body>
<div class="se-pre-con2"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php')?>        
<aside class="right-side right-padding n_tabledata">
            <div class="container-fluid">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-envelope"></i> Email Templates
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">Sr No.</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                            <td>1</td>
                                        
                                             <td>Account Registration Email</td>
                                             
                                            <td>
                                                <a class="btn btn-primary default-btns" href="edit-registration-email.php">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>2</td>
                                        
                                             <td>Subscription Renewal Email</td>
                                             
                                            <td>
                                                <a class="btn btn-primary default-btns" href="edit-renewal-email.php">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>3</td>
                                        
                                             <td>Thankyou Email</td>
                                             
                                            <td>
                                                <a class="btn btn-primary default-btns" href="edit-thankyou-email.php">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>4</td>
                                        
                                             <td>Subscription Renewal Reminder Email</td>
                                             
                                            <td>
                                                <a class="btn btn-primary default-btns" href="edit-reminder-email.php">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>5</td>
                                        
                                             <td>Special Email</td>
                                             
                                            <td>
                                                <a class="btn btn-primary default-btns" href="edit-special-email.php">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-md-6 -->
                <!--row -->
                <!--row ends-->
            </div>
            <!-- /.content -->
        </aside>
        <!-- /.right-side -->
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
    <script>
         window.onload = (event) => {
        $('.se-pre-con2').css('display','none');
    }
    </script>
</body>


</html>

