<?php  

require('db.php');

session_start();
if(isset($_SESSION['user_id']))
{
	header("Location:dashboard.php");
}
if(isset($_POST['LOGIN']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username) || empty($password))
	{
		echo '<script>alert("Both Input Fields are Empty")</script>';
	}
	else
	{
		$query = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($result = mysqli_fetch_assoc($execution))
		{
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['name'] = $result['name'];
			header("Location: dashboard.php");  
		}
		else
		{
			echo '<script>alert("Username/Password is Invalid")</script>';
		}
	}
}

?>
<!-- WEBTECH PROJECT
TOPIC: TECH BLOG WITH ADMIN PANEL IN PHP
Team Members:	-Anubhav
				-Kenny
				-Aavez
				-Ryan
 -->
<!DOCTYPE HTML>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<title>LOGIN ADMIN - TechSavvy</title>

	<!-- Bootstrap Files -->
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
	<!-- TechSavvy Font -->
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<!-- Headings Blog -->
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<!-- Paragraph Blog -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	
</head>
<body style="background-color: #f1f5ff;">
	
	<!-- Login Div -->

	<div class="container py-5 Login">
	    <div class="row">
	        <div class="col-md-12">
	            <h2 class="login-title mb-4">TechSavvy</h2>
	            <div class="row">
	                <div class="col-md-6 mx-auto">

	                	<center>
	                		<!-- form card login -->
		                    <div class="card formcard rounded-0">
		                        <div class="card-header border-0 special">
		                            <h3 class="login-heading">LOGIN PANEL</h3>
		                        </div>
		                        <div class="card-body border-0">

		                            <form action="index.php" class="form" role="form" autocomplete="off" id="formLogin" method="POST" name="login">
		                                <div class="form-group">
		                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus="" ng-model="user.username" required> <span style="color:red; font-weight: bold;" ng-show="login.username.$error.required">Required</span>
		                                </div>
		                                <div class="form-group">
		                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Password" ng-model="user.password" required> <span style="color:red; font-weight: bold;" ng-show="login.password.$error.required">Required</span>
		                                </div>
		                                <div class="form-group">
		                                    <input type="submit" name="LOGIN" class="btn btn-info login" value="LOGIN" ng-disabled = "login.$invalid">
		                                </div>
		                            </form>
		                        </div>
		                        <!--/card-block-->
		                    </div>
		                    <!-- /form card login -->
	                	</center>
		                    

	                </div>


	            </div>
	            <!--/row-->

	        </div>
	        <!--/col-->
	    </div>
	    <!--/row-->
	</div>
	<!--/container-->

	<!-- Login Div ENDS -->

	<!-- <script type="text/javascript">

		function IsValidUName(username){
			if(username == ""){
				return false;
			}
			else{
				return true;
			}
		}
		
		function IsValidPassword(password){
			if(password == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidContact(){
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;
			
			if(!IsValidUName(username)){
				alert("Username Field Empty");
			}
			
			if(!IsValidPassword(password)){
				alert("Password Field Empty");
			}
			
			else{
				alert("Thankyou");
			}
		}
	</script> -->


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>