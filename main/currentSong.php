<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["sn"]))>0 && strlen(trim($_REQUEST["code"]))>0 && strlen(trim($_REQUEST["source"]))>0){
			$sn = $_REQUEST["sn"];
			$code = $_REQUEST["code"];
			$source = $_REQUEST["source"];
			
			//for text in current_song class
			$song = "";
			$rs = mysqli_query($conn,"select * from song where sn=$sn AND album_code='$code'");
			if($r=mysqli_fetch_array($rs)){
				$song = $r["song_title"];
				echo $song;
			}
			
			//insert or update in recent table
			$rsn = 0;
			$mx = mysqli_query($conn,"select MAX(recent_sn) from recent where email='$email'");
			if($m=mysqli_fetch_array($mx)){
				$rsn = $m[0];
			}
			$rsn++;
			$ch = mysqli_query($conn,"select * from recent where email='$email' AND song_sn=$sn AND album_code='$code' AND source='$source'");
			if($c = mysqli_fetch_array($ch)){
				mysqli_query($conn,"update recent set recent_sn = $rsn where email='$email' AND song_sn=$sn AND album_code='$code' AND source='$source'");
			}
			else{
				mysqli_query($conn,"insert into recent values('$email',$rsn,$sn,'$code','$song','$source')");
			}
		}
	}
?>