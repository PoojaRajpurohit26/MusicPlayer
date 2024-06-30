<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		$rs=mysqli_query($conn,"select * from recent where email='$email' order by recent_sn desc limit 0,5");
		?>
		<h5 style="color:#5bc0de">Recents</h5>
		<table width=100% style="color:#5bc0de;">
		<?php
			$i = 0;
			while($r=mysqli_fetch_array($rs)){
				$i++;
			?>
				<tr class="recent_data" id="<?=$r["source"]?>-<?=$i?>-recent" rel="../album/<?=$r["album_code"]?>/<?=$r["song_sn"]?>">
					<td style="width:25%"><img src="../album/<?=$r["album_code"]?>.jpg" class="img_recent rounded-circle img-fluid" width="60" height="60"></td>
					<td style="padding-left:0px;padding-top:10px;">
						<ul style="list-style-type: none;">
							<li>
								<h5><?=$r["song_title"]?></h5>
							</li>
							<li>
								<h6><?=$r["source"]?></h6>
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
	else{
	?>
		<!--<div class="recent_before_login">
			<p class="recent_before_lg"><b>Create your first playlist</b></p>
		</div>-->
		<div class="recent_before_login">
			<div class="row">
				<div class="col-lg-9">
					<p class="recent_before_lg"><b>Create your first playlist</b></p>
				</div>
			</div>
		</div>
	<?php
	}
?>