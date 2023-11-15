<?php include('head.php') ;
$get_all_categories = db_select_query("SELECT * FROM categories ORDER BY id DESC") ;

$id=!empty($_GET['id'])?$_GET['id']:"";
$product = db_select_query("SELECT * FROM products WHERE id = '$id'");
if(count($product) == 0){
    echo "Product not exists";
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
                <h2>Products</h2>
                
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
                                    <i class="fa fa-fw fa-user"></i> View Products
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
                                              <form id="add-user-form"  method="post" onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="products" > 
                                               <input type="hidden" name="product_id" value="<?php echo $product[0]['id'];?>">                                              
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">                                                                
                                                                <tr>
                                                                    <td> Title</td>
                                                                    <td>
                                                                    <?php echo ucfirst($product[0]['title']);?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Category Name</td>
                                                                    <td>
                                                                            <?php if($get_all_categories) {
                                                                            foreach($get_all_categories as $k =>$v){ 
                                                                                    if($v['id'] == $product[0]['category_id']){
                                                                                       echo ucfirst($v['name']);
                                                                                    }
                                                                                ?>                                                                             
                                                                                <?php } 
                                                                            } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Price</td>
                                                                    <td>
                                                                    <?php echo $product[0]['price']?>
                                                                    </td>
                                                                </tr>  
                                                                <tr>
                                                                    <td>Stock</td>
                                                                    <td>
                                                                    <?php echo $product[0]['stock']?>
                                                                    </td>
                                                                </tr>                                                                                          <?php 
                                                                    $sumofSellQuantity = db_select_query("select SUM(quantity) AS 'sumofSellQuantity'  from sell_products where product_id = ".$product[0]['id']." ");
                                                                    
                                                                    if($sumofSellQuantity[0]['sumofSellQuantity'] == ''){
                                                                        $sumofSellQuantity[0]['sumofSellQuantity'] = 0;
                                                                    }
                                                                ?>                              
                                                                
                                                                <!-- <tr>
                                                                    <td>Stock Quantity</td>
                                                                    <td>
                                                                        <?= ($product[0]['quantity'] - $sumofSellQuantity[0]['sumofSellQuantity']) ?>
                                                                    </td>
                                                                </tr>  -->
                                                                <tr>
                                                                    <td>Total Sell</td>
                                                                   
                                                                    <td><?=$sumofSellQuantity[0]['sumofSellQuantity']?></td>
                                                                </tr>         
                                                                 <tr>
                                                                    <td>Featued Image</td>
                                                                    <td>
                                                                        <?php 
                                                                        $image = URL.'uploaded/product/'.$product[0]['featued_image'];
                                                                        if($product[0]['featued_image']!='' ){
                                                                            $url = URL.'uploaded/product/'.$product[0]['featued_image'];
                                                                        }else{
                                                                            $url = URL.'uploaded/product/default-placeholder.png'; 
                                                                        }?>
                                                                        <img src="<?= $url;?>" alt="product" style="width:100px">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Description</td>
                                                                    <td>
                                                                       <?php echo $product[0]['description'];?>
                                                                    </td>
                                                                </tr> 
                                                            </table>
                                                            </div>
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <a href="product.php"  class="btn btn-danger">Back</a> &nbsp;                            
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


<style>
    

.pricing-table .plan {
  margin-left:0px;
  border-radius: 5px;
  text-align: center;
  background-color: #f3f3f3;
  -moz-box-shadow: 0 0 6px 2px #b0b2ab;
  -webkit-box-shadow: 0 0 6px 2px #b0b2ab;
  box-shadow: 0 0 6px 2px #b0b2ab;
}
 
 .plan:hover {
  background-color: #fff;
  -moz-box-shadow: 0 0 12px 3px #b0b2ab;
  -webkit-box-shadow: 0 0 12px 3px #b0b2ab;
  box-shadow: 0 0 12px 3px #b0b2ab;
}
 
 .plan {
  padding: 20px;
  margin-left:0px;
  color: #ff;
  background-color: #5e5f59;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
   margin-right: 10px;
}
.panel-body h4 {
    float: left;
    width: 100%;
    background-color: #ddd;
    padding: 10px;
    margin-left: 0px;
     margin-top:10px;  
     margin-bottom :10px;
}
  
.plan-name-bronze {
  padding: 20px;
  color: #fff;
  background-color: #665D1E;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-silver {
  padding: 20px;
  color: #fff;
  background-color: #313e4b;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-gold {
  padding: 20px;
  color: #fff;
  background-color: #FFD700;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  } 
  
.pricing-table-bronze  {
  padding: 20px;
  color: #fff;
  background-color: #f89406;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.pricing-table .plan .plan-name span {
  font-size: 20px;
}
 
.pricing-table .plan ul {
  list-style: none;
  margin: 0;
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
 
.pricing-table .plan ul li.plan-feature {
  padding: 15px 10px;
  border-top: 1px solid #c5c8c0;
  margin-right: 35px;
}

 
.pricing-variable-height .plan {
  float: none;
  margin-left: 2%;
  vertical-align: bottom;
  display: inline-block;
  zoom:1;
  *display:inline;
}
 
.plan-mouseover .plan-name {
  background-color: #4e9a06 !important;
}
 
.btn-plan-select {
  padding: 8px 25px;
  font-size: 18px;
}
.pricing-three-column {
    /* margin: 0 auto; */
    width: 100%;
    float: left;
}
.plan.col-md-3 {
    width: 24%;
}
</style>

