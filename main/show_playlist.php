<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		if(strlen(trim($_REQUEST["id"]))>0){
			$code = $_REQUEST["id"];
			$pl = mysqli_query($conn,"select * from playlist where code = '$code'");
			if($p=mysqli_fetch_array($pl)){
			?>
				<div class="row">
					<div class="col-lg-12 playlist_song" style="cursor:default">
						<h2 style="color:#5bc0de"><?=$p["playlist"]?></h2>
						<table width=100% class="table table-borderless" style="color:white">
							<thead>
								<tr>
									<th>SN</th>
									<th>Song</th>
									<!--<th></th>-->
									<th></th>
									<th>Favourite</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 0;
									$max = 0;
									$rs=mysqli_query($conn,"select * from playlist_song where playlist_code='$code'");
									while($r=mysqli_fetch_array($rs)){
										$sg=mysqli_query($conn,"select * from song where sn=$r[1] AND album_code='$r[2]'");
										while($s=mysqli_fetch_array($sg)){
											$i++;
											$max = $i;
								?>
											<tr id="tr-<?=$s["sn"]?>-<?=$s["album_code"]?>-<?=$code?>">
												<td><?=$i?></td>
												<td><?=$s["song_title"]?></td>
												<!--<td><img src="../album/giphy.gif" style="height:80px; width:100%"></td>-->
												<td>
													<i class="fa fa-play-circle-o" id="playlist-<?=$i?>" rel="../album/<?=$s["album_code"]?>/<?=$s["sn"]?>" style="font-size:24px;cursor:pointer"></i>
												</td>
												<td>
													<?php
														$fv = mysqli_query($conn,"select * from favourite where song_sn=$s[0] AND album_code='$s[3]' AND email='$email'");
														if($f=mysqli_fetch_array($fv)){
													?>
															<i class="fa fa-heart liked" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="color:red;cursor:pointer"></i>
														<?php
														}
														else{
														?>
															<i class="fa fa-heart-o" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="cursor:pointer"></i>
														<?php
														}
													?>
												</td>
												<td><i class="fa fa-trash" id="<?=$s["sn"]?>-<?=$s["album_code"]?>-<?=$code?>" style="color:red;font-size:20px;cursor:pointer;"></i></td>
											</tr>
								<?php
										}
									}
								?>
							</tbody>
						</table>
						<label id="playlist-max" class="<?=$max?>"></label>
					</div>
				</div>
			<?php
			}
		}
	}
?>