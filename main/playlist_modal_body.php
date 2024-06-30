<div id="pl_msg"></div>
<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		$pl = mysqli_query($conn,"select * from playlist where email='$email'");
		while($p=mysqli_fetch_array($pl)){
			?>
				<ul class="ul_playlist" id="<?=$p["code"]?>" data-dismiss="modal">
					<li>
						<h5><?=$p["playlist"]?></h5>
					</li>
					<li>
						<?php
							$count=0;
							$cn = mysqli_query($conn,"select * from playlist_song where playlist_code='$p[1]'");
							while($c=mysqli_fetch_array($cn)){
								$count++;
							}
						?>
						<span><?=$count?> song</span>
					</li>
				</ul>
			<?php
		}
	}
?>