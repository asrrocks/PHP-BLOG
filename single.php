<?php 
require('db.php');
if(isset($_GET['id'])){
	$post_id = $_GET['id'];
	$post_title = "";
	$sql = "SELECT * FROM post WHERE id = '$post_id'";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($title = mysqli_fetch_assoc($execution)){
		$post_title = $title['title'];
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
<html lang="en" ng-app="single">
<head>
	<meta charset="UTF-8">
	<title><?php echo $post_title; ?> - TechSavy</title>

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
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="about.php">About</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="contact.php">Contact</a>
		      </li>
		      
		    </ul>
		    <form action="index.php" method="GET" class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" id="autocomplete" type="text" name="search" placeholder="Search" aria-label="Search">
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
					<div class="col-md-8 title">
						<h1 class="text-blog"><?php echo $post_title; ?></h1>
						<p class="lead-para">- <a href="http://www.alphacode.co.in">#teamalphacodegoa</a></p>
					</div>
				</div>
			</div>
			<!-- BLOG - Left Bottom Panel -->
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<?php 
						if(isset($_GET['id'])){
							$query = "SELECT * FROM post WHERE id = '$_GET[id]'";
							$execution = mysqli_query($db, $query) or die(mysqli_error($db));
							if(mysqli_num_rows($execution)>0){
								while($result = mysqli_fetch_assoc($execution)){
									$id = $result['id'];
									$postDate = $result['postDate'];
									$title = $result['title'];
									$category = $result['category_name'];
									$image = $result['image'];
									$content = $result['content'];
									?>
									<div class="card blog_post">
										<img src="admin/Upload/Image/<?php echo $image; ?>" class="card-img-top blog-img" alt="">
										<div class="card-body">
											<h3 class="card-title"><?php echo htmlentities($title); ?></h3>
											<p href="#" class="card-text extraText"><span><i class="far fa-edit"></i> <?php echo htmlentities($category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i>  <?php echo htmlentities($postDate); ?></span></p> <br>
											<p class="card-text blogPara"><?php echo htmlentities($content); ?></p>

											<!-- <a href="#" class="card-link btn btn-info readMore"><i class="fas fa-hand-point-right"></i> Read More</a> -->
										</div>
									</div>
									<?php
								}
							}
						}
						?>
									
						<div class="comments">
							<div class="container">
								<?php 
								$sql = "SELECT * FROM comment WHERE post_id = '$_GET[id]' AND status = 'approved'";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								if(mysqli_num_rows($execution)>0){
									while($comment = mysqli_fetch_assoc($execution)){
										$c_email = $comment['email'];
										$c_comment = $comment['comment'];
										?>
										<div class="row comment-1">
											<div class="col-md-12">
												<p class="comments-mail"><?php echo $c_email; ?></p>
												<p class="comments-body"><?php echo $c_comment; ?></p>
											</div>
										</div>
									<?php
									}
								}else{
									echo "<p class='comments-body' style='color: #fff;'>No Comments Yet</p>";
								}
								?>
								
							</div>
						</div>
						<div class="comment-section">
							<form method="POST" action="commentpost.php" name="comment">
								<fieldset>
									<legend class="legend">Your thoughts about this post</legend>
									
									<div class="form-group">
										<input type="email" name="email" id="email"  placeholder="Your Email Address" class="form-control" ng-model="email" required> <span style="color:red; font-weight: bold;" ng-show="comment.email.$error.required">Required</span> <span style="color:red; font-weight: bold;" ng-show="comment.email.$error.email">Email format is not proper</span>
									</div>
									<div class="form-group">
										<textarea name="comment" id="comment" placeholder="Your Comment" class="form-control" cols="20" rows="5" ng-model="cocontent" required></textarea> <span style="color:red; font-weight: bold;" ng-show="comment.cocontent.$error.required">Required</span>
									</div>
									<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
									<div class="form-group">
										<input type="submit" name="submit" value="Post" class="btn btn-info submit" ng-disabled="comment.$invalid">
									</div>
								</fieldset>
							</form>
						</div>
					</div>

					<div class="col-md-4 col-xs-12">
						<div class="panel">
							<div class="panel-heading">
								<h4>About Us</h4>
							</div>
							<div class="panel-body">
								<center><i class="fas fa-users"></i></center>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi sint similique nesciunt, optio placeat soluta, praesentium. Repudiandae, dolor sequi corporis eos, architecto pariatur voluptatibus eius deleniti totam, atque debitis libero. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui cumque blanditiis eius quasi sequi placeat corrupti velit a. Quis tempore earum nostrum rem alias optio nihil aliquam soluta in quibusdam.</p>
							</div>
						</div>

						<!-- Recent Post -->
						<div class="panel">
							<div class="panel-heading">
								<h4>Recent Post</h4>
							</div>
							<div class="panel-body">
								<?php 
								$sql = "SELECT * FROM post ORDER BY postDate LIMIT 5";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($recent = mysqli_fetch_assoc($execution)){
									$id = $recent['id'];
									?>
									<ul class="recent">
										<li class="recent-items"><a href="single.php?id=<?php echo $id;?>"><?php echo $recent['title']; ?></a></li>
									</ul>
									<?php
								}
								?>
							</div>
						</div>

						<!-- Categories -->
						<div class="panel">
							<div class="panel-heading">
								<h4>Categories</h4>
							</div>
							<div class="panel-body">
								<?php 
								$sql = "SELECT name FROM category";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($category = mysqli_fetch_assoc($execution)){
									?>
									<ul class="recent">
										<li class="recent-items"><a href="index.php?category=<?php echo $category['name'];?>"><?php echo $category['name']; ?></a></li>
									</ul>
									<?php
								}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
				

			<!-- BLOG - Left Bottom Panel ENDS -->
		</div>
		<!-- BLOG - Left Panel ENDS -->


		<!-- Main Section Ends -->

		<footer class="container-fluid">
			<p>MADE BY ALPHACODE</p>
			<p> <a href=""><i class="fab fa-facebook-square"></i></a> | <a href=""><i class="fab fa-instagram"></i></a> | <a href=""><i class="fab fa-linkedin"></i></a> </p>
		</footer>
	</div>

	<script>
		var single = angular.module("single", []);
	</script>
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

            return true;
		};

		
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
			var message = document.getElementById("comment").value;
			
			if(!IsValidName(name)){
				alert("Name Required");
			}
			if(!IsValidEmail(email)){
				alert("Invalid Email");
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