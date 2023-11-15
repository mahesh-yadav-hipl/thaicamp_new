<?php include('head.php') ;
if($_SESSION['login_type'] != "admin")
{
  redirect(URL.'dashboard.php');
}
$id=!empty($_GET['id'])?$_GET['id']:"" ;
$get_all_list =  db_select_query("SELECT waiting_list.*,classes.name as classes_name
                                     FROM waiting_list
                                     INNER JOIN classes ON classes.id = waiting_list.class_id
                                     ORDER BY waiting_list.id DESC") ;
$class = db_select_query("SELECT * FROM waiting_list where id = '$id'")[0]; 
$classes = db_select_query("SELECT * FROM classes"); 

?>

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
                <h2>Waiting List</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Waiting List</a>
                    </li>
                    <!--<li>-->
                    <!--    <a href="admin_rooms.html">Rooms</a>-->
                    <!--</li>-->
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                 <?php if($id) {  ?>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Basic charts strats here-->
                        
                         <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-list"></i> Edit Waiting List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="edit-class-form"  class="form-horizontal"  method="post" action="ajax/update-waiting_list.php"  onsubmit="return false;">
                                          <input type = "hidden" name="id" value="<?=$class['id']?>">
                                            <div class="form-body">
                                                  
                                                <div class="form-group">
                                                    <label for="room_name" class="col-md-3 control-label">
                                                        Class
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                          <select class="form-control" name="class_id"  required >
                                                              <option value="" >Select Class</option>
                                                            <?php  foreach($classes as $k =>$v){ ?>
                                                              <option value="<?=$v['id']?>"  <?=($v['id'] == $class['class_id'])?'Selected':''?> ><?=$v['name']?></option>
                                                            <?php } ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="course_duration" class="col-md-3 control-label">
                                                        Name
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-user"></i>
                                                            </span>
                                                            <input id="name" type="text" name="name" value="<?=$class['name']?>" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Contact
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                            </span>
                                                            <input type="text" id="contact" name="contact" class="form-control"  value="<?=$class['contact']?>" placeholder="Enter contact">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-6">
                                                        <input type="submit" class="btn btn-primary" value="Update"> &nbsp;
                                                        <a class="btn btn-danger" href="waiting_list.php">Cancel</a>
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
                        
                        <?php  } else { ?>
                         <div class="row">
                    <div class="col-lg-12">
                        
                         <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-list"></i> Add Class
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="add-class-form"  class="form-horizontal"  method="post" action="ajax/add-waiting_list.php"  onsubmit="return false;">
                                             
                                            <div class="form-body">
                                                  
                                                <div class="form-group">
                                                    <label for="room_name" class="col-md-3 control-label">
                                                        Class
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                          <select class="form-control" name="class_id"  required >
                                                              <option value="" >Select Class</option>
                                                            <?php  foreach($classes as $k =>$v){ ?>
                                                              <option value="<?=$v['id']?>" ><?=$v['name']?></option>
                                                            <?php } ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="course_duration" class="col-md-3 control-label">
                                                        Name
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-user"></i>
                                                            </span>
                                                            <input id="name" type="text" name="name" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Contact
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                            </span>
                                                            <input type="text" id="contact" name="contact" class="form-control"  placeholder="Enter contact">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-6">
                                                        <input type="submit" class="btn btn-primary" value="Add"> &nbsp;
                                                        <a class="btn btn-danger" href="waiting_list.php">Cancel</a>
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
                  <?php } ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-list"></i> Waiting List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-bordered" id="fitness-table">
                                    <thead>
                                        <tr>
                                             <th>Sr No.</th>
                                             <th>Name</th>
                                             <th>Contact</th>
                                             <th>Class Name</th>
                                             <th>Edit</th>
                                             <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                     if($get_all_list) {
                                     $i = 1 ;
                                    foreach($get_all_list as $k =>$v){  ?>
                                        <tr>
                                            <td><?=$i?></td>
                                           
                                             <td><?=$v['name']?></td>
                                             <td><?=$v['contact']?></td>
                                              <td><?=$v['classes_name']?></td>
                                            <td>
                                                <a class="btn btn-primary" href="waiting_list.php?id=<?=$v['id']?>">
                                                    <i class="fa fa-fw fa-edit"></i> Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger remove" href="#" data-table='waiting_list' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
                                            </td>
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
 $("#add-class-form").validate({
         rules:{
      name:{
            required:true,
    
        },
        duration:{
            required:true,
    
        },
        capacity:{
            required:true,
    
        },
     
    
},
messages:{
  name:{
        required:"Enter Class Name",
    
    },
      duration:{
            required:"Enter Class Duration",
    
        },
        capacity:{
            required:"Enter Class Capacity",
    
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
      
      
      
      $("#edit-class-form").validate({
         rules:{
     name:{
        required:true,
    
    },
      duration:{
            required:true,
    
        },
        capacity:{
            required:true,
    
        },
     
    
},
messages:{
 name:{
        required:"Enter Class Name",
    
    },
      duration:{
            required:"Enter Class Duration",
    
        },
        capacity:{
            required:"Enter Class Capacity",
    
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
                       setTimeout(function(){ location.href='waiting_list.php'; },1500); 
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
