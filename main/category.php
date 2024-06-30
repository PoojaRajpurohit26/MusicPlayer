<h5 style="color:#5bc0de">Category</h5>
<ul class="list-group cat">
<?php
	$conn = mysqli_connect("localhost","root","","mp3");
	$rs = mysqli_query($conn,"select * from category order by sn desc");
	while($r=mysqli_fetch_array($rs)){
?>
		<li class="list-group-item list-group-item-info cat_li" id="<?=$r["code"]?>"><?=$r["category"]?></li>
<?php
	}
?>
</ul>