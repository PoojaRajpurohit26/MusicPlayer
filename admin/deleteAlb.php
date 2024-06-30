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
			$cat_code = "";
			$rs = mysqli_query($conn,"select * from album where code='$code'");
			if($r=mysqli_fetch_array($rs)){
				$cat_code = $r["category_code"];
			}
			if(mysqli_query($conn,"delete from album where code='$code'")){
				header("location:add_album.php?id=$cat_code&del_success=1");
			}
			else{
				header("location:add_album.php?id=$cat_code&del_again=1");
			}
		}
	}
?>