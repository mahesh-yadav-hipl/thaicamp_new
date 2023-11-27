<?php include('head.php');
$id=!empty($_GET['id'])?$_GET['id']:"";
$get_all_employee = db_select_query("SELECT * FROM users Where role = 'employee' ORDER BY id DESC");
$employee = db_select_query("SELECT * FROM employee_deduction WHERE id = '$id'");
if(count($employee) == 0){
    echo "Deduction not exists";
    die;
}
?>
<style>
input[type="checkbox"]
{
    cursor:pointer;
}
    .swal2-modal
    {
        top:0px!important;
        left:0px!important;
    }
</style>

<body style="padding:0px;">
   
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
                <h2>Employee Deduction</h2>
               
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel">
                            <div class="panel-heading bg-primary">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-user"></i> View Employee Deduction
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="Info">
                                            <div class="row">
                                              <form id="add-user-form"  method="post" action="ajax/edit_employee_deduction.php"  onsubmit="return false;"  enctype="multipart/form-data" autocomplete="off">    
                                               <input type="hidden" name="table" value="employee_deduction" >   
                                               <input type="hidden" name="id" value="<?php echo $employee[0]['id'];?>">                                             
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                                <tr>
                                                                    <td> Select Employee</td>
                                                                    <td>
                                                                        <select class="form-control package" name="employee_id" disabled>
                                                                            <option value="">Select Employee</option>
                                                                            <?php if($get_all_employee) {
                                                                                foreach($get_all_employee as $k =>$v){ 
                                                                                        $selected_val = "";
                                                                                        if($v['id'] == $employee[0]['employee_id']){
                                                                                            $selected_val = "selected";
                                                                                        }
                                                                                    ?>
                                                                                <option value="<?php echo $v['id'] ?>" <?= $selected_val;?>><?php echo $v['name'] ?></option>
                                                                                <?php } 
                                                                            } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>

                                                                <tr>                                                                    
                                                                    <td>Deduction Amount </td>
                                                                      <td>
                                                                      <?php echo (int)$employee[0]['deduction_amount'];?>
                                                                    </td>                                                                    
                                                                </tr> 
                                                                <tr>
                                                                    <td>Reason</td>
                                                                    <td>
                                                                    <?php echo $employee[0]['reason'];?>
                                                                    </td>
                                                                </tr>


                                                                </tr>
                                                            </table>
                                                            </div>
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <a href = "employee_deduction.php"  class="btn btn-danger">Back</a> &nbsp;
                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
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
        <script src="js/sweetalert2.all.js"></script>
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
</html>



