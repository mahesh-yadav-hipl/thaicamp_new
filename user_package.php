<?php include('head.php') ;
$id = $_GET['id'] ;
 $user = db_select_query("SELECT * , CONCAT('".URL."admin/uploaded/users/', image) AS image FROM users where id = '$id'")[0];
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
                                    <i class="fa fa-fw fa-file-text-o"></i> View Subscriber Packages
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                 <h4>Current Packages</h4>
            <div class="container">
    <div class="pricing-table pricing-three-column row">
        <?php 
        
          $pck = explode(",",$user['packagesid']);
           $expiry_dates = explode(",",$user['expiry_dates']);
           $hold_dates = explode(",",$user['hold_dates']);
           $hold_status = explode(",",$user['hold_status']);
          foreach($pck as $key => $pck_id) {
                        $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                        $pck_name = $qry['name'] ;
                         $ser = explode(",",$qry['services']); 
                        $countfiles = count($expiry_dates);
                         $exp=$expiry_dates[$key] ;
                          $hld_date = $hold_dates[$key] ;
                           $hld_status = $hold_status[$key] ;
                         $today_date = date('Y-m-d'); 
           $currentDateTime = date('Y-m-d H:i:s');
          $newDateTime = date('h:i A', strtotime($currentDateTime)); ?>
        <div class="plan col-md-3">
          <div class="plan-name-silver">
            <span>Package ID - <?php echo $qry['package_id']?></span></br>
            <h2 style="line-height: 35px;"><?= $pck_name ?></h2>
            <span><?php echo $qry['price']?> KD / <?php echo $qry['duration'] ?> Days</span>
            <p><span class="label label-primary">Expiration Date - <?php echo date("d-m-Y" ,strtotime($exp))  ?></span></p>
          </div>
          <h6>
          Package Description <i style="cursor:pointer;" class="fa fa-info" onclick="info(<?php echo $pck_id ?>)"></i>
          </h6>
          <div style="display:none;" class="show_desc-<?php echo $pck_id ?>">
             <?php echo $qry['description']  ?>
          </div>
          
          <h6 class="text-info">Services Available</h6>
          
          <ul>
               <?php foreach($ser as $s) { 
              $srv = db_select_query("select * from services where name = '$s' ")[0];
               ?>
            <li class="plan-feature"><a href="services.php?id=<?php echo $srv['id'] ?>"><?php echo $s; ?></a></li>
           	<?php } ?>
            <?php if(($user['package_class'] != '0') && ($today_date <= $exp )){
           if($hld_status == "Active") { 
          ?>
          <li class="plan-feature"><a class="btn btn-warning btn-plan-select" onclick="hold_package(<?php echo $pck_id ?> , <?php echo $user['id'] ?> )"><i class="icon-ok"></i> Hold</a></li>
           <?php } else { ?>
            <li class="plan-feature"><a class="btn btn-primary btn-plan-select" onclick="active_package(<?php echo $pck_id ?> , <?php echo $user['id'] ?> , '<?php echo $hld_date  ?>' , '<?php echo $hld_status  ?>' )"><i class="icon-ok"></i> Active</a></li>
             <?php } 
          } else { ?>
           <li class="plan-feature"><a class="btn btn-success btn-plan-select" onclick="renew_package(<?php echo $user['id'] ?> , <?php echo $pck_id ?> )"><i class="icon-ok"></i> Renew</a></li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
        
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
        
        
        function info(pcid)
      {
        $('.show_desc-'+pcid).toggle() ;  
      }
        
  
  
</script>

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
</style>