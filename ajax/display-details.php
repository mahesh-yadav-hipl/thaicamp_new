<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
// include_once('../functions/functions.php');
include('../functions/_database.php'); 
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);
/// edit data
if(isset($_POST['userId'])){
    $userId= $_POST['userId'];
   
   $fetchData =fetchDataById($userId);
   displayData($fetchData );
}

function fetchDataById($userId){

  $products = db_select_query("SELECT u.packagesid AS user_id, u.pck_start_date as start_date, u.expiry_dates as end_date, p.name as package_name, p.duration as package_duration FROM users As u 
  LEFT JOIN packages AS p
  ON u.packagesid = p.id
  WHERE u.id='$userId' ");
  // echo '<pre>';  print_r($products);
  return $products[0];
  
}

function displayData($fetchData){
  echo '<table border="1" cellspacing="5" cellpadding="5">';
  if(count($fetchData)>0){
  echo "<tr>
          <td>
          <input type='hidden' name='package_id' value='".$fetchData['user_id']."'>
          Package Name</td><td>".$fetchData['package_name']."</td></tr>
          <tr><td>Package Start Date</td><td>".$fetchData['start_date']."</td></tr>
          <tr><td>Package End Date</td><td>".$fetchData['end_date']."</td></tr>
          <tr><td>Package Duration</td><td>".$fetchData['package_duration']."</td>

   </tr>";
     }
else{
     
  echo "<tr>
        <td colspan='7'>No Data Found</td>
       </tr>"; 
}
  echo "</table>";
}
?>