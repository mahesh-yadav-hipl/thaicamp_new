<?php include('head.php') ;
$id = $_SESSION['login_id'] ;
$admin_data = db_select_query("select * from admin where id = '$id' ")[0] ;
// print_r($admin_data);
// exit() ;
?>

<body>
   
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
                <h2>Profile</h2>
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
                                    <i class="fa fa-fw fa-user"></i> Admin Profile
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    <div class="terms">
                                        <ul class="nav nav-tabs nav-custom " role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#Info" aria-controls="Info" role="tab" data-toggle="tab">
                                                    <strong>Profile</strong>
                                                </a>
                                            </li>
                                            <!--<li role="presentation">-->
                                            <!--    <a href="#terms" aria-controls="terms" role="tab" data-toggle="tab">-->
                                            <!--        <strong>Terms & Conditions</strong>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                            <li role="presentation">
                                                <a href="#social" aria-controls="social" role="tab" data-toggle="tab">
                                                    <strong>Change Password</strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="Info">
                                            <div class="row">
                                              <form id="edit-admin-form"  method="post" action="ajax/update-data.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="admin" >
                                               <input type="hidden" name="id" value="<?=$admin_data['id']?>" >
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                                 <tr>
                                                                    <td>Username</td>
                                                                    <td>
                                                                        <input type="text" name="name" class="form-control" value="<?=$admin_data['name']?>" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>E-mail</td>
                                                                    <td>
                                                                        <input type="text" name="email" class="form-control" value="<?=$admin_data['email']?>" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td>
                                                                       <input type="text" name="mobile" class="form-control" value="<?=$admin_data['mobile']?>" >
                                                                    </td>
                                                                </tr>
                                                                
                                                            </table>
                                                              <div style="text-align: center;" class="">
                                                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;
                                                                <a href = "profile.php"  class="btn btn-danger">Cancel</a> &nbsp;
                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--<div role="tabpanel" class="tab-pane" id="terms">-->
                                        <!--    <div class="row">-->
                                        <!--        <div class="col-md-12">-->
                                        <!--            <div>-->
                                        <!--                <h4>Terms and Conditions</h4>-->
                                        <!--            </div>-->
                                        <!--            <form>-->
                                        <!--                <textarea class="summernote edi-css" placeholder="Place some text here"></textarea>-->
                                        <!--                <div class="form-actions pad-top">-->
                                        <!--                    <div class="">-->
                                        <!--                        <input type="submit" class="btn btn-primary" value="Add"> &nbsp;-->
                                        <!--                        <input type="button" class="btn btn-danger" value="Cancel"> &nbsp;-->
                                        <!--                        <input type="reset" class="btn btn-default reset-editable" value="Reset">-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </form>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div role="tabpanel" class="tab-pane" id="social">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                     <h4></h4> 
                                                    </div>
                                                    <form class="form-horizontal" id="change_password_form" name="change_password_form" action="ajax/change_password.php" method="post" onsubmit="return false;">
                                                       <input type="hidden" name="table" value="admin">
                                            
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="col-lg-2 control-label" for="fb-name">Current Password</label>
                                                                <div class="col-lg-6">
                                                                    <div class="input-group">
                                                            <input placeholder="Enter Current Password" class="form-control" id="current_password" type="password" name="current_password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-2 control-label" for="twitter">New Password</label>
                                                                <div class="col-lg-6">
                                                                    <div class="input-group">
                                                                       
                                                                        <input placeholder="Enter New Password" class="form-control"  id="new_password" type="password" name="new_password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-2 control-label" for="g-plus">Confirm Password</label>
                                                                <div class="col-lg-6">
                                                                    <div class="input-group">
                                                                        
                                                                        <input placeholder="Enter Confirm Password" class="form-control" id="confirm_password"  type="password" name="confirm_password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-9">
                                                                    <input type="submit" class="btn btn-primary" value="Update Password"> &nbsp;
                                                                     <a href = "profile.php"  class="btn btn-danger">Cancel</a> &nbsp;
                                                          
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
<style>
    .nav-tabs>li {
    font-family: 'Roboto', sans-serif;
    margin-top: 8px;
}
.table>tbody>tr>td {
    border: none;
}
.table-bordered {
    border: none;
}
</style>

</html>

<script>
 
   $(document).ready(function(){  
 $("#edit-admin-form").validate({
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
    
 });
  
  
</script>

<script type="text/javascript">

        const table_name='admin';
    
     $('#change_password_form').validate({
       
            rules:{
               current_password:{
                  required:true,
                  //minlength:5,
               },
               new_password:{
                  required:true,
                  minlength:8,
               },
               confirm_password:{
                  required:true,
                  equalTo:"#new_password",
               },
            },
            messages:{
               current_password:{
                  required:"Enter Password",
                  //minlength: "Enter atleast 5 digits",

               },
               new_password:{
                  required:"Enter Password",
                  minlength: "Password Must Be Of Atleast 8 Digits",
               },
               confirm_password:{
                  required:"Enter Password",
                  equalTo:"Confirm Password Doesn't Match With New Password",
               },
            },
       
            errorElement : 'div',
            submitHandler:function(form)
            {
                // startLoader($(form).find('.btn-loader'), $(form));
                var data = $('#change_password_form').serialize();

                $.ajax({
                    url:form.action,
                    type:form.method,
                    data:data+"&table="+table_name,
                    dataType:"json",
                    success:function(response)
                    {
     

                    if(response.result){
                        $(form).trigger('reset');
                        
                        toastr.success(response.message);
                        swal.close();
                        
                            setTimeout(function(){ location.href='profile.php'; },1500);
                      
                    }else{
                        toastr.error(response.message);
                        //setTimeout(function(){ location.href='index.php'; },1500);
                    }                      
                    },
                    error:function(response){
                        toastr.error(response.message);
            //console.log(response.message);
                    },
                }).then(function(){
                    // endLoader($(form).find('.btn-loader'),$(form));
                });
        
        //console.log(data);

            }
        });

</script>




