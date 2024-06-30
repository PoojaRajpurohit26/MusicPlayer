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
			if(empty($_POST["category"])){
				header("location:editCat.php?id=$code&empty=1");
			}
			else{
				$cat = $_POST["category"];
				if(mysqli_query($conn,"update category set category='$cat' where code='$code'")){
					header("location:editCat.php?id=$code&success=1");
				}
				else{
					header("location:editCat.php?id=$code&again=1");
				}
			}
		}
	}
?>