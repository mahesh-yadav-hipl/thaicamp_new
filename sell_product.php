<?php include('head.php') ;
$start_date = $end_date = '';

if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])){ 
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $start_date_fitler = date('Y-m-d',strtotime($start_date));
    $end_date_fitler = date('Y-m-d',strtotime($end_date));   

    
    if ($_SESSION['login_type'] === 'subscriber'){
        $id = $_SESSION['login_id'];
                $sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name, SUM(quantity) as total_qty
                                        FROM sell_products
                                        LEFT JOIN products ON products.id = sell_products.product_id
                                        Where created_by_id = '$id' 
                                        AND sell_products.created_at BETWEEN '$start_date_fitler' AND '$end_date_fitler'
                                        GROUP BY order_id
                                        ORDER BY sell_products.id DESC");

    }else{
        $sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name, SUM(quantity) as total_qty
        FROM sell_products
        LEFT JOIN products ON products.id = sell_products.product_id
        Where sell_products.created_at BETWEEN '$start_date_fitler' AND '$end_date_fitler'
        GROUP BY order_id
        ORDER BY sell_products.created_at DESC, sell_products.id DESC");
       // ORDER BY sell_products.id DESC");
    }

}else{
     if ($_SESSION['login_type'] === 'subscriber'){
        $id = $_SESSION['login_id'];
                $sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name, SUM(quantity) as total_qty
                                        FROM sell_products
                                        LEFT JOIN products ON products.id = sell_products.product_id
                                        Where created_by_id = '$id'
                                        GROUP BY order_id
                                        ORDER BY sell_products.id DESC");

    }else{
        $sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name, SUM(quantity) as total_qty
        FROM sell_products
        LEFT JOIN products ON products.id = sell_products.product_id
        GROUP BY order_id
        ORDER BY sell_products.created_at DESC, sell_products.id DESC");
    }

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
                <h2>Order List</h2>
                
            </section>
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-users"></i> All Order List
                                </h4>
                               <!-- <span class="pull-right">
                                    <a  href="add_sell_product.php" class="btn btn-primary">Add Sell Product</a>
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span> -->
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
                                                        <a href="sell_product.php" class="btn btn-sm btn-success default-btns">Clear</a>                                                        
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
                                            <th style="width: 100px;">Sr No.</th>
                                            <th>Order Id</th>
                                            <!-- <th>Product Name</th> -->
                                            <th>Sell Quantity</th>
                                            <!-- <th>Discount</th> -->
                                            <th>Created  at</th>
                                            <th>Invoice</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($sellproducts) {
                                        $i = 1 ;
                                        foreach($sellproducts as $k =>$v){ 
                                        $productDetail = json_decode($v['product_detail']);
                                         
                                        ?>    
                                        <tr class="odd">
                                            <td><?=$i?></td>
                                            <td><?=$v['order_id']?></td>
                                            <!-- <td><?=$v['product_name'] ?></td> -->
                                            <td><?=$v['total_qty']?></td>
                                            <td><?= date("d-m-Y" , strtotime($v['created_at'])) ; ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-style" href="order-invoice.php?order_id=<?=$v['order_id']?>">
                                                        Invoice
                                                </a>
                                            <td class="action-area">
                                                <a class="btn btn-primary" href="view_sell_product.php?order_id=<?=$v['order_id']?>">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                                <!-- <a class="btn btn-primary" href="edit_sell_product.php?id=<?=$v['id']?>">
                                                        Edit
                                                </a> -->
                                                <!-- <a class="btn btn-danger remove" href="#" data-table='sell_products' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a> -->
                                                
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
</html>

<script>

$('body').on('click','.remove',function(){

        var id = $(this).data('value');
       var table_name= $(this).data('table');

         swal({
            title: 'Are you sure?',
            text: "You want to delete this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff8084',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             console.log(result) ;
            if (result) {
                $.ajax({
                    url:'ajax/delete.php',
                    type:'POST',
                    data:{'table':table_name,'key':'id','value':id},
                    dataType:'json',
                    success: function(response){
                          
                        toastr.success(response.message);                  
                       setTimeout(function(){ location.href='sell_product.php'; },1500); 
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }).then(function(){
                    table.page(table.page.info().page).draw(false);
                }); 
            }
         });
         });
         
window.onload = (event) => {
    $('.se-pre-con2').css('display','none');
}     
         

</script>
