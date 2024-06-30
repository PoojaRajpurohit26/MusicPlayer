<?php
	setCookie("login","email",time()-1);
	header("location:index.php");
?>