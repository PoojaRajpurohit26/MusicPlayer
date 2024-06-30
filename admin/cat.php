<?php
	if(!isset($_COOKIE["login"])){
		header("location:index.php");
	}
	else{
		$email = $_COOKIE["login"];
		if(empty($_POST["category"])){
			header("location:dashboard.php?empty=1");
		}
		else{
			$cat = $_POST["category"];
			$sn = 0;
			$conn = mysqli_connect("localhost","root","","mp3");
			$rs = mysqli_query($conn,"select MAX(sn) from category");
			if($r=mysqli_fetch_array($rs)){
				$sn = $r[0];
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
			if(mysqli_query($conn,"insert into category values($sn,'$code','$cat')")){
				header("location:dashboard.php?success=1");
			}
			else{
				header("location:dashboard.php?again=1");
			}
		}
	}
?>