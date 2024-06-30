<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MP3 Admin</title>
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
			  <?php
					if(isset($_GET["empty"])){
			  ?>
						<h5 class="alert alert-danger">All Field Required</h5>
			  <?php
					}
					else if(isset($_GET["invalid_email"])){
			  ?>
						<h5 class="alert alert-danger">Invalid Email</h5>
			  <?php
					}
					else if(isset($_GET["invalid_pass"])){
			  ?>
						<h5 class="alert alert-danger">Invalid Password</h5>
			  <?php
					}
			  ?>
              <h3 class="card-title text-left mb-3">Login</h3>
              <form method="post" action="check.php">
                <div class="form-group">
                  <input type="text" name="email" class="form-control p_input" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="pass" class="form-control p_input" placeholder="Password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">LOG IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="../../js/misc.js"></script>
</body>

</html>
