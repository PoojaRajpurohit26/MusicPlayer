<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(strlen(trim($_REQUEST["email"]))>0 && strlen(trim($_REQUEST["pass"]))>0){
		$email = $_REQUEST["email"];
		$pass = $_REQUEST["pass"];
		$rs = mysqli_query($conn,"select * from user where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			if($r["password"]==$pass){
				$email = setCookie("login","$email",time()+3600);
				echo "success";
				/*$max = 0;
				$mx = mysqli_query($conn,"select MAX(recent_sn) from recent where email='$email'");
				if($m=mysqli_fetch_array($mx)){
					$max = $m[0];
				}*/
			}
		}
	}
?>