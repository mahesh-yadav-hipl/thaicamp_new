<?php include('head.php') ;
$id=!empty($_GET['id'])?$_GET['id']:"" ;
$rand = rand(99999 , 10000) ;
$user = db_select_query("SELECT * FROM users where id = '$id'")[0] ; 
$pck = explode(",",$user['packagesid']);
$tdt = date("j M, Y");

?>

<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
 
}
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.panel-default
{
    border-color: #f5f5f5;
}

.panel-default>.panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #f5f5f5;
}
</style>
<body>
    <div class="se-pre-con"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php')
?>        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Invoice</h2>
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
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <!--<h4 class="panel-title">-->
                                <!--    <i class="fa fa-fw fa-file-text-o"></i> Print Invoice-->
                                <!--</h4>-->
                                <!--<span class="pull-right">-->
                                <!--    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>-->
                                <!--    <i class="glyphicon glyphicon-remove removepanel"></i>-->
                                <!--</span>-->
                            </div>
                            <div class="panel-body table-responsive">
                             
    <div class="row">
        <div class="col-xs-12">
             <h1 style="display: block;margin-left:auto;margin-right:auto;text-align:center;color:#fc7070;">THAICAMP</h1>
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Invoice #<?=$rand;?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?=$user['name']?><br>
    					<?=$user['email']?><br>
    					Mobile - <?=$user['mobile']?><br>
    				</address>
    			</div>
    			<!--<div class="col-xs-6 text-right">-->
    			<!--	<address>-->
       <!-- 			<strong>Shipped To:</strong><br>-->
    			<!--		Jane Smith<br>-->
    			<!--		1234 Main<br>-->
    			<!--		Apt. 4B<br>-->
    			<!--		Springfield, ST 54321-->
    			<!--	</address>-->
    			<!--</div>-->
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Date:</strong><br>
    					<?= $tdt ?><br>
    				
    				</address>
    			</div>
    			<!--<div class="col-xs-6 text-right">-->
    			<!--	<address>-->
    			<!--		<strong>Order Date:</strong><br>-->
    			<!--		March 7, 2014<br><br>-->
    			<!--	</address>-->
    			<!--</div>-->
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Package summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>ID</strong></td>
        							<td class="text-center"><strong>Name</strong></td>
        							<td class="text-center"><strong>Duration</strong></td>
        							<td class="text-center"><strong>Description</strong></td>
        							<td class="text-center"><strong>Services</strong></td>
        							<td class="text-center"><strong>Number of classes</strong></td>
        							<td class="text-right"><strong>Discount Code</strong></td>
        							<td class="text-right"><strong>Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php
    							$sub_total = 0 ;
    							$total =  0 ;
    							foreach($pck as $p) {
    							$qry = db_select_query("select * from packages where id = '$p'")[0];
    							if(!empty($user['discount_code']) && !empty($user['after_discount_price']))
    							{
    							  $prc =  $user['after_discount_price']  ;  
    							   $dscnt_qry = db_select_query("select * from discount_code where id = '{$user['discount_code']}' ")[0] ;
                                   $discnt_code = $dscnt_qry['code'] ;
    							}
    							else
    							{
    							  $prc =  $qry['price'] ;
    							  
                                 $discnt_code = "No Discount" ;
    							}
    							?>
    							<tr>
    							   <?php $sub_total = $prc ; ?>
    							   	<td ><?php echo $qry['package_id']  ?></td>
    								<td class="text-center"><?php echo $qry['name']  ?></td>
    								<td class="text-center"><?php echo $qry['duration']  ?> Days</td>
    								<td class="text-center"><?php echo $qry['description']  ?></td>
    								<td class="text-center"><?php echo $qry['services']  ?></td>
    								<td class="text-center"><?php echo $qry['pck_class']  ?></td>
    								<td class="text-right"><?php echo $discnt_code ;  ?></td>
    								<td class="text-right"><?php echo $prc ;  ?> KD</td>
    							</tr>
    							
    							<?php
    							$total+=$sub_total ;
    							} ?>
                               
    							<tr>
    								
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Total</strong></td>
    								<td class="thick-line text-right"><?=$total?> KD</td>
    							</tr>
    						
    							<!--<tr>-->
    							<!--	<td class="no-line"></td>-->
    							<!--	<td class="no-line"></td>-->
    							<!--	<td class="no-line text-center"><strong>Total</strong></td>-->
    							<!--	<td class="no-line text-right"><?=$total?> KD</td>-->
    							<!--</tr>-->
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
           
                            </div>
                             <div class ="text-center" style="margin-bottom:15px">
           <a href="download_invoice.php?id=<?php echo $id ; ?>&rand=<?php echo $rand; ?>" style="background: #007bff!important;" class="btn btn-info">Click here to download</a>
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
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/custom_js/app.js" type="text/javascript"></script>
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/rooms.js" type="text/javascript"></script>
    <!-- end of page level js -->
</body>


</html>

<script>
 
   $(document).ready(function(){  
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
                       setTimeout(function(){ location.href='services.php'; },1500); 
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
    
 });
  
  
</script>
