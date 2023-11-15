<?php include('head.php') ;?>

<style>
.product-detail-container{
    margin-top: 20px;
    background: #fff;
    padding: 20px;
}
.flex-row{
    display: flex;
    flex-wrap: wrap;
}
.productImg{
    overflow: hidden;
    border-radius: 5px;
}
.productImg img{
    width: 100%;
}
.product-detail h3{
    margin: 0 0 15px;
    font-size: 24px;
    font-weight: 600;
    color: #000;
}
.product-detail .price{
    display: block;
    font-size: 18px;
    font-weight: 600;
    color: #65a800;
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
    margin-bottom: 8px;
}
.product-detail .list-group{
    max-width: 350px;
    margin: auto 0 0;
}
.product-detail .list-group .list-group-item{
    float: none;
    padding: 10px 15px;
    font-size: 15px;
    font-weight: 600;
    background: #f7f7f7;
    margin-bottom: 8px;
    border-radius: 5px;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.product-detail .list-group .list-group-item:last-child {
    margin-bottom: 0;
}
.product-detail .list-group .list-group-item .badge{
    background-color:#313e4b;
    padding: 5px 10px;
}
.text_up{
    padding: 7px 12px;
    background: #000;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-self: flex-start;
    margin: 10px 0;
}
.in_stock{
    background: #65a800;
    border-radius: 3px;
}
.out_stock{
    background: #dc1016;
    border-radius: 3px;
}
.detail-content{
    height: 70px;
    overflow: auto;
    margin-bottom: 15px;
}
.product-detail{
    height: 100%;
    display: flex;
    flex-direction: column;
    align-self: flex-start;
}
.detail-content{
    scrollbar-color: #F4F6FA;
    scrollbar-width: thin;
    transition: all 0.3s ease-in;
}
.detail-content::-webkit-scrollbar {
    height: 8px;
    width: 8px;
}
.detail-content::-webkit-scrollbar-track {
    background-color: #F4F6FA;
    border-radius: 15px;
}
.detail-content::-webkit-scrollbar-thumb {
    background-color: #9AA9BF;
    border-radius: 15px;
}
.detail-content::-webkit-scrollbar-thumb:hover {
    background-color: #9AA9BF;
}
.detail-content::-webkit-scrollbar-thumb:active {
    background-color: #9AA9BF;
}
.quanty-flex-group{
    display: flex;
    align-items: center;
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


@media (max-width:767px){
    .product-detail{
        margin-top: 20px;
    }
}
</style>

<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');
$get_all_categories = db_select_query("SELECT * FROM categories ORDER BY id DESC") ;

$id=!empty($_GET['id'])?$_GET['id']:"";
$product = db_select_query("SELECT * FROM products WHERE id = '$id'");
if(count($product) == 0){
    echo "Product not exists";
    die;
}
?>        
    <aside class="right-side right-padding">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h2>Product Detail</h2>
        </section>  
        <div class="clear"></div>
        <!--section ends-->
        <div class="product-detail-container">
            <div class="row flex-row">
                <div class="col-xs-12 col-sm-5">
                    <div class="productImg">
                        <?php 
                            $image = URL.'uploaded/product/'.$product[0]['featued_image'];
                            if($product[0]['featued_image']!=''){
                                $url = URL.'uploaded/product/'.$product[0]['featued_image'];
                            }else{
                                $url = URL.'uploaded/product/default-placeholder.png'; 
                            }?>
                            <img src="<?= $url;?>" alt="product">
                    </div> 
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="product-detail">
                        <h3><?php echo ucfirst($product[0]['title']);?></h3>
                        <div class="price">Price : <?php echo (int)$product[0]['price']?> KD</div>
                        <span class="text_up in_stock"><?php 
                        if($product[0]['stock'] == 0){
                            echo "Out of Stock";
                        }else{
                            echo "In Stock";
                        }
                        ?></span>
                        <div class="detail-content">
                            <p><?php echo $product[0]['description']?></p>
                        </div>

                       <?php  if($product[0]['stock'] > 0 && ($_SESSION['login_type'] === "admin" || $_SESSION['login_type'] === "subscriber")){?>
                            <div class="cart_section">
                           <?php 
                                $pro_qty = 1;
                            if (isset($_SESSION['cart'])) {
                                if(array_key_exists($product[0]['id'], $_SESSION['cart'])) {
                                    $pro_id = $product[0]['id'];
                                    $pro_qty = $_SESSION['cart'][$pro_id]['quantiy'];
                                }
                            }?>
                            <div class="quanty">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="size">Quantity</label>
                                        <div class="quanty-flex-group">
                                            <div class="qtyminus">-</div>
                                            <input type="number" name="quantity" value="<?php echo $pro_qty;?>" class="qty" id="quantiy">
                                            <input type="hidden" name="product_id" value="<?php echo $product[0]['id']; ?>" id="product_id">   
                                            <div class="qtyplus">+</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="d-block">&nbsp;</label>
                                        <br>
                                        <button type="button" id="cart_add" class="btn btn-success btn-sm">Add To cart</button>
                                        <a href="checkout.php" class="btn btn-primary btn-sm">Buy Now</a>
                                    </div>  
                                </div>
                                <div class="message_resp"></div>
                            </div>    
                                    
                            </div>
                        <?php } ?>



                        <!-- <ul class="list-group">
                            <li class="list-group-item">
                                Category
                                <span class="badge"><?php if($get_all_categories) {
                                foreach($get_all_categories as $k =>$v){ 
                                        if($v['id'] == $product[0]['category_id']){
                                           echo ucfirst($v['name']);
                                        }
                                    ?>                                                                             
                                    <?php } 
                                } ?></span>
                            </li>
                        </ul> -->
                    </div>
                </div>
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
        $(document).ready(function(){
            $(document).on('click','#cart_add',function(){
                $(".message_resp").html();
                var quantiy = $("#quantiy").val(); 
                var product_id = $("#product_id").val(); 
                if(quantiy > 0){
                    $.ajax({    
                        type: "post",
                        url: "ajax/cart.php", 
                        data:{quantiy:quantiy,product_id:product_id},                  
                        success: function(data){   
                            $(".message_resp").html(data.message);
                            $(".cart_count_header").html(data.total_cart);
                        }
                    }); 
                } 
            })

            $(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });
        })
    </script>
</body>

</html>

