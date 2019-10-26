
<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>
<?php 
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Manila');
	$time = time();
	$dateTime = strftime('%Y-%m-%d', $time);
	$category = mysqli_real_escape_string($db, $_POST['categoryName']);
	$categoryLength = strlen[$category];
	$admin = $_SESSION['name'];

	if(empty($category)){
		echo '<script>alert("All Fields must be fill out")</script>';
		header("Location: category.php");
	}
	
	else{
		$query = "INSERT INTO category (catdate, name, owner) VALUES ('$dateTime', '$category', '$admin')";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY ADDED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
		}
	}
}

if(isset($_GET['delete_attempt'])){
	if(!empty($_GET['delete_attempt'])){
		$sql = "DELETE FROM category WHERE id = $_GET[delete_attempt]";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY DELETED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
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
	<title>Category - Homepage</title>

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
							<li class="active"><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; CATEGORIES</a></li>
							<li><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
							<li><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
							<li><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
						</ul>
					</div>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Add Category -->
						<h3 class="post-heading">MANAGE CATEGORY</h3>

						<form action="category.php" method="POST" enctype="multipart/form-data" name="categoryform">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">NAME</label>
									<input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Add New Title" ng-model="user.categoryName" required> <span style="color:red; font-weight: bold;" ng-show="categoryform.categoryName.$error.required">Required</span>
								</div>

								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-info" value="ADD" ng-disabled = "categoryform.$invalid">
								</div>
							</fieldset>
						</form>
						<!-- Add Category ENDS -->

						<h3 class="post-heading">CATEGORY LIST</h3>
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Date Added</th>
									<th>Added By</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$num = 1;
								$sql = "SELECT * FROM category ORDER BY id DESC";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($result = mysqli_fetch_assoc($execution)){
									$cat_id = $result['id'];
									$cat_dateTime = $result['catdate'];
									$cat_name = $result['name'];
									$cat_admin = $result['owner'];
									echo "
										<tr>
											<td>$num</td>
											<td>$cat_name</td>
											<td>$cat_dateTime</td>
											<td>$cat_admin</td>
											<td><a href='category.php?delete_attempt=$cat_id'><button class='btn btn-danger'><i class='far fa-trash-alt'></i></button></a></td>
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

	<script type="text/javascript">

		function IsValidCatName(catname){
			if(catname == ""){
				return false;
			}
			else{
				return true;
			}
		}
		

		function ValidCat(){
			var catname = document.getElementById("catname").value;
			
			if(!IsValidCatName(catname)){
				alert("Category Title Required");
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