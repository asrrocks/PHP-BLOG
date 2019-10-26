<?php 
require('db.php');
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
	<title>Homepage</title>

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
						<h1 class="text-blog">Welcome to TechSavvy</h1>
						<p class="lead-para">- <a href="http://www.alphacode.co.in">#teamalphacodegoa</a></p>
					</div>
				</div>
			</div>
			<!-- BLOG - Left Bottom Panel -->
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<?php 
						$page = 1;
						$query = "";
						if(isset($_GET['search'])){
							if(empty($_GET['search'])){
								header("Location: index.php");
							}else{
								$search = $_GET['search'];
								$query = "SELECT * FROM post WHERE postDate LIKE '%$search%' OR title LIKE '%$search%' OR category_name LIKE '%$search%' ";
							}
						}elseif(isset($_GET['category'])){
							$query = "SELECT * FROM post WHERE category_name = '$_GET[category]' ";
						}
						else{
							$query = "SELECT * FROM post ORDER BY postDate DESC";
						}
						$execution = mysqli_query($db, $query) or die(mysqli_error($db));
						if($execution){
							if(mysqli_num_rows($execution) > 0){
								while($result = mysqli_fetch_assoc($execution)){
									$result_id = $result['id'];
									$result_date = $result['postDate'];
									$result_title = $result['title'];
									$result_category = $result['category_name'];
									$result_image = $result['image'];
									$result_content = substr($result['content'], 0,150) . '.....';
									?>
									<div class="card blog_post">
										<img src="admin/Upload/Image/<?php echo $result_image; ?>" class="card-img-top blog-img" alt="">
										<div class="card-body">
											<h3 class="card-title"><?php echo htmlentities($result_title); ?></h3>
											<p class="card-text extraText"><span><i class="far fa-edit"></i> <?php echo htmlentities($result_category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i> <?php echo htmlentities($result_date); ?></span></p> <br>
											<p class="card-text blogPara"><?php echo htmlentities($result_content); ?></p>
											<a href="single.php?id=<?php echo $result_id;?>" class="card-link btn btn-info readMore"><i class="fas fa-hand-point-right"></i> Read More</a>
										</div>
									</div>
									<?php
								}
							}else{
								echo "<span class='lead'>No results Found !!!</span>";
							}
						}else{

						}
						?>
						
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

	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>