<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(isset($_GET["code"]) || isset($_GET["sn"])){
			$album_code = mysqli_real_escape_string($conn,$_GET["code"]);
			$sn = mysqli_real_escape_string($conn,$_GET["sn"]);
			if(empty($_POST["song_title"]) || empty($_POST["description"]) || empty($_POST["dt"])){
				header("location:editSong.php?code=$album_code&sn=$sn&empty=1");
			}
			else{
				$song = $_POST["song_title"];
				$description = $_POST["description"];
				$dt = date("y-m-d");
				if(mysqli_query($conn,"update song set song_title='$song',description='$description',dt='$dt' where album_code='$album_code' AND sn=$sn")){
					header("location:editSong.php?code=$album_code&sn=$sn&success=1");
				}
				else{
					header("location:editSong.php?code=$album_code&sn=$sn&again=1");
				}
			}
		}
		else{
			header("location:dashboard.php");
		}
	}
?>