<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	if(isset($_COOKIE["login"])){
		$email = $_COOKIE["login"];
		?>
		<div class="row">
			<div class="col-lg-12" style="cursor:default">
				<table width=100% class="table table-borderless" style="color:white">
					<thead>
						<tr>
							<th>SN</th>
							<th>Song</th>
							<th></th>
							<th>Favourite</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
							<?php
							if(strlen(trim($_REQUEST["sch"]))>0){
								$sch = $_REQUEST["sch"];
								$i = 0;
								$max = 0;
								$rs = mysqli_query($conn,"select * from song where song_title LIKE '%$sch%'");
								while($r=mysqli_fetch_array($rs)){
									$i++;
									$max = $i;
								?>
									<tr>
										<td><?=$r["sn"]?></td>
										<td><?=$r["song_title"]?></td>
										<td>
											<i class="fa fa-play-circle-o" id="search-<?=$i?>" rel="../album/<?=$r["album_code"]?>/<?=$r["sn"]?>" style="font-size:24px;cursor:pointer"></i>
										</td>
										<td>
											<?php
												$fv = mysqli_query($conn,"select * from favourite where song_sn=$r[0] AND album_code='$r[3]' AND email='$email'");
												if($f=mysqli_fetch_array($fv)){
											?>
													<i class="fa fa-heart liked" id="<?=$r["sn"]?>&<?=$r["album_code"]?>" style="color:red;cursor:pointer"></i>
												<?php
												}
												else{
												?>
													<i class="fa fa-heart-o" id="<?=$r["sn"]?>&<?=$r["album_code"]?>" style="cursor:pointer"></i>
												<?php
												}
											?>
										</td>
										<td class="p_list" id="<?=$s["sn"]?>&<?=$s["album_code"]?>" style="cursor:pointer">Add+</td>
									</tr>
								<?php
								}
							}
							?>
					</tbody>
				</table>
				<label id="search-max" class="<?=$max?>"></label>
			</div>
		</div>
	<?php
	}
?>