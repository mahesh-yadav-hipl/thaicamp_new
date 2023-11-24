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


if($_REQUEST['report_type'] == "today_visitor"){
    $tdtt = date('Y-m-d'); 
    $getAll_attendence =  db_select_query("SELECT attendance.*,users.name as user_name, users.email as user_email, users.mobile as user_mabile
                            FROM attendance
                            LEFT JOIN users ON users.id = attendance.user_id
                            Where attendance.date BETWEEN '$tdtt' AND '$tdtt'");
    $html_report = "";
     if(count($getAll_attendence) > 0){ 
        $html_report .= "<table><tr><th>Name</th><th>Email</th><th>Mobile No.</th><th>View</th></tr>";
           foreach($getAll_attendence as $user_row){
                 $html_report .= "<tr><td>". $user_row['user_name']."</td><td>".$user_row['user_email']."</td>
                        <td>".$user_row['user_mabile']."</td>
                        <td align='center'><a class='btn btn-success btn-sm' href='entry_list.php?id=".$user_row['user_id']."' style='margin: 5px 0px;'>View</a></td>
                        </tr>";
           }
           $html_report .="</table>";
    }
    $json['result']=true;
    $json['message']=$html_report;
    echo json_encode($json);exit;	
}


if($_REQUEST['report_type'] == "deactivate_user"){
        $_ACTIVEDEACTIVE['is_deactivate'] = $_REQUEST['active_deactive_type'];
        $data['table']='users';
        $data['values']=$_ACTIVEDEACTIVE;
        $data['where']['id']=$_REQUEST['user_id'];

        if(db_update($data)){
            $json['result']=true;
            $json['message']="SuccessFully Deactivate";
            echo json_encode($json);exit;
        }
        $json['result']=true;
        $json['message']="SuccessFully Deactivate";
        echo json_encode($json);exit;

}


?>