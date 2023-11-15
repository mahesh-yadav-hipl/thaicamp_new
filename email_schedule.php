<?php
include_once('functions/functions.php');

// $myfile = fopen(time()."newfilelaabhaa.txt", "w") or die("Unable to open file!");
// $txt = "Testig" ;
// fwrite($myfile, $txt);
$get_renewal_email =  db_select_query("SELECT * FROM email_format where type = 'Renewal'")[0] ;
$get_reminder_email =  db_select_query("SELECT * FROM email_format where type = 'Reminder'")[0] ;

$users_finished_subscription_query = db_select_query("SELECT * FROM users") ;
          
          if($users_finished_subscription_query)
          {
                                   
                 foreach($users_finished_subscription_query as $u)
          {        $uname = $u['name'] ;
                  $uemail = $u['email'] ;
                  $uclass = $u['package_class'] ;
                $packages_id = explode(",",$u['packagesid']);
                $expiry_dates = explode(",",$u['expiry_dates']);
                foreach($packages_id as $key => $pck_id) {
                        $qry = db_select_query("select * from packages where id = '$pck_id'")[0] ;
                        $pck_name = $qry['name'] ;
                        $countfiles = count($expiry_dates);
                         $exp=$expiry_dates[$key] ;
                         $three_days_ago = date('Y-m-d', strtotime('-3 days', strtotime($exp)));
                        $today_date = date('Y-m-d'); 
                        
          $currentDateTime = date('Y-m-d H:i:s');
          $newDateTime = date('h:i A', strtotime($currentDateTime));
         if(($uclass == '0') || ($today_date == $exp)){ 
             
      
              $user_name = $uname ;
              $package_name =  $pck_name ;
              $expiry_date = date("d-m-Y" , strtotime($exp)) ;
              
         $headers  = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
         $headers .= "From:".SENDER_NAME." <".SENDER_EMAIL.">" . "\r\n";
         
         $message = '<table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
	<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
		<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
			valign="top"></td>
				<td class="container" width="600"
					style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
					valign="top">
					<div class="content"
						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0"
							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							   background-color="#fff">
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="alert alert-warning"
									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
									align="center" background-color="#71b6f9" valign="top">
									<img style="width:330px;" src="'.SITE_LOGO.'" alt="" >
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
									<h3>'.$get_renewal_email['greeting'].' '.$user_name.',</h3>
									<p>'.$get_renewal_email['intro'].'</p>
									<p>'.$get_renewal_email['detail'].'</p>
									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
											— <b>'.$get_renewal_email['closing'].'</b>   
										</p>
									</p>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
					valign="top"></td>
			</tr>
		</table>';
         
        @mail($uemail,$get_renewal_email['subject'], $message, $headers);
        
         }
         else if($three_days_ago == $today_date)
         {
             
              $user_name = $uname ;

              
         $headers  = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
         $headers .= "From:".SENDER_NAME." <".SENDER_EMAIL.">" . "\r\n";
         
         $message = '<table class="body-wrap" style=" box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" background-color="#f6f6f6">
	<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
		<td style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
			valign="top"></td>
				<td class="container" width="600"
					style=" box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
					valign="top">
					<div class="content"
						 style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
						<table class="main" width="100%" cellpadding="0" cellspacing="0"
							   style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
							   background-color="#fff">
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="alert alert-warning"
									style="box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #efefef; margin: 0; padding: 20px;"
									align="center" background-color="#71b6f9" valign="top">
									<img style="width:330px;" src="'.SITE_LOGO.'" alt="" >
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
								</td>
							</tr>
							<tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
								<td class="content-wrap"
									style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;"
									valign="top">
									<h3>'.$get_reminder_email['greeting'].' '.$user_name.',</h3>
									<p>'.$get_reminder_email['intro'].'</p>
									<p>'.$get_reminder_email['detail'].'</p>
									<p style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
										<p class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
											— <b>'.$get_reminder_email['closing'].'</b>   
										</p>
									</p>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
					valign="top"></td>
			</tr>
		</table>';
         
        @mail($uemail,$get_reminder_email['subject'], $message, $headers);
        
         }
            }
    }
          }
          





?>