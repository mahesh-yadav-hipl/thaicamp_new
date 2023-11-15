
<?php include('head.php') ;
$id = $_GET['id'] ;
if($id == '' || $id != $_SESSION['login_id'] ){
    die;
}
 $user = db_select_query("SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where id = '$id'")[0];
 $get_all_packages = db_select_query("SELECT * FROM packages ORDER BY id DESC") ; 
 $get_all_classes = db_select_query("SELECT * FROM classes ORDER BY id DESC") ;
 $get_all_payment_methods = db_select_query("SELECT * FROM payment_methods ORDER BY id DESC") ;
  $get_all_discount_codes = db_select_query("SELECT * FROM discount_code ORDER BY id DESC") ;
 $pck_id = $user['packagesid'] ;
 $pck_start_date = date("d-m-Y" , strtotime($user['pck_start_date'])) ;
 
  $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
  $drt = $qry['duration'] ;
                        $pck_name = $qry['name'] ;
                         $exp= $user['expiry_dates'];
                          $hld_date = $user['hold_dates'] ;
                           $hld_status = $user['hold_status'] ;
                         
                        
           $currentDateTime = date('Y-m-d H:i:s');
          $newDateTime = date('h:i A', strtotime($currentDateTime));
?>

<style>

input[type="checkbox"]
{
    cursor:pointer;
}
.action-button
{
    float:right;
}
</style>

<style>
    .swal2-modal
    {
        top:0px!important;
        left:0px!important;
    }
</style>
<body>
   
    <!-- header logo: style can be found in header-->
    <?php include('header.php')
?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php') ;
?>
        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2>Packages</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="admin_clubinfo.html" class="activated">Club Info</a>
                    </li>
                </ol>
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
                                    <i class="fa fa-fw fa-user"></i> Buy New Package
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
                                               <form id="edit-user-form"  method="post" action="ajax/upcoming_packages_generate.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="upcoming_packages_generate" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                <input type="hidden" name="cash_flow_created_by" value="Subscriber" >
                                                
                                                
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                             
                                                                <tr>
                                                                    <td>Package</td>
                                                                    <td>
                                                                     <select class="form-control package" name="packagesid" id="packagesid">
                                                                    <option value="">Select Package</option>
                                                                    <?php if($get_all_packages) {
                                                                        foreach($get_all_packages as $k =>$v){ ?>
                                                                         <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                                    <?php } 
                                                                    } ?>
                                                                   </select>   
                                                                      </td>
                                                                </tr> 
                                                                
                                                                 <tr>
                                                                    <td>Start Date</td>
                                                                    <td>
                                                                     <input type="date" name="pck_start_date" id="pck_start_date" class="form-control" ></br>   
                                                                      </td>
                                                                </tr> 
                                                                         
                                                                   
                                                                   
                                                                     
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>Classes</td>
                                                                    <td>
                                                                  <!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Add</button> -->
                                                                  
                                                                    
                                                                    <?php if($get_all_classes) {
         foreach($get_all_classes as $k =>$v){
         
         ?>
                                                                     <input type="checkbox" class="class_id" value="<?=$v['id']?>" name = "class_id[]"> <?=$v['name']?></br>
                                                        
                                                                    <?php } 
                                                                    } ?>
                                                                  
                                                                    </td>
                                                                </tr>
                                                                
                                                                
                                                                 <tr>
                                                                    <td>Payment Method</td>
                                                                    <td>
                                                                
                                                                    
                                                                     <input type="radio"  value="1" name = "payment_method" checked> Knet</br>
                                                        
                                                                  
                                                                    </td>
                                                                </tr>
                                                              
                                                               
                                                               
                                                            </table>
                                                           
                                                               <div class="">
                                                            <p><b>Price : &nbsp;&nbsp;<input id="show_pck_price" type = "text">
                                                            &nbsp;&nbsp; Discount Code : 
                                                            &nbsp;&nbsp;                                                                
                                                            <input type="text" id="discount_code" placeholder="" name="discount_code">  
                                                            <button type="button" class="btn btn-sm btn-success" id="discount_btn_apply">Apply Now</button>                                 
                                                            <input type="hidden" id="discount_amount" placeholder="" >
                                                            &nbsp;&nbsp;  Total : &nbsp;<input id="after_discount_price" name="after_discount_price" type = "text" > </b></p>
                                                           
                                                                <div class="discount_message"></div>
                                                            </div>
                                                            
                                                           
                                                            <div style="text-align: center;margin-top: 30px;" class="">
                                                                
                                                               <button type="submit" class="btn btn-warning button_submit">Submit</button> &nbsp;
                                                                <a href = "view_user.php?id=<?php echo $user['id'] ?>"  class="btn btn-warning">Cancel</a> &nbsp;
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





<script>
 
   $(document).ready(function(){ 
       $('#sel_pack_dt').css('display' , 'none') ;
       $('#sel_pck').css('display' , 'none') ;
       
       $('.edit_pck').click(function(){
         $('#sel_pack_dt').toggle() ;
       $('#sel_pck').toggle() ;   
       });
       
       
       $('.package').change(function(){
       var pck_id = $(this).val() ;    
       
           $.ajax({
                    url:'ajax/get_package_price.php',
                    type:'POST',
                    data:'pck_id='+pck_id,
                    success: function(response){
                        var json = $.parseJSON(response);
                        var package_price = json.package_price ;
                          if(json.result)
                          {
                            $('#show_pck_price').attr('value' , package_price) ;
                            //$('#after_discount_price').attr('value' , package_price) ;
                            $('#after_discount_price').val(package_price);
                            $('#after_discount_price').val(package_price);
                            $('#discount_code').val('');
                          }
                          else
                          {
                             console.log("something went wrong") ;
                          }
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }) ;   
       
        
    });
    
      $('.discount_code').change(function(){
       var code_id = $(this).val() ;
       var pck_price = $('#show_pck_price').val() ;
       
       
           $.ajax({
                    url:'ajax/get_discount_price.php',
                    type:'POST',
                    data:{'code_id':code_id,'pck_price':pck_price},
                    success: function(response){
                        var json = $.parseJSON(response);
                        var total_price = json.total_price ;
                          if(json.result)
                          {
                            $('#after_discount_price').attr('value' , total_price) ;
                          }
                          else
                          {
                             console.log("something went wrong") ;
                          }
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }) ;   
       
        
    });
       
      $('.class_id').click(function(){
       var pid = $(this).val() ;
       if($(this).prop('checked') == true)
       {
           $.ajax({
                    url:'ajax/check_sub_capacity.php',
                    type:'POST',
                    data:'pid='+pid,
                    success: function(response){
                        var json = $.parseJSON(response);
                        var cnt = json.cnt ;
                          if(json.result)
                          {
                            swal({
                          title: "",
                          text: "Active members in this class " +cnt+ ", press OK to continue",
                          type: ""
                     })  
                          }
                          else
                          {
                              console.log("Not active") ;
                          }
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }) ;   
       }
        
    });
    
 $("#edit-user-form").validate({
         rules:{
             
      packagesid:{
            required:true,
    
        },
     class_id:{
            required:true,
           
        }, 
        
       
       
        
      

},
messages:{
  packagesid:{
            required:"Select Package",
    
        },
     class_id:{
            required:"Choose Class",
            
        },  
        
         
      

         
    
  },
         submitHandler: async (form, event)=>{
            event.preventDefault();
            $('.button_submit').prop('disabled', true);
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
                     if(json.page_redirect == 'Yes'){
                            setTimeout(function(){ 
                               // location.href="knet_package.php?order_id="+json.order_data; 
                                location.href=json.Knet_payment_redirect_url; 
                            }, 1500);
                        }
                    //  var id = json.uid ;
                    //  setTimeout(function(){ 
                    //     location.href="view_user.php?id="+id; 
                    //  }, 3000);                      
               }else{
                $('.button_submit').prop('disabled', false);
                  toastr.info(json.message);
               }    
            }catch(err) {              
               toastr.error(err);
            }
             
            //table.draw();
           // table.page(table.page.info().page).draw(false);;
            
         }  
      }); 
    
 });
 
 
 function hold_package(packageid , userid)
        {
           var package_id = packageid ;
         var user_id = userid ;
        
      
       
                $.ajax({
                    url:'ajax/hold_subscription.php',
                    type:'POST',
                    data:{'package_id':package_id,'user_id':user_id},
                    dataType:'json',
                    success: function(response){
                        try {
                      if(response.result)
                      {
                        toastr.success(response.message);                  
                      setTimeout(function(){ location.href=''; },1500);     
                      }
                      else
                      {
                         toastr.error(response.message);      
                      }
                        }catch(err) {
              
               toastr.error(err);
            }    
             
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                })   
        }
        
        
        function active_package(packageid , userid , hold_date , hold_status)
        {
            var package_id = packageid ;
       var user_id = userid ;
       var hold_date =  hold_date ;
       var hold_status = hold_status ;
        
      
       
                $.ajax({
                    url:'ajax/active_subscription.php',
                    type:'POST',
                    data:{'package_id':package_id,'user_id':user_id,'hold_date':hold_date,'hold_status':hold_status},
                    dataType:'json',
                    success: function(response){
                        try {
                      if(response.result)
                      {
                        toastr.success(response.message);                  
                      setTimeout(function(){ location.href=''; },1500);     
                      }
                      else
                      {
                         toastr.error(response.message);      
                      }
                        }catch(err) {
              
               toastr.error(err);
            }    
             
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                })  
        }
        
        function renew_package(id)
        {
           var id = id ;
       var pck_id= $('#packagesid').val() ;
       var pck_start_date= $('#pck_start_date').val() ;
   

            $.ajax({
                    url:'ajax/renew_package.php',
                    type:'POST',
                    data:{'id':id,'pck_id':pck_id,'pck_start_date':pck_start_date},
                    dataType:'json',
                    success: function(response){
                          
                        toastr.success(response.message);                  
                    setTimeout(function(){ location.href=''; },1500); 
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }).then(function(){
                    table.page(table.page.info().page).draw(false);
                });  
        }
        
   //discount code 
    $(document).ready(function(){
        $(document).on('click','#discount_btn_apply',function(){
                    $('#discount_amount').val('');
                    $('.discount_amunt').html(0);
                    var total_amount = $('#show_pck_price').val();
                    var discount_code = $('#discount_code').val();
                    if(discount_code !='' && total_amount !=''){
                        $.ajax({    
                            type: "post",
                            url: "ajax/check_discount_code.php", 
                            data:{discount_code:discount_code},                  
                            success: function(data){  
                                $(".discount_message").html(data.message); 
                                $('#discount_amount').val(data.discount_price);                                
                                $('.discount_amunt').html(data.discount_price);                                
                                $('#after_discount_price').val(total_amount - data.discount_price);                                
                                setTimeout(function(){ 
                                    $(".discount_message").html('');
                                }, 1500);                               
                            }
                        }); 
                    }
                });
            });
        //discount code 
  
</script>

