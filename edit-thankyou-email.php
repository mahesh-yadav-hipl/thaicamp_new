<?php include('head.php') ;

$get_register_email =  db_select_query("SELECT * FROM email_format where type = 'Register'")[0] ;
$get_renewal_email =  db_select_query("SELECT * FROM email_format where type = 'Renewal'")[0] ;
$get_thankyou_email =  db_select_query("SELECT * FROM email_format where type = 'Thankyou'")[0] ;
$get_reminder_email =  db_select_query("SELECT * FROM email_format where type = 'Reminder'")[0] ;
$get_special_email =  db_select_query("SELECT * FROM email_format where type = 'Special'")[0] ;

?>
 <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <style>
     .note-editor.note-frame .note-editing-area {
    overflow: hidden;
    height: 250px;
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
                <h2>Thankyou Email</h2>
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
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-envelope"></i> Edit Email
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                      <div role="tabpanel">
                                            <div class="tab-content">
                                                 <div role="tabpanel" class="tab-pane active" id="social1">
                                                    <div class="row">
                                                      <form id="edit-email-thankyou-form"  method="post" action="ajax/update-email_format.php"  onsubmit="return false;"  enctype="multipart/form-data" >    
                                                      
                                                     <input type="hidden" name="id" value="<?=$get_thankyou_email['id']?>" >
                                                        <div class="col-md-12 col-sm-8">
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" id="users">
                                                                         <tr>
                                                                            <td>Subject</td>
                                                                            <td>
                                                                                <input type="text" name="subject" class="form-control" value="<?=$get_thankyou_email['subject']?>" >
                                                                            </td>
                                                                        </tr>
                                                                        <!--<tr>-->
                                                                        <!--    <td>Greeting</td>-->
                                                                        <!--    <td>-->
                                                                        <!--        <input type="text" name="greeting" class="form-control" value="<?=$get_thankyou_email['greeting']?>" >-->
                                                                        <!--    </td>-->
                                                                        <!--</tr>-->
                                                                        <!--<tr>-->
                                                                        <!--    <td>Intro/Purpose</td>-->
                                                                        <!--    <td>-->
                                                                        <!--       <input type="text" name="intro" class="form-control" value="<?=$get_thankyou_email['intro']?>" >-->
                                                                        <!--    </td>-->
                                                                        <!--</tr>-->
                                                                        <tr>
                                                                            <td>Detail</td>
                                                                            <td>
                                                                               <textarea id="thankyou_detail" rows="8" name="detail" class="form-control" ><?=$get_thankyou_email['detail']?></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <!--<tr>-->
                                                                        <!--    <td>Closing/Sign-off</td>-->
                                                                        <!--    <td>-->
                                                                        <!--       <input type="text" name="closing" class="form-control" value="<?=$get_thankyou_email['closing']?>" >-->
                                                                        <!--    </td>-->
                                                                        <!--</tr>-->
                                                                        
                                                                    </table>
                                                                      
                                                                </div>
                                                                <div id="show_thankyou">
                                                                    <label>Template :</label>
                                                                    <table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
        	<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
        		<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
        			valign="top"></td>
        				<td class="container" width="600"
        					style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
        					valign="top">
        					<div class="content"
        						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
        						<table class="main" width="100%" cellpadding="0" cellspacing="0"
        							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
        							   background-color="#fff">
        							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
        								<td class="alert alert-warning"
        									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
        									align="center" background-color="#71b6f9" valign="top">
        									<img style="width:330px;" src="<?php echo SITE_LOGO ; ?>" alt="" >
        								</td>
        							</tr>
        							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
        								<td class="content-wrap"
        									style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
        									valign="top">
        								</td>
        							</tr>
        							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
        								<td class="content-wrap"
        									style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
        									valign="top">
        									<h3><?php echo $get_thankyou_email['greeting'] ; ?></h3>
        									<p><?php echo $get_thankyou_email['intro'] ; ?></p>
        									<p><?php echo $get_thankyou_email['detail'] ; ?></p>
        									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
        											<b><?php echo $get_thankyou_email['closing'] ; ?></b>   
        										</p>
        									</p>
        								</td>
        							</tr>
        						</table>
        					</div>
        				</td>
        				<td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
        					valign="top"></td>
        			</tr>
        		</table>
                                                                </div>
                                                                <div style="text-align: center;" class="">
                                                                        <button type="submit" class="btn btn-primary">Update</button> &nbsp;
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
                    </div>
                </div>
                 
               
                
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
   
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</body>


</html>
<script>
 
   $(document).ready(function(){ 
        $('#register_detail').summernote();
         $('#renewal_detail').summernote();
          $('#thankyou_detail').summernote();
           $('#reminder_detail').summernote();
           $('#special_detail').summernote();
       
       $('#show_register').hide() ;
       $('#show_renewal').hide() ;
       $('#show_thankyou').show() ;
       $('#show_reminder').hide() ;
        $('#show_special').hide() ;
       
       $('#view_register').click(function(){
         $('#show_register').toggle() ;  
       }) ;
       
       $('#view_renewal').click(function(){
         $('#show_renewal').toggle() ;  
       }) ;
       
    //     $('#view_thankyou').click(function(){
    //      $('#show_thankyou').toggle() ;  
    //   }) ;
       
       $('#view_reminder').click(function(){
         $('#show_reminder').toggle() ;  
       }) ;
        $('#view_special').click(function(){
         $('#show_special').toggle() ;  
       }) ;
       
         $('.active_special_email').click(function(){
       var spcl_status = $(this).val() ;
       if($(this).prop('checked') == true)
       {
           $.ajax({
                    url:'ajax/send_special_email.php',
                    type:'POST',
                    data:'spcl_status='+spcl_status,
                    success: function(response){
                        var json = $.parseJSON(response);
                        var cnt = json.cnt ;
                          if(json.result)
                          {
                             
                      toastr.success('Special Email Marked Active') ; 

                     setTimeout(function(){ 
                        location.href=""; 
                     }, 1500); 
                     
                          }
                          else
                          {
                               toastr.error('Something went wrong') ; 
                          }
                    },              
                    error:function(response){
                        toastr.error(response.message);                  
                    },          
                }) ;   
       }
       
       else
       {
           $.ajax({
                    url:'ajax/change_status_nonactive_for_sepcial_email.php',
                    type:'POST',
                    data:'spcl_status='+spcl_status,
                    success: function(response){
                        var json = $.parseJSON(response);
                        var cnt = json.cnt ;
                          if(json.result)
                          {
                       
                       toastr.success('Special Email Marked Non Active') ; 

                     setTimeout(function(){ 
                        location.href=""; 
                     }, 1500); 
                          }
                          else
                          {
                             toastr.error('Something went wrong') ; 
                          }
                    },              
                    error:function(response){
                        toastr.error(response.message);                  
                    },          
                }) ; 
       }
        
    });
       
        $("#edit-email-register-form").validate({
         rules:{
      subject:{
            required:true,
    
        },
         greeting:{
            required:true,
    
        },
         intro:{
            required:true,
    
        },
        detail:{
            required:true,
    
        },
         closing:{
            required:true,
    
        },
        
    
},
messages:{
  subject:{
            required:"Enter Subject",
    
        },
         greeting:{
            required:"Enter Greeting",
    
        },
         intro:{
            required:"Enter Intro",
    
        },
        detail:{
            required:"Enter Detail",
    
        },
         closing:{
            required:"Enter Closing",
    
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
                     }, 1500);                      
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
 $("#edit-email-renewal-form").validate({
         rules:{
      subject:{
            required:true,
    
        },
         greeting:{
            required:true,
    
        },
         intro:{
            required:true,
    
        },
        detail:{
            required:true,
    
        },
         closing:{
            required:true,
    
        },
        
    
},
messages:{
  subject:{
            required:"Enter Subject",
    
        },
         greeting:{
            required:"Enter Greeting",
    
        },
         intro:{
            required:"Enter Intro",
    
        },
        detail:{
            required:"Enter Detail",
    
        },
         closing:{
            required:"Enter Closing",
    
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
                     }, 1500);                      
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
      
      
      
       $("#edit-email-thankyou-form").validate({
         rules:{
      subject:{
            required:true,
    
        },
         greeting:{
            required:true,
    
        },
         intro:{
            required:true,
    
        },
        detail:{
            required:true,
    
        },
         closing:{
            required:true,
    
        },
        
    
},
messages:{
  subject:{
            required:"Enter Subject",
    
        },
         greeting:{
            required:"Enter Greeting",
    
        },
         intro:{
            required:"Enter Intro",
    
        },
        detail:{
            required:"Enter Detail",
    
        },
         closing:{
            required:"Enter Closing",
    
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
                     }, 1500);                      
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
      
      
      
       $("#edit-email-reminder-form").validate({
         rules:{
      subject:{
            required:true,
    
        },
         greeting:{
            required:true,
    
        },
         intro:{
            required:true,
    
        },
        detail:{
            required:true,
    
        },
         closing:{
            required:true,
    
        },
        
    
},
messages:{
  subject:{
            required:"Enter Subject",
    
        },
         greeting:{
            required:"Enter Greeting",
    
        },
         intro:{
            required:"Enter Intro",
    
        },
        detail:{
            required:"Enter Detail",
    
        },
         closing:{
            required:"Enter Closing",
    
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
                     }, 1500);                      
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
      
      
      
        $("#edit-email-special-form").validate({
         rules:{
      subject:{
            required:true,
    
        },
         greeting:{
            required:true,
    
        },
         intro:{
            required:true,
    
        },
        detail:{
            required:true,
    
        },
         closing:{
            required:true,
    
        },
        
    
},
messages:{
  subject:{
            required:"Enter Subject",
    
        },
         greeting:{
            required:"Enter Greeting",
    
        },
         intro:{
            required:"Enter Intro",
    
        },
        detail:{
            required:"Enter Detail",
    
        },
         closing:{
            required:"Enter Closing",
    
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
                     }, 1500);                      
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
  
  
</script>
<style>
    .btn-default:hover, .default:hover, .tags a.default:hover
    {
        width:auto!important;
    }
    .panel-heading.note-toolbar .note-color .dropdown-toggle
    {
        width:20px!important;
    }
    
</style>