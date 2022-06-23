<?php
session_start();

include('db.php');
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
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<style>
	body {
		background:no-repeat left 0 top 250px url(swoosh.jpg);
	}
	*{
		font-family:'Poppins',sans-serif;
	}
	.center{
 width: 430px;
 margin: 130px auto;
 position: relative;
}
.center .header{
 font-size: 28px;
 font-weight: bold;
 color: white;
 padding: 25px 0 30px 25px;
 background: #2962ff;
 border-bottom: 1px solid #2962ff;
 border-radius: 5px 5px 0 0;
 text-align:center;
}
.center form{
 position: absolute;
 background: white;
 width: 100%;
 padding: 0 10px 20px 30px;
 box-sizing: border-box;
 box-shadow:0 12px 48px rgb(26 33 52 / 11%);
 border-radius: 0 0 5px 5px;
}
form input{
 height: 40px;
 width: 90%;
 padding: 0 10px;
 border-radius: 3px;
 border: 1px solid silver;
 font-size: 14px;
 outline: none;
 margin-top:20px;
}
form input:focus{
	border:thin solid #2962ff;
}
form input[type="password"]{
 margin: 20px 0 15px;
}
form i{
 position: absolute;
 font-size: 25px;
 color: grey;
 margin: 30px 0 0 -45px;
}
i.bx.bx-show{
 margin-top: 30px;
}
i.bx.bx-show:hover {
	cursor:pointer;
color:#2962ff;
}
form input[type="submit"]{
 margin-top: 40px;
 margin-bottom: 40px;
 width: 130px;
 height: 45px;
 color: white;
 cursor: pointer;
 line-height: 45px;
 border-radius: 45px;
 border-radius: 5px;
 background: #5c1769;
}
form input[type="submit"]:hover{
 background: #491254;
 transition: .5s;
}
form a{
 text-decoration: none;
 font-size: 18px;
 color: #7f2092;
 padding: 0 0 0 20px;
}
button.btn-login-primary{
	width:100%;
	padding:6px 16px;
margin:10px 0;
color:#fff;
border:none;
 cursor: pointer;
border-radius:4px;
 background: #2962ff;
}
a.mini{
	font-style:italic;
	font-size:small;
	color:#888;
	padding:0;
}
div.user-icon{
	display:flex;
	justify-content:center;
	align-items:center;
}
div.mini-button {
	text-align:center;
}
</style>
</head>
<body>
<div class="center">
         <div class="header">
            Login Pelanggan
         </div>
         <form method='post'>
		 <div class='user-icon'><i class='bx bx-user' style='position:inherit;font-size:70px;'></i></div>
            <input type="text" placeholder="Masukan Username" name='user'>
            <i class='bx bx-envelope'></i>
            <input id="pswrd" type="password" placeholder="Password" name='password'>
            <i class='bx bx-show'onclick="show()"></i>
            <button class='btn-login-primary' type="submit" name='login'>Login</button>
			<div class='mini-button'><a class='mini' href='daftar1.php'>Daftar / <a class='mini' href='index.php'>Beranda</a></div>
         </form>
      </div>
      <script>
         function show(){
          var pswrd = document.getElementById('pswrd');
          var icon = document.querySelector('.fas');
          if (pswrd.type === "password") {
           pswrd.type = "text";
           pswrd.style.margin = "20px 0 15px";
           icon.style.color = "#7f2092";
          }else{
           pswrd.type = "password";
           icon.style.color = "grey";
          }
         }
      </script>
	  <?php
	// jika ada tombol simpan ditekan maka
	if (isset($_POST["login"]))
	{
		// lakukan cek akun di tabel pelanggan yang ada didb
		$username = $_POST["user"];
		$password = $_POST["password"];
		$ambil= mysqli_query($conn,"SELECT * FROM tb_admin WHERE username= '$username' AND password='$password'");
		
		// ngitung akun yang terambil
		
		$akunyangcocok =$ambil->num_rows;
		
		//  jika 1 akun yang cocok, maka diloginkan
		
		if ($akunyangcocok==1)
		{	
			$akun = $ambil->fetch_assoc();
			if($akun["level"] == "admin"){
				$_SESSION["login"] = true;
				$_SESSION["a_global"] = $akun;
				$_SESSION["id"] = $akun["admin_id"];
				$_SESSION["level"] = $akun["level"];
				
				header ('location:home.php');
				exit;
			}
			if($akun["level"] == "penjual"){
				$_SESSION["login"] = true;
				$_SESSION["a_global"] = $akun;
				$_SESSION["id"] = $akun["admin_id"];
				$_SESSION["level"] = $akun["level"];
				
				header ('location:home-penjual.php');
				exit;
			}
			if($akun["level"] == "pembeli"){
				$_SESSION["login"] = true;
				$_SESSION["a_global"] = $akun;
				$_SESSION["id"] = $akun["admin_id"];
				$_SESSION["level"] = $akun["level"];
				$_SESSION["pelanggan"] =$akun;

				
				header ('location:produk.php');
				exit;
			}
			//anda sukses login
			//mendapatkan akun dalam bentuk array
			// var_dump($akun); die;
			//simpan disession pelanggan
			$_SESSION["pelanggan"] =$akun;
			$_SESSION["login"]=true;
			echo "<script>alert('anda sukses login');</script>";
			
			//jika sudah belanja
			if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
			{
			echo "<script>location='keranjang.php';</script>";
		}
			else {
				echo "<script>location='produk.php';</script>";
			}
			}
		else
		{
			//anda gagal login 
			echo "<script>alert('anda gagal login');</script>";
			echo "<script>location='login-pelanggan.php';</script>";
		}
		
		
		
	}
	?>
	</body>
	</html>