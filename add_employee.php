<?php include('head.php');?>
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
</style>

<body style="padding:0px;">
   
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
                <h2>Employee</h2>
               
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
                                    <i class="fa fa-fw fa-user"></i> Add Employee
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
                                              <form id="add-user-form"  method="post" action="ajax/add-employee.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="users" >                                              
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <input type="text" name="name" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td>
                                                                        <input type="email" name="email" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password</td>
                                                                    <td>
                                                                        <input type="password" name="password" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Salary</td>
                                                                    <td>
                                                                        <input type="number" name="salary" class="form-control" require>
                                                                    </td>
                                                                </tr>

                                                                <!-- <tr>
                                                                    <td>Trainee Fee</td>
                                                                    <td>
                                                                        <span class="text-success">When Subscriber buy Trainee then Trainee Fee</span>
                                                                        <input type="number" name="subscriber_buy_price" class="form-control" require>
                                                                    </td>
                                                                </tr> -->
                                                                <tr>
                                                                    <td>Trainee Percentage</td>
                                                                    <td>
                                                                        <span class="text-success">When Subscriber buy Trainee then Employee Percentage</span>
                                                                        <input type="number" name="employee_percentage" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td>Phone</td>
                                                                    <td>
                                                                        <input type="number" name="mobile" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Date of Birth</td>
                                                                    <td>
                                                                        <input type="date" name="date_of_birth" class="form-control" require>
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
                                                                    <td>Date of Joining</td>
                                                                    <td>
                                                                        <input type="date" name="date_of_joining" class="form-control" require>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Address</td>
                                                                    <td>
                                                                        <textarea name="address" class="form-control" rows="4" cols="50"></textarea>
                                                                    </td>
                                                                </tr>
                                                              
                                                                 <tr>
                                                                    <td>Upload Profile Image</td>
                                                                    <td>
                                                                      <input type="file" name="profile" class="form-control" require accept="image/*">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            </div>
                                                            </div>                                                               
                                                            <div style="text-align: center;" class="">
                                                                <button type="submit" class="btn btn-primary">Add</button> &nbsp;
                                                                <a href = "employee.php"  class="btn btn-danger">Cancel</a> &nbsp;                            
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
 
       
       
 $("#add-user-form").validate({
         rules:{
            name:{
            required:true,
            },
            email:{
            required:true,
            },
            password:{
            required:true,
            },
            salary:{
            required:true,
            },
            mobile:{
            required:true,
            },
            date_of_birth:{
            required:true,
            },
            date_of_joining:{
            required:true,
            },
            gender:{
            required:true,
            },
            profile:{
            required:true,
            },
            // subscriber_buy_price:{
            // required:true,
            // },
            employee_percentage:{
            required:true,
            max:100
            }
},
messages:{
  name:{
        required:"Enter Name",
    },
    email:{
    required:"Enter Email",
    },
    password:{
    required:"Enter Password",
    },
    salary:{
    required:"Enter Salary",
    },
    mobile:{
    required:"Enter Phone",
    },
    date_of_birth:{
    required:"Select Date Of Birth",
    },
    date_of_joining:{
    required:"Select Date Of Joining",
    },
    gender:{
    required:"Select Gender",
    },
    profile:{
    required:"Choose Profile",
    },
    // subscriber_buy_price:{
    // required:"Enter Trainee Fee",
    // },
    employee_percentage:{
    required:"Enter Trainee Percentage",
    }
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
                        location.href="employee.php"; 
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
  color: #fff;
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

