
<?php 
require('db.php');
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_id']))
{
	header("Location:index.php");
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
	<title>Admin - Dashboard</title>

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
							<li class="active"><a href="dashboard.php" class="nav-link links-sidebar"><i class="fas fa-columns"></i>&nbsp; DASHBOARD</a></li>
							<li><a href="newpost.php" class="nav-link links-sidebar"><i class="fas fa-list-alt"></i>&nbsp; NEW POSTS</a></li>
							<li><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; CATEGORIES</a></li>
							<li><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
							<li><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
							<li><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
							<li><a href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
							<li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
						</ul>
					</div>

					<!-- Content Section -->
					<div class="col-sm-10">

						<?php 
						$sql = "SELECT * FROM post ORDER BY postDate";
						$exec = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						if(mysqli_num_rows($exec) < 1){
							?>
							<p style="font-size: 20px; color: #fff; background-color: #111; padding: 15px;">You Have 0 Post for the Moment</p>
							<a href="newpost.php" class="btn btn-info">ADD POST</a>
							<?php
						}
						else
						{
							?>
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Post No.</th>
										<th>Post Date</th>
										<th>Date Title</th>
										<th>Author</th>
										<th>Category</th>
										<th>Image</th>
										<th>Comments Status</th>
										<th>Action</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									while ($result = mysqli_fetch_assoc($exec)){
										$post_id = $result['id'];
										$post_date = $result['postDate'];
										$post_title = $result['title'];
										$post_category = $result['category_name'];
										$author = $result['author'];
										$image = $result['image'];
										?>

										<tr>
											<td><?php echo $postNo;?></td>
											<td><?php echo $post_date;?></td>
											<td>
												<?php 
												if(strlen($post_title) > 20){
													echo substr($post_title, 0, 20) . '....';
												}else{
													echo $post_title;
												}
												?></td>
											<td><?php echo $author;?></td>
											<td><?php echo $post_category;?></td>
											<td style="width: 150px;"><?php echo "<img src= 'Upload/Image/$image'>"?></td>
											<td><?php echo 'Live'?></td>
											<td><a href="editpost.php?post_id=<?php echo $post_id;?>"><button class="btn btn-warning"><i class="far fa-edit"></i></button></a> | <a href="deletepost.php?post_id=<?php echo $post_id;?>"><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a></td>
											<td><a href="../single.php?id=<?php echo $post_id;?>"><button class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;Live Preview</button></a></td>
										</tr>
										<?php $postNo++; 
									} ?>
									
								</tbody>
							</table>
						<?php 
					}
						
						?>

							


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