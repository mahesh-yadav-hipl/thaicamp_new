
<?php include('head.php') ;
$id = $_GET['id'] ;
 $user = db_select_query("SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where id = '$id'")[0];
 $get_all_packages = db_select_query("SELECT * FROM packages ORDER BY id DESC") ; 
 $get_all_classes = db_select_query("SELECT * FROM classes ORDER BY id DESC") ;
 $pck_id = $user['packagesid'] ;
 $pck_start_date = date("d-m-Y" , strtotime($user['pck_start_date'])) ;
 
  $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
  $drt = $qry['duration'] ;
                        $pck_name = $qry['name'] ;
                        $pckid = $qry['id'] ;
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
<link type="text/css" href="css/new_custom.css" rel="stylesheet">


<style>
    .swal2-modal
    {
        top:0px!important;
        left:0px!important;
    }
    .n_tabledata .panel{
        border: none;
        min-height: 68px;
        border-radius: 5px !important;
    }
    .n_tabledata .panel > .panel-heading{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        background-color: #289ae7;
        padding: 15px;
        border-radius: 5px !important;
        min-height: 68px; 
    }
    .n_tabledata .panel > .panel-heading .panel-title {
        margin: 0;
        padding: 0;
        color: #fff;
        font-weight: 600;
        font-size: 17px;
    }
    .n_tabledata .panel > .panel-heading span {
        display: flex;
        align-items: center;
        margin-top: 0;
    }
    .n_tabledata .panel > .panel-heading span .glyphicon {
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background-color: #fbfbfb;
        color: #289ae7;
        margin-left: 10px;
        top: inherit;
        border-radius: 5px !important;
    }
    .view_user_tabtop .table td{
        border-top: none;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        font-family: 'Roboto', sans-serif;
        background-color: #ebeff7;
    }
    .view_user_tabtop .table td:first-child{
        border-right: 1px solid #ddd;
        font-weight: 600;
    }
    .view_user_tabtop .table td p{
        margin-bottom: 0;
    }
    .view_user_tabtop .table td p + p{
        margin-top: 8px;
    }
    .view_user_tabtop .multi-btns a,
    .view_user_tabtop .multi-btns button{
        color: #fff;
        font-family: 'Roboto', sans-serif;
        border: none;
        line-height: 19px;
        padding: 8px 12px;
        border-radius: 5px !important;
        margin-bottom: 8px;
    }
    .add-package-bottom{
        margin-top: 20px;
    }
    @media screen and (min-width: 768px) and (max-width: 1300px){
        .n_tabledata .table-responsive{
            border: none;
            padding-top: 20px;
        }
        .add-package-bottom span{
            display: block;
            padding-bottom: 15px;
        }
    }
    @media screen and (max-width: 767px){
        .n_tabledata .table-responsive{
            border: none;
            padding-top: 20px;
        }
        .add-package-bottom span{
            display: block;
            padding-bottom: 15px;
        }
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
        <aside class="right-side right-padding n_tabledata">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2>Subscribers</h2>
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
                                    <i class="fa fa-fw fa-user"></i> Update Current Package
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
                                    <div class="tab-content view_user_tabtop">
                                        <div role="tabpanel" class="tab-pane active" id="Info">
                                            <div class="row">
                                              <form id="edit-user-form"  method="post" action="ajax/edit_user_package.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                                <input type="hidden" name="table" value="users" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                
                                              
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table " id="users">
                                                             
                                                                <tr>
                                                                    <td>Package</td>
                                                                    <td>
                                                                        <!--<a href ="user_package.php?id=<?php echo $user['id'] ?>"><button type="button" class="btn btn-warning">View</button></a-->
                                                                    <select name= "packagesid" class="form-control">
                                                                    <?php if($get_all_packages){ 
                                                                    foreach($get_all_packages as $package) { ?>
                                                                    <option <?php if($package['id'] == $pckid ){ echo 'selected'; }?> value="<?php echo $package['id'] ?>"><?php echo $package['name'] ?></option>
                                                                <?php } 
                                                                    } ?>
                                                            
                                                                    </select>
                                                                     
                                                                    </td>
                                                                </tr>
                                                                
                                                                 <tr>
                                                                    <td>Package Start Date</td>
                                                                    <td>
                                                                     <input name="pck_start_date" type = "date" class="form-control" value="<?php echo $user['pck_start_date'] ?>" >
                                                                     
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>Classes</td>
                                                                    <td>
                                                                  <!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Add</button> -->
                                                                  
                                                                    
                                                                    <?php if($get_all_classes) {
         foreach($get_all_classes as $k =>$v){
          $sr = explode(",",$user['class_id']);
         ?>
                                                                     <input type="checkbox" class="class_id" value="<?=$v['id']?>" name = "class_id[]" <?php if(in_array($v['id'], $sr)){ echo 'checked="checked"'; }?>> <?=$v['name']?></br>
                                                        
                                                                    <?php } 
                                                                    } ?>
                                                                  
                                                                    </td>
                                                                    <tr>
                                                                        <td>Price</td>
                                                                        <td><input type="number" value="<?= $user['after_discount_price'] ?>" name="package_price" class="form-control"></td>
                                                                    </tr>
                                                                </tr>
                                                              
                                                               
                                                            </table>
                                                            
                                                           
                                                            <div  class="multi-btns" style="margin-top:5px">
                                                               
                                                                <button type="submit" class="btn btn-warning">Update</button> &nbsp;
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


// <script> 
// $(document).ready(function () {
// $('input[type=checkbox]:checked').each(function () {
//  $(this).attr("disabled" , "disabled"); 
// });
// });   
// </script>



<script>
 
   $(document).ready(function(){ 
       $('#sel_pack_dt').css('display' , 'none') ;
       $('#sel_pck').css('display' , 'none') ;
       
       $('.edit_pck').click(function(){
         $('#sel_pack_dt').toggle() ;
       $('#sel_pck').toggle() ;   
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
                     }, 3000);                      
               }else{
                  toastr.info(json.message);
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
        
  
  
</script>

