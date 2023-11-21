<?php include('head.php');

include('salary_calculate.php');
 if($_SESSION['login_type'] === "employee" || $_SESSION['login_type'] === 'subscriber') { 
    redirect(URL.'user-profile.php');
  // Start subscriber and employee we do not need and qeury
 }else{

$tdtt = date('Y-m-d'); 
$users_query = db_select_query("SELECT  COUNT(id) as count_id  , COUNT(DISTINCT(packagesid)) AS count_packagesid  FROM users WHERE package_class != '0' and expiry_dates >= '$tdtt'  ") ;
$count_users = $users_query[0]['count_id'] ;
// $count_packages = $users_query[0]['count_packagesid'] ;
// $get_all_users = db_select_query($users_query." limit 5") ;

$time=strtotime($tdtt);
$month=date("m",$time);
$year=date("Y",$time);

$expeses_query =  db_select_query("select SUM(price) as total_expenses from expenses where YEAR(date(date)) = '$year' AND MONTH(date(date)) = '$month' ") ;
$total_expeses = $expeses_query[0]['total_expenses'] ;

// total hold subscription
// $users_query_hold_sub = db_select_query("SELECT  *  FROM users WHERE package_class != '0' and hold_status = 'Hold'") ;
$users_query_hold_sub = db_select_query("SELECT  COUNT(id) as count_id  FROM users WHERE package_class != '0' and hold_status = 'Hold'") ;
$count_hold_subscription_users = $users_query_hold_sub[0]['count_id'] ;


$packages_query  = db_select_query("SELECT DISTINCT(packagesid)  FROM users WHERE package_class != '0' and expiry_dates >= '$tdtt'  ") ;
$qrcls = db_select_query("SELECT class_id  FROM users WHERE package_class != '0' and expiry_dates >= '$tdtt'  ") ;
$i = 0 ;
$get_arr=array();

foreach($qrcls as $cid[$i])
{
   $c = $cid[$i]['class_id'] ;
//   if (strpos($c, ',') !== false)
//  {
//   $clsid = explode(',', $c);
//   array_push($get_arr,$clsid[$i]);
  
// }
// else
// {
   array_push($get_arr,$c); 
//}
 $i++ ;
}
$ar = array_unique($get_arr);
$un = array() ;
foreach($ar as $a)
{
  if(strpos($a, ',') !== false)
{
  $clsid = explode(',', $a);
  foreach($clsid as $in)
  {
       array_push($un,$in);
  }
  
} 
else
{
    array_push($un,$a);  
}
}

$new_arr = array_unique($un);

// print_r($new_arr) ;
// exit() ;

// $count_packages1 = count(db_select_query($packages_query)) ;
// $get_all_packages = db_select_query($packages_query." limit 5");


// $subadmins_query = "SELECT * from admin where type = 'sub-admin' order by id desc" ;
// $count_subadmins = count(db_select_query($subadmins_query)) ;
// $get_all_subadmins = db_select_query($subadmins_query." limit 5");


// $get_all_discount_code = db_select_query("select * from discount_code"); 


$birthday_notification1 = db_select_query("select * , CONCAT('".URL."uploaded/users/', image) AS image from users") ;


$users_no_entry_more_then_7_days = "SELECT * , CONCAT('".URL."uploaded/users/', image) AS image FROM users where 1 = 1" ;
 $users_no_entry_more_then_7_days = db_select_query($users_no_entry_more_then_7_days." order by id desc");
           
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
                foreach($packages_id as $key => $pck_id) {
                        $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                        $pck_name = $qry['name'] ;
                        $dr = $qry['duration'] ;
                      if(!empty($u['discount_code']) && !empty($u['after_discount_price']))
                         {
                          $dscnt_qry = db_select_query("select * from discount_code where id = '{$u['discount_code']}' ")[0] ;
                          $discnt_code = $dscnt_qry['code'] ;
                          $amnt =  $u['after_discount_price'] ;
                         }
                         else
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
                  if(count($check_enternace))
                  {
                    
                  }
                  else
                  {
                     $count_ent += 1 ;   
                  }
                  
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

// End subscriber and employee we do not need and qeury
  }
  
  

function getActiveEmployeePt($emp_id, $emp_name){

    $q = "SELECT id FROM  private_training Where employee_id=$emp_id AND pt_end_date >= Now() AND pt_end_date is not null"; 

    $total_entry = count(db_select_query($q));
    
    if($total_entry > 0){
        $html = '<div class="newstick">
            <div id="pack_mod" class="recent">
                <h5>
                    <a class="text-primary" href="view_employee.php?id='.$emp_id.'">'.ucfirst($emp_name).'</a>
                    <small><span class="pull-right">'.$total_entry.'</span></small>
                </h5>  
            </div>
        </div>';
        echo $html;
    }
}
?>


<body>
    <div class="se-pre-con"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php')
?>  
<!-- start subscripber user  -->
 <?php  if($_SESSION['login_type'] === "subscriber") {?>
    <aside class="right-side">
        <div class="container-fluid">
                <div class="row bg-color">                 
                <div class="col-lg-4">
                    Subscribers
                    </div>
            </div>
        </div>
    </aside>
 <!-- End subscripber user  -->
 <!-- Start Employee user  -->
<?php } else if($_SESSION['login_type'] === "employee") {?>
     <aside class="right-side">
        <div class="container-fluid">
                <div class="row bg-color">                 
                <div class="col-lg-4">
                    Employee
                    </div>
            </div>
        </div>
    </aside>
<?php  }else{ ?>
 <!-- End Employee user  -->
<aside class="right-side">
            <!-- Content Header (Page header) -->
            <!--section ends-->
            <div class="container-fluid">
                 <div class="row bg-color">
                 
                    <div class="col-lg-4">
                        <?php if($_SESSION['login_type'] === "admin") { ?>
                  <div class="box-model admin-left-panel">
                                    <div class="registered">
                                        <div class="register-detail">
                                            <div class="re-left-area DarkBlue">
                                                <h3 id="userscount"><?=$count_users?></h3>
                                            </div>
                                            <div class="re-right-area">
                                                <h5>TOTAL ACTIVE SUBSCRIBERS</h5>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- <div class="registered bg-success">
                                        <div class="row">
                                            <div class="col-lg-8 col-xs-8">
                                                <h5>TOTAL ACTIVE PACKAGES</h5>
                                            </div>
                                            <div class="col-lg-4 col-xs-4">
                                                <h3 id="myTargetElement4.2"><?=$count_packages?></h3>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    

                                    <div class="registered">
                                        <div class="register-detail">
                                            <div class="re-left-area bg-yellow">
                                                <h3 id="myTargetElement4.1"><?=sizeof($new_arr);?></h3>
                                            </div>
                                            <div class="re-right-area">
                                                <h5>TOTAL ACTIVE CLASSES</h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="registered">
                                        <div class="register-detail">
                                            <div class="re-left-area bg-red">
                                                <h3 id="myTargetElement4.1"><?= $count_no_entry_more_then_7_days ?></h3>
                                            </div>
                                            <div class="re-right-area">
                                                <h5>NO ENTRY MORE THAN 7 DAYS</h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                   
                                    <!-- <div class="registered bg-warning">
                                        <div class="row">
                                            <div class="col-lg-8 col-xs-8">
                                                <h5>TOTAL SUB-ADMINS</h5>
                                            </div>
                                            <div class="col-lg-4 col-xs-4">
                                                <h3 id="myTargetElement4.1"><?=$count_subadmins?></h3>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    <!-- <div class="registered bg-success">
                                        <div class="row">
                                            <div class="col-lg-8 col-xs-8">
                                                <h5>TOTAL DISCOUNT CODE</h5>
                                            </div>
                                            <div class="col-lg-4 col-xs-4">
                                                <h3 id="myTargetElement4.2"><?= count($get_all_discount_code) ;?></h3>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    <div class="registered">
                                        <div class="register-detail">
                                            <div class="re-left-area bg-sky">
                                                <h3 id="myTargetElement4.1"><?=$total_expeses?> <span class="value-ext">KD</span></h3>
                                            </div>
                                            <div class="re-right-area">
                                                <h5>TOTAL MONTHLY EXPENSES</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="registered">
                                        <div class="register-detail">
                                            <div class="re-left-area bg-green">
                                                <h3 id="myTargetElement4.1" class="hold_package_btn"><?= $count_hold_subscription_users;?></h3>
                                            </div>
                                            <div class="re-right-area">
                                                <h5>TOTAL HOLD SUBSCRIPTION</h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                           
                        </div>
                  <?php } ?>
                 
                     <?php if($_SESSION['login_type'] === "admin") { ?>
                        <div class="box-model">
                            <h4>Active Classes</h4>
                            <div   class="newstick" style="">
                                <div  id="class_mod" class="recent" style="">
                                    <?php if($new_arr) {
                                    foreach($new_arr as $cls) {
                                    $qr_class = db_select_query("select * from classes where id = '$cls' ")[0] ;
                                    $all_us = db_select_query("select * from users where package_class != '0' and expiry_dates >= '$tdtt'") ;
                                    $cn = 0 ;
                                    $html_active_class_user = "";
                                    foreach($all_us as $g)
                                    {
                                     $gr = explode(',', $g['class_id']);
                                      if(in_array($cls, $gr))
                                      {
                                        $cn++ ; 
                                        $html_active_class_user .= "<tr><td>".$g['name']."</td><td>".$g['email']."</td><td>".$g['mobile']."</td>
                                            </tr>";
                                            // <td align='center'><a class='btn btn-success btn-sm' href='view_user.php?id=".$g['id']."' style='margin: 5px 0px;'>View</a></td></tr>";
                                      }
                                    
                                    }
                                    ?>
                                    <div class="row" style="margin: 0px; display: block;">
                                        <!--<img src="<?=$user['image']?>" class="recent-user-img" alt="image not found">-->
                                        <h5>
                                            <a class="text-primary" style="cursor: auto;"><?=$qr_class['name']?> </a>
                                            <small>
                                                <span class="pull-right view_all_active_class_user_btn"><?= $cn ; ?>
                                                    <div class="view_all_active_class_user" style="display: none;" >
                                                        <table>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Mobile No.</th>
                                                                <!-- <th>View</th> -->
                                                            </tr>
                                                            <?php echo $html_active_class_user;?>                                                       
                                                        </table>
                                                    </div>
                                                </span>
                                            </small>
                                        <br>
                                      <small>
                                                  <span class="pull-right view_all_active_class_user_btn">Waiting:- 
                                      <!-- <?php //$count = db_select_query("SELECT *,count(0) as count FROM waiting_list Where class_id = '".$qr_class['id']."' "); ?> -->
                                      <?php $count = db_select_query("SELECT * FROM waiting_list Where class_id = '".$qr_class['id']."' "); 
                                                // echo ($count)?$count[0]['count']:0; 
                                                echo ($count)?count($count):0; 
                                                 if(count($count) > 0){ ?>
                                                    <div class="view_all_active_class_user" style="display: none;">
                                                        <table>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Mobile No.</th>
                                                            </tr>
                                                            <?php foreach($count as $active_class_waiting){ ?>
                                                                <tr>
                                                                    <td> <?php echo ($active_class_waiting['name'] != "")?$active_class_waiting['name']:'-';?></td>
                                                                    <td><?php echo ($active_class_waiting['contact'] != "")?$active_class_waiting['contact']:'-';?> </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php }  ?>
                                      
                                        </span>
                                    
                                      </small>
                                    </h5>
                                        
                                    </div>
                                    
                                    <?php }
                                    } ?>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!-- <a href="class.php">
                             <div class="registered bg-success">
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12">
                                                <h5>View All Classes</h5>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    </a> -->
                        </div>
                        <?php } ?>
                       
                        <!--<div class="box-model">-->
                        <!--    <div class="row">-->
                        <!--        <div class=" col-lg-12 col-xs-12">-->
                        <!--            <div class="example">-->
                        <!--                <div class="example--label"></div>-->
                        <!--                <div class="example-content">-->
                        <!--                    <div class="list-inline">-->
                        <!--                        <div>-->
                        <!--                            <div id="custom-cells"><div class="datepicker-inline"><div class="datepicker"><i class="datepicker--pointer"></i><nav class="datepicker--nav"><div class="datepicker--nav-action" data-action="prev"><svg><path d="M 17,12 l -5,5 l 5,5"></path></svg></div><div class="datepicker--nav-title">September, <i>2020</i></div><div class="datepicker--nav-action" data-action="next"><svg><path d="M 14,12 l 5,5 l -5,5"></path></svg></div></nav><div class="datepicker--content"><div class="datepicker--days datepicker--body active"><div class="datepicker--days-names"><div class="datepicker--day-name -weekend-">Su</div><div class="datepicker--day-name">Mo</div><div class="datepicker--day-name">Tu</div><div class="datepicker--day-name">We</div><div class="datepicker--day-name">Th</div><div class="datepicker--day-name">Fr</div><div class="datepicker--day-name -weekend-">Sa</div></div><div class="datepicker--cells datepicker--cells-days"><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="30" data-month="7" data-year="2020">30</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="31" data-month="7" data-year="2020">31</div><div class="datepicker--cell datepicker--cell-day" data-date="1" data-month="8" data-year="2020">1<span class="dp-note"></span></div><div class="datepicker--cell datepicker--cell-day" data-date="2" data-month="8" data-year="2020">2</div><div class="datepicker--cell datepicker--cell-day" data-date="3" data-month="8" data-year="2020">3</div><div class="datepicker--cell datepicker--cell-day" data-date="4" data-month="8" data-year="2020">4</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="5" data-month="8" data-year="2020">5</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="6" data-month="8" data-year="2020">6</div><div class="datepicker--cell datepicker--cell-day" data-date="7" data-month="8" data-year="2020">7</div><div class="datepicker--cell datepicker--cell-day" data-date="8" data-month="8" data-year="2020">8</div><div class="datepicker--cell datepicker--cell-day" data-date="9" data-month="8" data-year="2020">9</div><div class="datepicker--cell datepicker--cell-day -current- -selected-" data-date="10" data-month="8" data-year="2020">10<span class="dp-note"></span></div><div class="datepicker--cell datepicker--cell-day" data-date="11" data-month="8" data-year="2020">11</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="12" data-month="8" data-year="2020">12<span class="dp-note"></span></div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="13" data-month="8" data-year="2020">13</div><div class="datepicker--cell datepicker--cell-day" data-date="14" data-month="8" data-year="2020">14</div><div class="datepicker--cell datepicker--cell-day" data-date="15" data-month="8" data-year="2020">15</div><div class="datepicker--cell datepicker--cell-day" data-date="16" data-month="8" data-year="2020">16</div><div class="datepicker--cell datepicker--cell-day" data-date="17" data-month="8" data-year="2020">17</div><div class="datepicker--cell datepicker--cell-day" data-date="18" data-month="8" data-year="2020">18</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="19" data-month="8" data-year="2020">19</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="20" data-month="8" data-year="2020">20</div><div class="datepicker--cell datepicker--cell-day" data-date="21" data-month="8" data-year="2020">21</div><div class="datepicker--cell datepicker--cell-day" data-date="22" data-month="8" data-year="2020">22<span class="dp-note"></span></div><div class="datepicker--cell datepicker--cell-day" data-date="23" data-month="8" data-year="2020">23</div><div class="datepicker--cell datepicker--cell-day" data-date="24" data-month="8" data-year="2020">24</div><div class="datepicker--cell datepicker--cell-day" data-date="25" data-month="8" data-year="2020">25</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="26" data-month="8" data-year="2020">26</div><div class="datepicker--cell datepicker--cell-day -weekend-" data-date="27" data-month="8" data-year="2020">27</div><div class="datepicker--cell datepicker--cell-day" data-date="28" data-month="8" data-year="2020">28</div><div class="datepicker--cell datepicker--cell-day" data-date="29" data-month="8" data-year="2020">29</div><div class="datepicker--cell datepicker--cell-day" data-date="30" data-month="8" data-year="2020">30</div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="1" data-month="9" data-year="2020">1<span class="dp-note"></span></div><div class="datepicker--cell datepicker--cell-day -other-month-" data-date="2" data-month="9" data-year="2020">2</div><div class="datepicker--cell datepicker--cell-day -weekend- -other-month-" data-date="3" data-month="9" data-year="2020">3</div></div></div></div></div></div></div>-->
                        <!--                        </div>-->
                        <!--                        <div class="calender-content-style" id="custom-cells-events"><strong class="text-primary">09/10/2020</strong>-->
                        <!--                            <p class="light-color">Duo Reges: constructio interrete, A mene tu? Ea possunt paria non esse.</p>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="box-model">-->
                        <!--    <div class="row">-->
                        <!--        <div class=" col-lg-12 col-xs-12">-->
                        <!--            <div class="example">-->
                        <!--                <div class="example--label"></div>-->
                        <!--                <div class="example-content">-->
                        <!--                    <div class="list-inline">-->
                        <!--                        <div>-->
                        <!--                            <div id="custom-cells"></div>-->
                        <!--                        </div>-->
                        <!--                        <div class="calender-content-style" id="custom-cells-events"><strong class="text-primary"></strong>-->
                        <!--                            <p class="light-color"></p>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-8 admin-right-panel">
                      
                        <!-- <div class="col-md-12">
                                <div id="birth_mod" class="box-model event">
                                    <h4 class="">Birthdays</h4>
                                    <div class="events_hover">
                                          <?php foreach($birthday_notification1 as $noti1) { 
                                                        $bdy1 = substr($noti1['date_of_birth'], 5 , 10) ;
                                                        $today_date1 = substr(date('Y-m-d') , 5, 10);                                                     
                                                        if($bdy1 == $today_date1)
                                                        { ?>
                                                            <a href="edit_user.php?id=<?php echo $noti1['id'] ?>">
                                                                <div class="row">
                                                                    <img src="<?=$noti1['image']?>" class="recent-user-img" alt="image not found">
                                                                    <h5><?=$noti1['name']?></h5>
                                                                    <small><?=date("d-m-Y", strtotime($noti1['date_of_birth']))?></small>
                                                                
                                                                </div>
                                                            </a>
                                                    <?php  } }?>
                                        
                                    </div>
                                </div>
                            </div> -->
                            
                            <?php if($_SESSION['login_type'] === "admin") { ?>
                                <div class="box-model bg-light radius-15">
                                    <h4>Employee Active PT</h4>                                
                                    <?php 
                                        $get_all_employee  = "SELECT id,name  FROM users Where role ='employee'";
                                        $all_employee = db_select_query($get_all_employee);  
                                        if($all_employee){
                                            foreach($all_employee as $row){
                                                getActiveEmployeePt($row['id'],  $row['name']);
                                            }
                                        }                         
                                    ?>
                                 </div> 
                            <div class="box-model bg-light radius-15">
                            <h4>Active Packages</h4>
                            <div  class="newstick" style="">
                                <div id="pack_mod"  class="recent" style="">
                                    <?php if($packages_query) {
                                        $i = 0 ;
                                    foreach($packages_query as $package[$i]) {
                                    $pc = $package[$i]['packagesid'] ;
                                    $qr = db_select_query("select * from packages where id = '$pc' ")[0] ; 
                                    $cnp = db_select_query("select * from users where packagesid = '$pc' and package_class != '0' and expiry_dates >= '$tdtt' "); 
                                    ?>
                                       
                                        <h5>
                                        <a  class="text-primary" style="cursor: auto;"><?=$qr['name']?> </a>
                                        <small>
                                            <span class="pull-right package_list_show_btn">
                                                <?=count($cnp)?>
                                                <?php if(count($cnp) > 0){ ?>
                                                <div class="view_package_list" style="display: none;">
                                                   <table>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile No.</th>
                                                            <!-- <th>View</th> -->
                                                        </tr>
                                                        <?php foreach($cnp as $package_user_name){ ?>
                                                            <tr>
                                                                <td> <?php echo $package_user_name['name'];?></td>
                                                                <td><?php echo $package_user_name['email'];?></td>
                                                                <td><?php echo $package_user_name['mobile'];?></td>
                                                                <!-- <td align='center'><a class='btn btn-success btn-sm' href='view_user.php?id="<?php echo $package_user_name['id']; ?>"' style='margin: 5px 0px;'>View</a></td> -->
                                                            </tr>
                                                        <?php } ?>
                                                   </table>
                                                </div>
                                                <?php } ?>
                                            </span>
                                        </small>
                                    </h5>
                                    
                                    <?php
                                    $i++ ;
                                    }
                                    } ?>
                                    
                                    
                                    
                                </div>
                               
                            </div>
                            
                             <!-- <a href="package.php">
                             <div class="registered bg-primary">
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12">
                                                <h5>View All Packages</h5>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    </a> -->
                            
                        </div>
                        <?php } ?>
                        
                         <!-- <?php if($_SESSION['login_type'] === "admin") { ?>
                        <div class="row">
                        
                            <div class="col-md-12">
                            <div class="box-model">
                            <h4>Recent Sub-Admins</h4>
                            <div class="newstick" style="">
                                <div class="recent" style="">
                                    <?php if($get_all_subadmins) {
                                    foreach($get_all_subadmins as $subadmin) { ?>
                                    <div class="row" style="margin: 0px; display: block;">
                                        
                                        <h5>
                                        <a href="subadmin.php?id=<?php echo $subadmin['id']?>" class="text-primary"><?=$subadmin['name']?> </a>
                                    </h5>
                                        <small><?=$subadmin['email']?><span class="pull-right">
                                 Mobile <?=$subadmin['mobile']?></span></small>
                                    </div>
                                    
                                    <?php }
                                    } ?>
                                    
                                    
                                    
                                </div>
                               
                            </div>
                             <a href="subadmin.php">
                             <div class="registered bg-warning">
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12">
                                                <h5>View All Sub-Admins</h5>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    </a>
                            
                        </div>
                            </div>
                           
                           
                      
                      
                        </div>

                   <?php } ?> -->


                    </div>
                </div>
            </div>
            <!-- /#right -->
            <!-- /.content -->
 </aside>
<?php } ?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body all_model_data">
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

</div>
    <!-- /.right-side -->
    <!-- ./wrapper -->
    <!-- global js -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/custom_js/app.js" type="text/javascript"></script>
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/trainers.js" type="text/javascript"></script>
    <!-- end of page level js -->
</body>
<style>
    .control-label {
    text-align: left !important;
}
.form-group {
    margin-bottom: 0px;
}
.package_list_show_btn:hover, .hold_package_btn:hover, .view_all_active_class_user_btn:hover{
    cursor: pointer;
}
.all_model_data {
    overflow-x: scroll;
}
.all_model_data table{
    width: 100%;
}
.all_model_data th, .all_model_data td{
    border: 1px solid #e5e5e5;
    padding: 0 5px;
}

.register-detail{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    background-color: #f6f8fc;
    padding: 12px;
    border-radius: 15px;
}
.register-detail .re-left-area{
    flex: 0 0 120px;
    max-width: 120px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    padding: 8px;
}
.register-detail .re-left-area h3{
    margin: 0;
    padding: 0;
}
.value-ext{
    display: block;
    font-size: 15px;
}
.register-detail .re-right-area{
    flex: 0 0 calc(100% - 120px);
    max-width: calc(100% - 120px);
    text-align: left;
    padding: 0 20px;
}
.register-detail .re-right-area h5{
    padding: 0;
    margin: 0;
    color: #33363a;
    text-transform: lowercase;
    font-weight: 600;
    font-size: 15px;
}
.register-detail .re-right-area h5::first-letter{
    text-transform: uppercase;
}

.DarkBlue{
    background-color: #e8e9fc;
}
.DarkBlue h3{
    color: #6159e1;
}
.bg-yellow{
    background-color: #f7eee8;
}
.bg-yellow h3{
    color: #c77b41;
}
.bg-red{
    background-color: #f7e4e8;
}
.bg-red h3{
    color: #cf373c;
}
.bg-sky{
    background-color: #ddf4fa;
}
.bg-sky h3{
    color: #29b2c9;
}
.bg-green{
    background-color: #dff7b3;
}
.bg-green h3{
    color: #84ad3a;
}
.admin-left-panel{
    background-color: transparent;
    margin: 20px 0 0;
    padding: 0;
    border: none;
}
.admin-left-panel .registered{
    padding: 0;
    margin: 0;
}
.admin-left-panel .registered:not(:last-child){
    margin-bottom: 10px;
}
.radius-15{
    border-radius: 15px;
}
.bg-light{
    background-color: #f6f8fc;
    padding: 12px;
    border: none;
}
.admin-right-panel .box-model{
    margin-top: 5px;
}
.admin-right-panel .box-model + .box-model{
    margin-top: 10px;
}
.admin-right-panel .box-model>h4{
    margin: 0;
    padding-bottom: 14px;
    padding-top: 10px;
}
.admin-right-panel .box-model .recent h5{
    background-color: #ebeff7;
    margin: 0 0 10px;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.admin-right-panel .box-model .recent h5:last-child{
    margin-bottom: 0;
}
.admin-right-panel .box-model .recent h5>a{
    color: #446e99;
}
.admin-right-panel .box-model .recent small span{
    width: 80px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    padding: 8px;
    font-size: 16px;
    font-weight: 500;
}
.admin-right-panel .box-model .recent small span{
    background-color: #fae2dd;
    color: #a93c25;
}



</style>
<script>
        $(document).ready(function(){
            $(document).on('click','.package_list_show_btn',function(){
                $('.all_model_data').html('');
                $("#exampleModal").modal('show');
                var getActivePackageLink = $(this).find('.view_package_list').html();
                $('.all_model_data').html(getActivePackageLink);
            });
            $(document).on('click','.hold_package_btn',function(){
                $('.all_model_data').html('');
                $("#exampleModal").modal('show');
                    $.ajax({    
                        type: "post",
                        url: "ajax/dashboard_report.php", 
                        data:{report_type:"hold_subscribers"},                  
                        success: function(data){  
                            $('.all_model_data').html(data.message);   
                        }
                    });  
            });
            $(document).on('click','.view_all_active_class_user_btn',function(){
                $('.all_model_data').html('');
                $("#exampleModal").modal('show');
                var view_all_active_class_user = $(this).find('.view_all_active_class_user').html();
                $('.all_model_data').html(view_all_active_class_user);
            })
            
        })
</script>
</html>
