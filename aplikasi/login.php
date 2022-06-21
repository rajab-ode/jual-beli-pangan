<?php 
	session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
<title>Login Form</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link href='css/login-style.css' rel='stylesheet'>
</head>
<body style='overflow:hidden'>
	
	<div class="round1"></div>
	<div class="round2"></div>
	
	<div id="login-button">
    <img src="logo-toba.png"></img>
  </div>
  <div class='center'><button class='btn-bg'><a href='daftar1.php'><svg xmlns="http://www.w3.org/2000/svg" style='width:24px;vertical-align:sub;float:left;' fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /> </svg>Daftar</a></button></div>
  <div id="container">
    <h1>Log In</h1>
	  <span class="close-btn"><img src='button-close.png'/></span>
    <form action="" method="post">
		<input type="text" name="user" placeholder="Username" class="input-control">
		<input type="password" name="pass" placeholder="Password" class="input-control">
		<input type="submit" name="submit" value="Login" class="btn-login">
	</form>
<?php
		
		if(isset($_POST['submit'])){
			include 'db.php';
			$user = mysqli_real_escape_string($conn,$_POST['user']);
			$pass = mysqli_real_escape_string($conn,$_POST['pass']);
			$cek = mysqli_query($conn, "SELECT * FROM tb_admin JOIN PELANGGAN WHERE username = '".$user."' AND password ='".$pass."'");
			$hasil = mysqli_fetch_array($cek);
			$level = $hasil['level'];
			$row = mysqli_num_rows($cek);
			if (mysqli_num_rows($cek) > 0){
				$d = mysqli_fetch_object($cek);
				var_dump($d); die;
				if($level == 'admin'){
					$_SESSION["login"] = true;
					$_SESSION["a_global"] = $d;
					$_SESSION["id"] = $d->admin_id;
					die;
					header ('location:home.php');
					exit;
				} elseif ($level == 'pembeli'){
					$_SESSION["login"] = true;
					$_SESSION["a_global"] = $d;
					$_SESSION["id"] = $d->admin_id;
					header ('location:index.php');
					exit;
				}
				
				elseif ($level == 'penjual'){
					$_SESSION["status_login"] = true;
					$_SESSION["a_global"] = $d;
					$_SESSION["id"] = $d->admin_id;

					header ('location:home-penjual.php');
					exit;
				}
				echo '<script>window.location="home.php"</script>';
			}
			else
			{
				echo '<script>alert("Username atau password anda salah")</script>';
			}
		}
		?>
  </div>

  
  <!-- Forgotten Password Container -->

  <script src='javascript/jquery.min.js'></script>
	<script src='javascript/tween.min.js'></script>
  <script>
	$('#login-button').click(function(){
  $('#login-button').fadeOut("slow",function(){
    $("#container").fadeIn();
    TweenMax.from("#container", .4, { scale: 0, ease:Sine.easeInOut});
    TweenMax.to("#container", .4, { scale: 1, ease:Sine.easeInOut});
  });
});
	$(".close-btn").click(function(){
  TweenMax.from("#container", .4, { scale: 1, ease:Sine.easeInOut});
  TweenMax.to("#container", .4, { left:"0px", scale: 0, ease:Sine.easeInOut});
  $("#container, #forgotten-container").fadeOut(800, function(){
    $("#login-button").fadeIn(800);
  });
});
	</script>
		<?php
		
		if(isset($_POST['submit'])){
			session_start();
			include 'db.php';
			$user = mysqli_real_escape_string($conn,$_POST['user']);
			$pass = mysqli_real_escape_string($conn,$_POST['pass']);
			$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password ='".MD5($pass)."'");
			if (mysqli_num_rows($cek) > 0){
				$d = mysqli_fetch_object($cek);
				$_SESSION["status_login"] = true;
				$_SESSION["a_global"] = $d;
				$_SESSION["id"] = $d->admin_id;
				echo '<script>window.location="home.php"</script>';
			}else{
				echo '<script>alert("Username atau password anda salah")</script>';
			}
		}
		?>
	</div>
	</div>
</html>