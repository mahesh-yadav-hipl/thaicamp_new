<?php include('head.php') ;
$order_id=!empty($_GET['order_id'])?$_GET['order_id']:"";

if ($_SESSION['login_type'] === 'subscriber'){
    $id = $_SESSION['login_id'];
    $sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name,products.price as product_price
                                     FROM sell_products
                                     LEFT JOIN products ON products.id = sell_products.product_id
                                     WHERE sell_products.order_id = '$order_id' AND created_by_id = '$id'");

}else{
$sellproducts =  db_select_query("SELECT sell_products.*,products.title as product_name,products.price as product_price
                                     FROM sell_products
                                     LEFT JOIN products ON products.id = sell_products.product_id
                                     WHERE sell_products.order_id = '$order_id'");
   }                                  
                                   //  $productDetail = json_decode($sellproducts[0]['product_detail']);
                                     
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
                <h2>Sell Product</h2>
                
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
                                    <i class="fa fa-fw fa-user"></i> View Sell Product
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
                                            <?php if(count($sellproducts ) > 0){ ?>                                         
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="panel-body">




                                                  <?php  $html = '';
                                                    $html .='<bookmark content="Start of the Document" />
                                                            <html lang="en">
                                                            <body style="width:100%;">	
                                                            <div  style="width:100%;text-align:center;margin-bottom:15px">				
                                                                <img src="img/logo.png" alt="image not found" class="logo_view_print"/>
                                                                <br>
                                                                <h5>Order Invoice</h5>
                                                            </div>';


                                                            $html .='<div class="table-responsive"><table class="table table-bordered" id="users" style="width:100%;border: 1px solid #ddd;overflow-x: scroll;"> 
                                                                    <tr style="border: 1px solid #ddd;">
                                                                        <th align="left" style="border: 1px solid #ddd;">Order id</th>
                                                                        <th align="left" style="border: 1px solid #ddd;">Product</th>
                                                                        <th align="left" style="border: 1px solid #ddd;">Qty / Size</th>
                                                                        <th align="left" style="border: 1px solid #ddd;">Price</th>
                                                                        <th align="left" style="border: 1px solid #ddd;">Amount</th>
                                                                    </tr>';
                                                                    if($sellproducts){
                                                                        $sub_total = 0;
                                                                        $discount_amount = 0;
                                                                        foreach($sellproducts as $row){
                                                                            $discount_amount = $row['discount_amount'];
                                                                            $pro_details = json_decode($row["product_detail"]);
                                                                            $total = $row['quantity']*$pro_details->price;
                                                                            $sub_total += $row['quantity']*$pro_details->price;
                                                                            $size_value = "";
                                                                            if($row['size_name'] != ""){
                                                                                $size_value = ' / '.$row['size_name'];
                                                                            }

                                                                            $html .='
                                                                                <tr style="border: 1px solid #ddd;">
                                                                                <td style="border: 1px solid #ddd;">'.$row["order_id"].'</td>
                                                                                <td style="border: 1px solid #ddd;">'.$pro_details->title.'</td>
                                                                                <td style="border: 1px solid #ddd;">'.$row['quantity'].$size_value.'</td>
                                                                                <td style="border: 1px solid #ddd;">'.(int)$pro_details->price.' &nbsp;KD</td>
                                                                                <td style="border: 1px solid #ddd;">'.$total.' &nbsp;KD</td>
                                                                            </tr>';
                                                                        }
                                                                        $html .='<tr style="border: 1px solid #ddd;">
                                                                                    <td style="border: 1px solid #ddd;" colspan="4" align="right">Discount Amount</td>
                                                                                    <td style="border: 1px solid #ddd;" >'.(int)$discount_amount.' &nbsp;KD</td>
                                                                                </tr>';
                                                                        $html .='<tr style="border: 1px solid #ddd;">
                                                                                    <td style="border: 1px solid #ddd;" colspan="4" align="right">Total</td>
                                                                                    <td style="border: 1px solid #ddd;" >'.($sub_total - $discount_amount).' &nbsp;KD</td>
                                                                                </tr>';
                                                                    }
                                                            $html .='</table></div>
                                                                    </body>
                                                                </html>' ; 
                                                                echo $html;
                                                                ?>





                                                          <!--  <?php  foreach($sellproducts as $sellproducts)
                                                                {  $productDetail = json_decode($sellproducts['product_detail']);?>
                                                                 <div class="table-responsive">
                                                                    <table class="table table-bordered" id="users">                                                                
                                                                        <tr>
                                                                            <td> Order Id</td>
                                                                            <td>
                                                                            <?php echo ucfirst($sellproducts['order_id']);?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Product Name</td>
                                                                            <td>
                                                                                <?php echo ucfirst($productDetail->title);?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Price Per Unit</td>
                                                                            <td>
                                                                            <?php echo $productDetail->price?> KD
                                                                            </td>
                                                                        </tr> 
                                                                        <tr>
                                                                            <td>Quantity</td>
                                                                            <td>
                                                                            <?php echo $sellproducts['quantity']?>
                                                                            </td>
                                                                        </tr>                                                                                                                            
                                                                        <tr>
                                                                            <td>Order Sub Total</td>
                                                                            <td>
                                                                                <?php 
                                                                                    $subTotal = $sellproducts['quantity'] * $productDetail->price;
                                                                                    echo $subTotal;
                                                                                ?>
                                                                            </td>
                                                                        </tr>                              
                                                                       <tr>
                                                                            <td>Order Total</td>
                                                                            <td>
                                                                                <?php 
                                                                                    $orTotal = $subTotal - $sellproducts['discount_amount'];
                                                                                    echo $orTotal;
                                                                                ?>
                                                                            </td>
                                                                        </tr>                                                                                                                            
                                                                        <tr>
                                                                            <td>Order Date</td>
                                                                            <td>
                                                                            <?php echo date("d-m-Y" , strtotime($sellproducts['created_at']))?>
                                                                            </td>
                                                                        </tr>                                                                
                                                                    </table>
                                                                </div>
                                                                <?php } ?> -->
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <a href="sell_product.php"  class="btn btn-danger">Back</a> &nbsp;    
                                                                <!-- <a href="#"  class="btn btn-info" >Invoice</a> &nbsp;                         -->
                                                                <!-- <a target="_blank" href="<?= URL ?>order-invoice.php?order_id=<?= $_GET['id'] ?>"  class="btn btn-info" >Invoice</a> &nbsp; -->
                                                            </div>
                                                        </div>
                                          <?php 
                                                 }else{ ?>
                                                        <div style="text-align: center;" class="">
                                                                <a href="sell_product.php"  class="btn btn-danger">Back</a> &nbsp;    
                                                                <!-- <a href="#"  class="btn btn-info" >Invoice</a> &nbsp;                         -->
                                                                <!-- <a target="_blank" href="<?= URL ?>order-invoice.php?order_id=<?= $_GET['id'] ?>"  class="btn btn-info" >Invoice</a> &nbsp; -->
                                                            </div>
                                                 <?php  } ?>

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

    <script>
        
    </script>
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

.logo_view_print{
    width: 200px;
    margin-top: 20px;
}
</style>

