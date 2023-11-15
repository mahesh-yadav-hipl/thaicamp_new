<?php 
include('head.php') ;
$tdtt = date('Y-m-d'); 





?>
<style>
.input-group-addon
{
    right: 0;
    position: absolute;
    top: 1px;
    z-index: 999;
    width: 45px;
    height: 32px;
    border-left: transparent!important;
    border-right: 1px solid #c5c5c5!important;

}
.profit
{
    text-align:center;
        background: #fc7070;
    color: #fff;
}
.profit h2
{
    float:left;
    margin-top:10px;
    width:100%;
}
    .sub-count
    {
         float:left;
    }
    .tot
    {
        float:right;
    }
    .total_row{
        background-color: #65a800 !important;
        color:#FFF;
    }
</style>
 <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
     <link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
<body>
    <div class="se-pre-con"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php') ?> 
        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Reports</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Course Schedule</a>
                    </li>
                    <li>
                        <a href="admin_rooms.html">Rooms</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
               
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file"></i> Cash Flow
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form   class="form-horizontal"  method="post" action=" " >
                                            <div class="form-body">
                                                <div  class="form-group">
                                                    <label for="room_name" class="col-md-3 control-label">
                                                        Select Month & Year
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span style="cursor: pointer;" class="input-group-addon">
                                                                <i id="show_cal" class="fa fa-fw fa-calendar"></i>
                                                            </span>
                                                            <input placeholder= "Click on calendar to select month & year" type ="text" name="date" id="date" class="form-control date-picker" value="<?php if(!empty($_REQUEST['date'])){echo $_REQUEST['date'];}?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-6">
                                                        <input type="submit" name="submit" class="btn btn-primary" value="Search"> &nbsp;
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
                 
                 
                <?php if(!empty($_REQUEST['date'])) {  ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file"></i> Cash Flow List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                            
                              
                              <h2>Income</h2>
                               
                                <?php 
                                    $tot_pck_pr = 0 ;
                                
                                    $time=strtotime($_REQUEST['date']);
                                    $month=substr($_REQUEST['date'],0 ,2);
                                    $year=substr($_REQUEST['date'],3);

                                   // $packages_query  = "SELECT DISTINCT(packagesid)  FROM upcoming_packages  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'";
                                   // $packages_query = db_select_query($packages_query);                                

                                    $new_cashflow_year = strtotime(date('2023-03'));
                                    $old_cashflow_year = strtotime(date($year.'-'.$month));
                                   

                                    // if($year >= 2023){
                                    if($old_cashflow_year >= $new_cashflow_year){
                                        $get_all_package_qry  = "SELECT packagesid, count(packagesid) as total_count, sum(price) as total_price  FROM cash_flow  WHERE YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'  GROUP BY packagesid";
                                        $packages_query = db_select_query($get_all_package_qry); 
                                    }else{
                                        $packages_query  = "SELECT DISTINCT(packagesid)  FROM users  WHERE  YEAR(date(pck_start_date)) = '$year' AND MONTH(date(pck_start_date)) = '$month' AND package_class != '0' " ;
                                        $packages_query = db_select_query($packages_query);     
                                    }                               
                                     // $array_all_package = array();
                                    // if($packages_query){
                                    //     foreach($packages_query as $row){
                                    //         $array_all_package[$row['packagesid']] = $row['packagesid'];
                                    //     }
                                    // }
                                    // if($get_all_package){
                                    //     foreach($get_all_package as $row){
                                    //         $array_all_package[$row['packagesid']] = $row['packagesid'];
                                    //     }
                                    // }

                                    
                                    

                                  ?>
                                <!-- pt -->
                                 <?php              
                                    $total_pt_amount = db_select_query("select sum(price) from private_training  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'")[0]['sum(price)'];
                                   
                                    $pt_get_amount = db_select_query("select employee_id, count(id) as total_entry, sum(price - employee_commission) as total_price from private_training  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month' GROUP BY employee_id" );
                                   
                                    $total_paid_salary = db_select_query("select sum(salary) from salary  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'")[0]['sum(salary)'];
                                    $total_paid_employee_percentage = db_select_query("select sum(pt_salary) from salary  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'")[0]['sum(pt_salary)'];

                                    ///$pt_get_amount_paid = db_select_query("select employee_id, count(id) as total_entry, sum(pt_salary) as total_price from salary  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month' AND pt_salary > 0 GROUP BY employee_id " );
                                    $pt_get_amount_paid = db_select_query("select employee_id, count(id) as total_entry, sum(employee_commission) as total_price from private_training  WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month' GROUP BY employee_id" );
                                   


                                    if($packages_query){
                                        $i = 0 ;
                                
                                ?>
                                <!-- pt -->
                                
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Packages</b></th>
                                            <th><b>Count</b></th>
                                            <th><b>Total Price</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // if($year >= 2023){ 
                                        if($old_cashflow_year >= $new_cashflow_year){ 
                                            foreach($packages_query as $package[$i])
                                            {   
                                                $pc = $package[$i]['packagesid'] ;
                                                $qr = db_select_query("select * from packages  where id = '$pc' ")[0] ;
                                                ?>
                                                <tr>
                                                
                                                <td><?=$qr['name']?></td>
                                                <td><?=$package[$i]['total_count']?></td>
                                                <td>
                                                <?php echo $total_pack_price = $package[$i]['total_price'];?>
                                                </td>
                                            </tr>
                                            <?php
                                                $i++ ;
                                                $tot_pck_pr+=$total_pack_price ; 
                                        
                                            }
                                        }else{                                            
                                                foreach($packages_query as $package[$i])
                                                {   
                                                    $pc = $package[$i]['packagesid'] ;
                                                    $qr = db_select_query("select * from packages  where id = '$pc' ")[0] ;
                                                    $pck_price =  $qr['price'] ;
                                                    $cnp = db_select_query("select * from users where YEAR(date(pck_start_date)) = '$year' AND MONTH(date(pck_start_date)) = '$month' and  packagesid = '$pc' and package_class != '0' ");
                                                    $discountedusers = db_select_query("select * from users where YEAR(date(pck_start_date)) = '$year' AND MONTH(date(pck_start_date)) = '$month' and  packagesid = '$pc' and package_class != '0' and after_discount_price != '' ");
                                                    $sumofDiscount = db_select_query("select SUM(after_discount_price) AS 'sumofDiscount'  from users where YEAR(date(pck_start_date)) = '$year' AND MONTH(date(pck_start_date)) = '$month' and  packagesid = '$pc' and package_class != '0' ");
                                                
                                                ?> 
                
                                                <tr>
                                                
                                                    <td><?=$qr['name']?></td>
                                                    <td><?=count($cnp)?></td>
                                                    <td>
                                                    <?php echo $total_pack_price =  (($pck_price * count($cnp)) - ($pck_price * count($discountedusers)) + ($sumofDiscount[0]['sumofDiscount']))  ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $i++ ;
                                                    $tot_pck_pr+=$total_pack_price ; 
                                            
                                                }
                                        
                                        }
                                    ?>
                                    </tbody>
                                    <tfooot> 
                                        <?php
                                         $total_pt_amount_calculate = 0;
                                        if($pt_get_amount) {?>
                                            <tr>
                                                <td><b>Private Training </b></td>
                                                    <td></td>
                                                    <td></td>
                                            </tr>
                                        <?php
                                       
                                            foreach($pt_get_amount as $rows){
                                                $user_id_pt = $rows['employee_id'];                                                 
                                                $uesr_qry = db_select_query("select name from users  where id = '$user_id_pt' ")[0] ;
                                                $total_pt_amount_calculate += $rows['total_price'];
                                                ?>
                                                <tr>
                                                    <td> <?= $uesr_qry['name']; ?></td>
                                                    <td><?= $rows['total_entry']?></td>
                                                    <td><?= $rows['total_price']?></td>
                                                </tr>
                                            <?php } 
                                        } ?>                                      
                                        <!-- <tr>
                                            <th colspan="2"><b>Private Training</b></th>
                                            <th><b><?php if($total_pt_amount){ echo $total_pt_amount;}else{ echo "0";};?></b></th>
                                        </tr> -->
                                        <tr class="total_row">
                                            <th colspan="2"><b>Total</b></th>
                                            <!-- <th><b><?php echo $tot_pck_pr+$total_pt_amount ;   ?> KD</b></th> -->
                                            <th><b><?php echo $tot_pck_pr+$total_pt_amount_calculate ;   ?> KD</b></th>
                                        </tr>
                                    </tfooot>
                                   
                                </table>                               
                                 
                                <?php }else if($total_pt_amount){ ?>
                                    <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Private Training</b></th>
                                            <th><b>Count</b></th>
                                            <th><b>Total</b></th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <?php 
                                         $total_pt_amount_calculate = 0;
                                        if($pt_get_amount) {?>
                                            
                                        <?php  foreach($pt_get_amount as $rows){
                                                    $user_id_pt = $rows['employee_id'];                                                 
                                                    $uesr_qry = db_select_query("select name from users  where id = '$user_id_pt' ")[0] ;
                                                    $total_pt_amount_calculate += $rows['total_price'];
                                                ?>
                                                    <tr>
                                                        <td> <?= $uesr_qry['name']; ?></td>
                                                        <td><?= $rows['total_entry']?></td>
                                                        <td><?= $rows['total_price']?></td>
                                                    </tr>
                                            <?php } } ?>  
                                        <!-- <tr>
                                            <th colspan="2">Private Training</th>
                                            <th><?= $total_pt_amount;?></th>
                                        </tr> -->
                                    </thead>
                                    <tfooot>                                     
                                         <tr class="total_row">
                                            <th colspan="2"><b>Total</b></th>
                                            <!-- <th><b><?php echo $total_pt_amount ;   ?> KD</b></th> -->
                                            <th><b><?php echo $total_pt_amount_calculate ;   ?> KD</b></th>
                                        </tr>
                                    </tfooot>
                                    <tbody>
                                </table> 
                               <?php } ?>
                                <h2>Expenses</h2>
                               
                                <?php 
                             
                                    $tot_expn_pr = 0;
                                    $time=strtotime($_REQUEST['date']);
                                    $month=substr($_REQUEST['date'],0 ,2);
                                    $year=substr($_REQUEST['date'],3);

                                    $expeses_query =  db_select_query("select *  from expenses where YEAR(date(date)) = '$year' AND MONTH(date(date)) = '$month' ") ;
                                    
                                    if($expeses_query || $total_paid_salary || $total_paid_employee_percentage){

                                ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Title</b></th>
                                            <th><b>Price</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                             if($expeses_query){
                                            foreach($expeses_query as $expense)
                                            {  
                                        ?> 
         
                                        <tr>
                                          
                                             <td><?=$expense['title']?></td>
                                             <td><?= $total_expnse_price = $expense['price']?></td>
                                        </tr>
                                        <?php
                                            $i++ ;
                                            $tot_expn_pr+=$total_expnse_price ;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th ><b>Salary</b></th>
                                            <th><b><?php if($total_paid_salary){ echo $total_paid_salary-$total_paid_employee_percentage;}else{ echo "0";};?></b></th>
                                        </tr>
                                            <?php
                                            $pt_get_amount_paid_calculate = 0;
                                            if($pt_get_amount_paid) {?>
                                                 <tr>
                                                    <td><b>Private Training </b></td>
                                                     <td></td>
                                                </tr>
                                            <?php foreach($pt_get_amount_paid as $rows){
                                                    $user_id_pt = $rows['employee_id'];                                                 
                                                    $uesr_qry = db_select_query("select name from users  where id = '$user_id_pt' ")[0];
                                                    $pt_get_amount_paid_calculate +=$rows['total_price']; 
                                                    ?>
                                                    <tr>
                                                        <td> <?= $uesr_qry['name']; ?> <b>(<?= $rows['total_entry']?>)</b></td>
                                                        <td><?= $rows['total_price']?></td>
                                                    </tr>
                                                <?php } 
                                            } ?>      
                                        <!-- <tr>
                                            <th ><b>Private Training</b></th>
                                            <th><b><?php if($total_paid_employee_percentage){ echo $total_paid_employee_percentage;}else{ echo "0";};?></b></th>
                                        </tr> -->
                                        <tr class="total_row">
                                            <th><b>Total</b></th>
                                            <th><b><?php echo $tot_expn_pr+($total_paid_salary-$total_paid_employee_percentage)+$pt_get_amount_paid_calculate;   ?> KD</b></th>
                                        </tr>
                                    </tfoot>
                                   
                                </table>
                                 
                                <?php
                                    } 
                                ?>
                                <div class="profit">
                                    <h2>Profit</h2>
                                    <!-- <p><b><?php echo ($tot_pck_pr+$total_pt_amount) - ($tot_expn_pr+$total_paid_salary)  ; ?> KD</b></p> -->
                                    <p><b><?php 
                                        $totalexpance = $tot_expn_pr+($total_paid_salary-$total_paid_employee_percentage)+$pt_get_amount_paid_calculate;
                                    echo ($tot_pck_pr+$total_pt_amount_calculate) - ($totalexpance)  ; ?> KD</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
    <!-- <script src="js/custom_js/app.js" type="text/javascript"></script> -->
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
          <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/rooms.js" type="text/javascript"></script>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
   




    <!-- end of page level js -->
</body>


</html>
   
    <script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'mm-yy',
                onClose: function(dateText, inst) { 
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
            
            $('#show_cal').click(function(){
               $('.date-picker').datepicker('show') ;
            }) ;
           

            $("[data-toggle='offcanvas']").click( function (e) {
                    e.preventDefault();
                    //change hand icon
                    //$('.sidebar-toggle i').toggleClass(" fa-navicon");
                   // $('.sidebar-toggle i').toggleClass("fa-navicon");

                    //If window is small enough, enable sidebar push menu
                    if ($(window).width() <= 992) {
                        $('.row-offcanvas').toggleClass('active');
                        $('.left-side').removeClass("collapse-left");
                        $(".right-side").removeClass("strech");
                        $('.row-offcanvas').toggleClass("relative");
                    } else {
                        //Else, enable content streching
                        $('.left-side').toggleClass("collapse-left");
                        $(".right-side").toggleClass("strech");
                    }
                });

                 //Add hover support for touch devices
                    $('.btn').bind('touchstart', function () {
                        $(this).addClass('hover');
                    }).bind('touchend', function () {
                        $(this).removeClass('hover');
                    });

                    //Activate tooltips
                    $("[data-toggle='tooltip']").tooltip();

                    /*     
                    * Add collapse and remove events to boxes
                    */
                    $("[data-widget='collapse']").click(function () {
                        //Find the box parent        
                        var box = $(this).parents(".box").first();
                        //Find the body and the footer
                        var bf = box.find(".box-body, .box-footer");
                        if (!box.hasClass("collapsed-box")) {
                            box.addClass("collapsed-box");
                            bf.slideUp();
                        } else {
                            box.removeClass("collapsed-box");
                            bf.slideDown();
                        }
                    });

        });
    </script>
   

<script>
 
    $(document).ready(function(){ 
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5'
            ]
        });
       
        $("#add-service-form").validate({
            rules:{
                name:{
                        required:true,
                },
            },
            messages:{
                name:{
                    required:"Enter Package Name",
                },

            },
            submitHandler: async (form, event)=>{
                event.preventDefault();
           
                var data=new FormData($(form)[0]);
            
                try {
                    var response=await fetch(form.action,{
                        method:form.method, 
                        body: data, 
                        dataType:'JSON',
                        credentials: 'same-origin',
                    });
               
                    var json= await response.json();
                    if (json.result){
                        $(form).trigger('reset');

                        toastr.success(json.message) ; 

                        setTimeout(function(){ 
                            location.href=""; 
                        }, 3000);                      
                    }else{
                        toastr.error(json.message);
                    }    
                }catch(err) {
              
                    toastr.error(err);
                }
             
                //table.draw();
                table.page(table.page.info().page).draw(false);;
            
            }  
        }); 
      
        $("#edit-service-form").validate({
            rules:{
                name:{
                    required:true,
                },
            },
            messages:{
                name:{
                    required:"Enter Package Name",
                },

            },
            submitHandler: async (form, event)=>{
                event.preventDefault();
           
                var data=new FormData($(form)[0]);
            
                try {
                    var response=await fetch(form.action,{
                        method:form.method, 
                        body: data, 
                        dataType:'JSON',
                        credentials: 'same-origin',
                    });
               
                    var json= await response.json();
                    if (json.result){
                        $(form).trigger('reset');

                        toastr.success(json.message) ; 

                        setTimeout(function(){ 
                            location.href=""; 
                        }, 3000);                      
                    }else{
                        toastr.error(json.message);
                    }    
                }catch(err) {
                
                    toastr.error(err);
                }
             
                //table.draw();
                table.page(table.page.info().page).draw(false);;
            
            }  
        });
    });
  
  
</script>
