<?php include('head.php') ;
if($_SESSION['login_type'] != "admin")
{
  redirect(URL.'dashboard.php');
}
$id=!empty($_GET['id'])?$_GET['id']:"" ;
$get_all_expenses =  db_select_query("SELECT * FROM expenses ORDER BY id DESC") ;
$expense = db_select_query("SELECT * FROM expenses where id = '$id'")[0] ; 

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
                <h2>Expenses</h2>
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
                 <?php if($_GET['id']) { ?>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-money"></i> Edit Expenses
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="edit-expenses-form"  class="form-horizontal"  method="post" action="ajax/update-expenses.php"  onsubmit="return false;">
                                          <input type = "hidden" name="id" value="<?=$expense['id']?>">
                                            <div class="form-body">
                                                
                                                
                                                <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Expenses Title
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="title" type="text" name="title" value="<?=$expense['title']?>" class="form-control" placeholder="Enter Title">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Expenses Price
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="price" type="text" name="price" value="<?=$expense['price']?>" class="form-control" placeholder="Enter Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Select Date
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="date" type="date" name="date" value="<?=$expense['date']?>" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-7">
                                                        <input type="submit" class="btn btn-primary default-btns" value="Update"> &nbsp;
                                                        <a class="btn btn-danger default-btns" href="expenses.php"> Cancel</a>
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
                                    <i class="fa fa-fw fa-money"></i> Add Expenses
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="add-expenses-form"  class="form-horizontal"  method="post" action="ajax/add-expenses.php"  onsubmit="return false;">
                                           
                                            <div class="form-body">
                                                
                                                 
                                                
                                                <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Expenses Title
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="tilte" type="text" name="title" class="form-control" placeholder="Enter Title">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 
                                                <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Expenses Price
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="price" type="text" name="price" class="form-control" placeholder="Enter Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="course_name" class="col-md-3 control-label">
                                                        Select Date
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input id="date" type="date" name="date"  class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-7">
                                                        <input type="submit" class="btn btn-primary default-btns" value="Add"> &nbsp;
                                                        <a class="btn btn-danger default-btns" href="expenses.php"> Cancel</a>
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
                                    <i class="fa fa-fw fa-money"></i> Expenses List
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
                                           
                                            <th>Expenses Title</th>
                                            <th>Expenses Price</th>
                                          <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                       <?php 
                                     if($get_all_expenses) {
                                     $i = 1 ;
                                    foreach($get_all_expenses as $k =>$v){  ?>
                                       <tr>
                                            <td><?=$i?></td>
                                        
                                             <td><?=$v['title']?></td>
                                             <td><?=$v['price']?> KD</td>
                                             <td><?= date("d-m-Y" , strtotime($v['date'])) ?></td>
                                            <td>
                                                <a class="btn btn-primary default-btns" href="expenses.php?id=<?=$v['id']?>">
                                                     Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger remove default-btns" href="#" data-table='expenses' data-key='id' data-value="<?php echo $v['id'] ?>">
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
 $("#add-expenses-form").validate({
         rules:{
      title:{
            required:true,
    
        },
        
        price:{
            required:true,
    
        },
         date:{
            required:true,
    
        },
        
         
    
},
messages:{
   title:{
            required:"Enter Title",
    
        },
        
        price:{
            required:"Enter Price",
    
        },
         date:{
            required:"Select Date",
    
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
      
      
      
      $("#edit-expenses-form").validate({
         rules:{
      title:{
            required:true,
    
        },
        
        price:{
            required:true,
    
        },
        
         date:{
            required:true,
    
        },
        
        
        
       
        
    
},
messages:{
   title:{
            required:"Enter Title",
    
        },
        
        price:{
            required:"Enter Price",
    
        },
         date:{
            required:"Select Date",
    
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
                       setTimeout(function(){ location.href='expenses.php'; },1500); 
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
