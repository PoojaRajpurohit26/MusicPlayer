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
			$album_code = mysqli_real_escape_string($conn,$_GET["id"]);
			if(empty($_POST["song"]) || empty($_POST["description"])){
				header("location:song.php?id=$album_code&empty=1");
			}
			else{
				$song = $_POST["song"];
				$desc = $_POST["description"];
				$sn = 0;
				$conn = mysqli_connect("localhost","root","","mp3");
				$rs = mysqli_query($conn,"select MAX(sn) from song where album_code='$album_code'");
				if($r=mysqli_fetch_array($rs)){
					$sn = $r[0];
				}
				$sn++;
				$dt = date("y-m-d");
				$target = "../album/$album_code/$sn.mp3";
				if(move_uploaded_file($_FILES["mp3"]["tmp_name"],$target)){
					if(mysqli_query($conn,"insert into song values($sn,'$song','$desc','$album_code','$dt')")){
						header("location:song.php?id=$album_code&success=1");
					}
					else{
						header("location:song.php?id=$album_code&again=1");
					}
				}
				else{
					header("location:song.php?id=$album_code&mp3_error=1");
				}
			}
		}
	}
?>