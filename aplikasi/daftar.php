<?php
include('db.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Daftar</title>
<style>
 body {
 	background: #fff;
    direction: ltr;
    font-size: 14px;
	font-family:'Poppins',sans-serif;
    line-height: 1.4286;
    margin: 0;
    padding: 0;
}
.container-form {
	display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
	padding:50px;
    min-height: 100vh;
    position: relative;
    justify-content: center;
    align-items: center;
	background:no-repeat left 0 top 250px url(swoosh.jpg);
}
.RAYh1e {
    background: #fff;
	box-shadow:  0 12px 48px rgb(26 33 52 / 11%);
	border-radius:10px;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    max-width: 100%;
    position: relative;
    z-index: 2;
}
.xkfVF {
    -webkit-box-flex: 1;
    box-flex: 1;
    -webkit-flex-grow: 1;
    flex-grow: 1;
    overflow: hidden;
    padding: 24px ;
}	
.Aa1VU {
    -webkit-flex-basis: 450px;
    flex-basis: 450px;
    margin: 0 -48px;
    overflow: hidden;
    padding: 0 48px;
}
.Wxwduf {
    display: inline-block;
    font-size: 14px;
    vertical-align: top;
    white-space: normal;
    width: 100%;
}
.WEQkZc {
    -webkit-flex-basis: 450px;
    flex-basis: 450px;
    margin: 0 -48px;
    overflow: hidden;
    padding: 0 48px;
}
.form-group {
	margin:15px 0; 
}
input.form-control {
	width:490px;
	height:20px;
	padding: 6px 8px;
	font-size:14px;
	border-radius:4px;
	border:thin solid #dadce0;
	outline-color:#2962ff66;
	font-family:'Poppins',sans-serif;
}
textarea.form-control {
	border-radius:4px;
	border:thin solid #dadce0;
	width:500px;
	font-family:'Poppins',sans-serif;
	outline-color:#2962ff66
}
.btn-register {
	background:#2962ff;
	color:#fff;
	border:none;
	padding:8px 16px;
	border-radius:50px;
	width:100%;
	text-align:center;
	font-family:'Poppins',sans-serif;
}
.btn-register.home {
	background:#fff;
	border:thin solid #dadce0;
	color:#212121;
	width:100%;
	text-align:center;
	border-radius:50px;
	font-family:'Poppins',sans-serif;
	transition:all ease .5s
}
.btn-register.home:hover{
background:#212121;
}
button a.home {
	color:#dadce0;
	text-decoration:none;
	font-family:'Poppins',sans-serif;
}
a {
	color:#2962ff;
}
.title h3 {
	margin:0;
	padding:0;
	text-align:center;
}
	</style>
</head>

<body>
	<div class='container-form'>
<div class='RAYh1e'>
	<div class='xkfVF'>
<div class="Aa1VU">
	<div class="Wxwduf">
<div class='WEQkZc'>
	<div class='title'><h3>Form Daftar</h3></div>
	<form method='post' class='form-regist'>
	<div class="form-group">
				<label class="control-label col-md-3">Email</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="email_pelanggan"  placeholder=' Contoh : admin99@mail.com' required>	
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Password</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="password_pelanggan" placeholder=' ******' required>	
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Nama</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="nama_pelanggan" placeholder=' contoh : Alex' required>	
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Telp / HP</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="telepon_pelanggan" placeholder=' +628319012321' required>	
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Alamat</label>
			<div class="col-md-7">
				<textarea class="form-control" name="alamat_pelanggan" placeholder=' Jakarta, Indonesia' required></textarea>	
			</div>
			</div>
			<div class="form-group">
			<div class="col-md-7 col-md-offset-3">
				<button class="btn-register" name="daftar">Daftar</button>
			</div>
			</div>
			<div class="col-md-7 col-md-offset-3">
				<button class="btn-register home" name="Beranda"><a href='index.php' class='home'>Beranda</button>
			</div>
			</div>
			<p style="color:#ccc;font-size:small;width:490px;" class="typography_xsmall__2NZHc">This site is protected by reCAPTCHA and the Google<!-- --> <a class="link_link__tEM4H" target="_blank" href="#">Privacy Policy</a> <!-- -->and<!-- --> <a class="link_link__tEM4H" target="_blank" href="#">Terms of Service</a> <!-- -->apply.</p>
			<p style="color:#ccc;font-size:small;width:490px;margin:0" class="typography_xsmall__2NZHc">You also agree to receive product-related marketing emails from This site, which you can unsubscribe from at any time.</p>
</form>
</div>
	</div>

</div>
	</div>
</div>
</div>

			<?php
			// jika ada tombol daftar ( ditekan tombol daftar)
			if (isset($_POST["daftar"]))
			{
				// mengambil isian nama,email,password,alamat,telepon
				$email = $_POST["email_pelanggan"];
				$password	= $_POST ["password_pelanggan"];
				$nama = $_POST ["nama_pelanggan"];
				$admin_telp	= $_POST ["telepon_pelanggan"];
				$admin_address	= $_POST ["alamat_pelanggan"];
		
				
				// cek apakah email sudah digunakan
				
				$cek =  mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '".$user."' AND password ='".MD5($pass)."'");
				$yangcocok = $ambil ->num_rows;
				if ($yangcocok==1)
				{
					echo "<script>alert('pendaftaran gagal, email sudah digunakan'); </script>";
					echo "<script>location='daftar.php'; </script>";
				}
				else {
					//query insert ke tabel pelanggan
					$sql=mysqli_query($conn,"INSERT INTO pelanggan( email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password', '$nama', '$admin_telp', '$admin_address') ");
								
					 echo "<script>alert('pendaftaran sukses, silahkan login'); </script>";
					echo "<script>location='login-pelanggan.php'; </script>";
				}
			}
			?>
</div>
</div>
</div>	
</div>	
</div>
</body>
</html>