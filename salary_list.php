<?php include('head.php') ;
include('salary_calculate.php');

$start_date = $end_date = '';
if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])){ 
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $start_date_fitler = date('Y-m-01',strtotime($start_date));
    $end_date_fitler = date('Y-m-d',strtotime($end_date));
    $employee_salary = db_select_query("SELECT salary.*,users.name, users.salary as gross_salary FROM salary LEFT JOIN users ON users.id = salary.employee_id  Where salary.salary_month BETWEEN '$start_date_fitler' AND '$end_date_fitler' ORDER BY salary.id DESC ");
}else{
    $employee_salary = db_select_query("SELECT salary.*,users.name, users.salary as gross_salary FROM salary LEFT JOIN users ON users.id = salary.employee_id ORDER BY salary.id DESC ");
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
                <h2>Salary </h2>                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> Salary List
                                </h4>
                            </div>

                            <div class="panel-body">
                                <div class="row">                                   
                                    <div class="col-md-12"><br>
                                        <form   class="form-horizontal"  method="get" action=" " >
                                            <div class="form-body">
                                                <div  class="form-group">                                                   
                                                    <div class="col-md-3">
                                                        Start Date
                                                        <div class="input-group">
                                                            <input type="date" name="start_date" value="<?php echo $start_date;?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        End Date
                                                        <div class="input-group">
                                                            <input type="date" name="end_date" value="<?php echo $end_date;?>"class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                    &nbsp;<br>
                                                        <input type="submit"  class="btn btn-primary btn-sm" value="Search"> &nbsp;                                                 
                                                        <a href="salary_list.php" class="btn btn-sm btn-success">Clear</a>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body table-responsive">
                                <table class="table table-bordered" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th>Sr No.</th>
                                             <th>Employee Name</th>
                                             <th>Pay Month</th>
                                             <th>Gross Salary</th>
                                             <th>PT Commission</th>
                                             <th>Deduction</th>
                                             <th>Net Salary</th>
                                         </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                    $total_salary = 0;
                                    if($employee_salary) {
                                     $i = 1 ;
                                    foreach($employee_salary as $k =>$v){  ?>    
                                    <tr class="odd">
                                            <td><?=$i?></td>
                                            <td><?= $v['name'];?></td>
                                            <td><?= date('d F Y',strtotime($v['salary_month'])); ?></td>                                                                                                                                
                                            <td><?= $v['gross_salary'];?></td>
                                            <td><?=$v['pt_salary']?></td>
                                            <td>
                                                
                                            <?php
                                                $start_date = date('Y-m-d 00:00:01',strtotime($v['salary_month'])); 
                                                $end_date = date('Y-m-t 23:59:00',strtotime($v['salary_month']));   
                                                $emp_id = $v['employee_id'];
                                                $employee_direct_deduction_Amount = db_select_query("SELECT SUM(`deduction_amount`) as `emp_deduction_amount` FROM `employee_deduction` WHERE `employee_id` = '$emp_id' AND `created_at` BETWEEN '$start_date' AND '$end_date' GROUP BY employee_id ");
                                                $emp_deduction_amount =  $employee_direct_deduction_Amount['0']['emp_deduction_amount'];
                                            ?>
                                                <?= $v['salary_deduction'] + $emp_deduction_amount ?>                                            
                                            </td>
                                            <td><?php 
                                                    echo $v['salary']-$emp_deduction_amount;
                                                    $salaryAmount = ($v['salary'] - $emp_deduction_amount );
                                                    $total_salary += $salaryAmount;
                                            ?></td>
                                        </tr>
                                    <?php
                                      $i++ ;
                                    } 
                                    }?>
                                     <?php if($employee_salary) {?>
                                        <tfoot>
                                            <tr>
                                            <td colspan="5"></td>
                                            <td><strong>Total</strong></td>
                                            <td><?php echo number_format(($total_salary),2,'.','');?></td>
                                            </tr>
                                        </tfoot>
                                        <?php } ?>
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



