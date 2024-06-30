<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
?>
		<ul class="navbar-nav">
		  <li class="nav-item">
			<i class="fa fa-heart" id="favourite" style="font-size:24px;color:#5bc0de;"></i>
		  </li>
		  <li class="nav-item">
			<i class="fa fa-user-circle-o" style="font-size:24px;color:#5bc0de;"></i>
		  </li>
		  <li class="nav-item">
			<a href="logout.php"><i class="fa fa-sign-out" style="font-size:24px;color:#5bc0de;"></i></a>
		  </li>
		</ul>
<?php
	}
?>