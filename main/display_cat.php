<?php
	if(isset($_COOKIE["login"])){
		$conn = mysqli_connect("localhost","root","","mp3");
		if(strlen(trim($_REQUEST["code"]))>0 && strlen(trim($_REQUEST["category"]))>0){
			$code = $_REQUEST["code"];
			$cat = $_REQUEST["category"];
			?>
			<h4 style="color:#5bc0de;margin-top:10px;cursor:default;"><?=$cat?> Albums</h4>
			<div class="row">
				<?php
				$rs = mysqli_query($conn,"select * from album where category_code='$code' order by sn desc");
				while($r=mysqli_fetch_array($rs)){
				?>
					<div class="col-lg-2 album" id="<?=$r["code"]?>">
						<img src="../album/<?=$r["code"]?>.jpg" class="rounded-circle img-fluid" alt="Album Name" width="304" height="236">
						<span class="alb"><h5><?=$r["album"]?></h5></span>
					</div>
				<?php
				}
				?>
			</div>
			<?php
		}
	}
?>