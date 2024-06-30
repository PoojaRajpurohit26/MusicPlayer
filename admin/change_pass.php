<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		$rs = mysqli_query($conn,"select * from admin where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			if(empty($_POST["cp"]) || empty($_POST["np"]) || empty($_POST["rp"])){
				header("location:change_password.php?empty=1");
			}
			else{
				$cp = $_POST["cp"];
				$np = $_POST["np"];
				$rp = $_POST["rp"];
				if($cp==$r["password"]){
					if($np==$rp){
						if(mysqli_query($conn,"update admin set password='$np' where email='$email'")){
							header("location:change_password.php?success=1");
						}
						else{
							header("location:change_password.php?again=1");
						}
					}
					else{
						header("location:change_password.php?mismatch_pass=1");
					}
				}
				else{
					header("location:change_password.php?invalid_password=1");
				}
			}
		}
		else{
			header("location:index.php");
		}
	}
?>