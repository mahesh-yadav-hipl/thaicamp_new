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
                         $exp= $user['expiry_dates'];
                          $hld_date = $user['hold_dates'] ;
                           $hld_status = $user['hold_status'] ;
                         
                        
           $currentDateTime = date('Y-m-d H:i:s');
          $newDateTime = date('h:i A', strtotime($currentDateTime));
?>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
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
    @media screen and (max-width: 767px){
        .n_tabledata .table-responsive{
            border: none;
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
                                    <i class="fa fa-fw fa-user"></i> Edit Subscriber
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
                                              <form id="edit-user-form"  method="post" action="ajax/update-data.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="users" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                
                                                <div class="col-md-3 col-sm-4 text-center">
                                                    <div class="form-group pad-top">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?=$user['image']?>"  alt="profile" style="border-radius:50%;width: 150px;height: 150px;">
                                                            </div>
                                                           
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table" id="users">
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <input type="text" name="name" class="form-control" value="<?=$user['name']?>" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>E-mail</td>
                                                                    <td>
                                                                        <input type="text" name="email" class="form-control" value="<?=$user['email']?>">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password</td>
                                                                    <td>
                                                                        <span class="text-warning">Enter password (If You want to change)</span>
                                                                        <input type="password" name="password" class="form-control"  autocomplete="new-password">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td>
                                                                       <input type="text" name="mobile" class="form-control" value="<?=$user['mobile']?>" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DOB</td>
                                                                    <td>
                                                                       <input type="date" name="date_of_birth" class="form-control" value="<?=$user['date_of_birth']?>" >
                                                                    </td>
                                                                </tr>
                                                               
                                                                <tr>
                                                                    <td>Gender</td>
                                                                    <td>
                                                                       <select class="form-control" name="gender">
                                                                        <option value="">Select Gender</option>  
                                                                        <option <?php if($user['gender']=="Male") echo 'selected';?> value="Male">Male</option>
                                                                        <option <?php if($user['gender']=="Female") echo 'selected';?> value="Female">Female</option>
                                                                       </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Title</td>
                                                                    <td>
                                                                       <input type="text" name="job_title" class="form-control" value="<?=$user['job_title']?>">
                                                                    </td>
                                                                </tr>
                                                                  
                                                                <tr>
                                                                    <td>Upload Image</td>
                                                                    <td>
                                                                      <input type="file" name="image" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                
                                                         
                                                            </table>
                                                            
                                                           
                                                            <div class="multi-btns" style="margin-top: 30px;">
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


<script> 
// $(document).ready(function () {
// $('input[type=checkbox]:checked').each(function () {
//  $(this).attr("disabled" , "disabled"); 
// });
// });   
</script>



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
                          if(json.result)
                          {
                            swal({
                          title: "",
                          text: "Active members in this class now , press OK to continue",
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
            name:{
                required:true,
        
            },
            email:{
                required:true,
                email:true, 
            },      
            mobile:{
                number:true,
                required:true,
            },
            gender:{
                required:true,
                
            },
            job_title:{
                required:true,
                
            },
            date_of_birth:{
                required:true,
            
            },
        },
        messages:{
            name:{
                required:"Enter Name",
            },
            email:{
                required:"Enter Email",
                email:"Enter Valid Email",
            },
            mobile:{
                number:"Mobile Must Contain Only Digits",
                required:"Enter Mobile",
            }, 
            gender:{
                required:"Select Gender",
            },
            job_title:{
                required:"Enter Job Title",
            },
            date_of_birth:{
                required:"Select DOB",
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

