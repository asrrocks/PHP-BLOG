<?php
function ConfirmLogin () {
	$login = false;
	if ( isset($_SESSION['username'])) {
		$login = true;
	}

	if ($login === false) {
		// $_SESSION['errorMessage'] = 'Login Required';
		header("location: index.php");
	}
}

function Query ($query) {
	global $con;

	try {

		$exec = mysqli_query($con,$query) or die(mysqli_error($con));
		if($exec) {
			return $exec;
		}
	
	}catch (Exception $e) {
		echo $e->getMessage();
	}

	return false;
}

function LoginAttempt($username, $password) {
	$query = "SELECT * FROM admin_users WHERE username = '$username'  AND password = '$password'";
	$exec = Query($query);
	if ($admin = mysqli_fetch_assoc($exec)) {
		return $admin;
	}else {
		return null;
	}

}
?>