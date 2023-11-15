<?php 
include('head.php') ;

?>
<style>
    .sub-count
    {
         float:left;
    }
    .tot
    {
        float:right;
    }
</style>
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
                <h2>Reports</h2>
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
                        <a href="admin_rooms.html">Rooms</a>
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
                                    <i class="fa fa-fw fa-file"></i> Report For No Entry Record More Than 7 Days
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form   class="form-horizontal"  method="post" action=" " >
                                            <div class="form-body">
                                                
                                                
                                                  <div class="form-group">
                                                    <label for="room_name" class="col-md-3 control-label">
                                                        Gender
                                                        <span class='require'>*</span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-user"></i>
                                                            </span>
                                                             <select class="form-control" name="gender" id = "gender">
                  <option value="">Select Gender</option>
                  <option value="Male" <?php if(isset($_REQUEST['gender'])){
                        if($_REQUEST['gender'] == 'Male'){ echo 'selected'; } } ?>>Male</option>
                 <option value="Female" <?php if(isset($_REQUEST['gender'])){
                        if($_REQUEST['gender'] == 'Female'){ echo 'selected'; } } ?>>Female</option>
                 
                  
                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                     <!--             <div class="form-group">-->
                                     <!--               <label for="room_name" class="col-md-3 control-label">-->
                                     <!--                   From-->
                                     <!--                   <span class='require'>*</span>-->
                                     <!--               </label>-->
                                     <!--               <div class="col-md-6">-->
                                     <!--                   <div class="input-group">-->
                                     <!--                       <span class="input-group-addon">-->
                                     <!--                           <i class="fa fa-fw fa-calendar"></i>-->
                                     <!--                       </span>-->
                                     <!--<input type ="date" name="from" id="from" class="form-control" value="<?php if(!empty($_REQUEST['from'])){echo $_REQUEST['from'];}?>">-->
                                     <!--                   </div>-->
                                     <!--               </div>-->
                                     <!--           </div>-->
                                                
                                                
                                                
                                              
                                                
                                                <!-- <div  class="form-group">-->
                                                <!--    <label for="room_name" class="col-md-3 control-label">-->
                                                <!--        To-->
                                                <!--        <span class='require'>*</span>-->
                                                <!--    </label>-->
                                                <!--    <div class="col-md-6">-->
                                                <!--        <div class="input-group">-->
                                                <!--            <span class="input-group-addon">-->
                                                <!--                <i class="fa fa-fw fa-calendar"></i>-->
                                                <!--            </span>-->
                                                <!--            <input type ="date" name="to" id="to" class="form-control" value="<?php if(!empty($_REQUEST['to'])){echo $_REQUEST['to'];}?>">-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                
                                                
                                                
                                                
                                                
                                              
                                                
                                                
                                                
                                                
                                        
                                                
                                                
                                          
                                                
                                                
                                               
                                              
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-6">
                                                        <input type="submit" name="submit" class="btn btn-primary" value="Search"> &nbsp;
                                                        
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
                 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-file"></i> Reports List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body table-responsive">
                                            
                              
                              
                              
                              <?php
                             
      
          $users_no_entry_more_then_7_days = "SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where 1 = 1" ;
          
          if(!empty($_REQUEST['gender']))
           {
              $users_no_entry_more_then_7_days.= " AND gender = '{$_REQUEST['gender']}'" ; 
           }
            
           $users_no_entry_more_then_7_days = db_select_query($users_no_entry_more_then_7_days." order by id desc");
           
          if($users_no_entry_more_then_7_days){  ?>
                                <table class="table table-bordered" id="example">
                                    <thead>
                                        <tr>
                                          
                                             <th>Sr No.</th>
                                             <th>Image</th>
                                            <th>User Name</th>
                                            <th>Package Name</th>
                                             <th>Payment Method</th>
                                             <th>Active Subscribers</th>
                                             <th>Package Start Date</th>
                                            <th>Expiry Date</th>
                                            <th>Package Duration</th>
                                              <th>Discount Code</th>
                                            <th>Package Amount</th>
                                            <th>Classes Count</th>
                                           <th>User Gender</th>
                                            <th>User Mobile</th>
                                            <th>Joined Date</th>
                                            <th>View</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                     $i = 1 ;
                                     $t = 0;
                 foreach($users_no_entry_more_then_7_days as $u)
          {   
                $count_ent = 0 ;
               $user_id = $u['id'] ;
              $uname = $u['name'] ;
                  $uemail = $u['email'] ;
                  $uclass = $u['package_class'] ;
               $pay_method = !empty($u['payment_method'])?$u['payment_method']:0 ; 
                $packages_id = explode(",",$u['packagesid']);
                $expiry_dates = explode(",",$u['expiry_dates']);
                foreach($packages_id as $key => $pck_id) {
                        $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                        $pck_name = $qry['name'] ;
                        $dr = $qry['duration'] ;
                      if(!empty($u['discount_code']) && !empty($u['after_discount_price']))
                         {
                          $dscnt_qry = db_select_query("select * from discount_code where id = '{$u['discount_code']}' ")[0] ;
                          $discnt_code = $dscnt_qry['code'] ;
                          $amnt =  $u['after_discount_price'] ;
                         }
                         else
                         {
                          $amnt = $qry['price'] ;  
                          $discnt_code = "" ;
                         }
                        $countfiles = count($expiry_dates);
                         $exp=$expiry_dates[$key] ;
                        $today_date = date('Y-m-d'); 
                         $get_act_sub  = db_select_query("SELECT * FROM users WHERE packagesid = '$pck_id' and package_class != '0' and expiry_dates >= '$today_date'  ") ;
                        $get_payment_method = db_select_query("select * from payment_methods where id = '$pay_method'")[0] ;
                        $eight_days_ago = date('Y-m-d', strtotime('-8 days', strtotime($today_date)));
                        $dts = $eight_days_ago ;
                        $currentDateTime = date('Y-m-d H:i:s');
                        $newDateTime = date('h:i A', strtotime($currentDateTime));
                        
           if(($uclass != '0') && ($exp >= $today_date)){ 
          for($k=1;$k<9;$k++)
              {
                  
                  $rec_date = date('Y-m-d', strtotime('+1 day', strtotime($dts)));
                  $check_enternace = db_select_query("select * from attendance where user_id = '$user_id' and date = '$rec_date'") ;
                  if(count($check_enternace))
                  {
                    
                  }
                  else
                  {
                     $count_ent += 1 ;   
                  }
                  
                  $dts = $rec_date ;
                
                  
                  
              }
             
              
              
           if($count_ent >= 8){
         
         
         ?> 
         
                                        <tr>
                                        
                                            <td><?=$i?></td>
                                             <td><img src="<?=$u['image']?>" width="50px" height="50px"></td>
                                             <td><?=$u['name']?></td>
                                             <td><?=$pck_name?></td>
                                              <td><?=$get_payment_method['name']?></td>
                                             <td><?php echo count($get_act_sub) ; ?></td>
                                             <td><?php echo date("d-m-Y" , strtotime($u['pck_start_date']))  ; ?></td>
                                              <td><?=date("d-m-Y" , strtotime($exp))?></td>
                                              <td><?=$dr?> Days</td>
                                               <td><?php echo $discnt_code ;  ?></td>
                                              <td><?=$amnt?> KD</td>
                                              <td><?=$u['package_class']?></td>
                                             <td><?=$u['gender']?></td>
                                               <td><?=$u['mobile']?></td>
                                               <td><?=date("d-m-Y" , strtotime(substr($u['created_at'], 0 ,10)))?></td>
                                             
                                            <td>
                                                <a class="btn btn-primary" href="view_user.php?id=<?=$u['id']?>">
                                                    <i class="fa fa-fw fa-eye"></i> View
                                                </a>
                                            </td>
                                            
                                        </tr>
                                         <?php
                                      $i++ ;
                                      $t+=$amnt;
                                      
           }
                                    } 
                                    }
                                    }?>
                                  
                                       
                                    </tbody>
                                   
                                </table>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                     <td><b>Subscribers Count - <?php echo $i-1 ;  ?></b></td>
                                    <td><b>Money Total - <?php echo $t ; ?> KD</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                              <?php
                              } 
                               ?>
                              
                              
                                  
                              
                              
                              
                              
                              
                              
                               
                              
                              
                              
                      
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
     <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
          <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/rooms.js" type="text/javascript"></script>
    
   




    <!-- end of page level js -->
</body>


</html>

<script>
 
   $(document).ready(function(){ 
       
       
      
      <?php
      if($_REQUEST['report_for'] == "Subscriptions Finished This Month") { ?>
      
         $('#pack').hide() ;
          $('#class').hide() ;
       
       <?php }
          ?>
          <?php
      if($_REQUEST['report_for'] == "Subscriptions Finished In 7 Days") { ?>
      
         $('#pack').hide() ;
          $('#class').hide() ;
       
       <?php }
          ?>
          <?php
      if($_REQUEST['report_for'] == "Finished Subscriptions") { ?>
      
         $('#pack').hide() ;
          $('#class').hide() ;
       
       <?php }
          ?>
          
          <?php
      if($_REQUEST['report_for'] == "New Users") { ?>
      
         $('#pack').hide() ;
          $('#class').hide() ;
       
       <?php }
          ?>
          
           <?php
      if($_REQUEST['package'] != "") { ?>
      
          $('#class').hide() ;
       
       <?php }
          ?>
          
          <?php
      if($_REQUEST['class'] != "") { ?>
      
          $('#pack').hide() ;
       
       <?php }
          ?>
    
     $('#report_for').change(function(){
        if($('#report_for').val() == 'New Users') {
          
            $('#pack').hide() ;
             $('#class').hide() ;
        }    
    });
    
     $('#report_for').change(function(){
        if($('#report_for').val() == 'Finished Subscriptions') {
          
            $('#pack').hide() ;
             $('#class').hide() ;
          
        } 
    });
    
     $('#report_for').change(function(){
        if($('#report_for').val() == 'Subscriptions Finished In 7 Days') {
          
            $('#pack').hide() ;
             $('#class').hide() ;
         
        } 
    });
    
     $('#report_for').change(function(){
        if($('#report_for').val() == 'Subscriptions Finished This Month') {
          
            $('#pack').hide() ;
             $('#class').hide() ;
           
             
        } 
    });
    
     $('#class').change(function(){
       
            $('#pack').hide() ;
            
           
             
         
    });
     
     $('#pack').change(function(){
       
            $('#class').hide() ;
            
           
             
         
    });
     
     
      $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
          
        ]
    } );

       
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
      
      
      
    
 });
  
  
</script>
