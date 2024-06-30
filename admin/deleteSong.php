<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(isset($_GET["code"]) && isset($_GET["code"])){
			$album_code = mysqli_real_escape_string($conn,$_GET["code"]);
			$sn = mysqli_real_escape_string($conn,$_GET["sn"]);
			if(mysqli_query($conn,"delete from song where album_code='$album_code' AND sn=$sn")){
				header("location:song.php?id=$album_code&del_success=1");
			}
			else{
				header("location:song.php?id=$album_code&del_again=1");
			}
		}
		else{
			header("location:dashboard.php");
		}
	}
?>