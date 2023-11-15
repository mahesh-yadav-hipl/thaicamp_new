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
	if($_SESSION['login_type']=='employee' || $_SESSION['login_type']=='subscriber'){
		$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri_segments = explode('/', $uri_path);

		if($uri_segments[2] == 'dashboard.php' || $uri_segments[2] == 'logout.php' || $uri_segments[2] == 'leave_employee.php' || $uri_segments[2] == 'add_leave.php' || $uri_segments[2] == 'edit_leave.php'){
			return true;
		}else{
			return false;
		}
	}else{
			return true;
	}
}

?>