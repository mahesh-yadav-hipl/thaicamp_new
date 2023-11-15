<style>
    .skiptranslate{display: none;}
</style>
<?php 


/******LANGUAGE COOKIE*******/

$cookie_name = "lang";

$lang=isset($_POST['lang'])?$_POST['lang']:'';
$googtrans=isset($_POST['googtrans'])?$_POST['googtrans']:'';

if($lang){
  
    $c_name = 'googtrans';
    $l_name = 'lang';
    // $domain_name =  DOMAIN ;
    $domain_name =  'thai-camp.com' ;
    
    unset($_COOKIE[$c_name]);
    unset($_COOKIE[$l_name]);
    // empty value and expiration one hour before
    $res = setcookie($c_name, '', time() - 3600, "/",".".$domain_name);
    $res1 = setcookie($l_name, '', time() - 3600, "/",".".$domain_name);
    $res1 = setcookie($c_name, '', time() - 3600, "/", ".thai-camp.com");
    
setcookie($cookie_name, $lang, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("googtrans", $googtrans, time() + (86400 * 30), "/"); // 86400 = 1 day

}
else{
	if(!isset($_COOKIE[$cookie_name])){
setcookie($cookie_name, "en_US", time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("googtrans", "/en/en", time() + (86400 * 30), "/"); // 86400 = 1 day
	}
}

if(isset($_COOKIE[$cookie_name])){
    $cookie_value = $_COOKIE[$cookie_name];
	if($lang){
		$cookie_value = $lang;
	}
}else{
	$cookie_value = "ar_AR";
} 




/*******LANGUAGE COOKIE CLOSE*********/

include_once('functions/functions.php');

if(!is_admin_login()){
    redirect('index.php');
}

if(!checkPageAccess()){
    redirect('dashboard.php');
}
$ids = $_SESSION['login_id'];
$ADMIN = db_select_query("SELECT * FROM admin WHERE id = $ids")[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Thaicamp</title>
    <link rel="shortcut icon" href="img/favicon.png" />
  <!-- global css -->
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/font-awesome.min.css" rel="stylesheet" />
    <link type="text/css" href="css/custom_css/metisMenu.css" rel="stylesheet" />
    <!-- Date picker -->
    <link href="vendors/air-datepicker-master/dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- end of global css -->
    <!-- page level css -->
    <link type="text/css" href="vendors/jquery-circliful/css/jquery.circliful.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="vendors/jquery-plugin-circliful-master/css/jquery.circliful.css"> -->
    <link type="text/css" href="vendors/progressbar/css/bootstrap-progressbar.min.css" rel="stylesheet">
    <link type="text/css" href="vendors/fullcalendar/css/fullcalendar.css" rel="stylesheet">
    <link type="text/css" href="vendors/select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link type="text/css" href="css/custom_css/calendar_custom.css" rel="stylesheet">
    <link type="text/css" href="vendors/sweetalert/dist/sweetalert2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="vendors/nvd3chart/nv.d3.min.css">
    <link type="text/css" href="css/custom_css/fitness.css" rel="stylesheet" />
    <link type="text/css" href="css/custom_css/panel.css" rel="stylesheet" />
    <link type="text/css" href="css/custom_css/admin_dashboard.css" rel="stylesheet">
     <link type="text/css" href="css/custom_css/timings.css" rel="stylesheet" />
      <link type="text/css" href="css/custom_css/panel.css" rel="stylesheet" />
    <link type="text/css" href="css/custom_css/coupon.css" rel="stylesheet">
    
      <link rel="stylesheet" type="text/css" href="css/toaster.min.css">
    
    <!-- end of page level css -->
        <link type="text/css" href="vendors/summernote/summernote.css" rel="stylesheet" media="screen" />
    <style>
        a.logo img {
            width:251px !important;
    background-color: #fff;
        margin-bottom: 30px;
}
   .goog-tooltip {
    display: none !important;
}
.goog-tooltip:hover {
    display: none !important;
}
.goog-text-highlight {
    background-color: transparent !important;
    border: none !important; 
    box-shadow: none !important;
}
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    }
    body {
    top: 0px !important; 
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px 17px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
    
    
    </style>
</head>