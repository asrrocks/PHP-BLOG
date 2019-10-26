<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>
<?php 

date_default_timezone_set('Asia/Manila');
$time = time();
if(isset($_POST['post-submit']))
{
	$title = mysqli_real_escape_string($db, $_POST['postTitle']);
	$category = mysqli_real_escape_string($db, $_POST['postCategory']);
	$content = mysqli_real_escape_string($db, $_POST['postContent']);
	$image = $_FILES['postFile']['name'];
	$author = $_SESSION['name'];
	$dateTime = strftime('%Y-%m-%d', $time);
	$title_length = strlen($title);
	$content_length = strlen($content);
	$imageDirectory = "Upload/Image/" . basename($_FILES['postFile']['name']);
	if(empty($title)){
		echo '<script>alert("Title Field is Empty")</script>';
		header("Location: newpost.php");
	}
	
	else{
		$query = "INSERT INTO post (postDate, title, category_name, author, image, content) VALUES ('$dateTime', '$title', '$category', '$author', '$image', '$content')";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($execution){
			move_uploaded_file($_FILES['postFile']['tmp_name'], $imageDirectory);
			echo '<script>alert("POST ADDED SUCCESSFULLY")</script>';
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
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
	<title>New Post - Admin</title>

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
							<li class="active"><a href="newpost.php" class="nav-link links-sidebar"><i class="fas fa-list-alt"></i>&nbsp; NEW POSTS</a></li>
							<li><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; CATEGORIES</a></li>
							<li><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
							<li><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
							<li><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
						</ul>
					</div>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Post Form -->
						<h3 class="post-heading">NEW POST</h3>

						<form action="newpost.php" method="POST" enctype="multipart/form-data" name="newpost">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">TITLE</label>
									<input type="text" name="postTitle" id="postname" class="form-control" placeholder="Add New Title" ng-model="postTitle" required> <span style="color:red; font-weight: bold;" ng-show="newpost.postTitle.$error.required">Required</span>
								</div>

								<div class="form-group">
									<label for="postCategory">CATEGORY</label>
									<select name="postCategory" class="form-control" id="postCategory" ng-model="postCategory" required>
										<?php 
										$sql = "SELECT name FROM category";
										$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
										$selected = "";
										while($row = mysqli_fetch_assoc($execution)){
											echo "<option>$row[name]</option>";
										}
										?>
									</select> <span style="color:red; font-weight: bold;" ng-show="newpost.postCategory.$error.required">Required</span>
								</div>

								<div class="form-group">
									<label for="postFile">UPLOAD IMAGE</label>
									<input type="file" name="postFile" id="postfile" class="form-control" required>
								</div>

								<div class="form-group">
									<label for="postContent">CONTENT</label>
									<textarea name="postContent" id="postcontent" class="form-control" cols="30" rows="10" ng-model="postContent" required></textarea> <span style="color:red; font-weight: bold;" ng-show="newpost.postContent.$error.required">Required</span>
								</div>

								<div class="form-group">
									<input type="submit" name="post-submit" class="btn btn-info" value="POST" ng-disabled= "newpost.$invalid">
								</div>
							</fieldset>
						</form>

						<!-- Add Post Form ENDS -->

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


	<script type="text/javascript">

		function IsValidPostName(postname){
			if(postname == ""){
				return false;
			}
			else{
				return true;
			}
		}
		

		function IsValidFile(file){
			var validextension = new Array("jpg", "png", "jpeg", "gif");
			var fileextension = file.split('.').pop().toLowerCase();

			for (var i = 0; i <= validextension.length; i++) {
				if (validextension[i] == fileextension) {
					return true;
				}
			}
			return false;
		}
		function IsValidPostContent(postcontent){
			if(postcontent == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidPost(){
			var postname = document.getElementById("postname").value;
			var file = document.getElementById("postfile").value;
			var postcontent = document.getElementById("postcontent").value;
			
			if(!IsValidPostName(postname)){
				alert("Post Title Required");
			}
			if(!IsValidFile(file)){
				alert("Invalid File selected");
			}
			if(!IsValidPostContent(postcontent)){
				alert("Content Field Empty");
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