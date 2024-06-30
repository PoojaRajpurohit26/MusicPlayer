<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(!isset($_GET["id"])){
			header("location:dashboard.php");
		}
		else{
			$code = mysqli_real_escape_string($conn,$_GET["id"]);
			if(mysqli_query($conn,"delete from category where code='$code'")){
				header("location:dashboard.php?del_success=1");
			}
			else{
				header("location:dashboard.php?del_again=1");
			}
		}
	}
?>