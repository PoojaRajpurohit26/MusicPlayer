<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(isset($_GET["code"]) && isset($_GET["sn"])){
			$album_code = mysqli_real_escape_string($conn,$_GET["code"]);
			$sn = mysqli_real_escape_string($conn,$_GET["sn"]);
			$rs = mysqli_query($conn,"select * from song where album_code='$album_code' AND sn=$sn");
			if($r=mysqli_fetch_array($rs)){
			?>
				<!DOCTYPE html>
				<html lang="en">
				<head>
				  <!-- Required meta tags -->
				  <meta charset="utf-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				  <title>MP3 Admin</title>
				  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
				  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
				  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css" />
				  <link rel="stylesheet" href="css/style.css" />
				  <link rel="shortcut icon" href="images/favicon.png" />
				</head>

				<body>
				  <div class=" container-scroller">
					<!-- partial -->
					<div class="container-fluid">
						<!-- partial -->
						  <div class="row">
							<div class="col-md-3 mb-4"></div>
							<div class="col-md-6 mb-4">
							  <div class="card">
								<div class="card-body px-5 py-3">
								  <div class="row">
									<div class="col-12">
										<form method="post" action="updateSong.php?code=<?=$album_code?>&sn=<?=$sn?>">
											<label><h6>Song</h6></label>
											<input type="text" value="<?=$r["song_title"]?>" name="song_title" class="form-control"><br>
											<input type="text" value="<?=$r["description"]?>" name="description" class="form-control"><br>
											<input type="date" value="<?=$r["dt"]?>" name="dt" class="form-control"><br>
											<input type="submit" value="Submit" class="btn btn-primary btn-sm">
										</form>
									</div>
								  </div>
								</div>
							  </div>
						  </div>
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
				header("location:dashboard.php");
			}
		}
		else{
			header("location:dashboard.php");
		}
	}
?>