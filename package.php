<?php include('head.php') ;
if($_SESSION['login_type'] != "admin")
{
  redirect(URL.'dashboard.php');
}
$id=!empty($_GET['id'])?$_GET['id']:"" ;
$get_all_services =  db_select_query("SELECT * FROM services ORDER BY id DESC") ;
$get_all_packages =  db_select_query("SELECT * FROM packages ORDER BY id DESC") ;
$package = db_select_query("SELECT * FROM packages where id = '$id'")[0] ; 


$dt=db_select_query("SELECT id FROM packages ORDER BY id DESC LIMIT 0,1");
if(count($dt))
{
  $ids=$dt[0]['id'];
  $package_id='PCK-000'.++$ids;
}
else
{
  $package_id='PCK-0001';
}
?>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
<body>
<div class="se-pre-con2"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php')
?>        <aside class="right-side right-padding n_tabledata">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h2>Packages</h2>
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
                        <a href="courses.html">Courses</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                 <?php if($id) {  ?>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file-text-o"></i> Edit Package
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="edit-package-form"  class="form-horizontal"  method="post" action="ajax/update-package.php"  onsubmit="return false;">
                                          <input type = "hidden" name="id" value="<?=$package['id']?>">
                                            <div class="form-body">
                                                
                                                 <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Package ID
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                    <input id="name" type="text"  class="form-control" value="<?php echo $package['package_id'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Package Name
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="name" type="text" name="name" value="<?=$package['name']?>" class="form-control" placeholder="Enter Package Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_duration" class="col-md-3 control-label">
                                                        Package Duration (In days)
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-clock-o"></i>
                                                            </span>
                                                            <input id="duration" type="text" name="duration" value="<?=$package['duration']?>" class="form-control" placeholder="Enter Package Duration">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Package Price
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                            </span>
                                                            <input id="price" type="text" name="price" value="<?=$package['price']?>" class="form-control" placeholder="Enter Package Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                  <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Classes Count
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                                            </span>
                                                            <input id="pck_class" type="text" name="pck_class" value="<?=$package['pck_class']?>" class="form-control" placeholder="Enter Classes Count">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Package Description
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-info" aria-hidden="true"></i>
                                                            </span>
                                                            <textarea rows="8" id="description" name="description" class="form-control" placeholder="Enter Package Description"><?=$package['description']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  <div class="form-group">-->
                                                <!--    <label for="course_name" class="col-md-3 control-label">-->
                                                <!--        Subscribers Capacity-->
                                                <!--        <span class='require'>*</span>-->
                                                <!--    </label>-->
                                                <!--    <div class="col-md-7">-->
                                                <!--        <div class="input-group">-->
                                                <!--            <span class="input-group-addon">-->
                                                <!--                <i class="fa fa-fw fa-bar-chart"></i>-->
                                                <!--            </span>-->
                                                <!--            <input id="subscribers_capacity" type="text" name="subscribers_capacity" value="<?=$package['subscribers_capacity']?>" class="form-control" placeholder="Enter Subscribers Capacity">-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                <!--    <label class="col-md-3 control-label">Image</label>-->
                                                <!--    <div class="col-md-7 text-center">-->
                                                <!--        <div class="input-group">-->
                                                <!--            <div class="fileinput fileinput-new" data-provides="fileinput">-->
                                                <!--                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">-->
                                                <!--                    <img data-src="holder.js/200x150" src="#" alt="profile">-->
                                                <!--                </div>-->
                                                <!--                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>-->
                                                <!--                <div class="select_align">-->
                                                <!--                    <span class="btn btn-primary btn-file">-->
                                                <!--                        <span class="fileinput-new">Select image</span>-->
                                                <!--                    <span class="fileinput-exists">Change</span>-->
                                                <!--                    <input type="file" name="...">-->
                                                <!--                    </span>-->
                                                <!--                    <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>-->
                                                <!--                </div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Select Services
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <?php 
                                                            if($get_all_services) {
                                                foreach($get_all_services as $k =>$v){ 
                                                  $sr = explode(",",$package['services']);
                                                 
                                                  
                                                ?>
                                        <input type="checkbox" value="<?=$v['name']?>" name = "services[]" <?php if(in_array($v['name'], $sr)){ echo 'checked="checked"'; }?>> <a href="services.php?id=<?php echo $v['id']  ?>"><?=$v['name']?></a> &nbsp;
                                                        <?php 
                                                } 
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-7">
                                                        <input type="submit" class="btn btn-primary default-btns" value="Update"> &nbsp;
                                                        <a class="btn btn-danger default-btns" href="package.php"> Cancel</a>
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
                 
                 <?php } else { ?>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file-text-o"></i> Add Package
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="add-package-form"  class="form-horizontal"  method="post" action="ajax/add-package.php"  onsubmit="return false;">
                                           <input type ="hidden" name="package_id" value="<?php echo $package_id ?>" >
                                            <div class="form-body">
                                                
                                                 <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Package ID
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                    <input id="name" type="text"  class="form-control" value="<?php echo $package_id ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Package Name
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="name" type="text" name="name" class="form-control" placeholder="Enter Package Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_duration" class="col-md-3 control-label">
                                                        Package Duration (In days)
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-clock-o"></i>
                                                            </span>
                                                            <input id="duration" type="text" name="duration" class="form-control" placeholder="Enter Package Duration">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Package Price
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                            </span>
                                                            <input id="price" type="text" name="price" class="form-control" placeholder="Enter Package Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Classes Count
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                                            </span>
                                                            <input id="pck_class" type="text" name="pck_class"  class="form-control" placeholder="Enter Classes Count">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_price" class="col-md-3 control-label">
                                                        Package Description
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-info" aria-hidden="true"></i>
                                                            </span>
                                                            <textarea rows="8" id="description" name="description" class="form-control" placeholder="Enter Package Description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group">-->
                                                <!--    <label for="course_name" class="col-md-3 control-label">-->
                                                <!--        Subscribers Capacity-->
                                                <!--        <span class='require'>*</span>-->
                                                <!--    </label>-->
                                                <!--    <div class="col-md-7">-->
                                                <!--        <div class="input-group">-->
                                                <!--            <span class="input-group-addon">-->
                                                <!--                <i class="fa fa-fw fa-bar-chart"></i>-->
                                                <!--            </span>-->
                                                <!--            <input id="subscribers_capacity" type="text" name="subscribers_capacity"  class="form-control" placeholder="Enter Subscribers Capacity">-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                <!--    <label class="col-md-3 control-label">Image</label>-->
                                                <!--    <div class="col-md-7 text-center">-->
                                                <!--        <div class="input-group">-->
                                                <!--            <div class="fileinput fileinput-new" data-provides="fileinput">-->
                                                <!--                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">-->
                                                <!--                    <img data-src="holder.js/200x150" src="#" alt="profile">-->
                                                <!--                </div>-->
                                                <!--                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>-->
                                                <!--                <div class="select_align">-->
                                                <!--                    <span class="btn btn-primary btn-file">-->
                                                <!--                        <span class="fileinput-new">Select image</span>-->
                                                <!--                    <span class="fileinput-exists">Change</span>-->
                                                <!--                    <input type="file" name="...">-->
                                                <!--                    </span>-->
                                                <!--                    <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>-->
                                                <!--                </div>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Select Services
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <?php 
                                                            if($get_all_services) {
                                                foreach($get_all_services as $k =>$v){  ?>
                                                        <input type="checkbox" value="<?=$v['name']?>" name = "services[]"> <a href="services.php?id=<?php echo $v['id'] ?>"><?=$v['name']?></a> &nbsp;
                                                        <?php 
                                                } 
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-7">
                                                        <input type="submit" class="btn btn-primary default-btns" value="Add"> &nbsp;
                                                        <a class="btn btn-danger default-btns" href="package.php"> Cancel</a>
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
                        <!-- Basic charts strats here-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file-text-o"></i> Packages List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table" id="fitness-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">Sr No.</th>
                                            <th>Package ID</th>
                                            <th>Package Name</th>
                                            <th>Package Duration</th>
                                            <th>Package Price</th>
                                         
                                            <th>Services</th>
                                            <th>Classes Count</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                       <?php 
                                     if($get_all_packages) {
                                     $i = 1 ;
                                    foreach($get_all_packages as $k =>$v){  ?>
                                       <tr>
                                            <td><?=$i?></td>
                                            <td><?=$v['package_id']?></td>
                                             <td><?=$v['name']?></td>
                                              <td><?=$v['duration']?> Days</td>
                                               <td><?=$v['price']?> KD</td>
                                              
                                               <td><?=$v['services']?></td>
                                               <td><?=$v['pck_class']?></td>
                                            <td>
                                                <a class="btn btn-primary default-btns" href="package.php?id=<?=$v['id']?>">
                                                     Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger default-btns remove" href="#" data-table='packages' data-key='id' data-value="<?php echo $v['id'] ?>">
                                                     Delete
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
    <script src="vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
    <script src="vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/courses.js" type="text/javascript"></script>
    <!-- end of page level js -->
</body>


</html>
<script>
 
   $(document).ready(function(){  
 $("#add-package-form").validate({
         rules:{
      name:{
            required:true,
    
        },
         price:{
            required:true,
    
        },
         duration:{
            required:true,
    
        },
        description:{
            required:true,
    
        },
        pck_class:{
            required:true,
            number:true,
    
        },
        
         
    
},
messages:{
  name:{
        required:"Enter Package Name",
    
    },
    price:{
            required:"Enter Package Price",
    
        },
         duration:{
            required:"Enter Package Duration",
    
        },
        description:{
            required:"Enter Package Description",
    
        },
        pck_class:{
            required:"Enter Classes Count",
             number:"Class Must Be Numeric",
    
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
      
      
      
      $("#edit-package-form").validate({
         rules:{
      name:{
            required:true,
    
        },
         price:{
            required:true,
    
        },
         duration:{
            required:true,
    
        },
        description:{
            required:true,
    
        },
        pck_class:{
            required:true,
             number:true,
    
        },
       
        
    
},
messages:{
  name:{
        required:"Enter Package Name",
    
    },
    price:{
            required:"Enter Package Price",
    
        },
         duration:{
            required:"Enter Package Duration",
    
        },
        description:{
            required:"Enter Package Description",
    
        },
        pck_class:{
            required:"Enter Classes Count",
             number:"Class Must Be Numeric",
    
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
                       setTimeout(function(){ location.href='package.php'; },1500); 
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
  
 window.onload = (event) => {
        $('.se-pre-con2').css('display','none');
    }
  
</script>
