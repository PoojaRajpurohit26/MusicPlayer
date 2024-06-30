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
			if(empty($_POST["album"]) || empty($_POST["description"]) || empty($_POST["dt"])){
				header("location:editAlb.php?id=$code&empty=1");
			}
			else{
				$album = $_POST["album"];
				$description = $_POST["description"];
				$dt = date("y-m-d");
				if(mysqli_query($conn,"update album set album='$album',description='$description',dt='$dt' where code='$code'")){
					header("location:editAlb.php?id=$code&success=1");
				}
				else{
					header("location:editAlb.php?id=$code&again=1");
				}
			}
		}
	}
?>