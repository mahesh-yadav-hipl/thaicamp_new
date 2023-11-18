<?php include('head.php') ;
$id = $_SESSION['login_id'] ;
$admin_data = db_select_query("select * from admin where id = '$id' ")[0] ;
// print_r($admin_data);
// exit() ;
if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { 
}else{
    redirect(URL.'user-profile.php');
}
?>

<body>
   
    <!-- header logo: style can be found in header-->
    <?php include('header.php')
?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php')
?>
        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2>Contain Icons</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="admin_clubinfo.html" class="activated">Club Info</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                        <div class="row main_menu_div">
                            <div class="col-lg-3">
                               <a href="dashboard.php" class="manu_dashboard"><i class="fa fa-fw fa-dashboard"></i> DashBoard </a>
                            </div>
                            <div class="col-lg-3">
                               <a href="subscription.php" class="menu_entrance"> <i class=" fa fa-fw fa fa-sign-in"></i> Entrance</a>   
                            </div>
                            <div class="col-lg-3">
                                <a href="subadmin.php" class="menu_admin"><i class=" fa fa-fw fa-user"></i> Admin </a>
                            </div>
                            <div class="col-lg-3">
                                <a href="product_view.php" class="menu_store"><i class=" fa fa-th fa-store-alt"></i> Store</a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="users.php" class="menu_subscriber"><i class=" fa fa-fw fa-users"></i> Subscriber </a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="employee.php" class="menu_employee"><i class=" fa fa-fw fa-users"></i> Employee </a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="profile.php" class="menu_profile"><i class=" fa fa-fw fa-info-circle"></i> Profile </a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="logout.php" class="menu_logout"><i class=" fa fa-fw fa fa-sign-out"></i> Logout </a>  
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
    <script src="vendors/x-editable/jquery.mockjax.js" type="text/javascript"></script>
    <script src="vendors/x-editable/bootstrap-editable.js" type="text/javascript"></script>
    <script src="vendors/x-editable/js/html5types.js" type="text/javascript"></script>
    <script src="vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="vendors/jasny-bootstrap/js/inputmask.js" type="text/javascript"></script>
    <script src="vendors/jasny-bootstrap/js/jquery.inputmask.js" type="text/javascript"></script>
    <script src="vendors/x-editable/js/demo-mock.js" type="text/javascript"></script>
    <script src="js/custom_js/club_info.js" type="text/javascript"></script>
    <!-- end of page level js -->
</body>
<style>
    .nav-tabs>li {
    font-family: 'Roboto', sans-serif;
    margin-top: 8px;
}
.table>tbody>tr>td {
    border: none;
}
.table-bordered {
    border: none;
}
.main_menu_div .col-lg-3{
    width: 33.33%;
    text-align: center;
}
.main_menu_div .col-lg-3 a{
    color:#fff;
    padding: 20px 15px;
    width: 100%;
    float: left;
    margin-bottom: 25px;
    font-size: 21px;
}
.main_menu_div .col-lg-3 a .fa{
    font-size: 17px;
}
.main_menu_div{
    clear: both;
    padding-top: 25px;
}
a.manu_dashboard {
    background: #00c4ff;
}
a.menu_entrance {
    background: #4b8d53;
}
a.menu_admin {
    background: #1255cf;
}
a.menu_store {
    background: #d78e1d;
}
a.menu_subscriber {
    background: #33a4d8;
}
a.menu_employee {
    background: #999927;
}
a.menu_profile {
    background: #23818b;
}
a.menu_logout {
    background: #d34b4b;
}
@media only screen and (max-width: 1200px) {
    .main_menu_div .col-lg-3 {
    width: 100%;
}
}
</style>

</html>




