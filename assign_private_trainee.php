<?php include('head.php') ;
$get_all_employee = db_select_query("SELECT * FROM users Where role = 'employee' ORDER BY id DESC");
$get_all_subscriber = db_select_query("SELECT * FROM users Where role = 'subscriber' ORDER BY id DESC");
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
span.select2  { width: 100% !important}
.form-control.package {
    padding: 3px 12px;
    height: 28px;}
    .error{display: block;}
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
                <h2>Private Training</h2>
                
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
                                    <i class="fa fa-fw fa-user"></i> Add Private Training
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
                                              <form id="add-private_training-form"  method="post" action="ajax/add-private-training.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                               <input type="hidden" name="table" value="private_training">


                                                <div class="col-md-6 col-sm-6">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">    
                                                                <tr>
                                                                    <td>
                                                                        <h3> Select Employee</h3>
                                                                        <select class="form-control package" name="employee_id" required>
                                                                            <option value="">Select Employee</option>
                                                                            <?php if($get_all_employee) {
                                                                            foreach($get_all_employee as $k =>$v){ ?>
                                                                                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                                                <?php } 
                                                                            } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h3> Select Subscriber</h3>
                                                                        <select class="form-control package" name="subscriber_id" id="subscriber_id" onchange="loadData()" required>
                                                                            <option value="">Select Subscriber</option>
                                                                            <?php if($get_all_subscriber) {
                                                                            foreach($get_all_subscriber as $k =>$v){ ?>
                                                                                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                                                                <?php } 
                                                                            } ?>
                                                                        </select>
                                                                    <!-- <div id="displayData"></div> -->
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h3>PT Start Date</h3>
                                                                        <input type="date" name="pt_start_date" class="form-control" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <h3>PT End Date</h3>
                                                                        <input type="date" name="pt_end_date" class="form-control" required>
                                                                    </td>
                                                                </tr> 
                                                                <tr>                                                                    
                                                                    <td>
                                                                        <h3>Price</h3>
                                                                        <input type="number" name="price" class="form-control" required>
                                                                    </td>
                                                                </tr> 
                                                                <tr>
                                                                    <td>
                                                                        <h3>Personal Trainee Percentage</h3>
                                                                        <input type="number" name="pt_percentage" class="form-control" required>
                                                                    </td>
                                                                </tr> 
                                                                <td>
                                                                    <h3>Payment Method</h3>
                                                                    <input type="radio" value="2" name="payment_method" checked=""> Cash<br>
                                                                    <input type="radio" value="3" name="payment_method"> Visa<br>
                                                                    <input type="radio" value="1" name="payment_method"> Knet<br>                                                                  
                                                                </td>
                                                            </table>
                                                            </div>
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <button type="submit" class="btn btn-primary">Assign</button> &nbsp;
                                                                <a href = "private-training.php"  class="btn btn-danger">Cancel</a> &nbsp;
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 
 $(document).ready(function() {
    $('#subscriber_id').select2();
}); 
       
 $("#add-private_training-form").validate({
         rules:{
            employee_id:{
                required:true,
            },   
            subscriber_id:{
                required:true,
            },
            price:{
                required:true,
            },
            duration:{
                required:true,
            },
            pt_percentage:{
                required:true,
                max:100
            },
            pt_start_date:{
                required:true,
            },
            pt_end_date:{
                required:true,
            },
},
messages:{
    employee_id:{
        required:"Please Select employee",
    },
    subscriber_id:{
        required:"Please Select subscriber",
    },
    price:{
        required:"Enter Price",
    },
    duration:{
        required:"Enter Duration",
    },
    pt_percentage:{
        required: "Enter Personal Trainee Percentage",
    },
    pt_start_date:{
        required: "Please Select start date",
    },
    pt_end_date:{
        required: "Please Select end date",
    }
},
         submitHandler: async (form, event)=>{
            event.preventDefault();           
            var data=new FormData($(form)[0]); 
            console.log(data);           
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
                        location.href="private-training.php"; 
                     }, 3000);                      
               }else{               
                  toastr.error(json.message);  
                }    
            }catch(err) {              
               toastr.error(err);
            }             
            //table.draw();
            // table.page(table.page.info().page).draw(false);            
         }  
      });    
   
 
 // function info(pcid)
 //      {
 //        $('.show_desc-'+pcid).toggle() ;  
 //      }
        
var loadData = function(){
const id = $("#subscriber_id").val();
$.ajax({    
    type: "post",
    url: "ajax/display-details.php", 
    data:{userId:id},      
    dataType: "html",                  
    success: function(data){   
     
       $("#displayData").html(data);
    }
});
};
  
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
#displayData td {
    padding: 5px;
}
#displayData table{
    width: 100%;
    margin-top: 5px;
}
</style>

