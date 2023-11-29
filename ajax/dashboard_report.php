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

if($_REQUEST['report_type'] == "waiting_list"){
    $get_all_list =  db_select_query("SELECT waiting_list.*,classes.name as classes_name FROM waiting_list INNER JOIN classes ON classes.id = waiting_list.class_id ORDER BY waiting_list.id DESC") ;
    
    if($_REQUEST['count_report'] == "count"){
        $json['result_type']="result_count";
        $html_report =  count($get_all_list);
    }
    if($_REQUEST['count_report'] == "list_show"){
        $json['result_type']="list_show";
        $html_report =  "";
        if(count($get_all_list) > 0){ 
            $html_report .= "<table><tr><th>Name</th><th>Mobile No.</th><th>Class Name</th></tr>";
               foreach($get_all_list as $user_row){
                     $html_report .= "<tr><td>". $user_row['name']."</td><td>".$user_row['contact']."</td>
                            <td>".$user_row['classes_name']."</td>                            
                            </tr>";
               }
               $html_report .="</table>";
        }
    }
    $json['result']=true;
    $json['message']=$html_report;
    echo json_encode($json);exit;	
}
if($_REQUEST['report_type'] == "active_subscriber_list"){
    $tdtt = date('Y-m-d');
    $users_query = db_select_query("SELECT *  FROM users WHERE package_class != '0' and expiry_dates >= '$tdtt'  ") ;
    if($_REQUEST['count_report'] == "count"){
        $json['result_type']="result_count";
        $html_report =  count($users_query);
    }
    if($_REQUEST['count_report'] == "list_show"){
        $json['result_type']="list_show";
        $html_report =  "";
        if(count($users_query) > 0){ 
            $html_report .= "<table><tr><th>Name</th><th>Email</th><th>Mobile No.</th><th>View</th></tr>";
            foreach($users_query as $user_row){
                  $html_report .= "<tr><td>". $user_row['name']."</td><td>".$user_row['email']."</td>
                         <td>".$user_row['mobile']."</td>
                         <td align='center'><a class='btn btn-success btn-sm' href='view_user.php?id=".$user_row['id']."' style='margin: 5px 0px;'>View</a></td>
                         </tr>";
            }
            $html_report .="</table>";
        }
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







// No entry more than 7 days
if($_REQUEST['report_type'] == "no_entry_more_than_seven_days"){
    $users_no_entry_more_then_7_days = "SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where 1 = 1" ;
    $users_no_entry_more_then_7_days = db_select_query($users_no_entry_more_then_7_days." order by id desc");
    $count_no_entry_more_then_7_days = 0;
    if($users_no_entry_more_then_7_days){ 
        $ikl = 1 ;
        $t = 0;
        foreach($users_no_entry_more_then_7_days as $u)
        {   
            $count_ent = 0 ;
            $user_id = $u['id'] ;
            $uname = $u['name'] ;
            $uemail = $u['email'] ;
            $uclass = $u['package_class'] ;
            $pay_method = !empty($u['payment_method'])?$u['payment_method']:0 ; 
            $packages_id = explode(",",$u['packagesid']);
            $expiry_dates = explode(",",$u['expiry_dates']);
            foreach($packages_id as $key => $pck_id) 
            {
                $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                $pck_name = $qry['name'] ;
                $dr = $qry['duration'] ;
                if(!empty($u['discount_code']) && !empty($u['after_discount_price']))
                {
                    $dscnt_qry = db_select_query("select * from discount_code where id = '{$u['discount_code']}' ")[0] ;
                    $discnt_code = $dscnt_qry['code'] ;
                    $amnt =  $u['after_discount_price'] ;
                }else
                {
                    $amnt = $qry['price'] ;  
                    $discnt_code = "" ;
                }
                $countfiles = count($expiry_dates);
                $exp=$expiry_dates[$key] ;
                $today_date = date('Y-m-d'); 
                $get_act_sub  = db_select_query("SELECT * FROM users WHERE packagesid = '$pck_id' and package_class != '0' and expiry_dates >= '$today_date'  ") ;
                $get_payment_method = db_select_query("select * from payment_methods where id = '$pay_method'")[0] ;
                $eight_days_ago = date('Y-m-d', strtotime('-8 days', strtotime($today_date)));
                $dts = $eight_days_ago ;
                $currentDateTime = date('Y-m-d H:i:s');
                $newDateTime = date('h:i A', strtotime($currentDateTime));
                
                if(($uclass != '0') && ($exp >= $today_date)){ 
                    for($k=1;$k<9;$k++)
                    {                 
                        $rec_date = date('Y-m-d', strtotime('+1 day', strtotime($dts)));
                        $check_enternace = db_select_query("select * from attendance where user_id = '$user_id' and date = '$rec_date'") ;
                        if(count($check_enternace)){}
                        else{ $count_ent += 1 ;}
                        $dts = $rec_date ;
                    }
                    if($count_ent >= 8){
                        $count_no_entry_more_then_7_days = $ikl ;
                        $ikl++ ;
                        $t+=$amnt;
                    }
                } 
            }
        }
    } 

    if($_REQUEST['count_report'] == "count"){
        $json['result_type']="result_count";
        $html_report =  $count_no_entry_more_then_7_days;
    }
    // if($_REQUEST['count_report'] == "list_show"){
    //     $json['result_type']="list_show";
    //     $html_report =  "";
    //     if(count($users_query) > 0){ 
    //         $html_report .= "<table><tr><th>Name</th><th>Email</th><th>Mobile No.</th><th>View</th></tr>";
    //         foreach($users_query as $user_row){
    //               $html_report .= "<tr><td>". $user_row['name']."</td><td>".$user_row['email']."</td>
    //                      <td>".$user_row['mobile']."</td>
    //                      <td align='center'><a class='btn btn-success btn-sm' href='view_user.php?id=".$user_row['id']."' style='margin: 5px 0px;'>View</a></td>
    //                      </tr>";
    //         }
    //         $html_report .="</table>";
    //     }
    // }
    $json['result']=true;
    $json['message']=$html_report;
    echo json_encode($json);exit;



}

// No entry more than 7 days





?>