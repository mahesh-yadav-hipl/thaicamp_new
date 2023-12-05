<?php include('head.php') ;
if($_POST['mobile'])
{
  $mob =  $_POST['mobile'] ;
  $user = db_select_query("select * , CONCAT('".URL."admin/uploaded/users/', image) AS image from users where mobile = '$mob' ")[0] ;
   $packages_id = explode(",",$user['packagesid']);
   $pck_cls_user = $user['package_class'] ;
   $class_id = explode(",",$user['class_id']);
   $expiry_dates = explode(",",$user['expiry_dates']);
   $hold_dates = explode(",",$user['hold_dates']);
   $hold_status = explode(",",$user['hold_status']);
   $joined_date = date("d-m-Y" , strtotime($user['created_at'])) ;
}
?>
<link type="text/css" href="css/new_custom.css" rel="stylesheet">
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
                <h2>Enterance</h2>
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
                
                       <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-sign-in"></i> Enterance
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                       <form class="form-horizontal" method="post" action="">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="room_name" class="col-md-2 control-label">
                                                        Subscriber Mobile
                                                        <span class="require">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-mobile"></i>
                                                            </span>
                                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter Subscriber Mobile" value="<?php if(!empty($_POST['mobile'])){echo $_POST['mobile'] ; } ?>" required="">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        
                
            
                        
                
             <?php if($_POST['mobile']) { ?>
                <div class="row enterance-table">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                               
                            </div>
                            <div class="panel-body table-responsive">
                                <?php if($user) { 
                                    if($user['is_deactivate'] == 0){?>

                                  
                                
                               <div class="col-md-8" style="margin:0 auto;">
                <div class="card">
                    <div class="card-block">
                       <a href="edit_user.php?id=<?=$user['id']?>"><h4 class="card-title"><?=$user['name']?></h4></a><span style="color: rgba(0, 0, 0, .4);font-size:1em;top: 16px;
    right: 15px;position: absolute;">Joined Date <?php echo $joined_date  ?></span>
                        
                        <div class="meta">
                            <h5>Validity Of Packages</h5>
                        </div>
                        <?php foreach($packages_id as $key => $pck_id) {
                        $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                        $pck_name = $qry['name'] ;
                        $countfiles = count($expiry_dates);
                         $exp=$expiry_dates[$key] ;
                          $hld_date = $hold_dates[$key] ;
                           $hld_status = $hold_status[$key] ;
                         $today_date = date('Y-m-d'); 
           $currentDateTime = date('Y-m-d H:i:s');
          $newDateTime = date('h:i A', strtotime($currentDateTime));
         
                        ?>
                        <div class="card-text">
                                <i class="fa fa-circle" aria-hidden="true"></i> <?=$pck_name?> (<?php echo $qry['package_id'];?>)
                                
                                <?php if(($user['package_class'] != '0') && ($today_date <= $exp )){
                                ?>
                                <span class="action-button">
                                    <button style="cursor: text;width: 143px;" type = "button" id="enterance"  data-date="<?php echo $today_date  ?>"  data-packageid="<?php echo $pck_id ?>" data-userid="<?php echo $user['id'] ?>" data-enttime="<?php echo $newDateTime ?>" class="btn btn-success">Valid</button>
                                </span>
                        <div style="border-top: none!important;" class="card-footer">
                        <span class="float-right">Expiration Date <?php echo date("d-m-Y" , strtotime($exp))  ?></span>
                         </div>
                        
                        <?php } else { ?>
                        <span class="action-button">
                        <button style="cursor: text;width: 143px;" id="enterance" class="btn btn-danger">Invalid</button>
                        </span>
                        <div style="border-top: none!important;" class="card-footer">
                        <span class="float-right">Expiration Date <?php echo date("d-m-Y" , strtotime($exp))  ?></span>
                         </div>
                        <?php } ?>
                        </div>
                        <?php 
                        } ?>
                         <div class="meta">
                         <h5>Selected Classes</h5>
                        </div>
                         <div class="card-text">
                        <?php foreach($class_id as $cls_id) {
                         $cls_qry = db_select_query("select * from classes where id = '$cls_id'")[0] ;
                        $cls_name = $cls_qry['name'] ;
                        ?>
                        <i  class="fa fa-circle" aria-hidden="true"></i> <?=$cls_name?></br>
                        <?php } ?>
                        </div>
                    </div>
                   
                        <span style="color: #ff931d;
    font-size: 1em;
    top: 164px;
    right: 35px;
    position: absolute;"><b id="class-left-count" >Classes Left - <?php echo $pck_cls_user ;  ?></b></span>
                        
                    
                </div>
            </div>
                                <div class="col-sm-6 col-md-4 col-lg-4"></div>

                <?php } else{ ?>
                    <h3>You are deactivated By admin.</h3>
               <?php } ?>
                                
            <?php } else { ?>
             <h3>No User Found</h3>
         <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
<style>
    html {
    font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
    font-size: 14px;
}

h5 {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
    margin: 0;
}

.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
    margin:0 auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
    margin:0;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
    float:left;
    width:100%;
}
.card-text .action-button
{
    float:right;
}

.card-text i
{
    font-size:10px;
    margin-right:5px;
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}


.enterance-table .panel-danger{
    background-color: transparent;
    border: none;
    box-shadow: none;
}
.enterance-table .panel-danger > .panel-heading{
    background-color: transparent;
    border: none;
    padding: 0;
}
.enterance-table .panel-danger .panel-body{
    padding: 0;
}
.enterance-table .panel-danger .panel-body .card{
    box-shadow: none;
    border: 1px solid #d4d4d5;
    border-radius: 10px;
}
.meta h5{
    font-size: 18px;
    color: #000;
}
.card-text .action-button{
    margin-top: -8px;
}
.card-footer{
    float: left;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 14px;
}


</style>


<script>


 
   $(document).ready(function(){
       
      $('.sidebar-offcanvas').addClass('collapse-left') ;
      $('.right-side').addClass('strech') ;
       
       <?php if($_POST['mobile']) { ?>  
 setTimeout(function() {
    $("#enterance").trigger('click');
  }, 1000);
 <?php }  ?>
 
 
 $.fn.setCursorPosition = function(pos) {
  this.each(function(index, elem) {
    if (elem.setSelectionRange) {
      elem.setSelectionRange(pos, pos);
    } else if (elem.createTextRange) {
      var range = elem.createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  });
  return this;
};

$('#mobile').setCursorPosition(1);
$('input[name=mobile]').focus();
 
 
 $("#add-service-form").validate({
         rules:{
      name:{
            required:true,
    
        },
     
    
},
messages:{
  name:{
        required:"Enter Package Name",
    
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
      
      
      
      $("#edit-service-form").validate({
         rules:{
      name:{
            required:true,
    
        },
     
    
},
messages:{
  name:{
        required:"Enter Package Name",
    
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
      
      
     
      
      
       $('#enterance').click(function(){
           
          
          var v = $('#enterance').text() ;
          
          if(v == 'Valid')
          {
             var package_id = $(this).data('packageid');
       var user_id = $(this).data('userid');
       var entered_time = $(this).data('enttime');
        var date = $(this).data('date');
      
       
                $.ajax({
                    url:'ajax/add_enterance.php',
                    type:'POST',
                    data:{'package_id':package_id,'user_id':user_id,'entered_time':entered_time,'date':date},
                    dataType:'json',
                    success: function(response){
                        try {
                      if(response.result)
                      {
                        var count = "<?= (isset($pck_cls_user))?$pck_cls_user:0?>";
                        if(count){
                            count =parseInt(count)-1;
                            console.log(count);
                            $("#class-left-count").text("Classes Left - "+count);
                        }
                        toastr.success(response.message);                  
                      setTimeout(function(){ location.href=''; },15000); 
                      
                      }
                      else
                      {
                         toastr.error(response.message);   
                         setTimeout(function(){ location.href=''; },15000);
                      }
                        }catch(err) {
              
               toastr.error(err);
               setTimeout(function(){ location.href=''; },15000);
            }    
             
                    },              
                    error:function(response){
                        toastr.success(response.message);                  
                    },          
                })   
          }else
          {
             setTimeout(function(){ location.href=''; },15000);
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
                       setTimeout(function(){ location.href='services.php'; },1500); 
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