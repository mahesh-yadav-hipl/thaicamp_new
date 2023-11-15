<?php 
if(!session_id()) {
    session_start();
}
require_once 'facebook/vendor/autoload.php';


$facebook = new \Facebook\Facebook([
  'app_id'      => '202547160250895',
  'app_secret'     => 'e17c2e52fd68d2482709b62606cd601e',
  'default_graph_version'  => 'v2.10'
]);

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

// if (isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', "");
// }

if(isset($_GET['code']))
{
 
//   $access_token = $facebook_helper->getAccessToken();
  
  var_dump($facebook_helper); 
 
}



?>