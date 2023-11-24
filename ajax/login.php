<?php 
header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array();
extract($_REQUEST);

//$query="SELECT * FROM admin WHERE email = '$email' ";
$query="SELECT * FROM users WHERE email = '$email' ";
$sql = db_select_query($query);
if($sql)
{
    $sql = $sql[0];
	$json['admin_type']="";
	if($sql['is_deactivate'] == 1){
		$json['result']=false;
		$json['message']="You are deactivated by admin.";
		echo json_encode($json); exit;
	}
	if($sql['password'] == $password)
	{
		
			$_SESSION['login_id']=$sql['id'];
			//$_SESSION['login_type']=$sql['type'];
			$_SESSION['login_type']=$sql['role'];
			$_SESSION['login']=true;
			$_SESSION['login_count']=0;
			$_SESSION['lock']=false;

			if($sql['role'] === "admin" && $sql['id'] == '1'){
				$json['admin_type']="super_admin";
			}	
		$json['result']=true;
		$json['message']="Login successfull";
	}
	else
	{
		$json['result']=false;
		$json['message']="Invalid password";
	}
}
else
{
	$json['result']=false;
	$json['message']="Invalid email";
}
echo json_encode($json);
?>