<?php include('head.php') ;
$get_all_packages = db_select_query("SELECT * FROM packages ORDER BY id DESC") ; 
?>

<!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
-->
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
<body style="padding-top: 0px!important;">
   
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
                <h2>Subscriber Packages</h2>
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
                                    <i class="fa fa-fw fa-file-text-o"></i> Add Subscriber Packages
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                          
    <div class="pricing-table pricing-three-column row">
       <?php if($get_all_packages) {
         foreach($get_all_packages as $k =>$v){ 
            $ser1 = explode(",",$v['services']); ?>
        <div class="plan col-sm-4 col-lg-4">
          <div class="plan-name-silver">
            <h2 style="line-height: 35px;"><?= $v['name'] ?></h2>
            <span><?php echo $v['price']?> KD / <?php echo $v['duration'] ?> Days</span>
          </div>
          <h6 class="text-info">Services Available</h6>
          
          <ul>
            <?php foreach($ser1 as $s1) { ?>
            <li class="plan-feature"><?php echo $s1; ?></li>
           	<?php } ?>
            <li class="plan-feature"><a class="btn btn-success btn-plan-select"><input type="checkbox" value="<?=$v['id']?>" name = "packagesid[]"> Select Package</a></li>
          
          </ul>
        </div>
        <?php }
        } ?>
        
    </div>
       
       
    </div>
     <div style="text-align: center;" class="">
    <button type="submit" class="btn btn-primary">Add Package</button>
   
     </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- col-md-6 -->
                <!--row -->
                <!--row ends-->
            </div>
            </aside>
            </div>
            <!-- /.content -->
           
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
$(document).ready(function () {
$('input[type=checkbox]:checked').each(function () {
 $(this).attr("disabled" , "disabled"); 
});
});   
</script>



<script>
 
   $(document).ready(function(){  
 $("#edit-user-package-form").validate({
         rules:{
      
        
      

},
messages:{
 

         
    
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
                     }, 1500);                      
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
        
        function renew_package(id , pck_id)
        {
           var id = id ;
       var pck_id= pck_id ;
   

            $.ajax({
                    url:'ajax/renew_package.php',
                    type:'POST',
                    data:{'id':id,'pck_id':pck_id},
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
        
  
  
</script>

<style>
    body{padding-top:20px}

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
  background-color: #C0C0C0;
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
 
.pricing-three-column {
  margin: 0 auto;
  width: 80%;
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
</style>