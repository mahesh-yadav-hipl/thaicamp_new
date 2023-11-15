<?php 
//header('Content-Type: application/json');
include_once('../functions/functions.php');
$json=array();

extract($_REQUEST);
//print_r($_REQUEST);

	unset($_REQUEST['table']);

	$query="SELECT * FROM users WHERE  id = '".$_SESSION['login_id']."' ";
	if(count(db_select_query($query)))
	{
		$query .="AND password = '$current_password'";
		
		if(count(db_select_query($query)))
		{
			
			if($_REQUEST['new_password']!=""){
				
				if($_REQUEST['new_password']==$_REQUEST['confirm_password']){
					
					$_REQUEST['password']=$_REQUEST['new_password'];
				
				unset($_REQUEST['new_password']);
				unset($_REQUEST['confirm_password']);
				unset($_REQUEST['current_password']);

				$data['table']=$table;
				$data['values']=$_REQUEST;
				$data['where']['id']=$_SESSION['login_id'];

				if(db_update($data)){
					$json['result']=true;	
					$json['message']="Updated Successfully";
				}else{
					$json['result']=false;	
					$json['message']="Something went wrong";
				}

				}else
					{
						$json['result']=false;	
						$json['message']="Please Enter valid password";
					}
				
			}else{
				$json['result']=false;	
				$json['message']="Your password not match";
			}

		}
		else
		{
			$json['result']=false;	
			$json['message']="Invalid Current Password";
		}
	}
	else
	{
		$json['result']=false;	
		$json['message']="Current password does not match to your login details";
	}	


	
echo json_encode($json);	
?>