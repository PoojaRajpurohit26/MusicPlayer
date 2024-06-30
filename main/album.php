<?php
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["id"]))>0){
			$code = $_REQUEST["id"];
			$rs = mysqli_query($conn,"select * from album where code='$code'");
			if($r=mysqli_fetch_array($rs)){
			?>
				<div class="row album_data" style="cursor:default">
					<div class="col-lg-2"></div>
					<div class="alb_img col-lg-3">
						<img src="../album/<?=$r["code"]?>.jpg" class="img-fluid" alt="Album Name" width="304" height="236">
					</div>
					<div class="alb_cnt col-lg-5">
						<h2 class="alb_name"><?=$r["album"]?></h2>
						<p class="alb_des"><?=$r["description"]?></p>
						<p class="alb_date"><?=$r["dt"]?></p>
					</div>
				</div><br>
				<div class="row album_song" style="cursor:default">
					<div class="col-lg-12">
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
									$i=0;
									$max = 0;
									$sg = mysqli_query($conn,"select * from song where album_code='$code'");
									while($s=mysqli_fetch_array($sg)){
										$i++;
										$max = $i;
								?>
										<tr>
											<td><?=$s["sn"]?></td>
											<td><?=$s["song_title"]?></td>
											<!--<td><img src="../album/giphy.gif" style="height:80px; width:100%"></td>-->
											<td>
												<i class="fa fa-play-circle-o" id="album-<?=$i?>" rel="../album/<?=$s["album_code"]?>/<?=$s["sn"]?>" style="font-size:24px;cursor:pointer"></i>
											</td>
											<td>
												<?php
													$fv = mysqli_query($conn,"select * from favourite where song_sn=$s[0] AND album_code='$code' AND email='$email'");
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
											<td class="p_list" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="cursor:pointer">Add+</td>
										</tr>
								<?php
									}
								?>
							</tbody>
						</table>
						<label id="album-max" class="<?=$max?>"></label>
					</div>
				</div>
			<?php
			}
		}
	}
?>