<?php
if(isset($_COOKIE["login"])){
	$email = $_COOKIE["login"];
	$conn = mysqli_connect("localhost","root","","mp3");
	$max = 0;
	$mx = mysqli_query($conn,"select MAX(recent_sn) from recent where email='$email'");
	if($m=mysqli_fetch_array($mx)){
		$max = $m[0];
	}
	$rs = mysqli_query($conn,"select * from recent where email='$email' AND recent_sn = $max");
	if($r=mysqli_fetch_array($rs)){
		?>
			<div class="footer_progressbar" style="cursor:pointer">
				<div class="row">
					<div class="col-lg-1 pic_footer">
						<img src="../album/<?=$r["album_code"]?>.jpg" class="img_footer img-fluid" width="45" height="45">
					</div>
					<div class="col-lg-2">
						<span class="current_song"><?=$r["song_title"]?></span><br>
						<span class="current_src"><?=$r["source"]?></span>
					</div>
					<div class="col-lg-9">
						<span class="current_duration">00:00</span>
						<input type="range" min="0" max="100" value="0" class="progressbar">
						<span class="total_duration">00:00</span>
						<ul class="footer_pbar">
						  <li class="pbar-item">
							<i class="fa fa-step-backward" style="color:#5bc0de;font-size:24px;"></i>
						  </li>
						  <li class="pbar-item">
							<i class="fa fa-play" style="color:#5bc0de;font-size:24px;" id="initial" rel="../album/<?=$r["album_code"]?>/<?=$r["song_sn"]?>"></i>
						  </li>
						  <li class="pbar-item">
							<i class="fa fa-step-forward" style="color:#5bc0de;font-size:24px;"></i>
						  </li>
						</ul>
					</div>
				</div>
			</div>
		<?php
	}
}
else{
	?>
	<div class="initial-footer">
		<div class="row">
			<div class="col-lg-9">
				<p class="footer_before_login"><b>Sign up to enjoy song on &nbsp &nbsp<img src="../album/logo.jpg" class="rounded-circle" width="50" height="50" alt="logo"> Music Player</b></p>
			</div>
		</div>
	</div>
	<?php
}
?>