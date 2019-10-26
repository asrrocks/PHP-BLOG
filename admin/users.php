<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>

<?php 
if(isset($_POST['SUBMIT']))
{
	date_default_timezone_set('Asia/Manila');
	$time = time();
	$dateTime = strftime('%Y-%m-%d %H:%M:%S', $time);
	$adminName = mysqli_real_escape_string($db, $_POST['adminname']); 
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
	$admin = $_SESSION['name'];
	if(empty($username) || empty($password) || empty($confirmpassword)){
		echo '<script>alert("All fields must be fill out.")</script>';
		header("Location: users.php");
	}
	else{
		$sql = "INSERT INTO admin_users (admindate, name, username, password, added_by) VALUES ('$dateTime', '$adminName', '$username', '$password', '$admin')";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("ADMIN ADDED SUCCESSFULLY")</script>';
			header("Location: users.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: users.php");
		}
	}
}

if(isset($_GET['delete_admin'])){
	if(!empty($_GET['delete_admin'])){
		$sql = "DELETE FROM admin_users WHERE id = '$_GET[delete_admin]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("ADMIN DELETED SUCCESSFULLY")</script>';
			header("Location: users.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: users.php");
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
<html lang="en" ng-app="newadmin">
<head>
	<meta charset="UTF-8">
	<title>USERS - Homepage</title>

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
<body>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">

		<!-- Sidebar -->
		<div class="container-fluid">
			<div class="sidebar">
				<h1 class="sidebar-heading">TechSavvy - <?php echo $_SESSION['name']; ?></h1>
				<div class="row">
					<!-- Navbar section -->
					<div class="col-sm-2 sidebar">
						
						<ul id="side-menu" class="nav nav-pills navig">
							<li><a href="dashboard.php" class="nav-link links-sidebar"><i class="fas fa-columns"></i>&nbsp; DASHBOARD</a></li>
							<li><a href="newpost.php" class="nav-link links-sidebar"><i class="fas fa-list-alt"></i>&nbsp; NEW POSTS</a></li>
							<li><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; CATEGORIES</a></li>
							<li class="active"><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
							<li><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
							<li><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
						</ul>
					</div>

					<!-- Content Section -->
					<div class="col-sm-10 content" ng-controller="newadmincontrol">

						<!-- Add Category -->
						<h3 class="post-heading">MANAGE USERS</h3>

						<form action="users.php" method="POST" enctype="multipart/form-data" name="admin">
							<fieldset>
								<div class="form-group">
									<label for="username">ADMIN NAME</label>
									<input type="text" name="adminname" id="adminname" class="form-control" placeholder="Name of the New admin" ng-model="user.adminname" required> <span style="color:red; font-weight: bold;" ng-show="admin.adminname.$error.required">Required</span>
									<!-- <h6 id="usernamecheck" class="validation"></h6> -->
								</div>

								<div class="form-group">
									<label for="username">USERNAME</label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Username" ng-model="user.username" required> <span style="color:red; font-weight: bold;" ng-show="admin.username.$error.required">Required</span>
									<!-- <h6 id="usernamecheck" class="validation"></h6> -->
								</div>

								<div class="form-group">
									<label for="password">PASSWORD</label>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password" ng-model="password" required> <span style="color:red; font-weight: bold;" ng-show="admin.password.$error.required">Required</span>
									<!-- <h6 id="passcheck" class="validation"></h6> -->
								</div>

								<div class="form-group">
									<label for="confirmpassword">Re-Type PASSWORD</label>
									<input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm Password" ng-model="confirmpassword" compare-to="password" required> <span style="color:red; font-weight: bold;" ng-show="admin.confirmpassword.$error.required">Required</span> <span style="color:red; font-weight: bold;" ng-show="admin.confirmpassword.$error.compareTo">Password do not match</span>
									<!-- <h6 id="confpasscheck" class="validation"></h6> -->
								</div>

								<div class="form-group">
									<input type="submit" name="SUBMIT" class="btn btn-info" value="SUBMIT" ng-disabled="admin.$invalid">
								</div>
							</fieldset>
						</form>
						<!-- Add Category ENDS -->

						<h3 class="post-heading">Registered Users</h3>
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>No.</th>
									<th>Date Added</th>
									<th>Name</th>
									<th>Added By</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$num = 1;
								$sql = "SELECT * FROM admin_users ORDER BY admindate DESC";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($result = mysqli_fetch_assoc($execution)){
									$id = $result['id'];
									$dateadded = $result['admindate'];
									$name = $result['name'];
									$admincreated = $result['added_by'];
									echo "
										<tr>
											<td>$num</td>
											<td>$dateadded</td>
											<td>$name</td>
											<td>$admincreated</td>
											<td><a href='users.php?delete_admin=$id'><button class='btn btn-danger'><i class='far fa-trash-alt'></i></button></a></td>
										</tr>
									";
									$num++;
								}
								?>

							</tbody>
						</table>

						<footer class="container-fluid">
							<p>MADE BY ALPHACODE</p>
							<p> <a href=""><i class="fab fa-facebook-square"></i></a> | <a href=""><i class="fab fa-instagram"></i></a> | <a href=""><i class="fab fa-linkedin"></i></a> </p>
						</footer>
					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->
		
	</div>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script>
		  var newadmin = angular.module("newadmin", []); 



		  newadmin.controller("newadmincontrol", function ($scope)  

		  {  

		      $scope.student = {  

		          password: "",  

		          repeatPassword: ""  

		      };  

		  });  



		  newadmin.directive("compareTo", function ()  

		  {  

		      return {  

		          require: "ngModel",  

		          scope:  

		          {  

		              repeatPassword: "=compareTo"  

		          },  

		          link: function (scope, element, attributes, paramval)  

		          {  

		              paramval.$validators.compareTo = function (val)  

		              {  

		                  return val == scope.repeatPassword;  

		              };  

		              scope.$watch("repeatPassword", function ()  

		              {  

		                  paramval.$validate();  

		              });  

		          }  

		      };  

		  });  
	</script>
	<script type="text/javascript">
		

		function IsValidusername(uservalid){
			
			if(uservalid == ""){
				return false;
			}
			else{
				return true;
			}
		}

		function IsPassword(pass1, pass2){
			
			if((pass1 == "") || (pass2 == "")){
				alert("Password Field Empty");
				return false;
			}

			if(pass1 != pass2){
				return false;
			}
			else{
				return true;
			}
		}

		function validate(){

			var userdisp = document.getElementById("usernamecheck");
			var uservalid = document.getElementById("username").value;
			var pass1 = document.getElementById("password").value;
			var pass2 = document.getElementById("confirmpassword").value;
			
			if(!IsValidusername(uservalid)){
				alert("Invalid Username");
			}
			if(!IsPassword(pass1, pass2)){
				alert("Password do not match");
			}
			else{
				alert("Thankyou");
			}
		}

		
	</script>

	<!-- Script Files -->
	
	
	
</body>
</html>