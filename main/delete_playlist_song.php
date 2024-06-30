<?php
	if(isset($_COOKIE["login"])){
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["id"]))>0){
			$id = $_REQUEST["id"];
			$song = explode("-",$id);
			if(mysqli_query($conn,"delete from playlist_song where song_sn=$song[0] AND album_code='$song[1]' AND playlist_code='$song[2]'")>0){
				echo $id;
			}
		}
	}
?>