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
                                    <i class="fa fa-fw fa-file"></i> Daily Sales and Subscribers Report
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
                                                        Select Date
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type ="date" name="date" id="date" class="form-control" value="<?php if(!empty($_REQUEST['date'])){echo $_REQUEST['date'];}?>">
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
                                    <i class="fa fa-fw fa-file"></i> Sale and Subscription Report List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <h2>Subscription</h2>
                                <?php 
                                    $tot_pck_pr = 0 ;
                                    $total_quantity = 0;
                                    $date = date('Y-m-d', strtotime($_REQUEST['date']));
                                    $subscriber_query  = "SELECT * FROM users WHERE role = 'subscriber' AND  CAST(created_at as DATE) = '$date'";
                                    $subscriber_query = db_select_query($subscriber_query);

                                    $product_query  = "SELECT DISTINCT(product_id) FROM sell_products WHERE CAST(created_at as DATE) = '$date'";
                                  
                                    $product_query = db_select_query($product_query);
                                ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Subscriber Name</b></th>
                                            <th><b>Package Name</b></th>
                                            <th><b>Count</th>
                                            <th><b>Total Price</b></th>
                                        </tr>
                                    </thead>
                                    <?php if($subscriber_query){
                                    $i = 0 ; ?>
                                    <tbody>
                                        <?php 
                                        foreach($subscriber_query as $subscriber[$i])
                                        {   
                                            $count_user = 0;
                                            $pc = $subscriber[$i]['packagesid'] ; 
                                            $qr = db_select_query("select price, name from packages where id = '$pc' ")[0] ;
                                            $count_user++;
                                        ?> 
         
                                        <tr>
                                          
                                            <td><?=$subscriber[$i]['name']?></td>
                                            <td><?=$qr['name']?></td>
                                            <td><?=$count_user?></td>
                                            <td><?=$qr['price']?></td>
                                        </tr>
                                        <?php
                                            $i++ ;
                                            $tot_pck_pr+=$qr['price'] ; 
                                            $total_quantity+=$count_user;
                                        }
                                        ?>
                                    </tbody>
                                    <tfooot>
                                        <tr>
                                            <th colspan="2"><b>Total</b></th>
                                            <th><b><?php echo $total_quantity ;   ?></b></th>
                                            <th><b><?php echo $tot_pck_pr ;   ?> KD</b></th>
                                        </tr>
                                    </tfooot>
                                    <?php } else{?>
                                    <tfooot>
                                        <tr>
                                            <th colspan="4"><b>No data Available</b></th>
                                        </tr>
                                    </tfooot>
                                    <?php }?>    
                                </table>
                            </div>
                            <div class="panel-body table-responsive">     
                                   
                                <h2>Sales</h2>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Product Name</b></th>
                                            <th><b>Quantity</b></th>
                                            <th><b>Total Price</b></th>
                                        </tr>
                                    </thead>
                                    <?php if($product_query){
                                    $i = 0 ;
                                    $total_quantity = 0;
                                    $total_sell = 0 ; ?>
                                    <tbody>
                                        <?php 
                                        foreach($product_query as $product[$i])
                                        {   
                                            $pc = $product[$i]['product_id'] ;
                                            $qr = db_select_query("select * from products where id = '$pc' ")[0] ;
                                            $pck_price =  $qr['price'] ;
                                            $cnp = db_select_query("select sum(quantity),sum(discount_amount) from sell_products WHERE CAST(created_at as DATE) = '$date' and  product_id = '$pc'"); 
                                            $total_price = ($pck_price - $cnp[0]['sum(discount_amount)']) * $cnp[0]['sum(quantity)']; 
                                        ?> 
         
                                        <tr>
                                          
                                            <td><?=$qr['title']?></td>
                                            <td><?=$cnp[0]['sum(quantity)']?></td>
                                            <td><?=$total_price?></td>
                                        </tr>
                                        <?php
                                            $i++ ;
                                            $total_sell+=$total_price ; 
                                            $total_quantity+=$cnp[0]['sum(quantity)'];
                                        }
                                        ?>
                                    </tbody>
                                    <tfooot>
                                        <tr>
                                            <th><b>Total</b></th>
                                            <th><b><?php echo $total_quantity ;   ?></b></th>
                                            <th><b><?php echo $total_sell ;   ?> KD</b></th>
                                        </tr>
                                    </tfooot>
                                    <?php } else{?>
                                    <tfooot>
                                        <tr>
                                            <th colspan="4"><b>No data Available</b></th>
                                        </tr>
                                    </tfooot><?php }?>
                                </table>
                            </div>
                            <div class="profit">
                                <h2>Total</h2>
                                <p><b><?php echo $tot_pck_pr + $total_sell  ; ?> KD</b></p>
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
    <script src="js/custom_js/app.js" type="text/javascript"></script>
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
    <!-- end of page level js -->
</body>


</html>

