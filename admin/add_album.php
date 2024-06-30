<?php
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(!isset($_GET["id"])){
			header("location:dashboard.php");
		}
		else{
			$conn = mysqli_connect("localhost","root","","mp3");
			$cat_code = mysqli_real_escape_string($conn,$_GET["id"]);
			$rs = mysqli_query($conn,"select * from category where code='".$cat_code."'");
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
        <!-- partial -->.
          <h3 class="page-heading mb-4 px-5 py-3">Add Album</h3>
		  <div class="row">
			<div class="col-md-3 mb-4"></div>
			<div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-body px-5 py-3">
					<form method="post" action="addalbum.php?id=<?=$cat_code?>" enctype="multipart/form-data">
						<label><h5>Album Name : </h5></label>
						<input type="text" name="album" class="form-control"><br><br>
						<label><h5>Description : </h5></label>
						<textarea rows="6" name="description" class="form-control"></textarea><br><br>
						<label><h5>Image : </h5></label>
						<input type="file" name="photo" class="form-control"><br><br>
						<input type="submit" value="Submit" class="btn btn-primary btn-sm">
					</form>
                </div>
              </div>
          </div>
		 </div>
		 <div class="card-deck">
            <div class="card col-lg-12 px-0 mb-4">
              <div class="card-body">
                <h4 class="card-title">Albums</h4>
                <div class="table-responsive">
                  <table class="table center-aligned-table">
					<?php
						$ps = mysqli_query($conn,"select * from album where category_code='$cat_code'");
						while($p=mysqli_fetch_array($ps)){
					?>
						  <tr class="">
							<td><h6><?=$p["album"]?></h6></td>
							<td><a href="song.php?id=<?=$p["code"]?>" class="btn btn-info btn-sm">+ Add Song</a></td>
							<td><a href="editAlb.php?id=<?=$p["code"]?>" class="btn btn-warning btn-sm">Edit</a></td>
							<td><a href="deleteAlb.php?id=<?=$p["code"]?>" class="btn btn-danger btn-sm">Delete</a></td>
						  </tr>
					<?php
						}
					?>
                  </table>
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
	}
?>