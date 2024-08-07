<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		$rs = mysqli_query($conn,"select * from admin where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			?>
				<!DOCTYPE html>
				<html lang="en">
				<head>
				  <!-- Required meta tags -->
				  <meta charset="utf-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				  <title>Star Admin</title>
				  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
				  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
				  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css" />
				  <link rel="stylesheet" href="css/style.css" />
				  <link rel="shortcut icon" href="images/favicon.png" />
				</head>

				<body>
				  <div class=" container-scroller">
					<!-- partial:partials/_navbar.html -->
					<nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
					  <div class="bg-white text-center navbar-brand-wrapper">
						<a class="navbar-brand brand-logo" href="index.html"><img src="images/logo_star_black.png" /></a>
						<a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo_star_mini.jpg" alt=""></a>
					  </div>
					  <div class="navbar-menu-wrapper d-flex align-items-center">
						<button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
						  <span class="navbar-toggler-icon"></span>
						</button>
						<form class="form-inline mt-2 mt-md-0 d-none d-lg-block">
						  <input class="form-control mr-sm-2 search" type="text" placeholder="Search">
						</form>
						<ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
						  <li class="nav-item">
							<a class="nav-link profile-pic" href="#"><img class="rounded-circle" src="images/face.jpg" alt=""></a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-th"></i></a>
						  </li>
						</ul>
						<button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
						  <span class="navbar-toggler-icon"></span>
						</button>
					  </div>
					</nav>

					<!-- partial -->
					<div class="container-fluid">
					  <div class="row row-offcanvas row-offcanvas-right">
						<!-- partial:partials/_sidebar.html -->
						<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
						  <div class="user-info">
							<img src="images/face.jpg" alt="">
							<p class="name">Richard V.Welsh</p>
							<p class="designation">Manager</p>
							<span class="online"></span>
						  </div>
						  <ul class="nav">
							<li class="nav-item active">
							  <a class="nav-link" href="index.html">
								<img src="images/icons/1.png" alt="">
								<span class="menu-title">Dashboard</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/widgets.html">
								<img src="images/icons/2.png" alt="">
								<span class="menu-title">Widgets</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/forms/index.html">
								<img src="images/icons/005-forms.png" alt="">
								<span class="menu-title">Forms</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/ui-elements/buttons.html">
								<img src="images/icons/4.png" alt="">
								<span class="menu-title">Buttons</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/tables/index.html">
								<img src="images/icons/5.png" alt="">
								<span class="menu-title">Tables</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/charts/index.html">
								<img src="images/icons/6.png" alt="">
								<span class="menu-title">Charts</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="pages/icons/index.html">
								<img src="images/icons/7.png" alt="">
								<span class="menu-title">Icons</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="change_password.php">
								<img src="images/icons/8.png" alt="">
								<span class="menu-title">Change Password</span>
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" data-toggle="collapse" href="#sample-pages" aria-expanded="false" aria-controls="sample-pages">
								<img src="images/icons/9.png" alt="">
								<span class="menu-title">Sample Pages<i class="fa fa-sort-down"></i></span>
							  </a>
							  <div class="collapse" id="sample-pages">
								<ul class="nav flex-column sub-menu">
								  <li class="nav-item">
									<a class="nav-link" href="pages/samples/blank_page.html">
									  Blank Page
									</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="pages/samples/login.html">
									  Login
									</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="pages/samples/register.html">
									  Register
									</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="pages/samples/404.html">
									  404
									</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="pages/samples/500.html">
									  500
									</a>
								  </li>
								</ul>
							  </div>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="#">
								<img src="images/icons/10.png" alt="">
								<span class="menu-title">Settings</span>
							  </a>
							</li>
						  </ul>
						</nav>

						<!-- partial -->
						<div class="content-wrapper">
						  <div class="row">
							<div class="col-md-3 mb-4"></div>
							<div class="col-md-6 mb-4">
							  <div class="card">
								<div class="card-body px-5 py-5">
								  <div class="row">
									<div class="col-12">
										<form method="post" action="change_pass.php">
											<label><h6>Current Password</h6></label>
											<input type="password" name="cp" class="form-control"><br>
											<label><h6>New Password</h6></label>
											<input type="password" name="np" class="form-control"><br>
											<label><h6>Retype Password</h6></label>
											<input type="password" name="rp" class="form-control"><br>
											<input type="submit" value="Submit" class="btn btn-primary btn-sm">
										</form>
									</div>
								  </div>
								</div>
							  </div>
						  </div>
						 </div>
						  </div>
						<!-- partial:partials/_footer.html -->
						<footer class="footer">
						  <div class="container-fluid clearfix">
							<span class="float-right">
								<a href="#">Star Admin</a> &copy; 2017
							</span>
						  </div>
						</footer>

						<!-- partial -->
					  </div>
					</div>

				  </div>

				  <script src="node_modules/jquery/dist/jquery.min.js"></script>
				  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
				  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
				  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
				  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
				  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
				  <script src="js/off-canvas.js"></script>
				  <script src="js/hoverable-collapse.js"></script>
				  <script src="js/misc.js"></script>
				  <script src="js/chart.js"></script>
				  <script src="js/maps.js"></script>
				</body>

				</html>
	<?php
		}
		else{
			header("location:index.php");
		}
	}
?>