<?php include_once('./functions/functions.php');  ?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
        <title>Thaicamp</title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- global level css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- end of global css-->
    <!-- page level styles-->
    <link href="vendors/iCheck/skins/all.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="vendors/bootstrapvalidator/dist/css/bootstrapValidator.css" rel="stylesheet" />
    <link href="css/custom_css/login.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <!-- end of page level styles-->
    <style>
        .account_info_btns{
            padding-top:20px;
            text-align: center;
        }
        .login-screen .form-group .form-control[type="file"]{
            padding: 15px;
        }
        #birth_date {
    position: relative;
}

#birth_date[type="date"]::-webkit-calendar-picker-indicator {
    background-position:top 15px right 15px;
    background-size: auto;
    cursor: pointer;
    position: absolute;
    z-index: 9;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    width: 100%;
    height: 100%;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="full-content-center login-screen">
            <div class="box bounceInLeft animated">
                <img src="img/logo.png" class="logo" alt="image not found">
                <h3>Hello Welcome to the <span>ThaiCamp!</span></h3>
                <form class="form" id="log_in_form" method="post"  onsubmit="return false;"  action="ajax/registration_subscriber.php" autocomplete="off">
                    <input type="hidden" name="table" value="users" >   
                    <div class="form-group">
                        <label>Name</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/user-icon.svg" alt="icon"></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/email.svg" alt="icon"></span>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/mobile-icon.svg" alt="icon"></span>
                            <input type="number" class="form-control" name="mobile" placeholder="Mobile Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/date-icon.svg" alt="icon"></span>
                            <input type="date" id="birth_date" class="form-control" max="<?= date('Y-m-d'); ?>" name="date_of_birth" placeholder="Date of Birth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/gender-icon.svg" alt="icon"></span>
                            <select class="form-control" name="gender" required>
                                <option value="">Select Gender</option>  
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Profile Image</label>
                        <div class="input-group">
                            <!-- <span class="icon-left"><img src="img/email.svg" alt="icon"></span> -->
                            <input type="file" name="image"  accept="image/*" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/lock.svg" alt="icon"></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <span class="icon-left"><img src="img/lock.svg" alt="icon"></span>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                        </div>    
                    </div>
                    <button type='submit' class="btn btn-block btn-warning btn-loader">Register</button>
                    <div class="form-group">
                        <div class="row">                            
                            <div class="col-xs-12 account_info_btns">
                                <p class="forgetlink">Already have an account?<a href="index.php" class=""> Login</a></p>
                            </div>
                        </div>
                     </div>
                </form>
               
            </div>
        </div>
    </div>
    <!-- global js -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
    <script src="vendors/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="js/custom_js/login1.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="js/custom-script.min.js"></script>
    <!-- end of page level js -->
    <script>
        
		$('#log_in_form').validate({
            rules:{
            "name":"required",
			"email":"required",
			"mobile":"required",
			"date_of_birth":"required",
			"gender":"required",
			"image":"required",
			"password":"required",
			"confirm_password":"required"
            },
            messages:{
			"name":"Please enter Name",
			"email":"Please enter Email",
			"mobile":"Please enter Mobile Number",
			"date_of_birth":"Please select Date of Birth",
			"gender":"Please select Gender",
			"image":"Please select Image",
			"password":"Please enter password",
			"confirm_password":"Please enter confirm password"
            },
             
            errorElement : 'div',
            submitHandler: async (form, event)=>{
                event.preventDefault();
                $('.btn-loader').prop('disabled', true);
                startLoader($(form).find('.btn-loader'), $(form));
                var data = new FormData($(form)[0]);
                try {
                    var response=await fetch(form.action,{
                                    method:form.method, 
                                    body: data, 
                                    dataType:'JSON',
                                    credentials: 'same-origin',
                                });
                    
                    var json= await response.json();
                    if (json.result){
                        toastr.success(json.message);
                        setTimeout(function(){ location.href='index.php'; }, 1500);
                    }else{
                        toastr.info(json.message);
                    }    
                }catch(err) {
                        toastr.error(JSON.stringify(err));
                }
                $('.btn-loader').prop('disabled', false);
                endLoader($(form).find('.btn-loader'),$(form));    
            }
        });



    </script>
    
</body>

</html>
