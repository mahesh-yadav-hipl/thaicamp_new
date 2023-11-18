<?php $birthday_notification = db_select_query("select * from users") ;
$ids_login_id = $_SESSION['login_id'] ;
$userAdmin = db_select_query("SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where id = '$ids_login_id'")[0];?>
<style>
    body > .header .navbar .sidebar-toggle {
    margin-left: 79px!important;
}
</style>
    
    <header class="header">
        <nav class="navbar navbar-static-top">
            <a href="dashboard.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/logo.png" alt="image not found">
            </a>
            <!-- Header Navbar: style can be found in header-->
            <!-- Sidebar toggle button-->
            <!-- Sidebar toggle button-->
            <div>
                <a style="position:absolute;right:5px;top:5px;" href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw fa-navicon"></i>
                </a>
            </div>
            <div class="navbar-right">
                <ul style="padding-right:40px" class="nav navbar-nav">
            <?php if($_SESSION['login_type'] === "admin" || $_SESSION['login_type'] === "subscriber"){?>   
            <li>
                <div style="padding: revert;
                        margin-top: 17px;
                        margin-right: 15px;
                        font-size: 21px;
                    ">
                    <a href="checkout.php">
                    <?php $cart_header_qty = 0;
                     if (isset($_SESSION['cart'])) {
                        $cart_header_qty = count($_SESSION['cart']);
                    }?>
                <i class="fa fa-shopping-cart text-default" aria-hidden="true"></i>
                    <span class="cart_count_header" style="position: absolute;
                                            font-size: 10px;
                                            background: #ff931d;
                                            border-radius: 50%;
                                            width: 17px;
                                            height: 17px;
                                            text-align: center;
                                            line-height: 19px;
                                            top: 9px;
                                            color: #fff;
                                            right: 2px;"><?php echo $cart_header_qty;?></span>
                                            </a>
                </div>
            </li>
            <?php } ?>

            <li>
              
                 <form action="" method="post">
                    <?php if($cookie_value == "en_US"){ ?>
                      <input type="hidden" name="lang" value="ar_AR">
                        <input type="hidden" name="googtrans" value="/en/ar">
                        <button type="submit" class="lan-btn"><li>
                            <!-- <img src = "img/ar_flag.png" width="50px"> -->
                            <img src = "img/ar_img.png">
                            <!-- &nbsp;&nbsp;AR&nbsp;&nbsp; -->
                        </li></button>
                        <?php } else { ?>
                        <input type="hidden" name="lang" value="en_US">
                        <input type="hidden" name="googtrans" value="/en/en">
                        <button type="submit" class="lan-btn"><li>
                            <!-- <img src = "img/en_flag1.png" width="50px"> -->
                            <img src = "img/en_img.png" >
                            <!-- <span style="margin-top: 10px;">&nbsp;&nbsp;EN&nbsp;&nbsp;</span> -->
                        </li></button>
                        <?php } ?>
                </form>
            </li>
                                            
                                            
            <li class="dropdown notifications-menu">
                        
                        <!--<div class="riot">-->
                        <!--        <div>-->
                        <!--            <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--    ع-->
                        
                        <!--</a>-->
                                   
                        <!--        </div>-->
                        <!--    </div>-->
                        </li>
                    <!-- Notifications: style can be found in dropdown-->
                    <!-- <?php if($_SESSION['login_type'] === "admin"){ ?>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-fw fa fa-birthday-cake black1"></i>
                                <span id="total_count" class="label label-warning"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                            <li class="dropdown-title">You have <span id ="tcnt"></span> notification</li>
                            <?php foreach($birthday_notification as $noti) { 
                            $bdy = substr($noti['date_of_birth'], 5 , 10) ;
                            $today_date = substr(date('Y-m-d') , 5, 10); 
                        
                            if($bdy == $today_date)
                            {
                            
                            ?>
                                <li>
                                    <a href="edit_user.php?id=<?php echo $noti['id'] ?>" class="message icon-not striped-col">
                                        <i class="fa fa-fw fa-user info"></i>
                                        <div class="message-body">
                                            <strong><?=$noti['name']?></strong>
                                            <br>Birthday Today
                                            <br>
                                        
                                        </div>
                                    </a>
                                </li>
                            
                        <?php  }
                            }?>
                            </ul>
                        </li>
                    <?php }?> -->
                    <li>
                        <div style="margin-top: 10px;">
                            <?php
                                if($userAdmin['image']!='' && @getimagesize($userAdmin['image'])){ 
                                    $image = $userAdmin['image'];
                                }else{
                                    $image = URL.'uploaded/users/default-user.jpg';
                                }
                            ?>
                            <img src="<?=$image?>" width="25px" height="25px">
                        </div>
                    </li>
                    <!-- User Account: style can be found in dropdown-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                            <div style="margin-left: -45px;" class="riot">
                                <div>
                                   <?=$userAdmin['name']?>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <style>
    a.logo img
{
    width:251px !important;
    background-color: #fff;
    margin-bottom: 0px; 
   
}
        @media only screen and (max-width:768px)
{
    a.logo img
    {
        width: 170px!important;
        background-color: #fff;
        margin-bottom: 0px; 
        height: 60px;
    }    
}
.lan-btn
{
    background:transparent;
    border:none;
    color:#fff;
    line-height:3.5;
}
.lan-btn img
{
   
}
.lan-btn:active, .lan-btn:visited, .lan-btn:focus
{
    border:none!important; 
    outline:none!important;
}

    </style>
     <script src="js/jquery.min.js" type="text/javascript"></script>
    <script>
     var cnt =  $('ul.dropdown-messages li').length ;
     var c = cnt - 1 ;
     $('#total_count').text(c) ;
     $('#tcnt').text(c) ;
    </script>
    
    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
