<?php
include_once('functions/functions.php');

//$today = date('Y-m-04'); 

$today = date('Y-m-d');
$upcomingPck = db_select_query("select * from upcoming_packages where pck_start_date = '$today' order by id desc");


foreach($upcomingPck as $key => $value){
    $user_id = $value['user_id'];
    $pckExpUsers = db_select_query("select * from users where id = '$user_id'")[0];
    
    if($pckExpUsers['expiry_dates'] < $today){
        $old_package_id = $pckExpUsers['packagesid'] ;
		$old_package_query = db_select_query("select * from packages where id = '$old_package_id' ")[0] ;
		$old_name = $old_package_query['name'] ;

        $save_old_package['user_id'] = $pckExpUsers['id'] ;
        $save_old_package['start_date'] = $pckExpUsers['pck_start_date'] ;
        $save_old_package['end_date'] = $pckExpUsers['expiry_dates'] ;
        $save_old_package['classes_count'] = $pckExpUsers['package_class'] ;

        if(!empty($pckExpUsers['discount_code']) && !empty($pckExpUsers['after_discount_price']))
        {
            $save_old_package['price'] =  $pckExpUsers['after_discount_price'] ;
        } else {
            $save_old_package['price'] = $old_package_query['price'] ;  
        }
        
        $save_old_package['duration'] = $old_package_query['duration'] ;
        $save_old_package['name'] = $old_package_query['name'] ;
       
        $old_package_data['table'] = "old_packages" ;
        $old_package_data['values'] = $save_old_package ;
        
        db_insert($old_package_data) ;

        $save['payment_method']         =   $value['payment_method'];
        $save['class_id']               =   $value['class_id'];
        $save['packagesid']             =   $value['packagesid'];
        $save['discount_code']          =   $value['discount_code'];
        $save['after_discount_price']   =   $value['after_discount_price'];
        $save['pck_start_date']         =   $value['pck_start_date'];
        $save['package_class']          =   $value['package_class'];
        $save['hold_dates']             =   $value['hold_dates'];
        $save['hold_status']            =   $value['hold_status'];
        $save['expiry_dates']           =   $value['expiry_dates'];
        
        $data['table']      =   "users";
        $data['values']     =   $save;
        $data['where']['id']=   $user_id;

        db_update($data);

    }
}

$cron_jobs['title'] = "upcoming package now activate on users";
$cron_jobs['created_at'] = date('Y-m-d H:i:s');      
$cron_job_data['table'] = "cron_jobs" ;
$cron_job_data['values'] = $cron_jobs ;
db_insert($cron_job_data);
?>