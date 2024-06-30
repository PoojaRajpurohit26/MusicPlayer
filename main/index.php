<?php
	$conn = mysqli_connect("localhost","root","","mp3");
?>
<html>
	<head>
		<title>MP3</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
		<script src="jquery-3.6.4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
		<script>
			$(document).on("click","#log",function(){
				$("#login").modal();
			});
			$(document).on("click","#log_back",function(){
				$("#login").modal();
			});
			$(document).on("click","#sign",function(){
				$("#signup").modal();
			});
			$(document).on("click","#sg",function(){
				$("#signup").modal();
			});
			$(document).on("click","#sub_sg",function(){
				var name = $("#user").val();
				var email = $("#emailsg").val();
				var pass = $("#passsg").val();
				$.post(
					"add_user.php",{username:name,email:email,pass:pass},function(data){
						data=data.trim();
						if(data=="success"){
							$("#lg_msg").css("color","green");
							$("#lg_msg").html("<h3>Successfully Registered</h3>");
							$("#login").modal();
						}
						else{
							$("#sg_msg").css("color","red");
							$("#sg_msg").html("<h3>Try Again</h3>");
							$("#signup").modal();
						}
					}	
				);
			});
			$(document).on("click","#submit",function(){
				var email = $("#email").val();
				var pass = $("#pass").val();
				$.post(
					"user_login.php",{email:email,pass:pass},function(data){
						data=data.trim();
						if(data=="success"){
							$("#collapsibleNavbar").load("nav_login.php");
							$(".nav-content").load("recent.php");
							$(".footer").load("footer.php");
						}
						else{
							$("#lg_msg").css("color","red");
							$("#lg_msg").html("<h3>Try Again</h3>");
							$("#login").modal();
						}
					}
				);
			});
			$(document).on("click","#category",function(){
				/*var len = document.querySelector("#category").classList.length;
				if(len===2){
					$(this).attr("class","btn btn-warning active");
					$(".nav-content").load("category.php");
				}
				else{
					$(this).attr("class","btn btn-warning");
				}*/
				var cls = $(this).attr("class");
				if(cls=="btn btn-info"){
					$(".btn-light").attr("class","btn btn-info");
					$(".btn-info").css("color","#fff");
					$(this).attr("class","btn btn-light");
					$(this).css("color","#5bc0de");
					$(".nav-content").load("category.php");
				}
				else if(cls=="btn btn-light"){
					$(this).attr("class","btn btn-info");
					$(this).css("color","#fff");
					$(".nav-content").load("recent.php");
				}
			});
			$(document).on("click","#recent-back",function(){
				$(".btn-light").attr("class","btn btn-info");
				$(".btn-info").css("color","#fff");
				$(".nav-content").load("recent.php");
			});
			$(document).on("click",".cat_li",function(){
				var code = $(this).attr("id");
				var cat = $(this).text();
				$.post(
					"display_cat.php",{code:code,category:cat},function(data){
						data = data.trim();
						if(data.length>0){
							if(data.length>96){
								$(".song_content").html(data);
							}
							else{
								$(".song_content").html(data);
								$(".song_content").html("<h4 style='color:white;margin-top:20px;'>There is no album uploaded</h4>");
							}
						}
						else{
							$("#login").modal();
						}
				});
			});
			var max = 0;
			$(document).on("click",".album",function(){
				var code = $(this).attr("id");
				$.post(
					"album.php",{id:code},function(data){
						data=data.trim();
						if(data.length>0){
							$(".song_content").html(data);
							max = $("#max").attr("class");
						}
						else{
							$("#login").modal();
						}
					}
				);
			});
			$(document).on("click",".fa-heart-o",function(){
				var scode = $(this).attr("id");
				$(this).attr("class","fa fa-heart liked");
				$(this).css("color","red");
				$.post(
					"fav.php",{scode:scode},function(data){
						data = data.trim();
						if(data=="success"){
							
						}
					}
				);
			});
			$(document).on("click",".liked",function(){
				var scode = $(this).attr("id");
				$(this).attr("class","fa fa-heart-o");
				$(this).css("color","white");
				$.post(
					"remove_fav.php",{scode:scode},function(data){
						data = data.trim();
						if(data.length>0){
							$("#l-"+data).fadeOut();
						}
					}
				);
			});
			$(document).on("click","#favourite",function(){
				$.post(
					"favourite.php",{},function(data){
						data=data.trim();
						if(data.length>0){
							$(".song_content").html(data);
						}
						else{
							$("#login").modal();
						}
					}
				);
			});
			$(document).ready(function(){
				$("#search").keyup(function(){
					var sch = $(this).val();
					$.post(
						"search.php",{sch:sch},function(data){
							data = data.trim();
							if(data.length>0){
								if(data.length>354){
									$(".song_content").html(data);
								}
								else{
									$(".song_content").html("<h5 style='color:white'>Record not found</h5>");
								}
							}
							else{
								$("#login").modal();
							}
						}
					);
				});
			});
			$(document).on('keypress', function(event) {
			    let keycode = (event.keyCode ? event.keyCode : event.which);
			    if(keycode == '13'){ 
					event.preventDefault(); 
					var sch = $("#search").val();
					$.post(
						"search.php",{sch:sch},function(data){
							data = data.trim();
							if(data.length>0){
								if(data.length>354){
									$(".song_content").html(data);
								}
								else{
									$(".song_content").html("<h5 style='color:white'>Record not found</h5>");
								}
							}
							else{
								$("#login").modal();
							}
						}
					);
			    }
			});
			var i = 0;
			var sn = 0;
			var ab_code = "";
			var audio;
			var v = 0;
			var song_rel = "";
			var max = 0;
			var n = 0;
			var p = 0;
			var source = "";
			$(document).on("click",".fa-play-circle-o",function(){
				//var path = $(this).attr("rel");
				//max = $("#max").attr("class");
				if(audio){
					audio.pause();
					$(".fa-pause-circle-o").attr("class","fa fa-play-circle-o");
				}
				var code = $(this).attr("rel");
				var path = code+".mp3";
				if(path==song_rel){
					audio.play();
				}
				else{
					//$(".fa-play").attr("rel",path);	// remember this
					audio = new Audio(path);
					//$(".progressbar").val("0");
					audio.play();
					song_rel=path;
				}
				$(this).attr("class","fa fa-pause-circle-o");
				$(".fa-play").attr("class","fa fa-pause");
				var song_id = $(this).attr("id");
				var song_id1 = song_id.split("-");
				source = song_id1[0];
				max = $("#"+source+"-max").attr("class");
				i = parseInt(song_id1[1]);
				n = i+1;
				p = i-1;
				if(i>max){
					i=1;
				}
				else if(i<1){
					i=max;
				}
				if(n>max){
					n = 1;
				}
				if(p<1){
					p = max;
				}
				var id = code.split("/");
				sn = id[3];
				ab_code = id[2];
				$(".pic_footer").html("<img src='../album/"+ab_code+".jpg' class='img_footer' width='45' height='45'>");
				$.post(
					"currentSong.php",{sn:sn,code:ab_code,source:source},function(data){
						data=data.trim();
						if(data.length>0){
							$(".current_song").text(data);
							/*if(source=="play"){
								$(".current_src").text("album");
							}
							else{
								$(".current_src").text(source);
							}*/
							$(".current_src").text(source);
							$(".nav-content").load("recent.php");
						}
					}
				);
				$(".fa-pause").attr("rel",code);
				$(".fa-pause").attr("id",i);
				var code_n = $("#"+source+"-"+n).attr("rel");
				$(".fa-step-forward").attr("rel",code_n);
				$(".fa-step-forward").attr("id",n);
				var code_p = $("#"+source+"-"+p).attr("rel");
				$(".fa-step-backward").attr("rel",code_p);
				$(".fa-step-backward").attr("id",p);
				audio.ontimeupdate = function(){
					var total_dur = parseInt(audio.duration);
					var digit = parseInt(audio.duration/60);
					var point = parseInt(audio.duration%60);
					var total_time = digit+":"+point;
					$(".total_duration").text(total_time);
					var current_dur = parseInt(audio.currentTime);
					var minutes = parseInt(audio.currentTime/60);
					var seconds = parseInt(audio.currentTime%60);
					var current_time = minutes+":"+seconds;
					$(".current_duration").text(current_time);
					v = (current_dur/total_dur)*100;
					$(".progressbar").val(v);
					/*if(current_dur==total_dur){
						i++;
					}*/
				};
			});
			$(document).on("click",".fa-pause-circle-o",function(){
				audio.pause();
				$(this).attr("class","fa fa-play-circle-o");
				$(".fa-pause").attr("class","fa fa-play");
			});
			$(document).on("click",".fa-play",function(){
				var pid = $(this).attr("id");
			    $("#"+source+"-"+pid).attr("class","fa fa-pause-circle-o");
				if(pid=="initial"){
					$(this).attr("id","initial_r");
					var code_r = $(".fa-play").attr("rel");
					var path_r = code_r+".mp3";
					audio = new Audio(path_r);
					audio.play();
				}
				audio.play();
				$(this).attr("class","fa fa-pause");
				/*var id = pid.split("-");
				i = parseInt(id[0]);
				ab_code = id[1];
				var path_n = $("#play-"+(i+1)+"-"+ab_code).attr("rel");
				$(".fa-step-forward").attr("rel",path_n);
				$(".fa-step-forward").attr("id",(i+1)+"-"+ab_code);
				var path_p = $("#play-"+(i-1)+"-"+ab_code).attr("rel");
				$(".fa-step-backward").attr("rel",path_p);
				$(".fa-step-backward").attr("id",(i-1)+"-"+ab_code);*/
				audio.ontimeupdate = function(){
					var total_dur = parseInt(audio.duration);
					var digit = parseInt(audio.duration/60);
					var point = parseInt(audio.duration%60);
					var total_time = digit+":"+point;
					$(".total_duration").text(total_time);
					var current_dur = parseInt(audio.currentTime);
					var minutes = parseInt(audio.currentTime/60);
					var seconds = parseInt(audio.currentTime%60);
					var current_time = minutes+":"+seconds;
					$(".current_duration").text(current_time);
					v = (current_dur/total_dur)*100;
					$(".progressbar").val(v);
				};
			});
			$(document).on("click",".fa-pause",function(){
				audio.pause();
				$(this).attr("class","fa fa-play");
				$(".fa-pause-circle-o").attr("class","fa fa-play-circle-o");
			});
			$(document).on("click",".fa-step-forward",function(){
				$(".fa-pause-circle-o").attr("class","fa fa-play-circle-o");
				audio.pause();
				var code = $(this).attr("rel");
				var path = code+".mp3";
				song_rel = path;
				audio = new Audio(path);
				audio.play();
				var pid = $(this).attr("id");
				$("#"+source+"-"+pid).attr("class","fa fa-pause-circle-o");
				$(".fa-play").attr("class","fa fa-pause");
				$(".fa-pause").attr("id",pid);
				$(".fa-pause").attr("rel",code);
				//i++;
				i = n;
				n = i+1;
				p = i-1;
				if(i>max){
					i=1;
				}
				else if(i<1){
					i=max;
				}
				if(n>max){
					n = 1;
				}
				if(p<1){
					p = max;
				}
				var code_n = $("#"+source+"-"+n).attr("rel");
				$(".fa-step-forward").attr("rel",code_n);
				$(".fa-step-forward").attr("id",n);
				var code_p = $("#"+source+"-"+p).attr("rel");
				$(".fa-step-backward").attr("rel",code_p);
				$(".fa-step-backward").attr("id",p);
				var id = code.split("/");
				sn = id[3];
				ab_code = id[2];
				$(".pic_footer").html("<img src='../album/"+ab_code+".jpg' class='img_footer' width='45' height='45'>");
				$.post(
					"currentSong.php",{sn:sn,code:ab_code,source:source},function(data){
						data=data.trim();
						if(data.length>0){
							$(".current_song").text(data);
							/*if(source=="play"){
								$(".current_src").text("album");
							}
							else{
								$(".current_src").text(source);
							}*/
							$(".current_src").text(source);
							$(".nav-content").load("recent.php");
						}
					}
				);
				audio.ontimeupdate = function(){
					var total_dur = parseInt(audio.duration);
					var digit = parseInt(audio.duration/60);
					var point = parseInt(audio.duration%60);
					var total_time = digit+":"+point;
					$(".total_duration").text(total_time);
					var current_dur = parseInt(audio.currentTime);
					var minutes = parseInt(audio.currentTime/60);
					var seconds = parseInt(audio.currentTime%60);
					var current_time = minutes+":"+seconds;
					$(".current_duration").text(current_time);
					v = (current_dur/total_dur)*100;
					$(".progressbar").val(v);
				};
			});
			$(document).on("click",".fa-step-backward",function(){
				$(".fa-pause-circle-o").attr("class","fa fa-play-circle-o");
				audio.pause();
				var code = $(this).attr("rel");
				var path = code+".mp3";
				song_rel=path;
				audio = new Audio(path);
				audio.play();
				var pid = $(this).attr("id");
				$("#"+source+"-"+pid).attr("class","fa fa-pause-circle-o");
				$(".fa-play").attr("class","fa fa-pause");
				$(".fa-pause").attr("id",pid);
				$(".fa-pause").attr("rel",code);
				//i--;
				i = p;
				n = i+1;
				p = i-1;
				if(i>max){
					i=1;
				}
				else if(i<1){
					i=max;
				}
				if(n>max){
					n = 1;
				}
				if(p<1){
					p = max;
				}
				var code_p = $("#"+source+"-"+p).attr("rel");
				$(".fa-step-backward").attr("rel",code_p);
				$(".fa-step-backward").attr("id",p);
				var code_n = $("#"+source+"-"+n).attr("rel");
				$(".fa-step-forward").attr("rel",code_n);
				$(".fa-step-forward").attr("id",n);
				var id = code.split("/");
				sn = id[3];
				ab_code = id[2];
				$(".pic_footer").html("<img src='../album/"+ab_code+".jpg' class='img_footer' width='45' height='45'>");
				$.post(
					"currentSong.php",{sn:sn,code:ab_code,source:source},function(data){
						data=data.trim();
						if(data.length>0){
							$(".current_song").text(data);
							/*if(source=="play"){
								$(".current_src").text("album");
							}
							else{
								$(".current_src").text(source);
							}*/
							$(".current_src").text(source);
							$(".nav-content").load("recent.php");
						}
					}
				);
				audio.ontimeupdate = function(){
					var total_dur = parseInt(audio.duration);
					var digit = parseInt(audio.duration/60);
					var point = parseInt(audio.duration%60);
					var total_time = digit+":"+point;
					$(".total_duration").text(total_time);
					var current_dur = parseInt(audio.currentTime);
					var minutes = parseInt(audio.currentTime/60);
					var seconds = parseInt(audio.currentTime%60);
					var current_time = minutes+":"+seconds;
					$(".current_duration").text(current_time);
					v = (current_dur/total_dur)*100;
					$(".progressbar").val(v);
				};
			});
			$(document).on("click","#playlist",function(){
				var cls = $(this).attr("class");
				$.post(
					"playlist.php",{},function(data){
						data=data.trim();
						if(data.length>0){
							if(cls=="btn btn-info"){
								$(".btn-light").attr("class","btn btn-info");
								$(".btn-info").css("color","#fff");
								$("#playlist").attr("class","btn btn-light");
								$("#playlist").css("color","#5bc0de");
								$(".nav-content").load("playlist.php");
							}
							else if(cls=="btn btn-light"){
								$("#playlist").attr("class","btn btn-info");
								$("#playlist").css("color","#fff");
								$(".nav-content").load("recent.php");
							}
						}
						else{
							$("#login").modal();
						}
					}
				);
			});
			$(document).on("click",".create",function(){
				var plist = $(".create_playlist").val();
				$.post(
					"create_playlist.php",{plist:plist},function(data){
						data=data.trim();
						if(data=="success"){
							$(".nav-content").load("playlist.php");
							$(".create_playlist").val('');
						}
					}
				);
			});
			$(document).on("click",".cancel",function(){
				$(".create_playlist").val('');
			});
			var song_id = "";
			$(document).on("click",".p_list",function(){
				song_id = $(this).attr("id");
				$("#pl_msg").text("");
				$("#playlist_modal").modal();
			});
			$(document).on("click",".ul_playlist",function(){
				var play_id = $(this).attr("id");
				$.post(
					"addsong_pl.php",{play_id:play_id,song_id:song_id},function(data){
						data=data.trim();
						if(data=="success"){
							$(".nav-content").load("playlist.php");
							$(".modal-playlist_body").load("playlist_modal_body.php");
						}
						else{
							$("#pl_msg").css("color","red");
							$("#pl_msg").text("Song already exist in this playlist");
							$("#playlist_modal").modal();
						}
					}
				);
			});
			$(document).on("click",".playlist_data",function(){
				var p_id = $(this).attr("id");
				$.post(
					"show_playlist.php",{id:p_id},function(data){
						data=data.trim();
						if(data.length>0){
							$(".song_content").html(data);
						}
						else{
							$("#login").modal();
						}
					}
				);
			});
			$(document).on("click",".fa-trash",function(){
				var id = $(this).attr("id");
				$.post(
					"delete_playlist_song.php",{id:id},function(data){
						data = data.trim();
						if(data.length>0){
							//$(".song_content").load("show_playlist.php");
							$("#tr-"+data).fadeOut();
							$(".nav-content").load("playlist.php");
						}
					}
				);
			});
			$(document).on("click",".recent_data",function(){
				var song_id = $(this).attr("id");
				var song_id1 = song_id.split("-");
				source = song_id1[0];
				if(source=="album"){
					var alb = $(this).attr("rel");
					var alb1 = alb.split("/");
					var alb2 = alb1[2];
					$.post(
						"album.php",{id:alb2},function(data){
							data=data.trim();
							if(data.length>0){
								$(".song_content").html(data);
								//max = $("#max").attr("class");
							}
							/*else{
								$("#login").modal();
							}*/
						}
					);
				}
				else if(source=="like"){
					$(".song_content").load("favourite.php");
				}
				else if(source=="search"){
					var alb = $(this).attr("rel");
					var alb1 = alb.split("/");
					var alb2 = alb1[2];
					$.post(
						"album.php",{id:alb2},function(data){
							data=data.trim();
							if(data.length>0){
								$(".song_content").html(data);
								//max = $("#max").attr("class");
							}
							/*else{
								$("#login").modal();
							}*/
						}
					);
				}
				else if(source=="playlist"){
					
				}
			});
		</script>
	</head>
	<body>
		<!-- The Modal -->
		  <div class="modal" id="login">
			<div class="modal-dialog">
			  <div class="modal-content">
			  
				<!-- Modal Header -->
				<div class="modal-header">
				  <h4 class="modal-title" style="cursor:default">Login</h4>
				  <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
				  <div id="lg_msg"></div>
				  <label>Email</label>
				  <input type="text" id="email" class="form-control"><br>
				  <label>Password</label>
				  <input type="password" id="pass" class="form-control"><br>
				  <button class="btn btn-danger" id="submit" data-dismiss="modal">Login</button><br>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				  <span style="cursor:pointer">Don't have an account <i style="color:red" id="sg" data-dismiss="modal">SignUp</i></span>
				</div>
				
			  </div>
			</div>
		  </div>
		  
		  <!-- The Modal -->
		  <div class="modal" id="signup">
			<div class="modal-dialog">
			  <div class="modal-content">
			  
				<!-- Modal Header -->
				<div class="modal-header">
				  <h4 class="modal-title" style="cursor:default">SignUp</h4>
				  <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
				  <div id="sg_msg"></div>
				  <label>User Name</label>
				  <input type="text" id="user" class="form-control"><br>
				  <label>Email</label>
				  <input type="email" id="emailsg" class="form-control"><br>
				  <label>Password</label>
				  <input type="password" id="passsg" class="form-control"><br>
				  <button class="btn btn-danger" data-dismiss="modal" id="sub_sg">Submit</button>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				  <span style="cursor:pointer">Already have an account <i style="color:red" id="log_back" data-dismiss="modal">Login</i></span>
				</div>
				
			  </div>
			</div>
		  </div>
		  
		  <!-- The Modal -->
		  <div class="modal" id="playlist_modal">
			<div class="modal-dialog">
			  <div class="modal-content">
			  
				<!-- Modal Header -->
				<div class="modal-header">
				  <h4 class="modal-title">Playlists</h4>
				  <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-playlist_body">
				  <div id="pl_msg"></div>
				  <?php
					if(isset($_COOKIE["login"])){
						$email = $_COOKIE["login"];
						$pl = mysqli_query($conn,"select * from playlist where email='$email'");
						while($p=mysqli_fetch_array($pl)){
							?>
								<ul class="ul_playlist" id="<?=$p["code"]?>" data-dismiss="modal">
									<li>
										<h5><?=$p["playlist"]?></h5>
									</li>
									<li>
										<?php
											$count=0;
											$cn = mysqli_query($conn,"select * from playlist_song where playlist_code='$p[1]'");
											while($c=mysqli_fetch_array($cn)){
												$count++;
											}
										?>
										<span><?=$count?> song</span>
									</li>
								</ul>
							<?php
						}
					}
				  ?>
				</div>
			  </div>
			</div>
		  </div>
		  
		<div class="container-fluid">
			<div class="row">
				<div class="sidenav" id="mysidebar">
				  <div class="upper_menu sticky-top">
						<ul class="navbar-nav">
							<li class="nav-item">
							  <a class="nav-link" href="index.php"><i class="fa fa-home" style="font-size:24px;color:#5bc0de;padding: 3px 10px;">Home</i></a>
							</li>
							<li>
							  <form class="form-inline">
								<div class="input-group">
								  <div class="input-group-prepend">
									<span class="input-group-text" style="border: 3px solid #5bc0de"><i class="fa fa-search"></i></span>
								  </div>
								  <input type="text" class="form-control" placeholder="Search..." id="search" style="border: 3px solid #5bc0de">
								</div>    
							  </form>
							</li>
						</ul>
					</div>
					<div class="lower_menu">
						<div class="nav-btn">
							<ul>
								<li class="nav-item">
									<span style='font-size:30px;padding: 5px 5px;' id="recent-back">&larr;</span>
									<button type="button" class="btn btn-info" id="playlist">Playlist</button>
									<button type="button" class="btn btn-info" id="category">Category</button>
								</li>
							</ul>
						</div>
						<div class="nav-content" style="cursor:pointer">
							<!--<h5 style="color:#5bc0de">Recents</h5>-->
							<?php
								include("recent.php");
							?>
						</div>
					</div>
				</div>
				<div class="song_side" id="main">
					<nav class="navbar navbar-expand-md fixed-top">
					  <button class="openbtn" id="navbtn"><i class="fa fa-navicon" style="font-size:30px;color:#5bc0de;"></i></button>
					  <a class="navbar-brand" href="#" style="color:#5bc0de;"><img src="../album/logo.jpg" class="rounded-circle" width="30" height="30" alt="logo"> Music Player</a>
					 
					   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
							<span class="fa fa-ellipsis-v" style="color:#5bc0de"></span>
						  </button>
					  
						 
						  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
						  
						  <?php
							if(!isset($_COOKIE["login"])){
						  ?>
							<ul class="navbar-nav">
							  <li class="nav-item">
								<button type="button" class="btn btn-primary" id="sign" style="float:right">SignUp</button>
							  </li>
							  <li class="nav-item">
								<button type="button" class="btn btn-danger" id="log">Login</button>
							  </li>
							</ul>
							<?php
							}
							else{
								?>
								<ul class="navbar-nav">
								  <li class="nav-item">
									<i class="fa fa-heart" id="favourite" style="font-size:24px;color:#5bc0de;"></i>
								  </li>
								  <li class="nav-item">
									<i class="fa fa-user-circle-o" style="font-size:24px;color:#5bc0de;"></i>
								  </li>
								  <li class="nav-item">
									<a href="logout.php"><i class="fa fa-sign-out" style="font-size:24px;color:#5bc0de;"></i></a>
								  </li>
								</ul>
							<?php
							}
							?>
						  </div>
					</nav>
					<div class="col-lg-12 song_content" style="margin-top:80px;">
						<h4 style="color:#5bc0de;margin-top:10px;cursor:default;">Albums</h4>
						<div class="row">
						<?php
							$rs = mysqli_query($conn,"select * from album order by RAND()");
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
					</div>
				</div>
				<div class="footer fixed-bottom">
					<?php
						include("footer.php");
					?>
				</div>
			</div>
		</div>
		<script>
			$(document).on("click","#navbtn",function(){
				$("#mysidebar").toggleClass("active");
				$("#main").toggleClass("active");
				$(".footer").toggleClass("active");
			});
		</script>
	</body>
</html>