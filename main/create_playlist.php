<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["plist"]))>0){
			$plist = $_REQUEST["plist"];
			$sn = 0;
			$mx = mysqli_query($conn,"select MAX(sn) from playlist");
			if($m=mysqli_fetch_array($mx)){
				$sn = $m[0];
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
			$dt = date("y-m-d");
			if(mysqli_query($conn,"insert into playlist values($sn,'$code','$plist','$email','$dt')")>0){
				echo "success";
			}
			//echo $sn." ".$code." ".$plist." ".$email." ".$dt;
		}
	}
?>