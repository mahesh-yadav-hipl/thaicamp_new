<?php
	include_once('config.php');
	include_once('google/vendor/autoload.php');
	
	//Create Client Request to access Google API
	$google_client = new Google_Client();
	$google_client->setApplicationName("bootcab");
	$google_client->setClientId($GOOGLE_APP_ID);
	$google_client->setClientSecret($GOOGLE_APP_SECRET);

	$google_permissions[]=Google_Service_Oauth2::PLUS_LOGIN;
	$google_permissions[]=Google_Service_Oauth2::PLUS_ME;
	$google_permissions[]=Google_Service_Oauth2::USERINFO_EMAIL;
	$google_permissions[]=Google_Service_Oauth2::USERINFO_PROFILE;
	
	$google_client->setScopes($google_permissions);
	
	
?>	
	
	