<?php
session_start();
include('../includes/db/connection_db.php');
	
//================== *Login Action Starts* ============================//

if (isset($_POST['login'])) 
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$login_check = "SELECT * from login where username = '$username' and password = '$password'";

	$result = $conn->query($login_check);

	if ($result->num_rows == 1) {
		
		while ($data = $result->fetch_assoc()) {
			$user_type = $data['user_type'];
			$id = $data['id'];
			$_SESSION['username'] = $username;
			$_SESSION['user_type'] = $user_type;
			$_SESSION['id'] = $id;
			// CHECK IF thE ACCOUNT IS ACTIVE
			if ($user_type != 1) {  // 1 is only for admin
					$auth = "SELECT * from registration where login_id = '$id' and authentication = 1";
					$check = $conn->query($auth);
					$reg_data = $check->fetch_all();
					if ($check->num_rows == 1) { 
						$_SESSION['member_id'] = $reg_data[0][1];
						header('location: ../dashboard.php');
						exit;
					}
					else{
						$_SESSION['alert'] = "Your Account is not Active!";
						$_SESSION['alert_type'] = "danger";
						header('location: ../../login.php');
						exit;
					}
			}
			else {
					header('location: ../dashboard.php');
					exit;
			}
			
		}


	}
	else{
		$_SESSION['alert'] = "Username/Password Incorrect !";
		$_SESSION['alert_type'] = "danger";
		header('location: ../../login.php');
		exit;
	}
}



//================== *Login Action Ends* ============================//





?>