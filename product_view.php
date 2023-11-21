<?php include('head.php');
    // update product qunatitiy 
    $lastday = date('Y-m-d 00:00:00', strtotime( '-1 day'));
    $get_sell_product = db_select_query("SELECT * FROM sell_product_generate WHERE deleted = 0  AND created_at < '$lastday' ");
    if(count($get_sell_product) > 0){
        foreach($get_sell_product as $row){            
                $product_id_update = $row['product_id'];   
				$product_qry = db_select_query("SELECT * FROM products WHERE id = '$product_id_update'")[0];
                if($product_qry){
                    //update quantity
                        $productData['table'] = 'products';
                        $productStock = (int)$product_qry['stock'] + (int)$row['quantity'];
                        $values_product['stock'] = $productStock;
                        $productData['values'] = $values_product;
                        $productData['where']['id']=$product_id_update;
                        db_update($productData);
                    //update quantity
                }                
                // update sell_product_generate table
                    $ProductGenerate['table'] = 'sell_product_generate';
                    $values['deleted'] = 1;
                    $ProductGenerate['values'] = $values;
                    $ProductGenerate['where']['id']=$row['id'];
                    db_update($ProductGenerate);
                // update sell_product_generate table
        }
    }
    // update product qunatitiy 
?>

<style>
.product-container{
    margin-top: 20px;
}
.flex-row{
    display: flex;
    flex-wrap: wrap;
}
.thumbnail{
    padding: 0;
    overflow: hidden;
    height: calc(100% - 20px);
}
.thumbnail img{
    width: 100%;
    height: 225px;
    object-fit: cover;
    transform: translateZ(0) scale(0.999999);
}
.thumbnail .caption{
    padding: 15px;
    position: relative;
}
.thumbnail .caption h3{
    margin: 0 0 10px;
    font-size: 18px;
    font-weight: 600;
    color: #000;
}
.text_up{
    position: absolute;
    right: 0;
    top: -34px;
    padding: 7px 12px;
    background: #000;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
}
.in_stock{
    background: #65a800;
}
.out_stock{
    background: #dc1016;
}
.thumbnail .btn-primary:hover{
    background: #000;
    border-color: #000;
    transition: all 0.3s ease-in;
}
.panel-heading span {
    margin-top: -38px;
    font-size: 12px;
}
.thumbnail {
    position: relative;
}
.add_edit_btn{
    position: absolute;
    right: 3px;
    top: 3px;
    z-index: 99;
}
.add_edit_btn a{
    border-radius: 50% !important;
    height: 25px;
    width: 25px;
    text-align: center;
    line-height: 25px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
}
.col-md-6.product_price, .product_total {
    margin-bottom: 5px;
    font-size: 15px;
}
.col-md-6.product_price {
    padding-right: 5px;
}
.product_total {
    text-align: right;
    padding-left: 5px;
}



   
.quanty-flex-group{
    display: flex;
    align-items: center;
    margin-top: 15px;
}
.quanty-flex-group .qtyminus, .quanty-flex-group .qtyplus{
    background: #000;
    color: #fff;
    font-size: 20px;
    padding: 0;
    height: 35px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
}
.quanty-flex-group input.qty{
    height: 35px;
    border: 1px solid #ddd;
    border-radius: 0; 
    width: 100px;
    text-align: center;
}
.bynow_btn{
    display: block;
    width: 100%;
    margin-top: 20px;
}
.select_size_inner{
    width: 100%;
    padding: 3px;
    border: 1px solid #ddd;
}
</style>

<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');
$products =  db_select_query("SELECT products.*,categories.name as categories_name
                            FROM products
                            LEFT JOIN categories ON categories.id = products.category_id
                            where categories.id != ''
                            ORDER BY products.id DESC");
?>        
    <aside class="right-side right-padding">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h2>Products</h2>
        </section>  
        <div class="clear"></div>
        <!--section ends-->
        <div class="product-container">
      <?php  if($_SESSION['login_type'] === "admin"){ ?>
        <div class="col-lg-12">
            <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="fa fa-fw fa-users"></i> Products List
                </h4>
                <span class="pull-right">
                    <a  href="add_product.php" class="btn btn-primary">Add Product</a>
                    <i class="glyphicon glyphicon-chevron-up showhide clickable" title="Hide Panel content"></i>
                    <i class="glyphicon glyphicon-remove removepanel"></i>
                </span>
            </div>
            </div>
        </div>
        <?php } ?>


            <div class="row flex-row">
                <?php 
                    if($products) {
                    foreach($products as $k =>$v){  ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="thumbnail">
                        <?php  if($_SESSION['login_type'] === "admin"){ ?>
                            <div class="add_edit_btn">
                                <?php if($v['stock'] > 0){ 
                                    $cart_class = 'success';
                                    $add_remove_cart = " add_to_cart ";
                                        if (isset($_SESSION['cart'])) {
                                             if(array_key_exists($v['id'], $_SESSION['cart'])) {
                                                $cart_class = 'danger';
                                                $add_remove_cart = " remove_cart ";
                                             }
                                        }

                                    ?>
                                <!-- <a class="btn btn-<?= $cart_class.' '.$add_remove_cart;?> btn-sm " data-product_id="<?=$v['id']?>"><i class="fa fa-shopping-cart text-default" aria-hidden="true"></i></a> -->
                                <?php } ?>
                                <a class="btn btn-primary btn-sm" href="edit_product.php?id=<?=$v['id']?>">
                                        <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-danger remove btn-sm" href="#" data-table='products' data-key='id' data-value="<?php echo $v['id'] ?>">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </div>
                        <?php } ?>
                            <?php  
                            $image = URL.'uploaded/product/'.$v['featued_image'];
                            if($v['featued_image']!='' ){
                                $url = $image;
                            }else{
                                $url = URL.'uploaded/product/default-placeholder.png';
                            }?>
                            <img src="<?= $url;?>" width="50px" height="50px">
                            <div class="caption">
                                <span class="text_up in_stock">
                                <?php 
                                $total_stock = '';
                                if($_SESSION['login_type'] === "admin"){
                                    $total_stock = '<span class="admin_stock">'.$v['stock'].'</span>';
                                }

                                if($v['stock'] == 0){
                                    echo "Out of Stock";
                                }else{
                                    echo "In Stock ".$total_stock;
                                }
                                ?></span>
                                <?php  if($_SESSION['login_type'] === "admin"){ ?>
                                    <div class="row">
                                    <div class="col-md-6 product_price"><strong>Price : </strong> <?php echo (int)$v['price']?> KD</div>
                                    <div class="col-md-6 product_total"><strong>Total Sell : </strong>                                 
                                     <?php 
                                            $sumofSellQuantity = db_select_query("select SUM(quantity) AS 'sumofSellQuantity'  from sell_products where product_id = ".$v['id']." ");
                                            if($sumofSellQuantity[0]['sumofSellQuantity'] == ''){
                                                $sumofSellQuantity[0]['sumofSellQuantity'] = 0;
                                            }
                                            ?>
                                            <?=$sumofSellQuantity[0]['sumofSellQuantity']?>
                                   </div>       
                                    
                                </div>
                                <?php  } ?>
                                <h3><a href="product-detail.php?id=<?=$v['id']?>"><?=$v['title']?></a></h3>
                                <p><?=$v['description']?></p>
                                <div class="row">
                                <?php if($v['stock'] > 0){ ?>
                                    <div class="col-md-12">
                                        <?php  
                                              $pro_qty = 1;
                                              if (isset($_SESSION['cart'])) {
                                                  if(array_key_exists($v['id'], $_SESSION['cart'])) {
                                                      $pro_id = $v['id'];
                                                      $pro_qty = $_SESSION['cart'][$pro_id]['quantiy'];
                                                  }
                                              }?>
                                        


                                        <?php 
                                            $getAllSizes = db_select_query("select * from  product_sizes WHERE product_id = ".$v['id']." AND deleted = 0 ");
                                            if(count($getAllSizes) > 0){
                                       ?>
                                         <div class="select_size_main">
                                                <select name="select_size" class="select_size_inner">
                                                    <option value="">Select Size</option>
                                                    <?php foreach($getAllSizes as $rowSize){?>
                                                            <option value="<?= $rowSize['id']; ?>"><?= $rowSize['size_name'];?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        <?php } ?>



                                        <span class="checkout_add_cart">
                                            <div class="quanty-flex-group qty_uniq">
                                                <div class="qtyminus">-</div>
                                                <input type="number" name="quantity" value="<?= $pro_qty;?>" class="qty quantity_input" data-product_id="<?=$v['id'];?>">
                                                <div class="qtyplus">+</div>                                        
                                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm cart_add_btn">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm delete_cart_producut"data-product_id="<?=$v['id'];?>"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="message_resp_<?= $v['id'];?>"></div>
                                        </span>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <a href="checkout.php" class="btn btn-warning pull-right bynow_btn" role="button">Buy Now</a>    
                                    </div> -->
                                    <?php } ?>

                                    <?php if($_SESSION['login_type'] === "admin"){?>
                                   
                                    <?php } ?>
                                  
                                    <!-- <a href="product-detail.php?id=<?=$v['id']?>" class="btn btn-primary " role="button">View Detail</a> -->

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } }?>               
                
                <!-- <div class="col-sm-12 text-center">
                    <ul class="pagination">
                        <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                </div> -->
            </div>
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
                       setTimeout(function(){ location.href='product_view.php'; },1500); 
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

         
         

          $(document).ready(function(){
        //     $(document).on('click','.add_to_cart',function(){
        //         var quantiy = 1; 
        //         var product_id = $(this).data('product_id'); 
        //         if(quantiy > 0){
        //             $.ajax({    
        //                 type: "post",
        //                 url: "ajax/cart.php", 
        //                 data:{quantiy:quantiy,product_id:product_id},                  
        //                 success: function(data){                            
        //                    setTimeout(function () {
        //                             location.reload();
        //                         }, 100);
        //                 }
        //             }); 
        //         } 
        //     })

            // remvoe cart
                // $(document).on('click','.remove_cart',function(){
                //     var product_id =  $(this).data('product_id');
                //     if(product_id > 0){
                //             $.ajax({    
                //                 type: "post",
                //                 url: "ajax/cart_delete.php", 
                //                 data:{product_id:product_id},                  
                //                 success: function(data){  
                //                     setTimeout(function () {
                //                         location.reload();
                //                     }, 100);
                //             }
                //             }); 
                //         } 
                // })
            // remvoe cart

            $(".qtyminus").on("click",function(){
                var now =  $(this).closest(".qty_uniq").find(".qty").val(); 
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(this).closest(".qty_uniq").find(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
              //  var now = $(".qty").val();
              var now =  $(this).closest(".qty_uniq").find(".qty").val(); 
                if ($.isNumeric(now)){
                    //$(".qty").val(parseInt(now)+1);
                    $(this).closest(".qty_uniq").find(".qty").val(parseInt(now)+1);
                }
            });
         })

         $(document).on('click','.cart_add_btn',function(){
                $(".message_resp").html();
                var quantiy = $(this).closest( ".checkout_add_cart").find('.quantity_input').val(); 
                var product_id = $(this).closest( ".checkout_add_cart").find('.quantity_input').data('product_id');; 
                if(quantiy > 0){
                    $.ajax({    
                        type: "post",
                        url: "ajax/cart.php", 
                        data:{quantiy:quantiy,product_id:product_id},                  
                        success: function(data){  
                            $('.message_resp_'+product_id).html(data.message);
                           $(".message_resp").html(data.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                    }
                    });  
                }
            });

            // delete
                $(document).on('click','.delete_cart_producut',function(){
                var product_id =  $(this).data('product_id');
                    if(product_id > 0){
                            $.ajax({    
                                type: "post",
                                url: "ajax/cart_delete.php", 
                                data:{product_id:product_id},                  
                                success: function(data){  
                                    $('.message_resp_'+product_id).html(data.message);
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                            }
                            }); 
                        } 
                })
            // delete


</script>
</body>

</html>

