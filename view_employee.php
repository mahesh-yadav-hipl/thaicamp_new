<?php include('head.php');
$id=!empty($_GET['id'])?$_GET['id']:"";
$employee = db_select_query("SELECT * FROM users WHERE id = '$id'");
if(count($employee) == 0){
    echo "employee not exists";
    die;
}
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
                                    <i class="fa fa-fw fa-user"></i> View Employee
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
                                              <form id="add-user-form"  method="post" action="ajax/edit-employee.php"  onsubmit="return false;"  enctype="multipart/form-data" autocomplete="off">    
                                               <input type="hidden" name="table" value="employee" >   
                                               <input type="hidden" name="id" value="<?php echo $employee[0]['id'];?>">                                             
                                                <div class="col-md-9 col-sm-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="users">
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['name'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['email'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['password'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Salary</td>
                                                                    <td>
                                                                         <?php echo $employee[0]['salary'];?>
                                                                    </td>
                                                                </tr>
                                                               <?php if($_SESSION['login_type']=='admin'){ ?>
                                                                <tr>
                                                                    <td>Trainee Fee</td>
                                                                    <td>
                                                                         <?php echo $employee[0]['subscriber_buy_price'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Trainee Percentage</td>
                                                                    <td>
                                                                         <?php echo $employee[0]['employee_percentage'];?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td>Phone</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['mobile'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Date of Birth</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['date_of_birth'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender</td>
                                                                    <td>
                                                                        <?php echo $employee[0]['gender'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Date of Joining</td>
                                                                    <td>
                                                                    <?php echo $employee[0]['date_of_joining'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Address</td>
                                                                    <td>
                                                                    <?php echo $employee[0]['address'];?>
                                                                    </td>
                                                                </tr>
                                                              
                                                                 <tr>
                                                                    <td>Image</td>
                                                                    <td>
                                                                    <?php 
                                                                        $image = URL.'uploaded/employee/'.$employee[0]['image'];
                                                                        if($employee[0]['image'] !='' ){
                                                                            $url = URL.'uploaded/employee/'.$employee[0]['image'];
                                                                        }else{
                                                                            $url = URL.'uploaded/users/default-user.jpg';   
                                                                        }
                                                                        echo '<img src="'.$url.'" style="width:100px;">';
                                                                            
                                                                    ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            </div>
                                                            </div>
                                                               
                                                            <div style="text-align: center;" class="">
                                                                <a href = "employee.php"  class="btn btn-danger">Back</a> &nbsp;                            
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

