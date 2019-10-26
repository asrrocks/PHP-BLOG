<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>

<?php 
if(isset($_GET['delete_contact'])){
	if(!empty($_GET['delete_contact'])){
		$sql = "DELETE FROM contact WHERE id = '$_GET[delete_contact]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CONTACT DELETED SUCCESSFULLY")</script>';
			header("Location: contact.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: contact.php");
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Requests - Homepage</title>

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
							<li><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
							<li><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
							<li class="active"><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
						</ul>
					</div>

					<!-- Content Section -->
					<div class="col-sm-10 content">

						<!-- Approve Comments -->
						<?php 
						$sql = "SELECT * FROM contact ORDER BY contactdate";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Contact Details</h3>

							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
										<th>Date Added</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone Number</th>
										<th>Message</th>
										<th>Call / Email / Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$commentid = $result['id'];
										$dateadded = $result['contactdate'];
										$contactname = $result['name'];
										$contactemail = $result['email'];
										$contactphone = $result['phone'];
										$message = $result['message'];
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $dateadded; ?></td>
											<td><?php echo $contactname; ?></td>
											<td><?php echo $contactemail; ?></td>
											<td><?php echo $contactphone; ?></td>
											<td><?php echo $message; ?></td>
											<td><a href="tel: <?php echo $contactphone; ?>"><button class="btn btn-info"><i class="fas fa-mobile-alt"></i></button></a> | <a href="mailto: <?php echo $contactemail; ?>"><button class="btn btn-primary"><i class="far fa-envelope"></i></button></a> | <a href="contact.php?delete_contact=<?php echo $commentid;?>"><button class="btn btn-danger"><i class='far fa-trash-alt'></i></button></a> </td>
										</tr>
										<?php
										$postNo++;
									}?>
						

								</tbody>
							</table>
						<!-- Approve Comments ENDS -->

						
						


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


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>