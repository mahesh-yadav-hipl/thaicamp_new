<?php include('head.php') ;
$id = $_GET['id'] ;
$tod_dat = date('Y-m-d') ;

// $get_upcoming_package_data = db_select_query("select * from upcoming_packages where user_id = '$id' ") ;
// if($get_upcoming_package_data)
// {
//     foreach($get_upcoming_package_data as $upcoming_data)
//     {
//         if($upcoming_data['pck_start_date'] == $tod_dat)
//         {
//             $upcmg_id  = $upcoming_data['id'] ;
//             $save1['packagesid'] = "" ;
//             $save1['class_id'] = "" ;
//             $save1['pck_start_date'] = "" ;
//             $save1['package_class'] = "" ;
//             $save1['hold_dates'] = "" ;
//             $save1['hold_status'] = "" ;
//             $save1['expiry_dates'] = "" ;
    
    
//             $data1['table']="users";
//             $data1['values']=$save1;
//             $data1['where']['id']=$id;
//             $updt = db_update($data1) ;
	
//             if($updt)
//             {
//                 $save['packagesid']=$upcoming_data['packagesid'] ;
//                 $save['expiry_dates']=$upcoming_data['expiry_dates'] ;
//                 $save['hold_dates']=$upcoming_data['hold_dates'] ;
//                 $save['hold_status']=$upcoming_data['hold_status'] ;
//                 $save['pck_start_date']=$upcoming_data['pck_start_date'] ;
//                 $save['package_class']=$upcoming_data['package_class'] ;
//                 $save['class_id']=$upcoming_data['class_id'] ;
//                 $save['payment_method'] = $upcoming_data['payment_method'] ;
//                 $save['discount_code'] = $upcoming_data['discount_code'] ; 
//                 $save['after_discount_price'] = $upcoming_data['after_discount_price'] ;
                
                
//                 $data['table']="users";
//                 $data['values']=$save;
//                 $data['where']['id']=$id;
            
//                 if(db_update($data))
//                 {
//                     $del_qry="DELETE FROM upcoming_packages WHERE id = '$upcmg_id' " ;
//                     db_delet_query($del_qry) ;
//                 }
                
//             }
//             else
//             {
                
                
//             }

//         }
//     }
// }




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
$upcoming_today = date('Y-m-d');
$get_all_upcoming_packages = db_select_query("select * from upcoming_packages where user_id = '$id' AND pck_start_date > '$upcoming_today' ") ;


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
                                    <i class="fa fa-fw fa-user"></i> View Subscriber
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
                                              <form id="edit-user-form"  method="post" action="ajax/update-data.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="users" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                
                                                <div class="col-md-3 col-sm-4 text-center">
                                                    <div class="form-group pad-top">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <?php 
                                                                    if($user['image']!=''){ 
                                                                        $image = $user['image'];
                                                                    }else{
                                                                        $image = URL.'uploaded/users/default-user.jpg';
                                                                    }
                                                                ?>
                                                                <img src="<?=$image?>" width="200px" height="150px" alt="profile">
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
                                                            
                                                           
                                                            <div style="text-align: center;" class="">
                                                                <?php $today_date = date('Y-m-d');
                                                                 //if($user['expiry_dates'] < $today_date)
                                                                 //{ 
                                                                 ?>
                                                                    <a href="add_new_package.php?id=<?php echo $user['id'] ?>" class="btn btn-warning btn-plan-select">Add Package</a> &nbsp; 
                                                                    <?php 
                                                                    //}
                                                                    ?>  
                                                                    <!--if(($user['package_class'] != '0') && ($today_date <= $exp)){-->
                                                                <?php if($hld_status == "Active") {
                                                                    if($user['pck_start_date'] > $today_date)
                                                                    {  ?>
                                                                        <button disabled class="btn btn-warning btn-plan-select">Hold Package</button> &nbsp; 
                                                                    <?php  }
                                                                    else
                                                                    {
                                                                ?>
                                                                <a class="btn btn-warning btn-plan-select" onclick="hold_package(<?php echo $pck_id ?> , <?php echo $user['id'] ?> )">Hold Package</a> &nbsp;
                                                                <?php }
                                                                    }else { ?>
                                                                        <a class="btn btn-warning btn-plan-select" onclick="active_package(<?php echo $pck_id ?> , <?php echo $user['id'] ?> , '<?php echo $hld_date  ?>' , '<?php echo $hld_status  ?>' )">Active Package</a> &nbsp;
                                                                <?php }  ?>
                                                                <!--} else {-->
                                                                
                                                                    <!--} -->
                                                                <a href = "edit_user.php?id=<?php echo $user['id'] ; ?>"  class="btn btn-warning">Edit Subscriber</a> &nbsp;
                                                                <a href = "edit_package.php?id=<?php echo $user['id'] ; ?>"  class="btn btn-warning">Edit Package</a> &nbsp;
                                                                <a href = "users.php"  class="btn btn-warning">Cancel</a> &nbsp;
                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        
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




                                <br><br>
                                    <h2> ALL UPCOMING PACKAGES</h2></br>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($get_all_upcoming_packages) {
                                    $i = 1 ;
                                    foreach($get_all_upcoming_packages as $k =>$v){ 
                                        $packagesid = $v['packagesid'];
                                        $package_data = db_select_query("select * from packages where id = '$packagesid'")[0] ;
                                        ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$package_data['name']?></td>
                                            <td><?=$v['after_discount_price']?></td>
                                            <td><?=$package_data['duration']?> Days</td>
                                            <td><?=$v['pck_start_date']?></td>
                                            <td><?=$v['expiry_dates']?></td>
                                            <td><?php $array = explode(',', $v['class_id']); echo count($array)?></td>
                                        
                                        
                                        </tr>
                                        <?php
                                    $i++ ;
                                    }
                                    } ?>
                                    
                                    </tbody>
                                    </table>





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
        
  
  
</script>

