<?php 
include_once('config.php');
include_once('_logs.php');
include_once('_database.php');
include_once('_files.php');
include_once('_comman.php');
include_once('_login.php');
include_once('_email.php');
include_once('_sms.php');
include_once('_notification.php');
include_once('_api.php');


if(isset($_REQUEST['lang'])){
    unset($_REQUEST['lang']);
}

if(isset($_REQUEST['googtrans'])){
    unset($_REQUEST['googtrans']);
}


if(isset($_REQUEST['PHPSESSID'])){
    unset($_REQUEST['PHPSESSID']);
}

if(isset($_REQUEST['timezone'])){
    unset($_REQUEST['timezone']);
}

if(isset($_REQUEST['cpsession'])){
    unset($_REQUEST['cpsession']);
}

if(isset($_REQUEST['G_ENABLED_IDPS'])){
    unset($_REQUEST['G_ENABLED_IDPS']);
}

if(isset($_REQUEST['admin_login'])){
    unset($_REQUEST['admin_login']);
}

if(isset($_REQUEST['G_AUTHUSER_H'])){
    unset($_REQUEST['G_AUTHUSER_H']);
}
?>