<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$code = "";
		$i = 0;
		$max = 0;
		$rs=mysqli_query($conn,"select * from user where email='$email'");
		if($r=mysqli_fetch_array($rs)){
			$code = $r["code"];
		}
		?>
		<div class="row">
			<div class="col-lg-12 liked_song" style="cursor:default">
				<h2 style="color:#5bc0de">Your liked songs</h2>
				<table width=100% class="table table-borderless" style="color:white">
					<thead>
						<tr>
							<th>SN</th>
							<th>Song</th>
							<!--<th></th>-->
							<th></th>
							<th>Favourite</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$rs=mysqli_query($conn,"select * from favourite where email='$email' AND user_code='$code'");
							while($r=mysqli_fetch_array($rs)){
								$sg=mysqli_query($conn,"select * from song where sn=$r[2] AND album_code='$r[3]'");
								while($s=mysqli_fetch_array($sg)){
									$i++;
									$max = $i;
						?>
									<tr id="l-<?=$s["sn"]?>-<?=$s["album_code"]?>">
										<td><?=$i?></td>
										<td><?=$s["song_title"]?></td>
										<!--<td><img src="../album/giphy.gif" style="height:80px; width:100%"></td>-->
										<td>
											<i class="fa fa-play-circle-o" id="like-<?=$i?>" rel="../album/<?=$s["album_code"]?>/<?=$s["sn"]?>" style="font-size:24px;cursor:pointer"></i>
										</td>
										<td>
											<i class="fa fa-heart liked" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="color:red;cursor:pointer"></i>
										</td>
										<td class="p_list" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="cursor:pointer">Add+</td>
									</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
				<label id="like-max" class="<?=$max?>"></label>
			</div>
		</div>
		<?php
	}
?>