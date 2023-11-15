<?php include('head.php') ;
$id = $_SESSION['login_id'] ;

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
          
$get_all_old_packages = db_select_query("select * from old_packages where user_id = '$id' ") ;



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
                <h2>Profile</h2>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        <div class="panel">
                            <div class="panel-heading bg-primary">
                                <?php if($_SESSION['login_type'] == "employee"){ ?> 
                                    <h4 class="panel-title">
                                        <i class="fa fa-fw fa-user"></i> Employee Profile
                                    </h4>
                                <?php }else{?>
                                    <h4 class="panel-title">
                                        <i class="fa fa-fw fa-user"></i> Subscriber Profile
                                    </h4>
                                <?php }?>
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
                                              	<form id="edit-user-form"  method="post" action="ajax/update-data.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               	<input type="hidden" name="table" value="users" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                
                                                <div class="col-md-3 col-sm-4 text-center">
                                                    <div class="form-group pad-top">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?=$user['image']?>" width="200px" height="150px" alt="profile">
                                                            </div>
                                                           
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <p><?=$user['name']?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>E-mail</td>
                                                                    <td>
                                                                        <p><?=$user['email']?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td>
                                                                       <p><?=$user['mobile']?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DOB</td>
                                                                    <td>
                                                                       <?=date("d/m/Y" , strtotime($user['date_of_birth']))?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender</td>
                                                                    <td>
                                                                      <p><?=$user['gender']?></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Title</td>
                                                                    <td>
                                                                      <p><?=$user['job_title']?></p>
                                                                    </td>
                                                                </tr>
                                                                
                                                                  
                                                                <!--<tr>-->
                                                                <!--    <td>Upload Image</td>-->
                                                                <!--    <td>-->
                                                                <!--      <input type="file" name="image" class="form-control" >-->
                                                                <!--    </td>-->
                                                                <!--</tr>-->
                                                                
                                                                <tr>
                                                                    <td>Package</td>
                                                                    <td>
                                                                        <!--<a href ="user_package.php?id=<?php echo $user['id'] ?>"><button type="button" class="btn btn-warning">View</button></a-->
                                                                        <p>Name - <?= $pck_name ?></p>
                                                                        <p>Start Date - <?= $pck_start_date ?></p>
                                                                        <p>End Date - <?= date("d-m-Y" , strtotime($exp)) ; ?></p>
                                                                        <p>Duration - <?= $drt ?> Days</p>
                                                                     
                                                                        <div class="row" id="sel_pck">
                                                                   
                                                                            <div class="col-md-4">
                                                                                Select Package  
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <select class="form-control" name="packagesid" id="packagesid">
                                                                                    <option value="">Select Package</option>
                                                                                    <?php 
                                                                                        if($get_all_packages) {
                                                                                        foreach($get_all_packages as $k =>$v){ 
                                                                                    ?>
                                                                                    <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                                                    <?php } 
                                                                                    } ?>
                                                                                </select></br>   
                                                                            </div>
                                                                         
                                                                        </div>
                                                                    
                                                                        <div class="row" id="sel_pack_dt">
                                                                            <div class="col-md-4">
                                                                                Package Start Date  
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="date" name="pck_start_date" id="pck_start_date" class="form-control" ></br>   
                                                                            </div>
                                                                            <div style="text-align:center;">
                                                                                <a class="btn btn-primary btn-plan-select" onclick="renew_package(<?php echo $user['id'] ?>)">Add</a> &nbsp;
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>Classes</td>
                                                                    <td>
                                                                        <!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Add</button> -->
                                                                  
                                                                    
                                                                        <?php if($get_all_classes) {
                                                                            foreach($get_all_classes as $k =>$v){
                                                                                $sr = explode(",",$user['class_id']);
                                                                                if(in_array($v['id'], $sr)){ 
                                                                        ?>
                                                                        <p><?=$v['name']?></p>
                                                            
                                                                        <?php 
                                                                        }
                                                                        } 
                                                                        } ?>
                                                                  
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
	                                    	<h2>ALL OLD PACKAGES</h2></br>
	                                    	<table class="table table-bordered" id="fitness-table">
	                                    	<thead>
	                                        <tr>
	                                             <th>Sr No.</th>
	                                             <th>Package Name</th>
	                                            <th>Package Price</th>
	                                            <th>Package Duration</th>
	                                            <th>Package Start Date</th>
	                                            <th>Package End Date</th>
	                                            <th>Classes Count</th>
	                                            <th>Date Added</th>
	                                            
	                                           
	                                        </tr>
	                                    	</thead>
	                                    	<tbody>
	                                         <?php 
		                                     if($get_all_old_packages) {
		                                     $i = 1 ;
		                                    foreach($get_all_old_packages as $k =>$v){  ?>
		                                        <tr>
		                                            <td><?=$i?></td>
		                                            <td><?=$v['name']?></td>
		                                             <td><?=$v['price']?></td>
		                                             <td><?=$v['duration']?> Days</td>
		                                             <td><?=$v['start_date']?></td>
		                                             <td><?=$v['end_date']?></td>
		                                             <td><?=$v['classes_count']?></td>
		                                             <td><?=date("d-m-Y" , strtotime($v['date_added']))?></td>
		                                           
		                                           
		                                        </tr>
		                                         <?php
		                                      $i++ ;
		                                    }
		                                    } ?>
		                                       
		                                	</tbody>
		                                	</table>
										</div>
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
                date_of_birth:{
                    required:true,
           
                } ,

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
                    date_of_birth:{
                        required:"Select DOB",
                    
                    } ,
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
        

    const table_name='users';
    
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

