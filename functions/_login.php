<?php
function is_user_login() {
	if(isset($_SESSION['login']) && $_SESSION['login']==true && isset($_SESSION['login_id']) && isset($_SESSION['login_type']) && $_SESSION['login_type']=='user'){
		return true;
	}else{
		return false;
	}	
}



function is_admin_login() {
	if(isset($_SESSION['login']) && $_SESSION['login']==true && isset($_SESSION['login_id']) && isset($_SESSION['login_type']) && $_SESSION['login_type']=='admin' || $_SESSION['login_type']=='sub-admin' || $_SESSION['login_type']=='employee' || $_SESSION['login_type']=='subscriber'){
		return true;
	}else{
		return false;
	}	
}
// employee and Subscripber 

function checkPageAccess(){
	//return true;
	if($_SESSION['login_type']=='employee'){
		$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri_segments = explode('/', $uri_path);

		if($uri_segments[2] == 'dashboard.php' || $uri_segments[2] == 'logout.php' || $uri_segments[2] == 'leave_employee.php' || $uri_segments[2] == 'add_leave.php' || $uri_segments[2] == 'edit_leave.php' || $uri_segments[2] == 'private-training.php' || $uri_segments[2] == 'user-profile.php' || $uri_segments[2] == 'salary_sheet.php'){
			return true;
		}else{
			return false;
		}
	}elseif($_SESSION['login_type']=='subscriber'){
		$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri_segments = explode('/', $uri_path);

		if($uri_segments[2] == 'dashboard.php' || $uri_segments[2] == 'logout.php' || $uri_segments[2] == 'product_view.php' || $uri_segments[2] == 'product-detail.php' || $uri_segments[2] == 'user-profile.php' || $uri_segments[2] == 'ajax' || $uri_segments[2] == 'private-training.php' || $uri_segments[2] == 'checkout.php' || $uri_segments[2] == 'knet_order.php' || $uri_segments[2] == 'knet_payment_suceess.php' ||  $uri_segments[2] ==  'knet_payment_package_suceess.php' || $uri_segments[2] == 'knet_payment_error.php' || $uri_segments[2] == 'sell_product.php' || $uri_segments[2] == 'view_sell_product.php' || $uri_segments[2] == 'buy_new_package.php' || $uri_segments[2] == 'knet_package.php' || $uri_segments[2] == 'buy_private_trainee.php' || $uri_segments[2] == 'knet_payment_private_trainer_suceess.php'){
			return true;
		}else{
			return false;
		}
	}elseif($_SESSION['login_type']=='admin' && $_SESSION['login_id']!='1'){
		$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri_segments = explode('/', $uri_path);

		if($uri_segments[2] == 'employee.php' || $uri_segments[2] == 'leave_admin.php' || $uri_segments[2] == 'private-training.php' || $uri_segments[2] == 'salary_list.php' || $uri_segments[2] == 'salary_sheet.php' || $uri_segments[2] == 'report_enterance.php' || $uri_segments[2] == 'payment_methods.php' || $uri_segments[2] == 'ajax/update-payment_methods.php' || $uri_segments[2] == 'ajax/add-payment_methods.php' || $uri_segments[2] == 'discount_code.php' || $uri_segments[2] == 'ajax/update-discount_code.php' || $uri_segments[2] == 'ajax/add-discount_code.php' || $uri_segments[2] == 'admin.php' || $uri_segments[2] == 'ajax/update-subadmin.php' || $uri_segments[2] == 'ajax/add-subadmin.php' || $uri_segments[2] == 'subadmin.php' || $uri_segments[2] == 'services.php' || $uri_segments[2] == 'ajax/update-service.php' || $uri_segments[2] == 'ajax/add-service.php' || $uri_segments[2] == 'class.php' || $uri_segments[2] == 'ajax/update-class.php' || $uri_segments[2] == 'ajax/add-class.php' || $uri_segments[2] == 'waiting_list.php' || $uri_segments[2] == 'ajax/update-waiting_list.php' || $uri_segments[2] == 'ajax/add-waiting_list.php' || $uri_segments[2] == 'package.php' || $uri_segments[2] == 'ajax/add-package.php' || $uri_segments[2] == 'ajax/update-package.php' || $uri_segments[2] == 'email.php' || $uri_segments[2] == 'edit-registration-email.php' || $uri_segments[2] == 'edit-renewal-email.php' || $uri_segments[2] == 'edit-thankyou-email.php' || $uri_segments[2] == 'edit-reminder-email.php' || $uri_segments[2] == 'edit-special-email.php' ||  $uri_segments[2] ==  'expenses.php' ||  $uri_segments[2] ==  'ajax/update-expenses.php.php' ||  $uri_segments[2] ==  'ajax/add-expenses.php' || $uri_segments[2] == 'reports.php' || $uri_segments[2] == 'report_for_finished_subscription.php' || $uri_segments[2] == 'report_for_subscription_finish_in_7_days.php' || $uri_segments[2] == 'report_no_entry.php' || $uri_segments[2] == 'cash_flow.php' || $uri_segments[2] == 'store-reports.php' || $uri_segments[2] == 'transaction-subscriber-reports.php' || $uri_segments[2] == 'sales-subscription-reports.php' || $uri_segments[2] == 'cash_flow_of_day.php'){
			return false;
		}else{
			return true;
		}
	}
	else{
			return true;
	}
}

?>

