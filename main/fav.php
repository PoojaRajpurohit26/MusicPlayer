<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$ucode = "";
		$rs = mysqli_query($conn,"select * from user where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			$ucode=$r["code"];
		}
		if(strlen(trim($_REQUEST["scode"]))>0){
			$scode = $_REQUEST["scode"];
			$id = explode("&",$scode);
			if(mysqli_query($conn,"insert into favourite values('$email','$ucode',$id[0],'$id[1]')")>0){
				echo "success";
			}
		}
	}
?>