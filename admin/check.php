<?php
	if(empty($_POST["email"]) || empty($_POST["pass"])){
		header("location:index.php?empty=1");
	}
	else{
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		$conn = mysqli_connect("localhost","root","","mp3");
		$rs = mysqli_query($conn,"select * from admin where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			if($pass==$r["password"]){
				$email = setCookie("login","$email",time()+3600);
				header("location:dashboard.php");
			}
			else{
				header("location:index.php?invalid_pass=1");
			}
		}
		else{
			header("location:index.php?invalid_email=1");
		}
	}
?>