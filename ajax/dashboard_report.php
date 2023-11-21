<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array('result'=>false,'message'=>"Something went wrong");
extract($_REQUEST);



if($_REQUEST['report_type'] == "hold_subscribers"){
    $users_query_hold_sub =  db_select_query("SELECT  *  FROM users WHERE package_class != '0' and hold_status = 'Hold'") ;
    $html_report = "";
     if(count($users_query_hold_sub) > 0){ 
        $html_report .= "<table><tr><th>Name</th><th>Email</th><th>Mobile No.</th><th>View</th></tr>";
           foreach($users_query_hold_sub as $package_user_hold){
                 $html_report .= "<tr><td>". $package_user_hold['name']."</td><td>".$package_user_hold['email']."</td>
                        <td>".$package_user_hold['mobile']."</td>
                        <td align='center'><a class='btn btn-success btn-sm' href='view_user.php?id=".$package_user_hold['id']."' style='margin: 5px 0px;'>View</a></td>
                        </tr>";
           }
           $html_report .="</table>";
    }
    $json['result']=true;
    $json['message']=$html_report;
    echo json_encode($json);exit;	
}



?>