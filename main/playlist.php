<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		$rs=mysqli_query($conn,"select * from playlist where email='$email'");
		?>
		<h5 style="color:#5bc0de">Your Playlists</h5>
		<input type="text" class="create_playlist" placeholder="Create Playlist"><br>
		<button class="create btn btn-info">Create</button>
		<button class="cancel btn btn-info">Cancel</button>
		<table width=100% style="color:#5bc0de;">
		<?php
			while($r=mysqli_fetch_array($rs)){
			?>
				<tr class="playlist_data" id="<?=$r["code"]?>">
					<td><h5><?=$r["sn"]?></h5></td>
					<td style="padding-left:0px;padding-top:20px;">
						<ul style="list-style-type: none;">
							<li>
								<h5><?=$r["playlist"]?></h5>
							</li>
							<li>
								<?php
									$count=0;
									$cn = mysqli_query($conn,"select * from playlist_song where playlist_code='$r[1]'");
									while($c=mysqli_fetch_array($cn)){
										$count++;
									}
								?>
								<span><?=$count?> song</span>
							</li>
						</ul>
					</td>
				</tr>
			<?php
			}
			?>
		</table>
		<?php
	}
?>