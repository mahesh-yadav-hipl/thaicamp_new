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
                                    <i class="fa fa-fw fa-file"></i>Month Store Report
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
                                    <i class="fa fa-fw fa-file"></i> Store Report List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                              
                                <?php 
                                    $tot_pck_pr = 0 ;
                                    $total_quantity = 0;                                
                                    $time=strtotime($_REQUEST['date']);
                                    $month=substr($_REQUEST['date'],0 ,2);
                                    $year=substr($_REQUEST['date'],3);

                                    
                                    $product_query  = "SELECT DISTINCT(product_id)  FROM sell_products WHERE  YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month'";
                                  
                                    $product_query = db_select_query($product_query);
            
                                    
                                
                                ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Product Name</b></th>
                                            <th><b>Quantity</b></th>
                                            <th><b>Total Price</b></th>
                                        </tr>
                                    </thead>
                                        <?php if($product_query){
                                        $i = 0 ; ?>
                                        <tbody>
                                            <?php 
                                             foreach($product_query as $product[$i])
                                            {   
                                                 $pc = $product[$i]['product_id'] ;
                                                // $qr = db_select_query("select * from products where id = '$pc' ")[0] ;
                                                // $pck_price =  $qr['price'] ;
                                                // $cnp = db_select_query("select sum(quantity),sum(discount_amount) from sell_products where YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month' and  product_id = '$pc'"); 
                                                // $total_price = ($pck_price - $cnp[0]['sum(discount_amount)']) * $cnp[0]['sum(quantity)']; 

                                                $cnp = db_select_query("select * from sell_products where YEAR(date(created_at)) = '$year' AND MONTH(date(created_at)) = '$month' and  product_id = '$pc'"); 
                                                $product_title = '';
                                                $product_qty = 0;
                                                $total_price = 0;
                                                if(count($cnp) > 0){
                                                    foreach($cnp as $cpn_row){
                                                        $cnp_productDetail = json_decode($cpn_row['product_detail']);
                                                        $product_title = ucfirst($cnp_productDetail->title);
                                                            $cpn_qty = $cpn_row['quantity'];
                                                            $cpn_price = $cnp_productDetail->price;
                                                            $product_qty += $cpn_qty;
                                                            $total_price += $cpn_price*$cpn_qty;
                                                    }
                                                }
                                           ?> 
             
                                            <tr>
                                              
                                                <!-- <td><?=$qr['title']?></td>
                                                <td><?=$cnp[0]['sum(quantity)']?></td>
                                                <td><?=$total_price?></td> -->
                                                <td> <?php echo $product_title;?></td>
                                                <td><?=$product_qty?></td>
                                                <td><?=$total_price?></td>
                                            </tr>
                                            <?php
                                                $i++ ;
                                                $tot_pck_pr+=$total_price ; 
                                                // $total_quantity+=$cnp[0]['sum(quantity)'];
                                                $total_quantity+=$product_qty;
                                            }
                                            ?>
                                        </tbody>
                                        <tfooot>
                                            <tr>
                                                <th><b>Total</b></th>
                                                <th><b><?php echo $total_quantity ;   ?></b></th>
                                                <th><b><?php echo $tot_pck_pr ;   ?> KD</b></th>
                                            </tr>
                                        </tfooot>
                                        <?php } else{?>
                                        <tbody>
                                            <tr>
                                                <th colspan="3"><b>No data available</b></th>
                                            </tr>
                                        </tbody>   
                                   
                                </table>
                                <?php }?> 
                                
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
   
