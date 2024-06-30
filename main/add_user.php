<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(strlen(trim($_REQUEST["username"]))>0 && strlen(trim($_REQUEST["email"]))>0 && strlen(trim($_REQUEST["pass"]))>0){
		$name = $_REQUEST["username"];
		$email = $_REQUEST["email"];
		$pass = $_REQUEST["pass"];
		$sn = 0;
		$rs = mysqli_query($conn,"select MAX(sn) from user");
		if($r=mysqli_fetch_array($rs)){
			$sn=$r[0];
		}
		$sn++;
		$a = array();
		for($i=0 ; $i<=9 ; $i++){
			array_push($a,$i);
		}
		for($i='A' ; $i<='Z' ; $i++){
			array_push($a,$i);
			if($i=='Z'){
				break;
			}
		}
		for($i='a' ; $i<='z' ; $i++){
			array_push($a,$i);
			if($i=='z'){
				break;
			}
		}
		shuffle($a);
		$code = "";
		for($i=0 ; $i<6 ; $i++){
			$code = $code.$a[$i];
		}
		$code = $code."_".$sn;
		if(mysqli_query($conn,"insert into user values($sn,'$code','$name','$email','$pass')")){
			echo "success";
		}
	}
?>