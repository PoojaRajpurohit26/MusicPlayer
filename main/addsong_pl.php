<?php
	if(isset($_COOKIE["login"])){
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["play_id"]))>0 && strlen(trim($_REQUEST["song_id"]))>0){
			$play_code = $_REQUEST["play_id"];
			$song_id = $_REQUEST["song_id"];
			$song = explode("&",$song_id);
			$rs = mysqli_query($conn,"select * from playlist_song where playlist_code='$play_code' AND song_sn = $song[0] AND album_code='$song[1]'");
			if($r=mysqli_fetch_array($rs)){
				echo "exists";
			}
			else{
				if(mysqli_query($conn,"insert into playlist_song values('$play_code',$song[0],'$song[1]')")>0){
					echo "success";
				}
			}
		}
	}
?>