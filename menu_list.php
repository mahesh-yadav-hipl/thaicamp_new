<?php include('head.php') ;
include('salary_calculate.php');
$id = $_SESSION['login_id'] ;
$admin_data = db_select_query("select * from admin where id = '$id' ")[0] ;
// print_r($admin_data);
// exit() ;
// if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { 
// }else{
//     redirect(URL.'user-profile.php');
// }
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
                <h2>Main </h2>
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
                        <?php if($_SESSION['login_type'] === "employee"){?>
                            <div class="col-lg-3">
                                <a href="user-profile.php" class="menu_store"><i class=" fa fa-user"></i> Profile </a>  
                            </div>
                            <div class="col-lg-3">
                               <a href="leave_employee.php" class="manu_dashboard"><i class="fa fa-fw fa-dashboard"></i> Leaves </a>
                            </div>
                            <div class="col-lg-3">
                               <a href="private-training.php" class="menu_entrance"> <i class="fa fa-fw fa-info-circle"></i> Private Training</a>   
                            </div>
                            <div class="col-lg-3">
                                <a href="salary_sheet.php?employee_id=<?= $_SESSION['login_id'] ;?>" class="menu_admin"><i class=" fa fa-building"></i> Salary Statement</a>
                            </div>
                            <div class="col-lg-3">
                                <a href="logout.php" class="menu_logout"><i class=" fa fa-fw fa fa-sign-out"></i> Logout </a>  
                            </div>
                        <?php  }else if ($_SESSION['login_type'] === 'subscriber'){?>
                            <div class="col-lg-3">
                                <a href="user-profile.php" class="menu_profile"><i class=" fa fa-user"></i> Profile </a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="product_view.php" class="menu_store"><i class=" fa fa-th fa-store-alt"></i> Store</a>  
                            </div>
                            <div class="col-lg-3">
                               <a href="private-training.php" class="menu_entrance"> <i class="fa fa-fw fa-info-circle"></i> Private Training</a>   
                            </div>

                            <div class="col-lg-3">
                                <a href="buy_new_package.php?id=<?= $_SESSION['login_id'];?>" class="menu_admin"><i class=" fa fa-fw fa-money"></i> Packages</a>
                            </div>

                            <div class="col-lg-3">
                                <a href="logout.php" class="menu_logout"><i class=" fa fa-fw fa fa-sign-out"></i> Logout </a>  
                            </div>

                        <?php } else{ ?>                 
                        
                            <div class="col-lg-3">
                               <a href="dashboard.php" class="manu_dashboard"><i class="fa fa-fw fa-dashboard"></i> DashBoard </a>
                            </div>
                            <div class="col-lg-3">
                               <a href="subscription.php" class="menu_entrance"> <i class=" fa fa-fw fa fa-sign-in"></i> Entrance</a>   
                            </div>
                            <?php if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { ?>
                            <div class="col-lg-3">
                                <a href="subadmin.php" class="menu_admin"><i class=" fa fa-fw fa-user"></i> Admin </a>
                            </div>
                            <?php } ?>
                            <div class="col-lg-3">
                                <a href="product_view.php" class="menu_store"><i class=" fa fa-th fa-store-alt"></i> Store</a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="users.php" class="menu_subscriber"><i class=" fa fa-fw fa-users"></i> Subscriber </a>  
                            </div>
                            <?php if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { ?>
                            <div class="col-lg-3">
                                <a href="employee.php" class="menu_employee"><i class=" fa fa-fw fa-users"></i> Employee </a>  
                            </div>
                            <?php } ?>
                            <div class="col-lg-3">
                                <a href="profile.php" class="menu_profile"><i class=" fa fa-fw fa-info-circle"></i> Profile </a>  
                            </div>
                            <div class="col-lg-3">
                                <a href="logout.php" class="menu_logout"><i class=" fa fa-fw fa fa-sign-out"></i> Logout </a>  
                            </div>

                            <?php } ?>
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
    float: left;
}
.main_menu_div .col-lg-3 a{
    /* color:#fff; */
    padding: 15px 15px;
    width: 100%;
    float: left;
    margin-bottom: 25px;
    font-size: 21px;
    border-radius: 15px;
}
.main_menu_div .col-lg-3 a .fa{
    font-size: 30px;
}
.main_menu_div .col-lg-3 a.manu_dashboard .fa{
    font-size: 32px;
}
.main_menu_div{
    clear: both;
    padding-top: 25px;
}
.main_menu_div div>a{
    border: 2px solid;
    position: relative;
    text-align: left;
    padding-left: 152px !important;
}
.main_menu_div div>a>i{
    position: absolute;
    left: 0;
    top: 0;
    width: 127px;
    height: 100%;
    color: #fff;
    text-align: center;
    border-radius: 10px 0 0 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
a.manu_dashboard {
    color: #32a2d7;
    border-color: #32a2d7 !important;
}
a.manu_dashboard i{
    background-color: #32a2d7;
}
a.menu_entrance {
    color: #63a700;
    border-color: #63a700 !important;
}
a.menu_entrance i{
    background-color: #63a700;
}
a.menu_admin {
    color: #1255cf;
    border-color: #1255cf !important;
}
a.menu_admin i{
    background-color: #1255cf;
}
a.menu_store {
    color: #d78e1d;
    border-color: #d78e1d !important;
}
a.menu_store i{
    background-color: #d78e1d;
}
a.menu_subscriber {
    color: #34b3ad;
    border-color: #34b3ad !important;
}
a.menu_subscriber i{
    background-color: #34b3ad;
}
a.menu_employee {
    color: #999927;
    border-color: #999927 !important;
}
a.menu_employee i{
    background-color: #999927;
}
a.menu_profile {
    color: #23818b;
    border-color: #23818b !important;
}
a.menu_profile i{
    background-color: #23818b;
}
a.menu_logout {
    color: #d34b4b;
    border-color: #d34b4b !important;
}
a.menu_logout i{
    background-color: #d34b4b;
}

@media only screen and (max-width: 1366px) {
    /* .main_menu_div .col-lg-3 {
        width: 100%;
    } */
    .main_menu_div div>a>i{
        width: 80px;
    }
    .main_menu_div div>a{
        padding-left: 100px !important;
    }
}

@media screen and (max-width: 767px){
    .main_menu_div .col-lg-3 {
        width: 100%;
        float: inherit;
    }
}
</style>

</html>




