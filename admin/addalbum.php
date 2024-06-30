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
			$cat_code = mysqli_real_escape_string($conn,$_GET["id"]);
			if(empty($_POST["album"]) || empty($_POST["description"])){
				header("location:add_album.php?id=$cat_code&empty=1");
			}
			else{
				$album = $_POST["album"];
				$desc = $_POST["description"];
				$sn = 0;
				$conn = mysqli_connect("localhost","root","","mp3");
				$rs = mysqli_query($conn,"select MAX(sn) from album");
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
				$dt = date("y-m-d");
				$target = "../album/$code.jpg";
				if(move_uploaded_file($_FILES["photo"]["tmp_name"],$target)){
					mkdir("../album/$code");
					if(mysqli_query($conn,"insert into album values($sn,'$code','$album','$desc','$cat_code','$dt')")>0){
						header("location:song.php?id=$code");
					}
					else{
						header("location:add_album.php?id=$cat_code&again=1");
					}
				}
				else{
					header("location:add_album.php?id=$cat_code&img_error=1");
				}
			}
		}
	}
?>