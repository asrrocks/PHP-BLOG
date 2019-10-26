<?php 
require('db.php');

if(isset($_POST['submit'])){
	if(!empty($_POST['submit'])){
		date_default_timezone_set('Asia/Manila');
		$time = time();
		$dateTime = strftime('%Y-%m-%d %H:%M:%S ',$time);
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$sql = "INSERT INTO contact (contactdate, name, email, phone, message) VALUES ('$dateTime', '$name', '$email', '$phone', '$message')";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			header("Location: index.php");
		}
		else{
			echo '<script>alert("Something Went Wrong!!!")</script>';
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
	<title>CONTACT US - TechSavvy</title>

	<!-- Bootstrap Files -->
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Fontawesome -->
	<script src="https://kit.fontawesome.com/ca0905f6a5.js"></script>
	<!-- TechSavvy Font -->
	<link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet">
	<!-- Headings Blog -->
	<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
	<!-- Paragraph Blog -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


	
</head>
<body>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">
		<!-- Navbar -->

		<nav class="navbar navbar-expand-md navbar-light bg-dark">
		  <a class="navbar-brand" href="#"><i class="fas fa-laptop-code"></i> TechSavvy</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="about.php">About</a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="contact.php">Contact</a>
		      </li>
		      
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" id="autocomplete" type="search" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
		    </form>
		  </div>
		</nav>

		<!-- Navbar Ends -->

		<!-- Main Section -->

		<!-- BLOG - Left Panel -->
		<div class="container">
			<div>
				<div class="row">
					<div class="col-md-4 title">
						<h1 class="text-blog">Contact Us</h1>
						<!-- <p class="lead-para">- <a href="#">#teamalphacodegoa</a></p> -->
					</div>
				</div>
			</div>

			<!-- Contact Us Section -->

			<div class="about">
				<div class="container">
					<div class="row contact-section">
						<div class="col-md-7">
							<h5 class="contactHeading">Get In Touch !!!</h5>

							<form method="POST" action="contact.php" name="frm">
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control" placeholder="Full Name" ng-model="user.name" required> <span style="color:red; font-weight: bold;" ng-show="frm.name.$error.required">Required</span>
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control" placeholder="Email" ng-model="user.email" required> <span style="color:red; font-weight: bold;" ng-show="frm.email.$error.required">Email Please</span> <span style="color:red; font-weight: bold;" ng-show="frm.email.$error.email">Email not in a proper format</span>
								</div>
								<div class="form-group">
									<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone No." ng-model="user.phone" ng-minlength = "10" ng-maxlength = "12" required> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.minlength">Phone Number less than 10</span> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.required">Phone Number please</span> <span style="color:red; font-weight: bold;" ng-show="frm.phone.$error.maxlength">Phone Number too long</span>
								</div>
								<div class="form-group">
									<textarea name="message" cols="30" id="message" rows="5" class="form-control" ng-model="user.message" required></textarea> <span style="color:red; font-weight: bold;" ng-show="frm.message.$error.required">Message Please</span>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="Submit" id="mysubmit" class="btn btn-info submit" ng-disabled = "frm.$invalid">
								</div>
							</form>

						</div>
						<div class="col-md-5">
							<div class="address">
								<h5 class="contactHeading">Address</h5>
								<div class="cont-panel">
									<h6>Location</h6>
									<p>Maria Julia B1-G6</p>
									<p>Near Nehru Stadium</p>
									<p>Fatorda, Margao</p>
									<p>Goa, India - 403602</p>
								</div>
								<div class="cont-panel">
									<h6>Contact No.</h6>
									<p>+91 7218450969</p>
								</div>
								<div class="cont-panel">
									<h6>Email</h6>
									<p><a href="mailto: teamalphacodegoa@gmail.com">teamalphacodegoa@gmail.com</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="embed-responsive maps embed-responsive-16by9">
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3848.638307252267!2d73.960889!3d15.287508!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x85541348b337b6b7!2sALPHACODE!5e0!3m2!1sen!2sin!4v1565611668605!5m2!1sen!2sin" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>

			<!-- Contact Us Section Ends -->
			
		</div>
		<!-- BLOG - Left Panel ENDS -->


		<!-- Main Section Ends -->

		<footer class="container-fluid">
			<p>MADE BY ALPHACODE</p>
			<p> <a href=""><i class="fab fa-facebook-square"></i></a> | <a href=""><i class="fab fa-instagram"></i></a> | <a href=""><i class="fab fa-linkedin"></i></a> </p>
		</footer>
	</div>

	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>
	<script>
		var availableTags = [
			"Laptop",
			"Lenovo",
			"Laptop1",
			"Laptop2",
			"Hardware",
			"Hardware1",
			"Hardware2",
			"Hardware3",
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
	</script>

	<script type="text/javascript">

		function IsValidName(name){
			if(name == ""){
				return false;
			}
			else{
				return true;
			}
		}
		
		function IsValidEmail(email){
			//Check minimum valid length of an Email.
            if (email.length <= 2) {
                return false;
            }
            //If whether email has @ character.
            if (email.indexOf("@") == -1) {
                return false;
            }

            var parts = email.split("@");
            var dot = parts[1].indexOf(".");
            var len = parts[1].length;
            var dotSplits = parts[1].split(".");
            var dotCount = dotSplits.length - 1;


            //Check whether Dot is present, and that too minimum 1 character after @.
            if (dot == -1 || dot < 2 || dotCount > 2) {
                return false;
            }

            //Check whether Dot is not the last character and dots are not repeated.
            for (var i = 0; i < dotSplits.length; i++) {
                if (dotSplits[i].length == 0) {
                    return false;
                }
            }
		};

		function IsValidPhone(phone){
			if((phone.length == 10) || (phone.length == 11)){
				return true;
			}
			else{
				return false;
			}
		}
		function IsValidMessage(message){
			if(message == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidContact(){
			var name = document.getElementById("name").value;
			var email = document.getElementById("email").value;
			var phone = document.getElementById("phone").value;
			var message = document.getElementById("message").value;
			
			if(!IsValidName(name)){
				alert("Name Required");
			}
			if(!IsValidEmail(email)){
				alert("Invalid Email");
			}
			if(!IsValidPhone(phone)){
				alert("Invalid Phone Number");
			}
			if(!IsValidMessage(message)){
				alert("Message Field Empty");
			}
			
			else{
				alert("Thankyou");
			}
		}
	</script>

	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>