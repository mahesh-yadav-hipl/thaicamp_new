<?php include('head.php') ;
include('salary_calculate.php');

if($_SESSION['login_type'] === "employee"){
    if($_REQUEST['employee_id'] != $_SESSION['login_id']){
        redirect('dashboard.php');
    }
}

$get_all_employee = db_select_query("SELECT * FROM  users where role = 'employee'");
 $employee_salary = $employee_id_get = $start_date = $end_date = '';
if(!empty($_REQUEST['employee_id'])){  
    $employee_id_get = $_REQUEST['employee_id'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    if($start_date !='' && $end_date!=''){
        $start_date_fitler = date('Y-m-1',strtotime($start_date));
        $end_date_fitler = date('Y-m-d',strtotime($end_date));
        $employee_salary = db_select_query("SELECT salary.*,users.name, users.salary as gross_salary, users.email, users.mobile, users.date_of_joining,users.address, users.date_of_birth, CONCAT('".URL."uploaded/employee/', image) AS image  FROM salary LEFT JOIN users ON users.id = salary.employee_id  Where salary.employee_id = '$employee_id_get' and salary.salary_month BETWEEN '$start_date_fitler' AND '$end_date_fitler' ORDER BY salary.id DESC ");
    }else{
        $employee_salary = db_select_query("SELECT salary.*,users.name, users.salary as gross_salary, users.email, users.mobile, users.date_of_joining,users.address, users.date_of_birth , CONCAT('".URL."uploaded/employee/', image) AS image  FROM salary LEFT JOIN users ON users.id = salary.employee_id  Where salary.employee_id = '$employee_id_get' ORDER BY salary.id DESC ");
    }
}?>
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
                                                <div  class="form-group ">
                                                    <?php if($_SESSION['login_type'] === "employee"){ ?>
                                                            <input type="hidden" value="<?= $_SESSION['login_id'];?>" name="employee_id">
                                                        <?php }else{?>
                                                    <div class="col-md-3"> Select Name
                                                        <div class="input-group">
                                                            <select class="form-control employee input-style" name="employee_id" required>
                                                                <option value="">Select Employee</option>
                                                            <?php if($get_all_employee) {
                                                            foreach($get_all_employee as $k =>$v){ ?>
                                                                <option value="<?php echo $v['id'] ?>" <?php if($employee_id_get == $v['id']){ echo'selected';};?>><?php echo $v['name'] ?></option>
                                                                <?php } 
                                                            } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
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
                                                    <?php  
                                                        if($_SESSION['login_type'] === "employee"){
                                                    ?>
                                                            <a href="salary_sheet.php?employee_id=<?= $_SESSION['login_id'] ;?>" class="btn btn-sm btn-success default-btns">Clear</a>
                                                    <?php }else{?>
                                                    <a href="salary_sheet.php" class="btn btn-sm btn-success default-btns">Clear</a>
                                                    <?php } ?>
                                                        <button type="button" class="print_btn btn btn-sm btn-warning default-btns">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           <?php  if($employee_salary) {?>
                            <div class="panel-body table-responsive" id="print_section">
                                <style>
                                     @media print {                                                
                                        .dataTables_info, .dataTables_paginate, .dataTables_length, .dataTables_filter{ display: none; }
                                        .print_top{width: 100%;float: left;}
                                        .print_top .col-md-4{width: 33%;float: left;}
                                        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                                padding: 8px 17px;
                                                line-height: 1.42857143;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                            }
                                     }
                                </style>
                                <div class="row print_top">
                                <div class="col-md-12 ">
                                    <br><br>
                                    </div>
                                    <div class="col-md-4">
                                        <div><strong>Name: </strong> <?php if(isset($employee_salary[0]['name'])){ echo $employee_salary[0]['name'];}?> </div>
                                        <div><strong>Email:</strong> <?php if(isset($employee_salary[0]['email'])){ echo $employee_salary[0]['email'];}?> </div>
                                         <div><strong>Contact:</strong> <?php if(isset($employee_salary[0]['mobile'])){ echo $employee_salary[0]['mobile'];}?>  </div>
                                    </div>
                                    <div class="col-md-4" style="text-align: center;">
                                            <?php 
                                                if($employee_salary[0]['image']!='' && @getimagesize($employee_salary[0]['image'])){ 
                                                    $image = $employee_salary[0]['image'];
                                                }else{
                                                    $image = URL.'uploaded/users/default-user.jpg';
                                                }
                                            ?>
                                       <img src="<?=$image?>" width="100px" height="100px" alt="profile" style="border-radius: 50%;">
                                    <div><h3>Salary Statement</h3></div>
                                    <?php if($start_date !='' && $end_date !=''){?>
                                        <div><strong><?php echo date('F Y',strtotime($start_date));?></strong> to <strong><?php echo date('F Y',strtotime($end_date));?></strong></div>
                                    <?php } ?>
                                    </div>
                                    <div class="col-md-4" style="text-align:right;">
                                        <div><strong>Date of Birth: </strong> <?php if(isset($employee_salary[0]['date_of_birth'])){ echo $employee_salary[0]['date_of_birth'];}?> </div>
                                        <div><strong>Joining Date: </strong> <?php if(isset($employee_salary[0]['date_of_joining'])){ echo $employee_salary[0]['date_of_joining'];}?>
                                      </div>
                                      <?php if($employee_salary[0]['address'] != ''){?>
                                        <div><strong>Address: </strong><span style="max-width: 250px;float:right;padding-left: 3px;"> <?php echo $employee_salary[0]['address'];?></span>  </div>
                                        <?php }  ?>
                                       
                                    </div>
                                    <div class="col-md-12">
                                    <br><br>
                                    </div>
                                </div>
                                <table class="table" id="fitness-table">
                                    <thead>
                                         <tr>
                                             <th style="width:120px;">Sr No.</th>
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
                                            <td>
                                                <?php //= 
                                                  //  $v['salary'];
                                                   // $total_salary +=$v['salary'];

                                                   echo $v['salary']-$emp_deduction_amount;
                                                   $salaryAmount = ($v['salary'] - $emp_deduction_amount );
                                                   $total_salary += $salaryAmount;
                                            ?>
                                            </td>
                                        </tr>
                                    <?php
                                      $i++ ;
                                    } 
                                    }?>
                                </tbody>
                                <?php if($employee_salary) {?>
                                <tfoot>
                                    <tr>
                                    <td colspan="5"></td>
                                    <td><strong>Total</strong></td>
                                    <td><?php echo number_format(($total_salary),2,'.','');?></td>
                                    </tr>
                                </tfoot>
                                <?php } ?>
                                </table>
                            </div>

                            <?php } ?>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>   

$(document).ready(function(){
    $(document).on('click','.print_btn',function(){
        $('#print_section').printThis({
            importCSS: false,
       // loadCSS: "path/to/new/CSS/file",
       // header: "<h1>Look at all of my kitties!</h1>"
         });
    })
})
   

window.onload = (event) => {
        $('.se-pre-con2').css('display','none');
    }
</script>
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



