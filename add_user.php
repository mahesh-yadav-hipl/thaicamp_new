<?php include('head.php') ;
$get_all_packages = db_select_query("SELECT * FROM packages ORDER BY id DESC") ;
$get_all_classes = db_select_query("SELECT * FROM classes ORDER BY id DESC") ; 
 $get_all_payment_methods = db_select_query("SELECT * FROM payment_methods ORDER BY id DESC") ;
  $get_all_discount_codes = db_select_query("SELECT * FROM discount_code ORDER BY id DESC") ;
?>
<style>
input[type="checkbox"]
{
    cursor:pointer;
}
    .swal2-modal
    {
        top:0px!important;
        left:0px!important;
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
</style>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
<body style="padding:0px;">
   
    <!-- header logo: style can be found in header-->
    <?php include('header.php')
?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php')
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
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-user"></i> Add Subscriber
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
                                              <form id="add-user-form"  method="post" action="ajax/add-data.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                                <input type="hidden" name="table" value="users" >
                                                <!--<div class="col-md-3 col-sm-4 text-center">-->
                                                <!--    <div class="form-group pad-top">-->
                                                <!--        <div class="fileinput fileinput-new" data-provides="fileinput">-->
                                                <!--            <div class="fileinput-new thumbnail">-->
                                                <!--                <img src="" width="200px" height="150px" alt="profile">-->
                                                <!--            </div>-->
                                                <!--            <div class="fileinput-preview fileinput-exists thumbnail"></div>-->
                                                <!--            <div class="select_align">-->
                                                <!--                <span class="btn btn-primary btn-file">-->
                                                <!--                    <span class="fileinput-new">Select image</span>-->
                                                <!--                <span class="fileinput-exists">Change</span>-->
                                                <!--               <input type="file" name="image" class="form-control" >-->
                                                <!--                </span>-->
                                                <!--                <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>-->
                                                <!--            </div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table" id="users">
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <input type="text" name="name" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>E-mail</td>
                                                                    <td>
                                                                        <input type="text" name="email" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password</td>
                                                                    <td>
                                                                        <input type="password" name="password" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td>
                                                                       <input type="text" name="mobile" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DOB</td>
                                                                    <td>
                                                                       <input type="date" name="date_of_birth" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender</td>
                                                                    <td>
                                                                       <select class="form-control" name="gender">
                                                                        <option value="">Select Gender</option>  
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                       </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Job Title</td>
                                                                    <td>
                                                                       <input type="text" name="job_title" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>Upload Image</td>
                                                                    <td>
                                                                      <input type="file" name="image" class="form-control" >
                                                                    </td>
                                                                </tr>
                                                                <!-- <tr>
                                                                    <td>Package</td>
                                                                    <td>
                                                                         <select class="form-control package" name="packagesid" id="packagesid">
                                                                    <option value="">Select Package</option>
                                                                    <?php //if($get_all_packages) {
                                                                       // foreach($get_all_packages as $k =>$v){ ?>
                                                                    <option value="<?php //echo $v['id'] ?>"><?php //echo $v['name'] ?></option>
                                                                    <?php //} 
                                                                    //} ?>
                                                                   </select>
                                                                    </td>
                                                                </tr> -->
                                                                
                                                                 <!-- <tr id="pck_start">
                                                                    <td>Package Start Date</td>
                                                                    <td>
                                                                      <input type="date" name="pck_start_date" class="form-control" >
                                                                    </td>
                                                                </tr> -->
                                                                
                                                                  <!-- <tr>
                                                                    <td>Classes</td>
                                                                    <td>
                                                                    <?php //if($get_all_classes) {
                                                                        //foreach($get_all_classes as $k =>$v){ ?>
                                                                    <input type="checkbox" value="<?//=$v['id']?>"  class = "class_id" name = "class_id[]"> <?//=$v['name']?></br>
                                                                    <?php //} 
                                                                    //} ?>
                                                                
                                                                    </td>
                                                                </tr> -->
                                                                
                                                                 <!-- <tr>
                                                                    <td>Payment Method</td>
                                                                    <td>
                                                                
                                                                    <?php //if($get_all_payment_methods) {
                                                                    //foreach($get_all_payment_methods as $k =>$method){
         
                                                                     ?>
                                                                     <input type="radio"  value="<?//=$method['id']?>" name = "payment_method"> <?//=$method['name']?></br>
                                                        
                                                                    <?php //} 
                                                                    //} ?>
                                                                  
                                                                    </td>
                                                                </tr> -->
                                                               
                                                            </table>
                                                             <!-- <div class="row" style="margin:0;margin-bottom:15px">
                                                            <p>
                                                                <div class="col-md-4" style="padding:0 5px">
                                                                    <b>Price :</b><input id="show_pck_price" type = "text" style="width:100%">
                                                                </div>
                                                                <div class="col-md-4" style="padding:0 5px">
                                                                     <b>Discount Code :</b>
                                                                    <select class = "discount_code" name="discount_code" style="width:100%">
                                                                        <option value="">Select Discount Code</option>
                                                                        <?php //if($get_all_discount_codes) 
                                                                       // { foreach($get_all_discount_codes as $code) { ?> 
                                                                        <option value="<?php //echo $code['id'] ?>"><?php //echo $code['code'] ?></option> <?php //} } ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4" style="padding:0 5px">
                                                                    <b>Total :</b>
                                                                    <input id="after_discount_price" name="after_discount_price" type = "text" style="width:100%"> 
                                                                </div>
                                                            </p>
                                                           
                                                             
                                                            </div> -->
                                                             
<div id="myModal" class="modal fade" role="dialog">
  <div style="width: 100%;float: left;" class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Packages</h4>
      </div>
      <div class="modal-body">
           <div class="container">
      <div class="pricing-table pricing-three-column row">
       <?php if($get_all_packages) {
         foreach($get_all_packages as $k =>$v){ 
            $ser1 = explode(",",$v['services']); ?>
        <div class="plan col-md-3">
          <div class="plan-name-silver">
               <span>Package ID - <?php echo $v['package_id']?></span>
            <h2 style="line-height: 35px;"><?= $v['name'] ?></h2>
            <span><?php echo $v['price']?> KD / <?php echo $v['duration'] ?> Days</span>
          </div>
          <h6>
          Package Description <i style="cursor:pointer;" class="fa fa-info" onclick="info(<?php echo $v['id'] ?>)"></i>
          </h6>
          <div style="display:none;" class="show_desc-<?php echo $v['id'] ?>">
             <?php echo $v['description']  ?>
          </div>
          <h6 class="text-info">Services Available</h6>
          
          <ul>
             <?php foreach($ser1 as $s1) { 
              $srv1 = db_select_query("select * from services where name = '$s1' ")[0];
               ?>
            <li class="plan-feature"><a href="services.php?id=<?php echo $srv1['id'] ?>"><?php echo $s1; ?></a></li>
           	<?php } ?>
            <li class="plan-feature"><a class="btn btn-success btn-plan-select"><input type="checkbox" value="<?=$v['id']?>" name = "packagesid[]"> Select Package</a></li>
          
          </ul>
        </div>
        <?php }
        } ?>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Add Package</button>
      </div>
    </div>

  </div>
  </div>
                                                    <div style="margin-top:30px;" class="multi-btns">
                                                        &nbsp;
                                                        <button type="submit" class="btn btn-primary ">Add</button> &nbsp;
                                                        <a href = "users.php"  class="btn btn-danger">Cancel</a> &nbsp;
                    
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
 
   $(document).ready(function(){ 
       $('#pck_start').hide() ;
       
       $('#packagesid').change(function(){
       $('#pck_start').show() ;
    });
    
    
     $('.package').change(function(){
       var pck_id = $(this).val() ;
       
       
           $.ajax({
                    url:'ajax/get_package_price.php',
                    type:'POST',
                    data:'pck_id='+pck_id,
                    success: function(response){
                        var json = $.parseJSON(response);
                        var package_price = json.package_price ;
                          if(json.result)
                          {
                            $('#show_pck_price').attr('value' , package_price) ;
                           // $('#after_discount_price').val(package_price);
                           $('#after_discount_price').attr('value' , package_price) ;
                          }
                          else
                          {
                             console.log("something went wrong") ;
                          }
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }) ;   
       
        
    });
    
      $('.discount_code').change(function(){
       var code_id = $(this).val() ;
       var pck_price = $('#show_pck_price').val() ;
       
       
           $.ajax({
                    url:'ajax/get_discount_price.php',
                    type:'POST',
                    data:{'code_id':code_id,'pck_price':pck_price},
                    success: function(response){
                        var json = $.parseJSON(response);
                        var total_price = json.total_price ;
                          if(json.result)
                          {
                            $('#after_discount_price').attr('value' , total_price) ;
                          }
                          else
                          {
                             console.log("something went wrong") ;
                          }
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                }) ;   
       
        
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
       
       
       
 $("#add-user-form").validate({
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
            } 
            //, 
       
            //class_id:{
            //    required:true,
           // },
            //password:{
           // required:true,
           // }
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
            } ,
            image:{
                required:"Choose Image",
            } 
            //,
           // class_id:{
            //    required:"Select Class",
           // },
           // password:{
           // required:"Enter Password",
           // }
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
                        location.href="users.php"; 
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
.plan.col-md-3 {
    width: 24%;
}
</style>

