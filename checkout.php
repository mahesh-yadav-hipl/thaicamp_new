<?php include('head.php') ;?>
<body>
    <div class="se-pre-con"></div>
<?php include('header.php');
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
<?php include('sidebar.php');

?> 
<style>
    
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
#discount_btn_apply{margin-top: 5px;}

</style>       
    <aside class="right-side right-padding">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h2>Checkout</h2>
        </section>  
        <div class="clear"></div>
        <!--section ends-->
        <div class="product-detail-container">
            <div class="row flex-row">
               
                <div class="col-md-9">
                    <div class="panel-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            
                           <?php if (isset($_SESSION['cart'])) {
                               if(count($_SESSION['cart']) > 0){
                                    $total_amount = 0;
                                    foreach($_SESSION['cart'] as $row){
                                        if($row['quantiy'] > 0){
                                                    $product_id = $row['product_id'];
                                                    $quantiy = $row['quantiy'];
                                                    $product = db_select_query("SELECT * FROM products WHERE id = '$product_id'")[0];                              
                                                ?>
                                                <?php 
                                                    $image = URL.'uploaded/product/'.$product['featued_image'];
                                                    if($product['featued_image']!='' ){
                                                        $url = URL.'uploaded/product/'.$product['featued_image'];
                                                    }else{
                                                        $url = URL.'uploaded/product/default-placeholder.png'; 
                                                    }
                                                ?>
                                                <tr>
                                                    <td><img src="<?= $url;?>" alt="product" style="width:100px;"></td>
                                                    <td><?= $product['title'];?></td>
                                                    <td>
                                                        <span class="checkout_add_cart">
                                                            <div class="quanty-flex-group">
                                                                <div class="qtyminus">-</div>
                                                                <input type="number" name="quantity" value="<?= $quantiy;?>" class="qty quantity_input" data-product_id="<?= $product_id;?>">
                                                                <div class="qtyplus">+</div>
                                                        
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm cart_add_btn">To Update</button>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm delete_cart_producut"data-product_id="<?= $product_id;?>"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                            <div class="message_resp_<?= $product_id;?>"></div>
                                                         </span>                                                    
                                                    </td>
                                                    <td><?= (int)$product['price'];?></td>
                                                    <td><?php 
                                                        echo $quantiy*$product['price'];
                                                        $total_amount +=  $quantiy*$product['price'];
                                                    
                                                    ?></td>
                                                </tr>
                                         <?php } 
                                    }?>
                                       
                                    <?php 
                            
                                }else{
                                    redirect(URL.'product_view.php');
                                ?>
                                <tr><td>Data not Found</td></tr>     
                                <?php } } else{ 
                                     redirect(URL.'product_view.php');
                                    ?>
                            <tr><td>Data not Found</td></tr>
                            <?php } ?>
                        </table>
                    </div>
               </div>
               <div class="col-md-3">
                <?php if (isset($_SESSION['cart'])) {
                     if(count($_SESSION['cart']) > 0){?>
                     <div class="panel-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                               <td><b>Amount</b></td>
                               <td><b><?= $total_amount;?></b></td> 
                            </tr>
                            <tr>  
                            <?php  if($_SESSION['login_type'] === "admin"){ ?>
                                     <td><b>Discount Amount</b></td>
                                     <td><input type="number" class="form-control" id="discount_amount" placeholder="" ></td> 
                                <?php } ?>                             
                                <?php  if($_SESSION['login_type'] === "subscriber"){ ?>
                                    <td><b>Discount Code</b></td>
                                    <td>
                                        <input type="text" class="form-control" id="discount_code" placeholder="" >  
                                        <button type="button" class="btn btn-sm btn-success" id="discount_btn_apply">Apply Now</button>                                 
                                        <input type="hidden" class="form-control" id="discount_amount" placeholder="" >
                                     </td>
                                <?php } ?>                                
                            </tr>

                            <?php  if($_SESSION['login_type'] === "subscriber"){ ?>
                                <td><b>Discount Amount</b></td>
                                     <td><b class="discount_amunt">0</b></td> 
                                <?php } ?>

                            <tr>
                               <td><b>Total Amount</b></td>
                               <td><b class="total_amount_discount"><?= $total_amount;?></b></td> 
                            </tr>
                            <tr>
                               <td><b>Payment Method</b></td>                               
                               <td>
                               <?php  if($_SESSION['login_type'] === "admin"){ ?>
                                    <input type="radio" value="2" name="payment_method" checked> Cash<br>
                                    <input type="radio" value="3" name="payment_method"> Visa<br>
                                    <input type="radio" value="1" name="payment_method"> Knet<br>
                                <?php } ?> 
                               <?php  if($_SESSION['login_type'] === "subscriber"){ ?>
                                    <input type="radio" value="1" name="payment_method" checked> Knet<br>
                                <?php } ?>
                                   
                               </td> 
                            </tr>

                            <!-- date  -->
                           
                            <?php if($_SESSION['login_type'] === "admin"){ ?>
                                <tr>
                                    <td><b>Select Date</b></td>
                                    <td>
                                    <input type="date" name="date_of_purchase" class="form-control" value="<?php echo date('Y-m-d'); ?>"  max="<?php echo date("Y-m-d"); ?>">
                                    </td>
                                </tr>
                            <?php }else{ ?>
                                 <input type="hidden" name="date_of_purchase" class="form-control" value="">
                         <?php } ?>
                            <!-- date  -->

                                 <tr align="center">
                                    <td colspan="2"><button type="button" class="btn btn-sm btn-success buy_now_btn">Buy Now</button></td>
                                    <div class="buy_now_message"></div>
                                </tr>                        
                            </table>
                     </div>
                     <?php } } ?>
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

            // buy now
                $(document).on('click','.buy_now_btn',function(){
                    var discount_amount = $("#discount_amount").val(); 
                    var total_amount = '<?php echo $total_amount;?>'; 
                    if(parseInt(discount_amount) > parseInt(total_amount) ) {
                            $(".buy_now_message").html('<span class="text-danger">Discount amount is greater than total amount.</span>');
                            return false;
                    } 
                    if (confirm("Are You Sure Buy Now?") == true) {
                        $('.buy_now_btn').prop('disabled', true);
                        var buy_now = "buy_now"                              
                        var payment_method = $('input[name="payment_method"]:checked').val();  

                        var date_of_purchase = $('input[name="date_of_purchase"]').val(); 
                        $.ajax({    
                            type: "post",
                            url: "ajax/cart_buy_now.php", 
                            data:{buy_now:buy_now,discount_amount:discount_amount,payment_method:payment_method,total_amount:total_amount,date_of_purchase:date_of_purchase},                  
                            success: function(data){  
                                $('.buy_now_btn').prop('disabled', false);
                                $(".buy_now_message").html(data.message);                                
                                if(data.page_redirect == 'Yes' && data.created_by =='Admin'){
                                    $('.buy_now_btn').prop('disabled', true);
                                    setTimeout(function(){ 
                                        location.href="sell_product.php"; 
                                    }, 3000);
                                }
                                if(data.page_redirect == 'Yes'  && data.created_by =='Subscriber' && data.Knet_payment_redirect_url !=''){
                                    $('.buy_now_btn').prop('disabled', true);
                                    setTimeout(function(){ 
                                        //location.href="knet_order.php?order_id="+data.order_data; 
                                        location.href=data.Knet_payment_redirect_url; 
                                    }, 1500);
                                }
                               
                             }
                        });  
                    }
                });

            // buy now

            $(".qtyminus").on("click",function(){
                //var now = $(".qty").val();
                var now =  $(this).closest(".checkout_add_cart").find(".qty").val(); 
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    //$(".qty").val(now);
                    $(this).closest(".checkout_add_cart").find(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
               // var now = $(".qty").val();
                var now =  $(this).closest(".checkout_add_cart").find(".qty").val();
                if ($.isNumeric(now)){
                   // $(".qty").val(parseInt(now)+1);
                    $(this).closest(".checkout_add_cart").find(".qty").val(parseInt(now)+1);
                }
            });

            //discount code 
                $(document).on('click','#discount_btn_apply',function(){
                       $('#discount_amount').val('');
                       $('.discount_amunt').html(0);
                       var total_amount = '<?php echo $total_amount;?>';
                       var discount_code = $('#discount_code').val();
                       if(discount_code !=''){
                        $.ajax({    
                            type: "post",
                            url: "ajax/check_discount_code.php", 
                            data:{discount_code:discount_code},                  
                            success: function(data){  
                                $(".buy_now_message").html(data.message); 
                                $('#discount_amount').val(data.discount_price);                                
                                $('.discount_amunt').html(data.discount_price);                                
                                $('.total_amount_discount').html(total_amount - data.discount_price);                                
                                setTimeout(function(){ 
                                    $(".buy_now_message").html('');
                                }, 1500);                               
                             }
                        }); 
                       }
                });
                $(document).on('keyup','#discount_amount',function(){
                    var discount_value = $(this).val();
                    var total_amount = '<?php echo $total_amount;?>';
                    $('.total_amount_discount').html(total_amount - discount_value); 
                })
            //discount code 

        })
    </script>
</body>

</html>

